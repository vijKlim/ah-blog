{extends file="base.tpl"}

{block name="content"}
    <article class="article-page">
        {if $article->image}
            <img
                    src="{$article->image|escape}"
                    alt="{$article->title|escape}"
                    class="article-image"
            >
        {/if}

        <div class="article-content">
            <div class="article-meta">
                <span>{$article->createdAt|escape}</span>
                <span>{$article->views} views</span>
            </div>

            <h1>{$article->title|escape}</h1>

            <p class="article-description">
                {$article->description|escape}
            </p>

            <div class="article-text">
                {$article->content|escape|nl2br nofilter}
            </div>
        </div>
    </article>

    <section class="related-section">
        <div class="related-header">
            <h2>Related articles</h2>
        </div>

        {if $relatedArticles|count > 0}
            <div class="related-grid">
                {foreach $relatedArticles as $relatedArticle}
                    <article class="related-post">
                        {if $relatedArticle->image}
                            <a href="/article?id={$relatedArticle->id}">
                                <img
                                        src="{$relatedArticle->image|escape}"
                                        alt="{$relatedArticle->title|escape}"
                                >
                            </a>
                        {/if}

                        <h3>
                            <a href="/article?id={$relatedArticle->id}">
                                {$relatedArticle->title|escape}
                            </a>
                        </h3>

                        <div class="article-meta">
                            <span>{$relatedArticle->views} views</span>
                        </div>

                        <p>{$relatedArticle->description|truncate:140}</p>

                        <a href="/article?id={$relatedArticle->id}" class="read-more">
                            Continue Reading
                        </a>
                    </article>
                {/foreach}
            </div>
        {else}
            <p class="empty-message">No related articles found.</p>
        {/if}
    </section>
{/block}