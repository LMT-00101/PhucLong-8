<?php

class BlogController extends Controller
{
    public function index(): void
    {
        global $PostModel;

        $list_posts = $PostModel->select_all_posts();
        $list_post_catgories = $PostModel->select_post_category();

        $this->view('blog/blogs.php', compact('list_posts', 'list_post_catgories'));
    }

    public function detail(): void
    {
        global $PostModel;

        $post_id = $_GET['id'] ?? 0;
        $post_details = $PostModel->select_post_by_id($post_id);
        $list_posts = $PostModel->select_all_posts();

        $this->view('blog/blog-details.php', compact('post_id', 'post_details', 'list_posts'));
    }

    public function byCategory(): void
    {
        global $PostModel;

        $category_id = $_GET['id'] ?? 0;
        $list_posts = $PostModel->select_post_by_catgory($category_id);
        $list_post_category = $PostModel->select_post_category();

        $this->view('blog/blog-by-category.php', compact('category_id', 'list_posts', 'list_post_category'));
    }
}
