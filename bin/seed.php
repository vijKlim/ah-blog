<?php

declare(strict_types=1);

use App\Database\Connection;
use Dotenv\Dotenv;
use Faker\Factory;

require_once __DIR__ . '/../vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

$pdo = Connection::create();

$schema = file_get_contents(__DIR__ . '/../database/schema.sql');

if ($schema === false) {
    throw new RuntimeException('Cannot read database/schema.sql');
}

$pdo->exec($schema);

$pdo->exec('SET FOREIGN_KEY_CHECKS=0');
$pdo->exec('TRUNCATE TABLE article_category');
$pdo->exec('TRUNCATE TABLE articles');
$pdo->exec('TRUNCATE TABLE categories');
$pdo->exec('SET FOREIGN_KEY_CHECKS=1');

$faker = Factory::create('en_US');

$categories = [
    ['PHP', 'Articles about PHP, backend development and clean architecture.'],
    ['JavaScript', 'Frontend and backend JavaScript articles.'],
    ['Databases', 'Articles about MySQL, data modeling and SQL queries.'],
    ['DevOps', 'Docker, deployment and development environment notes.'],
];

$categoryIds = [];

foreach ($categories as [$title, $description]) {
    $stmt = $pdo->prepare(
        'INSERT INTO categories (title, description) VALUES (:title, :description)'
    );

    $stmt->execute([
        'title' => $title,
        'description' => $description,
    ]);

    $categoryIds[] = (int) $pdo->lastInsertId();
}

for ($i = 1; $i <= 40; $i++) {
    $stmt = $pdo->prepare(
        '
        INSERT INTO articles (
            title,
            description,
            content,
            created_at,
            views,
            image
        ) VALUES (
            :title,
            :description,
            :content,
            :created_at,
            :views,
            :image
        )
        '
    );

    $stmt->execute([
        'title' => $faker->sentence(5),
        'description' => $faker->paragraph(),
        'content' => implode("\n\n", $faker->paragraphs(6)),
        'created_at' => $faker
            ->dateTimeBetween('-3 months', 'now')
            ->format('Y-m-d H:i:s'),
        'views' => $faker->numberBetween(0, 1500),
        'image' => 'https://picsum.photos/800/400?random=' . $i,
    ]);

    $articleId = (int) $pdo->lastInsertId();

    $linkedCategories = $faker->randomElements(
        $categoryIds,
        $faker->numberBetween(1, 3)
    );

    foreach ($linkedCategories as $categoryId) {
        $stmt = $pdo->prepare(
            '
            INSERT INTO article_category (
                article_id,
                category_id
            ) VALUES (
                :article_id,
                :category_id
            )
            '
        );

        $stmt->execute([
            'article_id' => $articleId,
            'category_id' => $categoryId,
        ]);
    }
}

echo "Database seeded successfully.\n";