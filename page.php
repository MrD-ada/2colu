<?php get_header(); ?>

<div class="container">
    <?php if (is_active_sidebar('ads-header')) : ?>
        <?php dynamic_sidebar('ads-header'); ?>
    <?php endif; ?>
    
    <div class="main-wrapper">
        <main class="main-content" role="main">
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                    <header class="post-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <time class="published" datetime="<?php echo get_the_date('c'); ?>">
                                最終更新: <?php echo get_the_modified_date('Y年m月d日'); ?>
                            </time>
                        </div>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( get_theme_mod('show_share_buttons_page', false) ) : ?>
                        <?php get_template_part('template-parts/share-buttons'); ?>
                    <?php endif; ?>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => '<div class="page-links">ページ: ', 'after' => '</div>')); ?>
                    </div>

                    <footer class="entry-footer">
                        <?php if ( get_theme_mod('show_share_buttons_page', false) ) : ?>
                            <?php get_template_part('template-parts/share-buttons'); ?>
                        <?php endif; ?>
                    </footer>
                </article>
                
                <?php
                // コメント（固定ページ用設定）
                if ( get_theme_mod('show_comments_page', false) ) :
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
