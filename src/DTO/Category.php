<?php

namespace App\DTO;

readonly class Category
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
    ){
    }
}