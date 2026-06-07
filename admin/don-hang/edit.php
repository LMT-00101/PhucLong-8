<?php
    if(isset($_GET['id']) && $_GET['id'] >0) {
        $order_id = $_GET['id'];
    }else {

    }
    $order_details = $OrderModel->getFullOrderInformation($order_id);
    foreach ($order_details as $value) {
        extract($value);
    }

    function getOrderStatusName($statusValue) {
        switch ((int) $statusValue) {
            case 1: return 'Chờ xác nhận';
            case 2: return 'Đã xác nhận';
            case 3: return 'Đang giao';
            case 4: return 'Giao thành công';
            default: return 'Không xác định';
        }
    }

    function getOrderStatusBadgeClass($statusValue) {
        switch ((int) $statusValue) {
            case 4: return 'bg-success';
            case 3: return 'bg-primary';
            case 2: return 'bg-info text-dark';
            case 1: return 'bg-warning text-dark';
            default: return 'bg-secondary';
        }
    }

    $order_status = getOrderStatusName($status);
    $date_formated = $BaseModel->date_format($order_date, '');
    $statusBadgeClass = getOrderStatusBadgeClass($status);
    $isOrderCompleted = ((int) $status === 4);

    $orderSubtotal = 0;
    foreach ($order_details as $line) {
        $orderSubtotal += (int) $line['price'] * (int) $line['quantity'];
    }

    require_once dirname(__DIR__, 2) . '/models/LoyaltyModel.php';
    $loyaltyAdmin = new LoyaltyModel();
    $orderPointsRow = pdo_query_one(
        "SELECT points_change FROM points_transactions
         WHERE order_id = ? AND reason = 'order_completed'",
        $order_id
    );
    $customerLoyalty = $loyaltyAdmin->getLoyaltyInfo((int) $user_id);
    $customerTierBadge = LoyaltyModel::getTierBadgeClass($customerLoyalty['tier_name']);

    $orderPointsEarned = 0;
    if ($isOrderCompleted && is_array($orderPointsRow) && !empty($orderPointsRow['points_change'])) {
        $orderPointsEarned = (int) $orderPointsRow['points_change'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_status_order"])) {
        $status = $_POST["status"];
        $order_id = $_POST["order_id"];
        $OrderModel->update_status_order($status, $order_id);
        header("Location: index.php?quanli=cap-nhat-don-hang&id=$order_id");
    }

?>

<div class="container-fluid pt-4 px-4">
    <div class="mb-3">
        <h6 class="mb-0">
            <a href="index.php?quanli=danh-sach-don-hang" class="link-not-hover">Đơn hàng</a>
            / Chi tiết đơn hàng #<?= (int) $order_id ?>
        </h6>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card shadow-sm rounded border-0 mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 text-dark">Sản phẩm trong đơn</h6>
                </div>
                <div class="card-body p-0 order-detail-table-scroll">
                    <table class="table table-bordered table-hover align-middle mb-0 order-detail-products-table">
                        <thead class="table-light">
                            <tr>
                                <th style="width:70px">Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th style="width:110px" class="text-end">Đơn giá</th>
                                <th style="width:60px" class="text-center">SL</th>
                                <th style="width:120px" class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $value) {
                                $lineTotal = (int) $value['price'] * (int) $value['quantity'];
                                $hasImage = !empty($value['product_image']);
                            ?>
                            <tr>
                                <td class="order-detail-col-image">
                                    <?php if ($hasImage) { ?>
                                    <div class="order-detail-product-img-wrap">
                                        <img src="../upload/<?= htmlspecialchars($value['product_image']) ?>" alt="<?= htmlspecialchars($value['product_name']) ?>">
                                    </div>
                                    <?php } else { ?>
                                    <div class="order-detail-product-img-placeholder" aria-hidden="true"></div>
                                    <?php } ?>
                                </td>
                                <td><?= htmlspecialchars($value['product_name']) ?></td>
                                <td class="text-end"><?= number_format((int) $value['price']) ?>₫</td>
                                <td class="text-center"><?= (int) $value['quantity'] ?></td>
                                <td class="text-end fw-semibold text-danger"><?= number_format($lineTotal) ?>₫</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Tổng cộng</td>
                                <td class="text-end fw-bold text-danger"><?= number_format($orderSubtotal) ?>₫</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm rounded border-0">
                <div class="card-header bg-white">
                    <h6 class="mb-0 text-dark">Thông tin giao hàng</h6>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Tên khách hàng</dt>
                        <dd class="col-sm-8 mb-2"><?= htmlspecialchars($full_name) ?></dd>

                        <dt class="col-sm-4">Số điện thoại</dt>
                        <dd class="col-sm-8 mb-2"><?= htmlspecialchars($order_phone) ?></dd>

                        <dt class="col-sm-4">Địa chỉ giao hàng</dt>
                        <dd class="col-sm-8 mb-2"><?= htmlspecialchars($order_address) ?></dd>

                        <dt class="col-sm-4">Ghi chú</dt>
                        <dd class="col-sm-8 mb-0"><?= $note !== '' ? nl2br(htmlspecialchars($note)) : '<span class="text-muted">Không có</span>' ?></dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm rounded border-0 mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 text-dark">Tổng quan đơn hàng</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-3">
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Mã đơn</span>
                            <strong>#<?= (int) $order_id ?></strong>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Ngày đặt</span>
                            <span><?= $date_formated ?></span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Trạng thái</span>
                            <span class="badge <?= $statusBadgeClass ?>"><?= htmlspecialchars($order_status) ?></span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tổng tiền hàng</span>
                            <span><?= number_format((int) $total) ?>₫</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Phí vận chuyển</span>
                            <span class="text-success">Miễn phí</span>
                        </li>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold">Tổng thanh toán</span>
                        <span class="fs-5 fw-bold text-danger"><?= number_format((int) $total) ?>₫</span>
                    </div>

                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <select name="status" class="form-select" id="floatingSelect">
                                <?php
                                foreach ([1, 2, 3, 4] as $option_value) {
                                    $selected = ($option_value == $status) ? 'selected' : '';
                                    echo "<option value='$option_value' $selected>" . getOrderStatusName($option_value) . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Cập nhật trạng thái</label>
                        </div>
                        <input type="hidden" name="order_id" value="<?= (int) $order_id ?>">
                        <button type="submit" name="update_status_order" class="btn btn-custom w-100">Cập nhật trạng thái</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm rounded border-0">
                <div class="card-header bg-white">
                    <h6 class="mb-0 text-dark">Điểm thưởng</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-2">Hạng thành viên hiện tại</p>
                    <p class="mb-3">
                        <span class="loyalty-tier-badge-admin <?= $customerTierBadge ?>"><?= htmlspecialchars($customerLoyalty['tier_name']) ?></span>
                    </p>

                    <?php if ($orderPointsEarned > 0) : ?>
                        <p class="mb-1 text-muted small">Điểm đã cộng cho đơn này</p>
                        <span class="badge bg-success fs-6">+<?= number_format($orderPointsEarned) ?> điểm</span>
                    <?php elseif ($isOrderCompleted) : ?>
                        <span class="badge bg-secondary">Chưa ghi nhận điểm</span>
                    <?php else : ?>
                        <span class="badge bg-secondary">Điểm sẽ được cộng khi đơn hoàn thành</span>
                    <?php endif; ?>

                    <hr class="my-3">
                    <p class="small text-muted mb-1">Điểm tích lũy khách</p>
                    <p class="mb-0 fw-semibold"><?= number_format($customerLoyalty['accumulated_points']) ?> điểm</p>
                </div>
            </div>
        </div>
    </div>
</div>
