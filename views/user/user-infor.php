<!-- User infor	 -->
<section class="coffee-account-section">
    <?php if (isset($_SESSION['user'])) {
        try {
            $loyaltyInfo = $LoyaltyModel->getLoyaltyInfo($_SESSION['user']['id']);
            $loyaltyTransactions = $LoyaltyModel->getRecentTransactions($_SESSION['user']['id'], 10);
            $loyaltyTiers = $LoyaltyModel->getAllTiers();
        } catch (Throwable $e) {
            $loyaltyInfo = [
                'total_points' => 0,
                'accumulated_points' => 0,
                'tier_id' => 1,
                'tier_name' => 'Member',
                'points_per_vnd' => 10000,
                'next_tier_name' => null,
                'points_to_next_tier' => null,
                'is_max_tier' => true,
            ];
            $loyaltyTransactions = [];
            $loyaltyTiers = [[
                'id' => 1,
                'name' => 'Member',
                'min_accumulated_points' => 0,
                'points_per_vnd' => 10000,
            ]];
        }
        $tierBadgeClass = LoyaltyModel::getTierBadgeClass($loyaltyInfo['tier_name']);
        $tierProgressPercent = 100;
        if (!$loyaltyInfo['is_max_tier'] && !empty($loyaltyTiers)) {
            $currentMin = 0;
            foreach ($loyaltyTiers as $t) {
                if ((int) $t['id'] === (int) $loyaltyInfo['tier_id']) {
                    $currentMin = (int) $t['min_accumulated_points'];
                    break;
                }
            }
            $nextMin = $currentMin + (int) $loyaltyInfo['points_to_next_tier'];
            $span = max(1, $nextMin - $currentMin);
            $tierProgressPercent = min(100, round(((int) $loyaltyInfo['accumulated_points'] - $currentMin) / $span * 100));
        }
    ?>
    <div class="container my-4">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thông tin tài khoản</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="upload/<?=$_SESSION['user']['image']?>" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 80px;">
                            <div class="ml-2">
                                <h6 class="my-2 font-weight-bold"></h6>
                                <a href="ho-so" style="opacity: 0.6;" class="text-dark font-weight-bold">Sửa hồ sơ</a>
                            </div>
                        </div>

                        <div class="row mt-2">

                            <div class="list-group col-12 p-0" style="border: none;">
                                <a href="index.php?url=thong-tin-tai-khoan"
                                    class="list-group-item list-group-item-action">

                                    Hồ sơ
                                </a>
                                <a href="index.php?url=don-hang" class="list-group-item list-group-item-action">Đơn
                                    mua</a>
                                <a href="index.php?url=doi-mat-khau" class="list-group-item list-group-item-action">Đổi
                                    mật khẩu</a>
                                <a href="index.php?url=dang-xuat" class="list-group-item list-group-item-action">Đăng
                                    xuất</a>

                            </div>


                        </div>


                    </div>
                </div>


            </div>
            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="font-weight-bold mb-3">Khách hàng thân thiết</h5>
                        <div class="d-flex flex-wrap align-items-center mb-3">
                            <span class="loyalty-tier-badge <?= $tierBadgeClass ?>"><?= htmlspecialchars($loyaltyInfo['tier_name']) ?></span>
                            <span class="text-muted ml-2 small">Cứ <?= number_format($loyaltyInfo['points_per_vnd']) ?>₫ = 1 điểm (theo hạng hiện tại)</span>
                        </div>
                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <p class="mb-0 text-muted small">Điểm hiện có</p>
                                <p class="mb-0 h5 text-danger font-weight-bold"><?= number_format($loyaltyInfo['total_points']) ?></p>
                            </div>
                            <div class="col-4">
                                <p class="mb-0 text-muted small">Điểm tích lũy</p>
                                <p class="mb-0 h5 font-weight-bold"><?= number_format($loyaltyInfo['accumulated_points']) ?></p>
                            </div>
                            <div class="col-4">
                                <p class="mb-0 text-muted small">Lên hạng tiếp</p>
                                <?php if ($loyaltyInfo['is_max_tier']) { ?>
                                <p class="mb-0 h6 text-success font-weight-bold">Đã đạt hạng cao nhất</p>
                                <?php } else { ?>
                                <p class="mb-0 h5 font-weight-bold"><?= number_format($loyaltyInfo['points_to_next_tier']) ?></p>
                                <p class="mb-0 small text-muted">điểm → <?= htmlspecialchars($loyaltyInfo['next_tier_name']) ?></p>
                                <?php } ?>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="font-weight-bold mb-3">A. Cách tính điểm</h6>
                        <p class="text-muted small mb-3">
                            Điểm được <strong>cộng tự động</strong> khi đơn hàng chuyển sang trạng thái
                            <span class="badge badge-success">Giao thành công</span> (hoàn thành).
                            Công thức: <code>điểm = tổng tiền đơn ÷ tỷ lệ VNĐ/điểm</code> (làm tròn xuống), theo hạng thành viên <strong>tại thời điểm hoàn thành đơn</strong>.
                        </p>
                        <div class="row">
                            <?php foreach ($loyaltyTiers as $tierRow) {
                                $isCurrentRate = ((int) $tierRow['id'] === (int) $loyaltyInfo['tier_id']);
                            ?>
                            <div class="col-6 col-md-3 mb-3">
                                <div class="card h-100 border <?= $isCurrentRate ? 'border-danger shadow-sm' : '' ?>">
                                    <div class="card-body text-center p-3">
                                        <span class="loyalty-tier-badge <?= LoyaltyModel::getTierBadgeClass($tierRow['name']) ?> mb-2"><?= htmlspecialchars($tierRow['name']) ?></span>
                                        <p class="mb-0 font-weight-bold text-danger"><?= number_format((int) $tierRow['points_per_vnd']) ?>₫</p>
                                        <p class="mb-0 small text-muted">= 1 điểm</p>
                                        <?php if ($isCurrentRate) { ?>
                                        <span class="badge badge-danger mt-2">Hạng của bạn</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="table-responsive d-none d-md-block mb-4">
                            <table class="table table-sm table-bordered loyalty-guide-table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Hạng</th>
                                        <th>Tỷ lệ tích điểm</th>
                                        <th>Ví dụ đơn 100.000₫</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($loyaltyTiers as $tierRow) {
                                        $examplePoints = (int) floor(100000 / max(1, (int) $tierRow['points_per_vnd']));
                                    ?>
                                    <tr class="<?= ((int) $tierRow['id'] === (int) $loyaltyInfo['tier_id']) ? 'table-active' : '' ?>">
                                        <td><span class="loyalty-tier-badge <?= LoyaltyModel::getTierBadgeClass($tierRow['name']) ?>"><?= htmlspecialchars($tierRow['name']) ?></span></td>
                                        <td><?= number_format((int) $tierRow['points_per_vnd']) ?>₫ / 1 điểm</td>
                                        <td class="text-success font-weight-bold">+<?= $examplePoints ?> điểm</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="font-weight-bold mb-3">B. Cách lên hạng</h6>
                        <p class="text-muted small mb-3">
                            Hạng được xét theo <strong>điểm tích lũy</strong> (chỉ cộng, không trừ khi dùng điểm đổi quà).
                        </p>
                        <?php if (!$loyaltyInfo['is_max_tier']) { ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small mb-1">
                                <span>Tiến độ lên <strong><?= htmlspecialchars($loyaltyInfo['next_tier_name']) ?></strong></span>
                                <span><?= number_format($loyaltyInfo['accumulated_points']) ?> / <?= number_format($loyaltyInfo['accumulated_points'] + $loyaltyInfo['points_to_next_tier']) ?> điểm</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?= (int) $tierProgressPercent ?>%;" aria-valuenow="<?= (int) $tierProgressPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="small text-muted mt-1 mb-0">Còn <strong><?= number_format($loyaltyInfo['points_to_next_tier']) ?></strong> điểm tích lũy để lên <?= htmlspecialchars($loyaltyInfo['next_tier_name']) ?>.</p>
                        </div>
                        <?php } ?>
                        <div class="loyalty-tier-timeline">
                            <?php foreach ($loyaltyTiers as $index => $tierRow) {
                                $isCurrent = ((int) $tierRow['id'] === (int) $loyaltyInfo['tier_id']);
                                $isPassed = (int) $loyaltyInfo['accumulated_points'] >= (int) $tierRow['min_accumulated_points'];
                            ?>
                            <div class="loyalty-tier-step <?= $isCurrent ? 'loyalty-tier-step--current' : '' ?> <?= $isPassed ? 'loyalty-tier-step--passed' : '' ?>">
                                <div class="loyalty-tier-step__marker">
                                    <?php if ($isPassed && !$isCurrent) { ?><i class="fa fa-check"></i><?php } else { ?><?= $index + 1 ?><?php } ?>
                                </div>
                                <div class="loyalty-tier-step__body card border-0 shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <span class="loyalty-tier-badge <?= LoyaltyModel::getTierBadgeClass($tierRow['name']) ?>"><?= htmlspecialchars($tierRow['name']) ?></span>
                                            <?php if ($isCurrent) { ?>
                                            <span class="badge badge-danger">Bạn đang ở đây</span>
                                            <?php } ?>
                                        </div>
                                        <p class="mb-1 mt-2 small"><strong>Ngưỡng:</strong> <?= number_format((int) $tierRow['min_accumulated_points']) ?> điểm tích lũy</p>
                                        <p class="mb-0 small text-muted">Ưu đãi: <?= number_format((int) $tierRow['points_per_vnd']) ?>₫ = 1 điểm</p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <hr class="my-4">

                        <h6 class="font-weight-bold mb-2">Lịch sử điểm (10 gần nhất)</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0 loyalty-history-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Thời gian</th>
                                        <th>Đơn hàng</th>
                                        <th>Thay đổi</th>
                                        <th>Lý do</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($loyaltyTransactions)) { ?>
                                        <?php foreach ($loyaltyTransactions as $tx) { ?>
                                        <tr>
                                            <td><?= date('d/m/Y H:i', strtotime($tx['created_at'])) ?></td>
                                            <td><?= $tx['order_id'] ? '#' . (int) $tx['order_id'] : '—' ?></td>
                                            <td class="<?= (int) $tx['points_change'] >= 0 ? 'text-success' : 'text-danger' ?>">
                                                <?= (int) $tx['points_change'] >= 0 ? '+' : '' ?><?= number_format((int) $tx['points_change']) ?>
                                            </td>
                                            <td><?= htmlspecialchars(LoyaltyModel::getReasonLabel($tx['reason'])) ?></td>
                                        </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Chưa có giao dịch điểm</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Họ tên</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0"><?=$_SESSION['user']['full_name']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-5">
                                <p class=" mb-0"><?=$_SESSION['user']['email']?></p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Số điện thoại</p>
                            </div>
                            <div class="col-sm-5">

                                <p class=" mb-0"><?=$_SESSION['user']['phone']?></p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tên tài khoản</p>
                            </div>
                            <div class="col-sm-9">
                                <p class=" mb-0"><?=$_SESSION['user']['username']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Mật khẩu</p>
                            </div>
                            <div class="col-sm-5">

                                <p class=" mb-0">*********</p>
                            </div>

                            <div class="col-sm-3">
                                <a href="index.php?url=doi-mat-khau" class="text-primary mb-0">Thay đổi</a>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Đia chỉ 1</p>
                            </div>
                            <div class="col-sm-5">
                                <p class=" mb-0"><?=$_SESSION['user']['address']?></p>
                            </div>
                            <div class="col-sm-3">
                                <a href="index.php?url=them-dia-chi" class="text-primary mb-0">Thêm địa chỉ</a>
                            </div>
                        </div>
                        <hr>
                         <?php
                            $address = $AddressModel->select_address_user($_SESSION['user']['id']);
                        ?>
                        <?php
                            if(is_array($address)) {
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Đia chỉ 2</p>
                            </div>
                            <div class="col-sm-5">
                                
                                <p class=" mb-0"><?=$address['address']?></p>
                            </div>
                           
                        </div>
                        <hr>
                        <?php
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4 d-flex">

                                <a href="ho-so" class="btn btn-outline-dark btn-rounded mb-4">Sửa hồ sơ</a>
                                <a href="index.php?url=don-hang" class="btn btn-danger btn-rounded mb-4 ml-2">Đơn
                                    mua</a>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    } else {
    ?>
    <div class="container-fluid mt-5">
        <div class="row vh-100 rounded justify-content-center mx-0 pt-5">
            <div class="col-md-6 text-center">
                <h4 class="mb-4">Bạn chưa đăng nhập</h4>
                <p class="mb-4 text-dark">Mời bạn đăng nhập để sử dụng chức năng</p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=dang-nhap">Đăng nhập ngay</a>

            </div>
        </div>
    </div>
    <?php
    }
    ?>


</section>

<style>
p {
    color: #111;
    font-size: 16px;
}
.loyalty-tier-badge {
    display: inline-block;
    padding: 0.35rem 0.85rem;
    border-radius: 999px;
    font-weight: 700;
    font-size: 0.9rem;
    color: #fff;
}
.loyalty-badge-member {
    background: linear-gradient(135deg, #6c757d, #495057);
}
.loyalty-badge-silver {
    background: linear-gradient(135deg, #adb5bd, #868e96);
    color: #212529;
}
.loyalty-badge-gold {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
}
.loyalty-badge-platinum {
    background: linear-gradient(135deg, #6f42c1, #4e2a84);
}
.loyalty-history-table th,
.loyalty-history-table td,
.loyalty-guide-table th,
.loyalty-guide-table td {
    font-size: 14px;
    vertical-align: middle;
}
.loyalty-tier-timeline {
    position: relative;
    padding-left: 8px;
}
.loyalty-tier-step {
    display: flex;
    gap: 12px;
    margin-bottom: 12px;
    position: relative;
}
.loyalty-tier-step:not(:last-child)::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 36px;
    bottom: -12px;
    width: 2px;
    background: #dee2e6;
}
.loyalty-tier-step--passed:not(:last-child)::before {
    background: #28a745;
}
.loyalty-tier-step__marker {
    width: 32px;
    height: 32px;
    min-width: 32px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    font-weight: 700;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}
.loyalty-tier-step--passed .loyalty-tier-step__marker {
    background: #28a745;
    color: #fff;
}
.loyalty-tier-step--current .loyalty-tier-step__marker {
    background: #dc3545;
    color: #fff;
    box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.2);
}
.loyalty-tier-step__body {
    flex: 1;
}
@media (max-width: 575.98px) {
    .loyalty-tier-step__body .card-body {
        padding: 0.75rem !important;
    }
}
</style>
