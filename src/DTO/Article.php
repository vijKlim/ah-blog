<?php

namespace App\DTO;

class Article
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public string $content,
        public string $createdAt,
        public int $views,
        public ?string $image,
    ){
    }
}