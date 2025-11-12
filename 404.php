<?php get_header(); ?>

<div class="container">
    <div class="main-wrapper">
        <main class="main-content" role="main">
            <div class="error-404">
                <h1>404</h1>
                <h2>ページが見つかりません</h2>
                <p>お探しのページは見つかりませんでした。<br>
                   削除されたか、URLが間違っている可能性があります。</p>
                
                <div class="error-actions">
                    <div class="search-again">
                        <h3>サイト内検索</h3>
                        <?php get_search_form(); ?>
                    </div>
                    
                    <div class="popular-categories">
                        <h3>カテゴリーから探す</h3>
                        <?php
                        wp_list_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'show_count' => true,
                            'title_li' => '',
                            'number' => 8,
                        ));
                        ?>
                    </div>
                    
                    <div class="recent-posts-404">
                        <h3>新着記事</h3>
                        <?php
                        $recent_posts = new WP_Query(array(
                            'posts_per_page' => 5,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        
                        if ($recent_posts->have_posts()) :
                            echo '<ul>';
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                            endwhile;
                            echo '</ul>';
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    
                    <p style="margin-top: 30px;">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
                            ホームページに戻る
                        </a>
                    </p>
                </div>
            </div>
        </main>
        
        <?php get_sidebar('right'); ?>
    </div>
</div>

<?php get_footer(); ?>