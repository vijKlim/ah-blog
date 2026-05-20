<?php

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\Service\ArticleService;
use App\View\Renderer;

class ArticleController
{
    public function __construct(
        private readonly Renderer $renderer,
        private readonly ArticleService $articleService,
    ){
    }

    public function show(Request $request): Response
    {
        $articleId = (int)($request->query['id'] ?? 0);

        if ($articleId <= 0) {
            return new Response('Article id is required', 400);
        }

        $article = $this->articleService->getArticle($articleId);

        if (empty($article)) {
            return new Response('Article not found', 404);
        }

        $relatedArticles = $this->articleService->getRelatedArticles($articleId);

        return new Response(
            $this->renderer->render('article.tpl', [
                'title' => $article->title,
                'article' => $article,
                'relatedArticles' => $relatedArticles,
            ])
        );
    }
}