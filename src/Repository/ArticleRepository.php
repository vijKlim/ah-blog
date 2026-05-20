<?php

namespace App\Repository;

use App\DTO\Article;

class ArticleRepository
{

    public function findById(int $id): ?Article
    {
        return $this->getFakeArticle();
    }

    public function findRelated(int $articleId): array
    {
        $related = [];

        for($i = 1; $i <= 5; $i++) {
            $related[] = $this->getFakeArticle();
        }

        return $related;
    }

    private function getFakeArticle(): Article
    {
        $faker = \Faker\Factory::create('ru_RU');
        return new Article(
            1,
            $faker->sentence(4),
            $faker->paragraph(),
            $faker->paragraph(5, true),
            $faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d H:i:s'),
            $faker->numberBetween(0, 1000),
            'https://picsum.photos/800/400?random='. $faker->numberBetween(0, 30)
        );
    }
}