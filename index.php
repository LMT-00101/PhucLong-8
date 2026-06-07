<?php
    ob_start();
    session_start();


    require_once __DIR__ . "/core/bootstrap.php";
    require_once __DIR__ . "/core/Router.php";

    // Controllers
    require_once __DIR__ . "/controllers/HomeController.php";
    require_once __DIR__ . "/controllers/ShopController.php";
    require_once __DIR__ . "/controllers/CartController.php";
    require_once __DIR__ . "/controllers/SearchController.php";
    require_once __DIR__ . "/controllers/BlogController.php";
    require_once __DIR__ . "/controllers/PageController.php";
    define('BASE_URL', 'index.php?url=');
    define('URL_MOMO', 'http://localhost/DUAN_TRASUA/cam-on');
    define('URL_ORDER', 'http://localhost/DUAN_TRASUA/don-hang');

    require_once "components/head.php";
    require_once "components/header.php";


    $router = new Router();

    $home = new HomeController();
    $shop = new ShopController();
    $cart = new CartController();
    $search = new SearchController();
    $blog = new BlogController();
    $page = new PageController();

    // Default + aliases
    $router->get('__home__', fn() => $home->index());
    $router->get('trang-chu', fn() => $home->index());

    // Catalog
    $router->get('cua-hang', fn() => $shop->index());
    $router->get('chitietsanpham', fn() => $shop->detail());
    $router->get('danh-muc-san-pham', fn() => $shop->byCategory());

    // Static pages
    $router->get('lien-he', fn() => $page->render('contact.php'));

    // Cart / checkout (kept as legacy views for now)
    $router->get('gio-hang', fn() => $cart->index());
    $router->get('thanh-toan', fn() => $page->render('checkout.php'));
    $router->get('thanh-toan-2', fn() => $page->render('checkout-address.php'));
    $router->get('thanh-toan-momo', fn() => $page->render('checkout/checkout_momo.php'));
    $router->get('thanh-toan-momo-address', fn() => $page->render('checkout/momo-address.php'));
    $router->get('thanh-toan-momo-address-2', fn() => $page->render('checkout/momo-address-2.php'));
    $router->get('thanh-toan-dia-chi2', fn() => $page->render('thanh-toan-dia-chi.php'));

    // Orders
    $router->get('cam-on', fn() => $page->thanks());
    $router->get('don-hang', fn() => $page->render('my-order.php'));
    $router->get('chi-tiet-don-hang', fn() => $page->render('my-orderdetails.php'));

    // Auth / user (legacy views)
    $router->get('dang-nhap', fn() => $page->render('user/login.php'));
    $router->get('dang-ky', fn() => $page->render('user/register.php'));
    $router->get('dang-xuat', function () {
        unset($_SESSION['user']);
        header("Location: index.php");
        exit;
    });
    $router->get('thong-tin-tai-khoan', fn() => $page->render('user/user-infor.php'));
    $router->get('ho-so', fn() => $page->render('user/edit-profile.php'));
    $router->get('them-dia-chi', fn() => $page->render('user/add-address.php'));
    $router->get('doi-mat-khau', fn() => $page->render('user/change-password.php'));
    $router->get('quen-mat-khau', fn() => $page->render('user/forgot-password.php'));
    $router->get('khoi-phuc-mat-khau', fn() => $page->render('user/password-recovery.php'));
    $router->get('remove-address', fn() => $page->render('remove-address.php'));

    // Blog
    $router->get('bai-viet', fn() => $blog->index());
    $router->get('chi-tiet-bai-viet', fn() => $blog->detail());
    $router->get('danh-muc-bai-viet', fn() => $blog->byCategory());

    // Search
    $router->get('tim-kiem', fn() => $search->index());

    // 404
    $router->get('__404__', fn() => $page->notFound());

    $router->dispatch($_GET['url'] ?? null);

    require_once "components/minicart.php";

    require_once "components/footer.php";


    
    ob_end_flush();
?>
<br>