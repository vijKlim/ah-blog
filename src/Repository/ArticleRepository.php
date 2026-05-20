<?php

namespace App\Repository;

use App\DTO\Article;
use PDO;

class ArticleRepository
{
    use HydrationTrait;
    public function __construct(private readonly PDO $connection)
    {
    }

    public function findById(int $id): ?Article
    {
        $statement = $this->connection->prepare(
        /** @lang MySQL */ '
            SELECT
                id,
                title,
                description,
                content,
                created_at,
                views,
                image
            FROM articles
            WHERE id = :id
            '
        );

        $statement->execute([
            'id' => $id,
        ]);

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function findRelated(int $articleId, int $limit = 3): array
    {
        $statement = $this->connection->prepare(
        /** @lang MySQL */ '
            SELECT DISTINCT
                a.id,
                a.title,
                a.description,
                a.content,
                a.created_at,
                a.views,
                a.image
            FROM articles a
            INNER JOIN article_category ac
                ON ac.article_id = a.id
            WHERE ac.category_id IN (
                SELECT category_id
                FROM article_category
                WHERE article_id = :source_article_id
            )
            AND a.id != :excluded_article_id
            ORDER BY a.created_at DESC
            LIMIT :limit
            '
        );

        $statement->bindValue('source_article_id', $articleId, PDO::PARAM_INT);
        $statement->bindValue('excluded_article_id', $articleId, PDO::PARAM_INT);
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateList($statement->fetchAll());
    }

    public function findLatestByCategory(
        int $categoryId,
        int $limit = 3,
    ): array {
        $statement = $this->connection->prepare(
        /** @lang MySQL */ '
            SELECT
                a.id,
                a.title,
                a.description,
                a.content,
                a.created_at,
                a.views,
                a.image
            FROM articles a
            INNER JOIN article_category ac
                ON ac.article_id = a.id
            WHERE ac.category_id = :category_id
            ORDER BY a.created_at DESC
            LIMIT :limit
            '
        );

        $statement->bindValue('category_id', $categoryId, PDO::PARAM_INT);
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateList($statement->fetchAll());
    }

    public function findByCategory(
        int $categoryId,
        string $sort,
        int $limit,
        int $offset,
    ): array {
        $orderBy = match ($sort) {
            'views' => 'a.views DESC',
            default => 'a.created_at DESC',
        };

        $statement = $this->connection->prepare(
        /** @lang MySQL */ "
            SELECT
                a.id,
                a.title,
                a.description,
                a.content,
                a.created_at,
                a.views,
                a.image
            FROM articles a
            INNER JOIN article_category ac
                ON ac.article_id = a.id
            WHERE ac.category_id = :category_id
            ORDER BY {$orderBy}
            LIMIT :limit OFFSET :offset
            "
        );

        $statement->bindValue('category_id', $categoryId, PDO::PARAM_INT);
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->bindValue('offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        return $this->hydrateList($statement->fetchAll());
    }

    public function countByCategory(int $categoryId): int
    {
        $statement = $this->connection->prepare(
        /** @lang MySQL */ '
            SELECT COUNT(*)
            FROM article_category
            WHERE category_id = :category_id
            '
        );

        $statement->execute([
            'category_id' => $categoryId,
        ]);

        return (int) $statement->fetchColumn();
    }

    public function incrementViews(int $id): void
    {
        $statement = $this->connection->prepare(
        /** @lang MySQL */ '
            UPDATE articles
            SET views = views + 1
            WHERE id = :id
            '
        );

        $statement->execute([
            'id' => $id,
        ]);
    }

    private function hydrate(array $row): Article
    {
        return new Article(
            id: (int) $row['id'],
            title: $row['title'],
            description: $row['description'],
            content: $row['content'],
            createdAt: $row['created_at'],
            views: (int) $row['views'],
            image: $row['image'],
        );
    }
}