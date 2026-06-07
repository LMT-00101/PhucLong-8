<?php

class ShopController extends Controller
{
    public function index(): void
    {
        global $ProductModel, $CategoryModel;

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $list_products = $ProductModel->select_list_products($page, 9);
        $list_catgories = $CategoryModel->select_all_categories();

        $this->view('shop.php', compact('page', 'list_products', 'list_catgories'));
    }

    public function detail(): void
    {
        global $ProductModel, $CategoryModel, $CommentModel;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_comment'])) {
            $user_id = $_POST['user_id'];
            $product_id = $_POST['product_id'];
            $content = $_POST['content'];
            $catgory_id = isset($_GET['id_dm']) ? $_GET['id_dm'] : '';
            $CommentModel->insert_comment($user_id, $product_id, $content);
            $link = 'index.php?url=chitietsanpham&id_sp=' . $product_id . '&id_dm=' . $catgory_id;
            header('Location: ' . $link);
            exit;
        }

        if (!isset($_GET['id_sp'])) {
            $this->view('productdetail.php');
            return;
        }

        $id_sp = $_GET['id_sp'];
        $id_danhmuc = $_GET['id_dm'] ?? '';

        $ProductModel->update_views($id_sp);
        $product_details = $ProductModel->select_products_by_id($id_sp);
        $similar_product = $ProductModel->select_products_similar($id_danhmuc);
        $name_catgoty = $CategoryModel->select_name_categories();
        $product_id = $id_sp;
        $list_comments = $CommentModel->select_comments_by_id($product_id);
        $discount_percentage = $ProductModel->discount_percentage(
            $product_details['price'] ?? 0,
            $product_details['sale_price'] ?? 0
        );

        $this->view('productdetail.php', compact(
            'id_sp',
            'id_danhmuc',
            'product_details',
            'similar_product',
            'name_catgoty',
            'product_id',
            'list_comments',
            'discount_percentage'
        ));
    }

    public function byCategory(): void
    {
        global $ProductModel, $CategoryModel;

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $category_id = $_GET['id'];
            $list_products = $ProductModel->select_products_by_cate($category_id);
        } else {
            header('Location: index.php');
            exit;
        }

        $list_catgories = $CategoryModel->select_all_categories();

        $this->view('shop-by-category.php', compact('category_id', 'list_products', 'list_catgories'));
    }
}
