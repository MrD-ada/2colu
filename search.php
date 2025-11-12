<?php get_header(); ?>

<div class="container">
    <?php if (is_active_sidebar('ads-header')) : ?>
        <?php dynamic_sidebar('ads-header'); ?>
    <?php endif; ?>
    
    <div class="main-wrapper">
        <main class="main-content" role="main">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        printf(
                            '「%s」の検索結果',
                            '<span>' . get_search_query() . '</span>'
                        );
                        ?>
                    </h1>
                    <p class="search-results-count">
                        <?php
                        global $wp_query;
                        printf(
                            '%d件の記事が見つかりました',
                            $wp_query->found_posts
                        );
                        ?>
                    </p>
                </header>
                
                <?php if (is_active_sidebar('ads-list-top')) : ?>
                    <?php dynamic_sidebar('ads-list-top'); ?>
                <?php endif; ?>
                
                <?php 
                $post_count = 0;
                while (have_posts()) : 
                    the_post(); 
                    $post_count++;
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
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
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="entry-summary">
                            <?php 
                            // 検索キーワードをハイライト
                            $excerpt = get_the_excerpt();
                            $search_query = get_search_query();
                            if (!empty($search_query)) {
                                $excerpt = str_ireplace($search_query, '<mark>' . $search_query . '</mark>', $excerpt);
                            }
                            echo $excerpt;
                            ?>
                            <p>
                                <a href="<?php the_permalink(); ?>" class="more-link">
                                    続きを読む
                                </a>
                            </p>
                        </div>
                        
                        <?php get_template_part('template-parts/share-buttons'); ?>
                    </article>
                    
                    <?php 
                    // 3件目の後に中段広告を表示
                    if ($post_count == 3 && is_active_sidebar('ads-list-mid')) : 
                    ?>
                        <?php dynamic_sidebar('ads-list-mid'); ?>
                    <?php endif; ?>
                    
                <?php endwhile; ?>
                
                <?php if (is_active_sidebar('ads-list-bottom')) : ?>
                    <?php dynamic_sidebar('ads-list-bottom'); ?>
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
                        <h1 class="entry-title">
                            「<?php echo get_search_query(); ?>」に該当する記事は見つかりませんでした
                        </h1>
                    </header>
                    <div class="entry-content">
                        <p>お探しの内容が見つかりませんでした。</p>
                        <p>以下の方法で再度お試しください：</p>
                        <ul>
                            <li>別のキーワードで検索する</li>
                            <li>キーワードの一部を削って検索する</li>
                            <li>カテゴリーから記事を探す</li>
                        </ul>
                        
                        <div class="search-again">
                            <h3>再度検索</h3>
                            <?php get_search_form(); ?>
                        </div>
                        
                        <div class="popular-categories">
                            <h3>人気のカテゴリー</h3>
                            <?php
                            wp_list_categories(array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'show_count' => true,
                                'title_li' => '',
                                'number' => 10,
                            ));
                            ?>
                        </div>
                    </div>
                </article>
            <?php endif; ?>
        </main>
        
        <?php get_sidebar('right'); ?>
    </div>
</div>

<?php get_footer(); ?>