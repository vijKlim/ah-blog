<?php

namespace App\Service;

use App\DTO\Category;
use App\Repository\CategoryRepository;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository
    ) {
    }

    public function getCategoriesWithArticles(): array
    {
        return $this->categoryRepository->findAllWithArticles();
    }

    public function getCategory(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }
}