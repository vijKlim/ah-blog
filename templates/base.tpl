<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$title|default:'Blog'}</title>
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<header class="site-header">
    <div class="container header-inner">
        <a href="/" class="logo">AH Blog</a>

        <nav class="navigation">
            <a href="/">Home</a>
        </nav>
    </div>
</header>

<main class="container main-content">
    {block name="content"}{/block}
</main>

<footer class="site-footer">
    <div class="container">
        Test blog application
    </div>
</footer>
</body>
</html>