<?php

class PageController extends Controller
{
    public function render(string $viewPath): void
    {
        $this->view($viewPath);
    }

    public function contact(): void
    {
        $this->view('contact.php');
    }

    public function thanks(): void
    {
        $this->view('thanks.php');
    }

    public function notFound(): void
    {
        $this->view('not-page.php');
    }
}
