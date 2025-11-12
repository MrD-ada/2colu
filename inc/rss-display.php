<?php
/**
 * 外部RSSフィードを表示する関数
 *
 * @package 2colu
 */

function two_colu_display_rss_feed() {
    // RSS表示ウィジェットがアクティブでない場合は何もしない
    if ( ! is_active_sidebar( 'rss-widget' ) ) {
        return;
    }

    // WP_Feed_Cacheをロード
    if ( ! class_exists( 'WP_SimplePie_Cache_Base' ) ) {
        include_once( ABSPATH . WPINC . '/feed.php' );
    }

    // ここに表示するRSSフィードのURLと、表示件数を設定
    $rss_url = get_theme_mod( 'rss_feed_url', '' );
    $item_count = get_theme_mod( 'rss_feed_count', 5 );

    // URLが設定されていない場合は何もしない
    if ( empty( $rss_url ) ) {
        return;
    }

    // RSSフィードを取得
    $rss = fetch_feed( $rss_url );

    if ( ! is_wp_error( $rss ) ) {
        // フィードアイテムをセット
        $max_items = $rss->get_item_quantity( $item_count );
        $rss_items = $rss->get_items( 0, $max_items );
        ?>
        <div class="rss-feed-widget">
            <h3 class="widget-title"><?php echo esc_html( $rss->get_title() ); ?></h3>
            <div class="rss-items">
                <ul>
                    <?php
                    if ( $max_items == 0 ) {
                        echo '<li>' . esc_html__( 'No items to display.', '2colu' ) . '</li>';
                    } else {
                        foreach ( $rss_items as $item ) {
                            $title = $item->get_title();
                            $link = $item->get_permalink();
                            $date = $item->get_date( 'Y年n月j日' );
                            ?>
                            <li>
                                <a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer">
                                    <span class="rss-date"><?php echo esc_html( $date ); ?></span><br>
                                    <span class="rss-title"><?php echo esc_html( $title ); ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
    } else {
        echo '<div>' . esc_html__( 'RSS Feed Error.', '2colu' ) . '</div>';
    }
}
add_action( 'dynamic_sidebar_rss-widget', 'two_colu_display_rss_feed' );