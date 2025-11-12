<?php get_header(); ?>

<div id="primary" class="content-area container">
    <main id="main" class="site-main main-content">

    <?php 
    // 記事一覧上部の広告
    if ( is_active_sidebar( 'ads_list_top' ) ) {
        dynamic_sidebar( 'ads_list_top' );
    }
    ?>

    <?php if ( have_posts() ) : ?>
        <div class="post-list-grid-wrapper">
        <?php
        /* Start the Loop */
        $post_count = 0;
        while ( have_posts() ) :
            the_post();
            $post_count++;

            // ここをcontent-list.phpに修正しました
            get_template_part( 'template-parts/content-list', get_post_type() );
            
            // 3件目後の広告
            if ( $post_count == 3 && is_active_sidebar( 'ads_list_mid' ) ) {
                dynamic_sidebar( 'ads_list_mid' );
            }
        endwhile;
        ?>
        </div>
        
        <?php the_posts_navigation(); ?>
        
        <?php
        // 記事一覧下部の広告
        if ( is_active_sidebar( 'ads_list_bottom' ) ) {
            dynamic_sidebar( 'ads_list_bottom' );
        }
        ?>

    <?php else :
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>

    </main><?php get_sidebar( 'right' ); ?>
</div><?php get_footer(); ?>