<?php get_header(); ?>

<div class="container">
    <?php if (is_active_sidebar('ads-header')) : ?>
        <div class="ads-area">
            <?php dynamic_sidebar('ads-header'); ?>
        </div>
    <?php endif; ?>
    
    <div class="main-wrapper">
        <main class="main-content" role="main">
            <?php if (is_active_sidebar('ads-list-top')) : ?>
                <div class="ads-area">
                    <?php dynamic_sidebar('ads-list-top'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (have_posts()) : ?>
                <div class="post-list">
                    <?php 
                    $post_count = 0;
                    while (have_posts()) : 
                        the_post(); 
                        $post_count++;
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post post-list-item'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail-list">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content-list">
                                <header class="post-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <div class="entry-meta">
                                        <time class="published" datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date('Y年m月d日'); ?>
                                        </time>
                                        <span class="categories">
                                            <?php the_category(', '); ?>
                                        </span>
                                        <?php if (function_exists('tcolu_get_post_views')) : ?>
                                            <span class="post-views">
                                                PV: <?php echo tcolu_get_post_views(get_the_ID()); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </header>
                                
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                    <p>
                                        <a href="<?php the_permalink(); ?>" class="more-link">
                                            続きを読む
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </article>
                        
                        <?php 
                        // 3件目の後に中段広告を表示
                        if ($post_count == 3 && is_active_sidebar('ads-list-mid')) : 
                        ?>
                            <div class="ads-area">
                                <?php dynamic_sidebar('ads-list-mid'); ?>
                            </div>
                        <?php endif; ?>
                        
                    <?php endwhile; ?>
                </div>
                
                <?php if (is_active_sidebar('ads-list-bottom')) : ?>
                    <div class="ads-area">
                        <?php dynamic_sidebar('ads-list-bottom'); ?>
                    </div>
                <?php endif; ?>
                
                <?php
                // ページネーション
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '&laquo; 前へ',
                    'next_text' => '次へ &raquo;',
                    'before_page_number' => '<span class="meta-nav screen-reader-text">ページ </span>',
                ));
                ?>
                
            <?php else : ?>
                <article class="post">
                    <header class="post-header">
                        <h2 class="entry-title">記事が見つかりませんでした</h2>
                    </header>
                    <div class="entry-content">
                        <p>申し訳ございませんが、お探しの記事は見つかりませんでした。</p>
                        <p>検索フォームから再度お試しください。</p>
                        <?php get_search_form(); ?>
                    </div>
                </article>
            <?php endif; ?>
        </main>
        
        <?php get_sidebar('right'); ?>
    </div>
</div>

<?php get_footer(); ?>