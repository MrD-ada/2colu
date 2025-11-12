<?php
/**
 * 2colu テーマ機能設定
 */

// テーマサポート機能を有効化
function tcolu_theme_setup() {
    // 翻訳サポート
    load_theme_textdomain('2colu', get_template_directory() . '/languages');
    
    // タイトルタグサポート
    add_theme_support('title-tag');
    
    // アイキャッチ画像サポート
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(900, 400, true);
    
    // カスタム画像サイズ
    add_image_size('sidebar-thumb', 80, 60, true);
    add_image_size('grid-thumb', 300, 200, true);
    
    // RSS フィード
    add_theme_support('automatic-feed-links');
    
    // HTML5サポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    
    // メニューサポート
    register_nav_menus(array(
        'primary' => 'メインメニュー',
    ));
    
    // カスタムロゴサポート
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width'  => 240,
    ));
    
    // エディタースタイル
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
}
add_action('after_setup_theme', 'tcolu_theme_setup');

// スタイルシートとスクリプトの読み込み
function tcolu_scripts() {
    wp_enqueue_style('tcolu-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('noto-sans-jp', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap');
    
    wp_enqueue_script('tcolu-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // コメントフォーム用
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tcolu_scripts');

// ウィジェットエリアの登録
function tcolu_widgets_init() {
    // ヘッダー下広告
    register_sidebar(array(
        'name'          => 'ヘッダー下広告',
        'id'            => 'ads-header',
        'description'   => 'ヘッダー直下に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 記事タイトル上広告
    register_sidebar(array(
        'name'          => '記事タイトル上広告',
        'id'            => 'ads-single-top',
        'description'   => '記事タイトル上に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 記事本文中段広告
    register_sidebar(array(
        'name'          => '記事本文中段広告',
        'id'            => 'ads-single-mid',
        'description'   => '記事本文中間に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 記事下広告
    register_sidebar(array(
        'name'          => '記事下広告',
        'id'            => 'ads-single-bottom',
        'description'   => '記事本文直後に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 記事一覧上部広告
    register_sidebar(array(
        'name'          => '記事一覧上部広告',
        'id'            => 'ads-list-top',
        'description'   => '記事一覧最上部に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 記事一覧中段広告
    register_sidebar(array(
        'name'          => '記事一覧中段広告',
        'id'            => 'ads-list-mid',
        'description'   => '記事一覧途中（3件目後）に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 記事一覧下部広告
    register_sidebar(array(
        'name'          => '記事一覧下部広告',
        'id'            => 'ads-list-bottom',
        'description'   => '記事一覧最下部に表示される広告エリア',
        'before_widget' => '<div id="%1$s" class="widget ads-area %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // 右サイドバー
    register_sidebar(array(
        'name'          => '右サイドバー',
        'id'            => 'sidebar-right',
        'description'   => 'メイン右サイドバーエリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // フッターウィジェット
    register_sidebar(array(
        'name'          => 'フッターウィジェット',
        'id'            => 'footer-widget',
        'description'   => 'フッターエリアのウィジェット',
        'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'tcolu_widgets_init');

// 抜粋の長さをカスタマイズ
function tcolu_excerpt_length($length) {
    return 120;
}
add_filter('excerpt_length', 'tcolu_excerpt_length');

// 抜粋の「...」を変更
function tcolu_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'tcolu_excerpt_more');

// 本文中に広告を自動挿入
function tcolu_insert_ads_in_content($content) {
    if (is_single() && is_main_query()) {
        $ad_code = '';
        if (is_active_sidebar('ads-single-mid')) {
            ob_start();
            dynamic_sidebar('ads-single-mid');
            $ad_code = ob_get_clean();
        }
        
        if (!empty($ad_code)) {
            $paragraphs = explode('</p>', $content);
            $paragraph_count = count($paragraphs);
            
            // 記事の中間（50%位置）に広告を挿入
            $insert_position = floor($paragraph_count * 0.5);
            
            if ($paragraph_count > 3 && $insert_position > 1) {
                $paragraphs[$insert_position] .= $ad_code;
                $content = implode('</p>', $paragraphs);
            }
        }
    }
    return $content;
}
add_filter('the_content', 'tcolu_insert_ads_in_content');

// カスタムウィジェット: 人気記事
class Tcolu_Popular_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'tcolu_popular_posts',
            '人気記事',
            array('description' => 'PV数に基づく人気記事を表示')
        );
    }
    
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '人気記事';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        
        echo '<div class="widget-content">';
        echo '<ul class="popular-posts">';
        
        $popular_posts = new WP_Query(array(
            'posts_per_page' => $number,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_status' => 'publish'
        ));
        
        if ($popular_posts->have_posts()) {
            while ($popular_posts->have_posts()) {
                $popular_posts->the_post();
                echo '<li>';
                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '">';
                    the_post_thumbnail('sidebar-thumb');
                    echo '</a>';
                }
                echo '<div class="post-info">';
                echo '<div class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                echo '<div class="post-date">' . get_the_date('Y.m.d') . '</div>';
                echo '</div>';
                echo '</li>';
            }
            wp_reset_postdata();
        }
        
        echo '</ul>';
        echo '</div>';
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '人気記事';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">表示件数:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo esc_attr($number); ?>" size="3" min="1" max="15">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        return $instance;
    }
}

// カスタムウィジェット: 新着記事
class Tcolu_Recent_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'tcolu_recent_posts',
            '新着記事',
            array('description' => '最新の投稿を表示')
        );
    }
    
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '新着記事';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        
        echo '<div class="widget-content">';
        echo '<ul class="recent-posts">';
        
        $recent_posts = new WP_Query(array(
            'posts_per_page' => $number,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        ));
        
        if ($recent_posts->have_posts()) {
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                echo '<li>';
                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '">';
                    the_post_thumbnail('sidebar-thumb');
                    echo '</a>';
                }
                echo '<div class="post-info">';
                echo '<div class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
                echo '<div class="post-date">' . get_the_date('Y.m.d') . '</div>';
                echo '</div>';
                echo '</li>';
            }
            wp_reset_postdata();
        }
        
        echo '</ul>';
        echo '</div>';
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '新着記事';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">表示件数:</label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo esc_attr($number); ?>" size="3" min="1" max="15">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        return $instance;
    }
}

// ウィジェットを登録
function tcolu_register_widgets() {
    register_widget('Tcolu_Popular_Posts_Widget');
    register_widget('Tcolu_Recent_Posts_Widget');
}
add_action('widgets_init', 'tcolu_register_widgets');

// PV数をトラッキング
function tcolu_set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

// PV数を取得
function tcolu_get_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return "0";
    }
    return $count;
}

// 単一記事表示時にPV数をカウント
function tcolu_track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;    
    }
    tcolu_set_post_views($post_id);
}
add_action('wp_head', 'tcolu_track_post_views');

// クラシックエディタを優先
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// ウィジェット画面をクラシックモードにする（この行を追加）
add_filter('use_widgets_block_editor', '__return_false');

// または、WordPress 5.8以降のウィジェットブロックエディターを無効化する場合
function tcolu_disable_widget_block_editor() {
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'tcolu_disable_widget_block_editor');

// コメントの表示をカスタマイズ
function tcolu_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    
    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
        <br />
    <?php endif; ?>
    
    <div class="comment-meta commentmetadata">
        <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
            <?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?>
        </a>
        <?php edit_comment_link(__('(Edit)'), '  ', ''); ?>
    </div>
    
    <?php comment_text() ?>
    
    <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ('div' != $args['style']) : ?>
    </div>
    <?php endif; ?>
    <?php
}

// カスタマイザーの設定
function tcolu_customize_register($wp_customize) {
    // カラー設定セクション
    $wp_customize->add_section('tcolu_colors', array(
        'title' => 'カラー設定',
        'priority' => 30,
    ));
    
    // アクセントカラー
    $wp_customize->add_setting('accent_color', array(
        'default' => '#e63946',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => 'アクセントカラー',
        'section' => 'tcolu_colors',
        'settings' => 'accent_color',
    )));
    
    // ヘッダー背景色
    $wp_customize->add_setting('header_bg_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label' => 'ヘッダー背景色',
        'section' => 'tcolu_colors',
        'settings' => 'header_bg_color',
    )));
}
add_action('customize_register', 'tcolu_customize_register');

// カスタマイザーのCSS出力
function tcolu_customize_css() {

    $accent_color = get_theme_mod('accent_color', '#e63946');
    $header_bg_color = get_theme_mod('header_bg_color', '#000000');
    ?>
    <style type="text/css">
        :root {
            --accent-color: <?php echo esc_attr($accent_color); ?>;
            --header-bg-color: <?php echo esc_attr($header_bg_color); ?>;
        }
        
        .site-header {
            background-color: var(--header-bg-color);
        }
        
        a,
        .entry-meta a,
        .more-link {
            color: var(--accent-color);
        }
        
        a:hover,
        .entry-meta a:hover,
        .more-link:hover,
        .entry-title a:hover {
            color: <?php echo esc_attr(tcolu_adjust_brightness($accent_color, -30)); ?>;
        }
        
        .sidebar-right .widget-title,
        .main-navigation a:hover,
        .main-navigation .current_page_item > a,
        .pagination .current,
        .pagination a:hover,
        .search-form button,
        .entry-content h2 {
            background-color: var(--accent-color);
        }
        
        .entry-content h2 {
            border-left-color: var(--accent-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'tcolu_customize_css');

// 色の明度を調整する関数
function tcolu_adjust_brightness($hex, $percent) {
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }
    
    $decimal = hexdec($hex);
    
    $r = ($decimal >> 16) & 0xff;
    $g = ($decimal >> 8) & 0xff;
    $b = $decimal & 0xff;
    
    $r = max(0, min(255, $r + $percent));
    $g = max(0, min(255, $g + $percent));
    $b = max(0, min(255, $b + $percent));
    
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}

// フォールバックメニュー関数
function tcolu_fallback_menu() {
    echo '<ul id="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">ホーム</a></li>';
    wp_list_pages(array(
        'title_li' => '',
        'depth' => 1,
    ));
    wp_list_categories(array(
        'title_li' => '',
        'number' => 5,
    ));
    echo '</ul>';
}

// メニューにモバイルトグルボタンを追加
function tcolu_add_menu_toggle() {
    ?>
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        メニュー
    </button>
    <?php
}
add_action('wp_nav_menu_primary_items', 'tcolu_add_menu_toggle', 0);

// フッターにトップに戻るボタンを追加
function tcolu_back_to_top() {
    echo '<a href="#" class="back-to-top" style="display: none;">↑</a>';
}
add_action('wp_footer', 'tcolu_back_to_top');

// ブレッドクラム機能
function tcolu_breadcrumb() {
    if (is_front_page()) return;
    
    $delimiter = ' &gt; ';
    $home = 'ホーム';
    $before = '<span class="current">';
    $after = '</span>';
    
    echo '<div class="breadcrumb">';
    echo '<a href="' . get_option('home') . '">' . $home . '</a>' . $delimiter;
    
    if (is_category()) {
        $cat = get_category(get_query_var('cat'));
        if ($cat->parent != 0) {
            echo get_category_parents($cat->parent, TRUE, $delimiter);
        }
        echo $before . single_cat_title('', false) . $after;
        
    } elseif (is_search()) {
        echo $before . '検索結果: ' . get_search_query() . $after;
        
    } elseif (is_day()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
        echo $before . get_the_time('d') . $after;
        
    } elseif (is_month()) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
        echo $before . get_the_time('F') . $after;
        
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
        
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . get_option('home') . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter;
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category(); 
            if (!empty($cat)) {
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, $delimiter);
            }
            echo $before . get_the_title() . $after;
        }
        
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
        
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); 
        if (!empty($cat)) {
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, $delimiter);
        }
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . $delimiter;
        echo $before . get_the_title() . $after;
        
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
        
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo $crumb . $delimiter;
        echo $before . get_the_title() . $after;
        
    } elseif (is_tag()) {
        echo $before . single_tag_title('', false) . $after;
        
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . '投稿者: ' . $userdata->display_name . $after;
        
    } elseif (is_404()) {
        echo $before . 'ページが見つかりません' . $after;
    }
    
    if (get_query_var('paged')) {
        echo ' (ページ' . get_query_var('paged') . ')';
    }
    
    echo '</div>';
}

// OGP・Twitter Cards対応
function tcolu_add_ogp() {
    if (is_front_page() || is_home()) {
        $ogp_title = get_bloginfo('name');
        $ogp_description = get_bloginfo('description');
        $ogp_url = home_url();
        $ogp_image = get_template_directory_uri() . '/screenshot.png';
    } elseif (is_single()) {
        $ogp_title = get_the_title();
        $ogp_description = get_the_excerpt() ? wp_trim_words(get_the_excerpt(), 50) : wp_trim_words(get_the_content(), 50);
        $ogp_url = get_permalink();
        $ogp_image = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : get_template_directory_uri() . '/screenshot.png';
    } else {
        $ogp_title = wp_get_document_title();
        $ogp_description = get_bloginfo('description');
        $ogp_url = get_permalink();
        $ogp_image = get_template_directory_uri() . '/screenshot.png';
    }
    
    echo '<meta property="og:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($ogp_description) . '" />' . "\n";
    echo '<meta property="og:type" content="website" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url($ogp_url) . '" />' . "\n";
    echo '<meta property="og:image" content="' . esc_url($ogp_image) . '" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
    echo '<meta property="og:locale" content="ja_JP" />' . "\n";
    
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($ogp_description) . '" />' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($ogp_image) . '" />' . "\n";
}
add_action('wp_head', 'tcolu_add_ogp');

// セキュリティ強化
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// 絵文字スクリプトを無効化（パフォーマンス向上）
function tcolu_disable_emoji() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'tcolu_disable_emoji');

// 管理バー非表示（フロントエンド）
function tcolu_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'tcolu_remove_admin_bar');

// RSS フィードにアイキャッチ画像を含める
function tcolu_add_thumbnail_to_rss($content) {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = get_the_post_thumbnail($post->ID, 'medium') . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'tcolu_add_thumbnail_to_rss');
add_filter('the_content_feed', 'tcolu_add_thumbnail_to_rss');

// =============================
// 投稿・固定ページごとの表示設定
// =============================
function two_colu_customize_register($wp_customize) {
    $wp_customize->add_section('two_colu_display_settings', array(
        'title'    => '表示設定（投稿・固定ページ）',
        'priority' => 130,
    ));

    // 投稿ページ：コメント欄表示
    $wp_customize->add_setting('show_comments_single', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('show_comments_single_control', array(
        'label'    => '【投稿ページ】コメント欄を表示する',
        'section'  => 'two_colu_display_settings',
        'settings' => 'show_comments_single',
        'type'     => 'checkbox',
    ));

    // 投稿ページ：シェアボタン表示
    $wp_customize->add_setting('show_share_buttons_single', array(
        'default'   => true,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('show_share_buttons_single_control', array(
        'label'    => '【投稿ページ】SNSシェアボタンを表示する',
        'section'  => 'two_colu_display_settings',
        'settings' => 'show_share_buttons_single',
        'type'     => 'checkbox',
    ));

    // 固定ページ：コメント欄表示
    $wp_customize->add_setting('show_comments_page', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('show_comments_page_control', array(
        'label'    => '【固定ページ】コメント欄を表示する',
        'section'  => 'two_colu_display_settings',
        'settings' => 'show_comments_page',
        'type'     => 'checkbox',
    ));

    // 固定ページ：シェアボタン表示
    $wp_customize->add_setting('show_share_buttons_page', array(
        'default'   => false,
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('show_share_buttons_page_control', array(
        'label'    => '【固定ページ】SNSシェアボタンを表示する',
        'section'  => 'two_colu_display_settings',
        'settings' => 'show_share_buttons_page',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'two_colu_customize_register');
