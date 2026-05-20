{extends file="base.tpl"}

{block name="content"}
    <article class="article-page card">
        {if $article->image}
            <img
                    src="{$article->image|escape}"
                    alt="{$article->title|escape}"
                    class="article-image"
            >
        {/if}

        <div class="article-content">
            <div class="article-meta">
                <span>Views: {$article->views}</span>
                <span>Published: {$article->createdAt|escape}</span>
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
        <h2>Related articles</h2>

        {if $relatedArticles|count > 0}
            <div class="article-grid">
                {foreach $relatedArticles as $relatedArticle}
                    <a href="/article?id={$relatedArticle->id}" class="related-card card">
                        {if $relatedArticle->image}
                            <img
                                    src="{$relatedArticle->image|escape}"
                                    alt="{$relatedArticle->title|escape}"
                            >
                        {/if}

                        <div class="related-card-content">
                            <span class="article-meta">Views: {$relatedArticle->views}</span>
                            <h3>{$relatedArticle->title|escape}</h3>
                            <p>{$relatedArticle->description|escape}</p>
                        </div>
                    </a>
                {/foreach}
            </div>
        {else}
            <p class="empty-message">No related articles found.</p>
        {/if}
    </section>
{/block}