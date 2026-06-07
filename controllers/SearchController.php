<?php

class SearchController extends Controller
{
    public function index(): void
    {
        global $ProductModel, $CategoryModel;

        $list_products = '';

        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = trim($_GET['query']);
            $list_products = $ProductModel->search_products($query);
        }

        if (isset($_GET['from_price']) && isset($_GET['to_price'])) {
            $from_price = $_GET['from_price'];
            $to_price = $_GET['to_price'];
            $list_products = $ProductModel->search_products_by_price($from_price, $to_price);
        }

        $min_max_price = $ProductModel->get_min_max_prices();
        $list_catgories = $CategoryModel->select_all_categories();

        $this->view('search.php', compact('list_products', 'min_max_price', 'list_catgories'));
    }
}
