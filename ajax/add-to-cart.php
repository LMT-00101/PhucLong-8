<?php
    error_reporting(0);
    ob_start();

    define('PROJECT_ROOT', dirname(__DIR__));
    chdir(PROJECT_ROOT);

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    header('Content-Type: application/json; charset=utf-8');

    function cart_json_response($data, $code = 200) {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        http_response_code($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            cart_json_response(['success' => false, 'message' => 'Phuong thuc khong hop le'], 405);
        }

        require_once PROJECT_ROOT . '/models/pdo_library.php';
        require_once PROJECT_ROOT . '/models/CartModel.php';

        if (!isset($_SESSION['user'])) {
            cart_json_response([
                'success' => false,
                'login_required' => true,
                'message' => 'Vui long dang nhap de them vao gio hang'
            ]);
        }

        if (!isset($_POST['add_to_cart'])) {
            cart_json_response(['success' => false, 'message' => 'Thieu thong tin yeu cau']);
        }

        $product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
        $user_id = (int) $_SESSION['user']['id'];
        $product_name = trim($_POST['name'] ?? '');
        $product_price = isset($_POST['price']) ? (int) $_POST['price'] : 0;
        $product_quantity = isset($_POST['product_quantity']) ? (int) $_POST['product_quantity'] : 1;
        $product_image = trim($_POST['image'] ?? '');

        if ($product_id <= 0 || $product_name === '') {
            cart_json_response(['success' => false, 'message' => 'Thong tin san pham khong hop le']);
        }

        if ($product_quantity < 1) {
            cart_json_response(['success' => false, 'message' => 'So luong san pham khong duoc nho hon 1']);
        }

        $CartModel = new CartModel();
        $product = $CartModel->select_cart_by_id($product_id, $user_id);
        $addedQty = $product_quantity;

        if ($product && is_array($product)) {
            $new_quantity = (int) $product['product_quantity'] + $product_quantity;
            $CartModel->update_cart($new_quantity, $product_id, $user_id);
        } else {
            $CartModel->insert_cart($product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image);
        }

        $cart_count = count($CartModel->count_cart($user_id));

        cart_json_response([
            'success' => true,
            'product_name' => $product_name,
            'quantity' => $addedQty,
            'cart_count' => $cart_count,
            'message' => 'Da them vao gio hang',
        ]);
    } catch (Throwable $e) {
        cart_json_response(['success' => false, 'message' => 'Khong the them vao gio hang. Vui long thu lai.'], 500);
    }
