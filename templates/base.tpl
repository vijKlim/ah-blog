<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$title|default:'Blogly'}</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<header class="site-header">
    <div class="container">
        <a href="/" class="logo">Blogly.</a>
    </div>
</header>

<main class="container main-content">
    {block name="content"}{/block}
</main>

<footer class="site-footer">
    <div class="container">
        Copyright ©2026. All Rights Reserved.
    </div>
</footer>
</body>
</html>