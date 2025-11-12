<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title post-title">', '</h1>' ); ?>
    </header><?php if ( has_post_thumbnail() ) : ?>
        <figure class="post-thumbnail">
            <?php the_post_thumbnail( 'full' ); ?>
        </figure>
    <?php endif; ?>

    <?php get_template_part( 'template-parts/share-buttons' ); ?>

    <div class="entry-content">
        <?php
        $content = get_the_content();
        $paragraphs = preg_split('/(<p>.*?<\/p>)/s', $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $mid_paragraph_index = ceil(count($paragraphs) / 2);

        foreach ($paragraphs as $index => $paragraph) {
            echo $paragraph;
            if ($index + 1 == $mid_paragraph_index) {
                // 本文中段の広告
                if ( is_active_sidebar( 'ads_single_mid' ) ) {
                    dynamic_sidebar( 'ads_single_mid' );
                }
            }
        }

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', '2colu' ),
            'after'  => '</div>',
        ) );
        ?>
    </div></article>```

#### `content-list.php`
記事一覧（リスト／グリッド）に表示される個々の記事カードのテンプレートです。

```php
<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-item-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail-wrapper">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium' ); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    </header><div class="entry-summary">
        <?php the_excerpt(); ?>
    </div></article>```

#### `share-buttons.php`
記事のシェアボタンを配置するテンプレートです。

```php
<div class="share-buttons">
    <p>記事をシェアする：</p>
    <ul>
        <li><a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank">Twitter</a></li>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">Facebook</a></li>
        <li><a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank">LINE</a></li>
    </ul>
</div>