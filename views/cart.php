<?php
    $success = $success ?? '';
    $error = $error ?? '';
    $list_carts = $list_carts ?? [];
    $count_carts = $count_carts ?? 0;
    $loyaltyPoints = $loyaltyPoints ?? null;
?>

<?php if(isset($_SESSION['user'])) { ?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="index.php?url=cua-hang"> Cửa hàng</a>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$hero_kicker = 'Giỏ hàng';
$hero_title = 'Đơn hàng của bạn';
$hero_desc = 'Kiểm tra món đã chọn và tiến hành thanh toán khi sẵn sàng.';
$hero_modifier = 'coffee-page-hero--cart';
include __DIR__ . '/../components/coffee-page-hero.php';
?>

<?php if(count($list_carts) > 0) {
    $totalPayment = 0;
    foreach ($list_carts as $c) {
        $totalPayment += (int) $c['product_price'] * (int) $c['product_quantity'];
    }
?>
<section class="cart-page-section spad">
    <div class="container">
        <?= $BaseModel->alert_error_success($error, $success) ?>

        <form action="" method="post" id="cart-form">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card cart-page-card shadow-sm mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 font-weight-bold">Giỏ hàng (<?= (int) $count_carts ?> sản phẩm)</h5>
                        </div>
                        <div class="card-body pt-0">
                            <?php foreach ($list_carts as $value) {
                                extract($value);
                                $totalPrice = (int) $product_price * (int) $product_quantity;
                                $product = $ProductModel->select_cate_in_product($product_id);
                                $productDetail = $ProductModel->select_products_by_id($product_id);
                                $shortDesc = is_array($productDetail) && !empty($productDetail['short_description'])
                                    ? $productDetail['short_description'] : '';
                            ?>
                            <div class="cart-page-item cart-item-row">
                                <a href="index.php?url=chitietsanpham&id_sp=<?= $product_id ?>&id_dm=<?= $product['category_id'] ?>" class="cart-page-item__img">
                                    <img src="upload/<?= htmlspecialchars($product_image) ?>" alt="<?= htmlspecialchars($product_name) ?>">
                                </a>
                                <div class="cart-page-item__body">
                                    <div class="cart-page-item__name">
                                        <a href="index.php?url=chitietsanpham&id_sp=<?= $product_id ?>&id_dm=<?= $product['category_id'] ?>" class="text-dark">
                                            <?= htmlspecialchars($product_name) ?>
                                        </a>
                                    </div>
                                    <?php if ($shortDesc !== '') { ?>
                                    <div class="cart-page-item__desc"><?= htmlspecialchars($shortDesc) ?></div>
                                    <?php } ?>
                                    <div class="cart-page-item__price"><?= number_format((int) $product_price) ?>đ / sản phẩm</div>
                                    <input type="hidden" name="product_id[]" value="<?= (int) $product_id ?>">
                                    <div class="mt-2">
                                        <div class="input-next-cart d-inline-flex align-items-center">
                                            <input type="button" value="-" class="button-minus btn btn-light btn-sm" data-field="quantity">
                                            <input type="number" min="1" step="1"
                                                value="<?= (int) $product_quantity ?>" name="quantity[]"
                                                class="quantity-field-cart form-control form-control-sm cart-qty-input text-center"
                                                data-unit-price="<?= (int) $product_price ?>">
                                            <input type="button" value="+" class="button-plus btn btn-light btn-sm" data-field="quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-page-item__actions">
                                    <div class="cart-page-item__line-total cart-line-total"><?= number_format($totalPrice) ?>đ</div>
                                    <a href="index.php?url=gio-hang&xoa=<?= (int) $cart_id ?>" class="btn-cart-remove" title="Xóa sản phẩm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="index.php?url=cua-hang" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left mr-1"></i> Tiếp tục mua sắm
                            </a>
                            <button name="update_cart" type="submit" class="btn btn-outline-primary float-right d-none d-md-inline-block">
                                Cập nhật giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card cart-page-card shadow-sm cart-page-summary">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 font-weight-bold">Tóm tắt đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="summary-row">
                                <span class="text-muted">Tạm tính</span>
                                <span id="cart-subtotal"><?= number_format($totalPayment) ?>đ</span>
                            </div>
                            <div class="summary-row">
                                <span class="text-muted">Phí vận chuyển</span>
                                <span class="text-success">Miễn phí</span>
                            </div>
                            <?php if ($loyaltyPoints !== null) { ?>
                            <div class="summary-row border-top pt-2 mt-2">
                                <span class="text-muted">Điểm thưởng của bạn</span>
                                <span class="text-danger font-weight-bold"><?= number_format($loyaltyPoints) ?> điểm</span>
                            </div>
                            <?php } ?>
                            <hr>
                            <div class="summary-row align-items-center mb-3">
                                <span class="font-weight-bold">Tổng cộng</span>
                                <span class="summary-total" id="cart-grand-total"><?= number_format($totalPayment) ?>đ</span>
                            </div>
                            <a href="index.php?url=thanh-toan" class="btn btn-cart-checkout btn-block mb-2">Đặt hàng</a>
                            <a href="index.php?url=thanh-toan-momo" class="btn btn-outline-danger btn-block">Thanh toán MoMo</a>
                            <button name="update_cart" type="submit" class="btn btn-link btn-block btn-sm text-muted d-md-none mt-2">
                                Cập nhật giỏ hàng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php } else { ?>
<section class="cart-page-section spad">
    <div class="container">
        <div class="card cart-page-card shadow-sm">
            <div class="cart-page-empty">
                <i class="fa fa-shopping-cart d-block"></i>
                <h4 class="mb-2">Giỏ hàng của bạn đang trống</h4>
                <p class="text-muted mb-4">Hãy khám phá menu và thêm món yêu thích nhé!</p>
                <a href="index.php?url=cua-hang" class="btn btn-cart-checkout px-4">Tiếp tục mua sắm</a>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php } else { ?>
<div class="row coffee-page-spacer">
    <div class="col-lg-12 col-md-12">
        <div class="container-fluid mt-5">
            <div class="row rounded justify-content-center mx-0 pt-5">
                <div class="col-md-6 text-center">
                    <h4 class="mb-4">Vui lòng đăng nhập để có thể mua hàng</h4>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=dang-nhap">Đăng nhập</a>
                    <a class="btn btn-secondary rounded-pill py-3 px-5" href="index.php">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<style>
.cart-qty-input {
    width: 70px;
    margin: 0 4px;
}
.cart-qty-input::-webkit-outer-spin-button,
.cart-qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.cart-qty-input[type=number] {
    -moz-appearance: textfield;
}
</style>

<script>
(function($) {
    function normalizeCartQty($input) {
        var val = parseInt($input.val(), 10);
        if (isNaN(val) || val < 1) val = 1;
        $input.val(val);
        return val;
    }
    function formatVnd(amount) {
        return amount.toLocaleString('vi-VN') + 'đ';
    }
    function updateCartTotals() {
        var grand = 0;
        $('.cart-page-section .cart-item-row').each(function() {
            var $row = $(this);
            var $input = $row.find('.cart-qty-input');
            var qty = normalizeCartQty($input);
            var price = parseInt($input.data('unit-price'), 10) || 0;
            var line = qty * price;
            $row.find('.cart-line-total').text(formatVnd(line));
            grand += line;
        });
        $('#cart-grand-total, #cart-subtotal').text(formatVnd(grand));
    }
    function submitCartUpdate() {
        var $form = $('#cart-form');
        if (!$form.length) return;
        $form.find('button[name="update_cart"]').first().trigger('click');
    }
    $('.cart-page-section').on('blur', '.cart-qty-input', function() {
        normalizeCartQty($(this));
        updateCartTotals();
        submitCartUpdate();
    });
    $('.cart-page-section').on('keydown', '.cart-qty-input', function(e) {
        if (e.key !== 'Enter') return;
        e.preventDefault();
        normalizeCartQty($(this));
        updateCartTotals();
        submitCartUpdate();
    });
    $('.cart-page-section').on('change', '.cart-qty-input', function() {
        normalizeCartQty($(this));
        updateCartTotals();
    });
    $('.cart-page-section').on('click', '.button-plus, .button-minus', function() {
        setTimeout(function() {
            var $input = $(this).closest('.input-next-cart').find('.cart-qty-input');
            normalizeCartQty($input);
            updateCartTotals();
        }.bind(this), 0);
    });
})(jQuery);
</script>
