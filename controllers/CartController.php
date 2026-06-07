<?php

class CartController extends Controller
{
    public function index(): void
    {
        global $CartModel, $LoyaltyModel, $BaseModel;

        $success = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart']) && isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
            $product_id = $_POST['product_id'];
            $new_quantity = $_POST['quantity'];
            $index = 0;

            for ($i = 0; $i < count($product_id); $i++) {
                $id = $product_id[$i];
                $quantity = $new_quantity[$i];

                if ($quantity <= 0) {
                    $CartModel->delete_product_in_cart($id, $user_id);
                    $index += 1;
                } elseif ($quantity > 0) {
                    $CartModel->update_cart($quantity, $id, $user_id);
                }
            }

            if ($index > 0) {
                $success = 'Đã xóa ' . $index . ' sản phẩm ra khỏi giỏ hàng';
            } else {
                $success = 'Cập nhật thành công';
            }
        }

        if (isset($_GET['xoa']) && isset($_SESSION['user'])) {
            $cart_id = (int) $_GET['xoa'];
            $user_id = (int) $_SESSION['user']['id'];
            if ($cart_id > 0) {
                $CartModel->delete_cart_by_id_and_user($cart_id, $user_id);
                $success = 'Đã xóa 1 sản phẩm';
            }
        }

        $loyaltyPoints = null;
        $list_carts = [];
        $count_carts = 0;

        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
            $list_carts = $CartModel->select_all_carts($user_id);
            $count_carts = count($CartModel->count_cart($user_id));
            try {
                $loyaltyInfo = $LoyaltyModel->getLoyaltyInfo($user_id);
                $loyaltyPoints = (int) $loyaltyInfo['total_points'];
            } catch (Throwable $e) {
                // Do not block cart access when loyalty schema is unavailable.
                $loyaltyPoints = null;
            }
        }

        $this->view('cart.php', compact(
            'success',
            'error',
            'loyaltyPoints',
            'list_carts',
            'count_carts'
        ));
    }
}
