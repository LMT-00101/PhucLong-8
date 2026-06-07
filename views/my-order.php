
<?php
    if(isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $perPage = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $page = max(1, $page);
        $totalOrders = $OrderModel->count_orders_by_user($user_id);
        $totalPages = max(1, (int) ceil($totalOrders / $perPage));
        if ($page > $totalPages) {
            $page = $totalPages;
        }
        $offset = ($page - 1) * $perPage;
        $list_orders = $OrderModel->select_list_orders_with_points($user_id, $perPage, $offset);

        function render_order_status_badge($status) {
            $status = (int) $status;
            if ($status === 4) {
                return '<span class="badge badge-success">Giao thành công</span>';
            }
            if ($status === 3) {
                return '<span class="badge badge-primary">Đang giao</span>';
            }
            if ($status === 2) {
                return '<span class="badge badge-info">Đã xác nhận</span>';
            }
            return '<span class="badge badge-warning text-dark">Chờ xác nhận</span>';
        }

        function render_order_points_cell($status, $pointsChange) {
            $status = (int) $status;
            if ($status !== 4) {
                return '<span class="text-muted">Chờ xác nhận</span>';
            }
            if ($pointsChange !== null && $pointsChange !== '' && (int) $pointsChange > 0) {
                return '<span class="text-success font-weight-bold">+' . number_format((int) $pointsChange) . ' điểm</span>';
            }
            return '<span class="text-muted">—</span>';
        }
?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="index.php?url=thong-tin-tai-khoan">Tài khoản</a>
                    <span>Đơn mua</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$hero_kicker = 'Đơn hàng';
$hero_title = 'Lịch sử mua hàng';
$hero_desc = 'Theo dõi trạng thái và chi tiết các đơn đã đặt.';
$hero_modifier = 'coffee-page-hero--orders';
include __DIR__ . '/../components/coffee-page-hero.php';
?>

<div class="coffee-orders-page">
<div class="container pt-4 pb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between">
            <h5 class="mb-0 font-weight-bold">Lịch sử đơn hàng</h5>
            <span class="text-muted small"><?= number_format($totalOrders) ?> đơn</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 my-orders-table">
                    <thead class="thead-light">
                        <tr>
                            <th class="d-none d-md-table-cell" style="width: 72px;">Ảnh</th>
                            <th>Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Điểm tích lũy</th>
                            <th style="width: 110px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_orders)) { ?>
                            <?php foreach ($list_orders as $orderRow) {
                                $date_formated = $BaseModel->date_format($orderRow['date'], '');
                            ?>
                            <tr>
                                <td class="d-none d-md-table-cell align-middle">
                                    <div class="my-order-thumb d-flex align-items-center justify-content-center">
                                        <?php if (!empty($orderRow['thumb_image'])) { ?>
                                        <img src="upload/<?= htmlspecialchars($orderRow['thumb_image']) ?>" alt="Sản phẩm">
                                        <?php } else { ?>
                                        <i class="fa fa-image text-muted"></i>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td class="align-middle font-weight-bold">#<?= (int) $orderRow['order_id'] ?></td>
                                <td class="align-middle"><?= $date_formated ?></td>
                                <td class="align-middle text-danger font-weight-bold"><?= number_format((int) $orderRow['total']) ?>₫</td>
                                <td class="align-middle"><?= render_order_status_badge($orderRow['status']) ?></td>
                                <td class="align-middle"><?= render_order_points_cell($orderRow['status'], $orderRow['points_change'] ?? null) ?></td>
                                <td class="align-middle text-right">
                                    <a href="index.php?url=chi-tiet-don-hang&id=<?= (int) $orderRow['order_id'] ?>" class="btn btn-sm btn-custom">Chi tiết</a>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">Bạn chưa có đơn hàng nào.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($totalPages > 1) { ?>
        <div class="card-footer bg-white d-flex flex-wrap align-items-center justify-content-between">
            <span class="text-muted small mb-2 mb-sm-0">Trang <?= $page ?> / <?= $totalPages ?></span>
            <nav aria-label="Phân trang đơn hàng">
                <ul class="pagination pagination-sm mb-0">
                    <?php if ($page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?url=don-hang&page=<?= $page - 1 ?>">Trước</a>
                    </li>
                    <?php } ?>
                    <?php if ($page < $totalPages) { ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?url=don-hang&page=<?= $page + 1 ?>">Xem thêm</a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <?php } ?>
    </div>
</div>
</div>

<?php
    } else {
?>
<div class="row coffee-page-spacer">
    <div class="col-lg-12 col-md-12">
        <div class="container-fluid mt-5">
            <div class="row rounded justify-content-center mx-0 pt-5">
                <div class="col-md-6 text-center">
                    <h4 class="mb-4">Vui lòng đăng nhập để có thể sử dụng chức năng</h4>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=dang-nhap">Đăng nhập</a>
                    <a class="btn btn-secondary rounded-pill py-3 px-5" href="index.php">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>

<style>
    .btn-custom {
        color: #555;
        background-color: #f6f6f6;
        border-color: rgba(0,0,0,.09);
    }
    .btn-custom:hover {
        background-color: #fff;
    }
    .my-orders-table th,
    .my-orders-table td {
        font-size: 14px;
        vertical-align: middle;
    }
    .my-order-thumb {
        width: 60px;
        height: 60px;
        overflow: hidden;
        border-radius: 6px;
        border: 1px solid #eee;
        background: #f8f9fa;
    }
    .my-order-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 767.98px) {
        .my-orders-table th,
        .my-orders-table td {
            font-size: 13px;
            padding: 0.5rem;
        }
    }
</style>
