<?php

namespace App\Repository;

use App\DTO\Article;

class ArticleRepository
{

    public function findById(int $id): ?Article
    {
        return $this->getFakeArticle($id);
    }

    public function findRelated(int $articleId): array
    {
        $related = [];

        for($i = 1; $i <= 5; $i++) {
            $related[] = $this->getFakeArticle($i);
        }

        return $related;
    }

    public function findLatestByCategory(int $categoryId, int $limit): array
    {
        $articles = [];

        for ($i = 1; $i <= $limit; $i++) {
            $articles[] = $this->getFakeArticle($i);
        }

        return $articles;
    }

    public function findByCategory(
        int $categoryId,
        string $sort,
        int $limit,
        int $offset,
    ): array {

        $articles = [];

        for ($i = 1; $i <= 100; $i++) {
            $articles[] = $this->getFakeArticle($i);
        }

        usort(
            $articles,
            function (Article $left, Article $right) use ($sort): int {

                return match ($sort) {

                    'views' =>
                        $right->views <=> $left->views,

                    default =>
                        strtotime($right->createdAt)
                        <=>
                        strtotime($left->createdAt),
                };
            }
        );

        return array_slice(
            $articles,
            $offset,
            $limit,
        );
    }

    public function countByCategory(int $categoryId): int
    {
        return 100;
    }

    private function getFakeArticle(int $id): Article
    {
        $faker = \Faker\Factory::create('ru_RU');
        return new Article(
            $id,
            $faker->sentence(4),
            $faker->paragraph(),
            $faker->paragraph(5, true),
            $faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d H:i:s'),
            $faker->numberBetween(0, 1000),
            'https://picsum.photos/800/400?random='. $faker->numberBetween(0, 30)
        );
    }
}