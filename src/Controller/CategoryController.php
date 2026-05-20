<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\ArticleService;
use App\Service\CategoryService;
use App\Service\Pagination;
use App\View\Renderer;

readonly class CategoryController
{
    private const PER_PAGE = 5;

    public function __construct(
        private Renderer $renderer,
        private CategoryService $categoryService,
        private ArticleService $articleService,
    ){
    }

    public function show(Request $request): Response
    {
        $categoryId = (int) ($request->query['id'] ?? 0);

        if ($categoryId <= 0) {
            return new Response('Category id is required', 400);
        }

        $category = $this->categoryService->getCategory($categoryId);

        if ($category === null) {
            return new Response('Category not found', 404);
        }

        $sort = $request->query['sort'] ?? 'date';

        if (!in_array($sort, ['date', 'views'], true)) {
            $sort = 'date';
        }

        $page = max(1, (int) ($request->query['page'] ?? 1));

        $pager = new Pagination(
            totalCount: $this->articleService->countByCategory($categoryId),
            page: $page,
            perPage: self::PER_PAGE,
        );

        $articles = $this->articleService->getByCategory(
            categoryId: $categoryId,
            sort: $sort,
            limit: $pager->getLimit(),
            offset: $pager->getOffset(),
        );

        return new Response(
            $this->renderer->render('category.tpl', [
                'title' => $category->title,
                'category' => $category,
                'articles' => $articles,
                'pager' => $pager,
            ])
        );
    }
}