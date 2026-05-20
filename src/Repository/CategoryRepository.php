<?php

namespace App\Repository;

use App\DTO\Category;
use PDO;

class CategoryRepository
{
    public function __construct(
    ){
    }

    public function findAllWithArticles(): array
    {
        $categories = [];

        for ($i = 1; $i <= 15; $i++) {
            $categories[] = $this->getFakeCategory($i);
        }

        return $categories;
    }

    public function findById(int $id): ?Category
    {
        return $this->getFakeCategory($id);
    }

    private function getFakeCategory(int $id): Category
    {
        $faker = \Faker\Factory::create('ru_RU');
        return new Category(
            $id,
            $faker->sentence(4),
            $faker->paragraph(),
        );
    }
}