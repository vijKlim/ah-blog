<?php

namespace App\DTO;

class CategoryWithArticles
{
    public function __construct(
        public Category $category,
        /** @var Article[] */
        public array $articles,
    ) {
    }
}