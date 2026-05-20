<?php

namespace App\Controller;

use App\DTO\CategoryWithArticles;
use App\Http\Response;
use App\Service\ArticleService;
use App\Service\CategoryService;
use App\View\Renderer;

class HomeController
{
    public function __construct(
        private readonly Renderer $renderer,
        private readonly CategoryService $categoryService,
        private readonly ArticleService $articleService,
    ) {
    }

    public function index(): Response
    {
        $categories = $this->categoryService->getCategoriesWithArticles();
        $categoriesWithArticles = [];

        foreach ($categories as $category) {
            $categoriesWithArticles[] = new CategoryWithArticles(
                category: $category,
                articles: $this->articleService->getLatestByCategory($category->id, 3),
            );
        }

        return new Response(
            $this->renderer->render('home.tpl', [
                'title' => 'Blog',
                'categories' => $categoriesWithArticles,
            ])
        );
    }
}
