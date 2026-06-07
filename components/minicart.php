<?php
    $count_carts = 0;
    $list_minicarts = [];

    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $list_minicarts = $CartModel->select_mini_carts($user_id, 5);
        $count_carts = count($CartModel->count_cart($user_id));
    }

    $totalPayment = 0;
    foreach ($list_minicarts as $row) {
        $totalPayment += ($row['product_price'] * $row['product_quantity']);
    }
?>

<div class="minicart-overlay" id="minicart-overlay" aria-hidden="true"></div>

<aside class="shopping-cart" id="shopping-cart" aria-hidden="true">
    <div class="shopping-cart-header">
        <div class="shopping-cart-header__inner">
            <h2 class="shopping-cart-title">Giỏ hàng (<?= (int) $count_carts ?>)</h2>
            <button type="button" class="minicart-close" id="close-minicart" aria-label="Đóng giỏ hàng">&times;</button>
        </div>
    </div>

    <div class="shopping-cart-body">
        <?php if ($count_carts === 0) : ?>
            <p class="minicart-empty">Chưa có sản phẩm trong giỏ.<br><a href="index.php?url=cua-hang">Xem cửa hàng</a></p>
        <?php else : ?>
            <ul class="minicart-list">
                <?php foreach ($list_minicarts as $value) :
                    $product_name = htmlspecialchars($value['product_name']);
                    $product_image = htmlspecialchars($value['product_image']);
                    $product_price = (float) $value['product_price'];
                    $product_quantity = (int) $value['product_quantity'];
                ?>
                <li class="minicart-item">
                    <a href="index.php?url=gio-hang" class="minicart-item__thumb">
                        <img src="upload/<?= $product_image ?>" alt="<?= $product_name ?>">
                    </a>
                    <div class="minicart-item__info">
                        <a href="index.php?url=gio-hang" class="minicart-item__name"><?= $product_name ?></a>
                        <div class="minicart-item__meta">
                            <span class="price"><?= number_format($product_price) ?>đ</span>
                            <span> × <?= $product_quantity ?></span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="shopping-cart-footer">
        <div class="minicart-subtotal">
            <span>Tổng tạm tính</span>
            <span class="minicart-subtotal__amount"><?= number_format($totalPayment) ?>₫</span>
        </div>
        <div class="minicart-actions">
            <a href="index.php?url=gio-hang" class="btn-minicart btn-minicart--cart">Xem giỏ hàng</a>
            <a href="index.php?url=thanh-toan" class="btn-minicart btn-minicart--checkout">Thanh toán</a>
        </div>
        <?php if ($count_carts > 0) : ?>
            <p class="minicart-count-note"><?= (int) $count_carts ?> sản phẩm trong giỏ</p>
        <?php endif; ?>
    </div>
</aside>
