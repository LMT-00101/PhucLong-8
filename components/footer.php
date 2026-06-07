<!-- Instagram End -->
<div class="footer__divider"></div>
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./index.html"><img style="width: 100px;" src="upload/logo/logo-phuclong.png"
                                alt=""></a>
                    </div>
                    <p>Chào mừng bạn đến với cửa hàng trà sữa Phúc Long tươi ngon từng ly trà
                    </p>

                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>ĐƯỜNG DẪN</h6>
                    <ul>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>tÀI khoẢN</h6>
                    <ul>
                        <li><a href="#">Tài khoản của tôi</a></li>
                        <li><a href="#">Theo dõi đơn hàng</a></li>
                        <li><a href="#">Thủ tục thanh toán</a></li>
                        <li><a href="#">Danh sách yêu thích</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>BẢN TIN</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Theo dõi</button>
                    </form>
                    <div class="footer__payment">
                        <a href="#"><img src="public/img/payment/payment-1.png" alt=""></a>
                        <a href="#"><img src="public/img/payment/payment-2.png" alt=""></a>
                        <a href="#"><img src="public/img/payment/payment-3.png" alt=""></a>
                        <a href="#"><img src="public/img/payment/payment-4.png" alt=""></a>
                        <a href="#"><img src="public/img/payment/payment-5.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>
                        document.write(new Date().getFullYear());
                        </script> Thiết kế và phát triển bởi <i class="fa fa-heart" aria-hidden="true"></i> by <a
                            href="#" target="_blank">Lập trình viên</a></p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form action="index.php" method="get" class="search-model-form">
            <input type="hidden" name="url" value="tim-kiem">
            <input type="search" name="query" id="search-input" placeholder="TÌM KIẾM.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Toast -->
<!--
    Project đã có cơ chế toast riêng cho giỏ hàng:
    - `public/js/add-to-cart.js` + `components/cart-toast.php`
    Đoạn toastr bên dưới trước đây có thể tạo ra "toast nền đen" khó nhìn.
-->

<!-- Js Plugins -->

<script>
if (!window.jQuery) {
    document.write('<script src="public/js/jquery-3.3.1.min.js"><\/script>');
}
</script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/jquery.magnific-popup.min.js"></script>
<script src="public/js/jquery-ui.min.js"></script>
<script src="public/js/mixitup.min.js"></script>
<script src="public/js/jquery.countdown.min.js"></script>
<script src="public/js/jquery.slicknav.js"></script>
<script src="public/js/owl.carousel.min.js"></script>
<script src="public/js/jquery.nicescroll.min.js"></script>
<script src="public/js/main.js"></script>
<?php // require_once __DIR__ . '/cart-toast.php'; ?>
<script src="public/js/add-to-cart.js"></script>
<script src="public/js/navigation-guard.js"></script>

<script>
(function () {
    function enableLazyImages() {
        var images = document.querySelectorAll('img');
        for (var i = 0; i < images.length; i++) {
            if (!images[i].hasAttribute('loading')) {
                images[i].setAttribute('loading', 'lazy');
            }
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', enableLazyImages);
    } else {
        enableLazyImages();
    }
})();
</script>

<!-- dialogflow -->
<!-- <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
    intent="WELCOME"
    chat-title="Chat"
    agent-id="a111a74a-8334-4098-9636-0f1433d6fc97"
    language-code="vi"
></df-messenger> -->


</body>

</html>
