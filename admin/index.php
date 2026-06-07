<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['user_admin'])) {
        header("Location: login.php");
        exit();
    }
    require_once __DIR__ . "/core/bootstrap.php";
    require_once __DIR__ . "/controllers/AdminPageController.php";

    require_once "components/head.php";
    require_once "components/header.php";
    
    

    $router = new Router();
    $page = new AdminPageController();

    $router->get('__home__', fn() => $page->render('home.php'));

    $router->get('danh-sach-san-pham', fn() => $page->render('san-pham/list.php'));
    $router->get('them-san-pham', fn() => $page->render('san-pham/add.php'));
    $router->get('cap-nhat-san-pham', fn() => $page->render('san-pham/edit.php'));
    $router->get('thung-rac-san-pham', fn() => $page->render('san-pham/recycle-bin.php'));

    $router->get('danh-sach-danh-muc', fn() => $page->render('danh-muc/list.php'));
    $router->get('them-danh-muc', fn() => $page->render('danh-muc/add.php'));
    $router->get('cap-nhat-danh-muc', fn() => $page->render('danh-muc/edit.php'));

    $router->get('danh-sach-don-hang', fn() => $page->render('don-hang/list.php'));
    $router->get('danh-sach-don-cho', fn() => $page->render('don-hang/unconfirmed.php'));
    $router->get('cap-nhat-don-hang', fn() => $page->render('don-hang/edit.php'));

    $router->get('danh-sach-bai-viet', fn() => $page->render('bai-viet/list.php'));
    $router->get('them-bai-viet', fn() => $page->render('bai-viet/add.php'));
    $router->get('cap-nhat-bai-viet', fn() => $page->render('bai-viet/edit.php'));
    $router->get('danh-muc-bai-viet', fn() => $page->render('bai-viet/category.php'));
    $router->get('cap-nhat-danh-muc-bai-viet', fn() => $page->render('bai-viet/edit_catgory.php'));

    $router->get('dang-xuat', function () {
        unset($_SESSION['user_admin']);
        header("Location: login.php");
        exit;
    });

    $router->get('danh-sach-khach-hang', fn() => $page->render('khach-hang/list.php'));
    $router->get('them-tai-khoan', fn() => $page->render('khach-hang/add.php'));

    $router->get('binh-luan', fn() => $page->render('binh-luan/list.php'));
    $router->get('chi-tiet-binh-luan', fn() => $page->render('binh-luan/edit.php'));

    $router->get('thong-ke-san-pham', fn() => $page->render('thong-ke/products.php'));
    $router->get('thong-ke-don-hang', fn() => $page->render('thong-ke/orders.php'));
    $router->get('bieu-do-luot-ban', fn() => $page->render('thong-ke/chart-order.php'));
    $router->get('top-luot-ban', fn() => $page->render('thong-ke/top-orders.php'));
    $router->get('luot-ban-theo-ngay', fn() => $page->render('thong-ke/chart-order-date.php'));

    $router->get('xuat-exel', fn() => $page->render('export_exel/export_orders.php'));

    $router->get('kho-hang2', fn() => $page->render('kho-hang/list.php'));
    $router->get('kho-hang', fn() => $page->render('kho-hang/danhsach.php'));
    $router->get('them-hoa-don', fn() => $page->render('kho-hang/add.php'));

    $router->get('__404__', fn() => $page->render('components/404.php'));

    $router->dispatch($_GET['quanli'] ?? null);

    require_once "components/footer.php";


    
    ob_end_flush();
?>