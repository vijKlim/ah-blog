{extends file="base.tpl"}

{block name="content"}
    {foreach $categories as $item}
        <section class="home-category">
            <div class="home-category-header">
                <h2>{$item->category->title|escape}</h2>
                <a href="/category?id={$item->category->id}">View All</a>
            </div>

            <div class="home-posts">
                {foreach $item->articles as $article}
                    <article class="home-post">
                        <a href="/article?id={$article->id}">
                            <img src="{$article->image|escape}" alt="{$article->title|escape}">
                        </a>
                        <h3>
                            <a href="/article?id={$article->id}">{$article->title|escape}</a>
                        </h3>
                        <time>{$article->createdAt|escape}</time>
                        <p>{$article->description|truncate:160}</p>
                        <a href="/article?id={$article->id}" class="read-more">
                            Continue Reading
                        </a>
                    </article>
                {/foreach}
            </div>
        </section>
    {/foreach}
{/block}