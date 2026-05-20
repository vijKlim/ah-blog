<?php

namespace App\Service;

use App\DTO\Article;
use App\Repository\ArticleRepository;

class ArticleService
{
    private const COUNT_LATEST = 3;

    public function __construct(private ArticleRepository $articleRepository)
    {
    }

    public function getLatestByCategory(int $categoryId, int $limit = self::COUNT_LATEST): array
    {
        return [];
    }

    public function getByCategory(int $categoryId, string $sort, int $page, int $perPage): array
    {
        return [

        ];
    }

    public function getArticle(int $articleId): ?Article
    {
        return $this->articleRepository->findById($articleId);
    }

    public function getRelatedArticles(int $articleId): array
    {
        return $this->articleRepository->findRelated($articleId);
    }
}