<?php
    class LoyaltyModel {

        const ORDER_COMPLETED_STATUS = 4;
        const REASON_ORDER_COMPLETED = 'order_completed';

        public function getOrCreateLoyalty($customerId) {
            $loyalty = pdo_query_one(
                "SELECT cl.*, mt.name AS tier_name, mt.points_per_vnd, mt.min_accumulated_points
                 FROM customer_loyalty cl
                 JOIN membership_tiers mt ON cl.tier_id = mt.id
                 WHERE cl.customer_id = ?",
                $customerId
            );

            if ($loyalty) {
                return $loyalty;
            }

            pdo_execute(
                "INSERT INTO customer_loyalty (customer_id, total_points, accumulated_points, tier_id)
                 VALUES (?, 0, 0, 1)",
                $customerId
            );

            return $this->getOrCreateLoyalty($customerId);
        }

        public function hasPointsForOrder($orderId) {
            $count = pdo_query_value(
                "SELECT COUNT(*) FROM points_transactions
                 WHERE order_id = ? AND reason = ?",
                $orderId,
                self::REASON_ORDER_COMPLETED
            );

            return (int) $count > 0;
        }

        public function addPoints($customerId, $orderId, $orderAmount) {
            $orderId = (int) $orderId;
            $customerId = (int) $customerId;
            $orderAmount = (int) $orderAmount;

            if ($orderId <= 0 || $customerId <= 0 || $orderAmount <= 0) {
                return false;
            }

            if ($this->hasPointsForOrder($orderId)) {
                return false;
            }

            $loyalty = $this->getOrCreateLoyalty($customerId);
            $pointsPerVnd = (int) $loyalty['points_per_vnd'];

            if ($pointsPerVnd <= 0) {
                return false;
            }

            $pointsEarned = (int) floor($orderAmount / $pointsPerVnd);

            if ($pointsEarned <= 0) {
                return false;
            }

            $conn = pdo_get_connection();

            try {
                $conn->beginTransaction();

                $stmt = $conn->prepare(
                    "SELECT COUNT(*) FROM points_transactions
                     WHERE order_id = ? AND reason = ? FOR UPDATE"
                );
                $stmt->execute([$orderId, self::REASON_ORDER_COMPLETED]);

                if ((int) $stmt->fetchColumn() > 0) {
                    $conn->rollBack();
                    return false;
                }

                $stmt = $conn->prepare(
                    "UPDATE customer_loyalty
                     SET total_points = total_points + ?,
                         accumulated_points = accumulated_points + ?,
                         updated_at = NOW()
                     WHERE customer_id = ?"
                );
                $stmt->execute([$pointsEarned, $pointsEarned, $customerId]);

                if ($stmt->rowCount() === 0) {
                    $stmt = $conn->prepare(
                        "INSERT INTO customer_loyalty (customer_id, total_points, accumulated_points, tier_id)
                         VALUES (?, ?, ?, 1)"
                    );
                    $stmt->execute([$customerId, $pointsEarned, $pointsEarned]);
                }

                $stmt = $conn->prepare(
                    "INSERT INTO points_transactions (customer_id, order_id, points_change, reason)
                     VALUES (?, ?, ?, ?)"
                );
                $stmt->execute([$customerId, $orderId, $pointsEarned, self::REASON_ORDER_COMPLETED]);

                $conn->commit();
            } catch (PDOException $e) {
                if ($conn->inTransaction()) {
                    $conn->rollBack();
                }
                throw $e;
            }

            $this->checkAndUpgradeTier($customerId);

            return $pointsEarned;
        }

        public function checkAndUpgradeTier($customerId) {
            $loyalty = pdo_query_one(
                "SELECT accumulated_points, tier_id FROM customer_loyalty WHERE customer_id = ?",
                $customerId
            );

            if (!$loyalty) {
                return false;
            }

            $newTier = pdo_query_one(
                "SELECT id FROM membership_tiers
                 WHERE min_accumulated_points <= ?
                 ORDER BY min_accumulated_points DESC
                 LIMIT 1",
                $loyalty['accumulated_points']
            );

            if (!$newTier || (int) $newTier['id'] === (int) $loyalty['tier_id']) {
                return false;
            }

            pdo_execute(
                "UPDATE customer_loyalty SET tier_id = ?, updated_at = NOW() WHERE customer_id = ?",
                $newTier['id'],
                $customerId
            );

            return true;
        }

        public function getLoyaltyInfo($customerId) {
            $loyalty = $this->getOrCreateLoyalty($customerId);

            $nextTier = pdo_query_one(
                "SELECT id, name, min_accumulated_points
                 FROM membership_tiers
                 WHERE min_accumulated_points > ?
                 ORDER BY min_accumulated_points ASC
                 LIMIT 1",
                $loyalty['min_accumulated_points']
            );

            $pointsToNextTier = null;
            $nextTierName = null;

            if ($nextTier) {
                $pointsToNextTier = (int) $nextTier['min_accumulated_points'] - (int) $loyalty['accumulated_points'];
                if ($pointsToNextTier < 0) {
                    $pointsToNextTier = 0;
                }
                $nextTierName = $nextTier['name'];
            }

            return [
                'total_points' => (int) $loyalty['total_points'],
                'accumulated_points' => (int) $loyalty['accumulated_points'],
                'tier_id' => (int) $loyalty['tier_id'],
                'tier_name' => $loyalty['tier_name'],
                'points_per_vnd' => (int) $loyalty['points_per_vnd'],
                'next_tier_name' => $nextTierName,
                'points_to_next_tier' => $pointsToNextTier,
                'is_max_tier' => $nextTier === false || $nextTier === null,
            ];
        }

        public function getAllTiers() {
            return pdo_query(
                "SELECT id, name, min_accumulated_points, points_per_vnd
                 FROM membership_tiers
                 ORDER BY min_accumulated_points ASC"
            );
        }

        public function getRecentTransactions($customerId, $limit = 10) {
            $limit = max(1, min(50, (int) $limit));

            return pdo_query(
                "SELECT pt.*, o.order_id AS linked_order_id
                 FROM points_transactions pt
                 LEFT JOIN orders o ON pt.order_id = o.order_id
                 WHERE pt.customer_id = ?
                 ORDER BY pt.created_at DESC, pt.id DESC
                 LIMIT $limit",
                $customerId
            );
        }

        public static function getTierBadgeClass($tierName) {
            switch (strtolower($tierName)) {
                case 'silver':
                    return 'loyalty-badge-silver';
                case 'gold':
                    return 'loyalty-badge-gold';
                case 'platinum':
                    return 'loyalty-badge-platinum';
                default:
                    return 'loyalty-badge-member';
            }
        }

        public static function getReasonLabel($reason) {
            $labels = [
                'order_completed' => 'Hoàn thành đơn hàng',
                'redeem' => 'Đổi quà',
            ];

            return $labels[$reason] ?? $reason;
        }
    }

    $LoyaltyModel = new LoyaltyModel();
?>
