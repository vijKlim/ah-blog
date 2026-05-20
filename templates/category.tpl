{extends file="base.tpl"}

{block name="content"}
    <section class="category-page-header">
        <div>
            <h1>{$category->title|escape}</h1>
            <p>{$category->description|escape}</p>
        </div>

        <span>{$pager->getTotalCount()} articles</span>
    </section>

    <section class="category-toolbar">
        <div class="sort-links">
            <a href="/category?id={$category->id}&sort=date" class="{if $sort === 'date'}active{/if}">
                Newest
            </a>

            <a href="/category?id={$category->id}&sort=views" class="{if $sort === 'views'}active{/if}">
                Most viewed
            </a>
        </div>
    </section>

    {if $articles|count > 0}
        <div class="category-posts">
            {foreach $articles as $article}
                <article class="category-post">
                    {if $article->image}
                        <a href="/article?id={$article->id}" class="category-post-image">
                            <img src="{$article->image|escape}" alt="{$article->title|escape}">
                        </a>
                    {/if}

                    <div class="category-post-content">
                        <div class="article-meta">
                            <span>{$article->createdAt|escape}</span>
                            <span>{$article->views} views</span>
                        </div>

                        <h2>
                            <a href="/article?id={$article->id}">
                                {$article->title|escape}
                            </a>
                        </h2>

                        <p>{$article->description|truncate:220}</p>

                        <a href="/article?id={$article->id}" class="read-more">
                            Continue Reading
                        </a>
                    </div>
                </article>
            {/foreach}
        </div>
    {else}
        <p class="empty-message">No articles found.</p>
    {/if}

    {if $pager->getPagesCount() > 1}
        <nav class="pagination">
            {if $pager->hasPreviousPage()}
                <a href="/category?id={$category->id}&sort={$sort}&page={$pager->getPreviousPage()}">
                    Previous
                </a>
            {/if}

            {for $pageNumber=1 to $pager->getPagesCount()}
                <a href="/category?id={$category->id}&sort={$sort}&page={$pageNumber}"
                        class="{if $pageNumber === $pager->getPage()}active{/if}"
                >
                    {$pageNumber}
                </a>
            {/for}

            {if $pager->hasNextPage()}
                <a href="/category?id={$category->id}&sort={$sort}&page={$pager->getNextPage()}">
                    Next
                </a>
            {/if}
        </nav>
    {/if}
{/block}