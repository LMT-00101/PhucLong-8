<?php

class HomeController extends Controller
{
    public function index(): void
    {
        global $ProductModel, $CategoryModel;

        $listProducts = $ProductModel->select_products_limit(8);
        $listProductBanChay = $ProductModel->select_products_limit_banchay(8);
        $listCategories = $CategoryModel->select_categories_limit(8);
        $product_limit_3 = $ProductModel->select_products_limit(3);
        $product_order_by = $ProductModel->select_products_order_by(3, 'ASC');

        $this->view('home.php', compact(
            'listProducts',
            'listProductBanChay',
            'listCategories',
            'product_limit_3',
            'product_order_by'
        ));
    }
}
