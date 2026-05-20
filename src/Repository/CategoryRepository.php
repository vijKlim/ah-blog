<?php

namespace App\Repository;

use App\DTO\Category;
use PDO;

class CategoryRepository
{
    use HydrationTrait;

    public function __construct(private readonly PDO $connection)
    {
    }

    public function findAllWithArticles(): array
    {
        $sql = /** @lang MySQL */'
            SELECT DISTINCT c.id, c.title, c.description
            FROM categories c
            INNER JOIN article_category ac ON ac.category_id = c.id
            ORDER BY c.title
        ';

        return $this->hydrateList($this->connection->query($sql)->fetchAll());
    }

    public function findById(int $id): ?Category
    {
        $statement = $this->connection->prepare(
        /** @lang MySQL */'
            SELECT
                id,
                title,
                description
            FROM categories
            WHERE id = :id
            '
        );

        $statement->execute([
            'id' => $id,
        ]);

        $result = $statement->fetch();

        if ($result === false) {
            return null;
        }

        return $this->hydrate($result);
    }

    private function hydrate(array $row): Category
    {
        return new Category(
            id: (int)$row['id'],
            title: $row['title'],
            description: $row['description'],
        );
    }
}