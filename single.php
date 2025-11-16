<?php get_header(); ?>

<div class="container">
    <?php if (is_active_sidebar('ads-header')) : ?>
        <?php dynamic_sidebar('ads-header'); ?>
    <?php endif; ?>
    
    <div class="main-wrapper">
        <main class="main-content" role="main">
            <?php while (have_posts()) : the_post(); ?>
                
                <?php if (is_active_sidebar('ads-single-top')) : ?>
                    <?php dynamic_sidebar('ads-single-top'); ?>
                <?php endif; ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                    <header class="post-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta">
                            <time class="published" datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date('Y年m月d日'); ?>
                            </time>
                            <span class="author">投稿者: <?php the_author(); ?></span>
                            <span class="categories"><?php the_category(', '); ?></span>
                            <?php if (has_tag()) : ?>
                                <span class="tags"><?php the_tags('タグ: ', ', '); ?></span>
                            <?php endif; ?>
                            <?php if (function_exists('tcolu_get_post_views')) : ?>
                                <span class="post-views">PV: <?php echo tcolu_get_post_views(get_the_ID()); ?></span>
                            <?php endif; ?>
                        </div>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_theme_mod('show_share_buttons_single', true) ) : ?>
                        <?php get_template_part('template-parts/share-buttons'); ?>
                    <?php endif; ?>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => '<div class="page-links">ページ: ', 'after' => '</div>')); ?>
                    </div>
                    
                    <footer class="entry-footer">
                        <?php if ( get_theme_mod('show_share_buttons_single', true) ) : ?>
                            <?php get_template_part('template-parts/share-buttons'); ?>
                        <?php endif; ?>
                    </footer>
                </article>
                
                <?php if (is_active_sidebar('ads-single-bottom')) : ?>
                    <?php dynamic_sidebar('ads-single-bottom'); ?>
                <?php endif; ?>
                
                <?php
                // 関連記事
                $related_posts = new WP_Query(array(
                    'posts_per_page' => 6,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                    'category__in' => wp_get_post_categories(get_the_ID()),
                ));
                if ($related_posts->have_posts()) :
                ?>
                    <section class="related-posts">
                        <h3>関連記事</h3>
                        <div class="related-posts-grid">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <div class="related-post">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="related-post-thumbnail">
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('grid-thumb'); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="related-post-content">
                                        <h4 class="related-post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <div class="related-post-meta"><?php echo get_the_date('Y.m.d'); ?></div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </section>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                
                <?php
                // 前後ナビ
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                if ($prev_post || $next_post) :
                ?>
                    <nav class="post-navigation">
                        <?php if ($prev_post) : ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-previous">
                                <span class="nav-label">前の記事</span>
                                <span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if ($next_post) : ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-next">
                                <span class="nav-label">次の記事</span>
                                <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                            </a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
                
                <?php
                // コメント（投稿用設定）
                if ( get_theme_mod('show_comments_single', true) ) :
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endif;
                ?>
                
            <?php endwhile; ?>
        </main>
        
        <?php get_sidebar('right'); ?>
    </div>
</div>

<?php get_footer(); ?>