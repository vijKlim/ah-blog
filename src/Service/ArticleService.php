<?php

namespace App\Service;

use App\DTO\Article;
use App\Repository\ArticleRepository;

class ArticleService
{
    public const COUNT_LATEST = 3;

    public function __construct(private readonly ArticleRepository $articleRepository)
    {
    }

    public function getLatestByCategory(int $categoryId, int $limit = self::COUNT_LATEST): array
    {
        return $this->articleRepository->findLatestByCategory($categoryId, $limit);
    }

    public function getByCategory(
        int $categoryId,
        string $sort,
        int $limit,
        int $offset,
    ): array {
        return $this->articleRepository->findByCategory(
            $categoryId,
            $sort,
            $limit,
            $offset,
        );
    }

    public function countByCategory(
        int $categoryId,
    ): int {
        return $this->articleRepository
            ->countByCategory($categoryId);
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