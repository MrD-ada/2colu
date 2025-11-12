<?php
/**
 * Register widget areas.
 *
 * @package 2colu
 */

if ( ! function_exists( 'two_colu_widgets_init' ) ) :
	function two_colu_widgets_init() {
		// 右サイドバー
		register_sidebar( array(
			'name'          => esc_html__( '右サイドバー', '2colu' ),
			'id'            => 'sidebar-right',
			'description'   => esc_html__( '右サイドバーに表示されるウィジェットエリアです。', '2colu' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		
		// 広告ウィジェットエリア
		register_sidebar( array(
			'name'          => esc_html__( '広告：ヘッダー下', '2colu' ),
			'id'            => 'ads-header',
			'description'   => esc_html__( 'ヘッダー直下に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( '広告：記事タイトル上', '2colu' ),
			'id'            => 'ads-single-top',
			'description'   => esc_html__( '個別記事のタイトル直前に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( '広告：本文中段', '2colu' ),
			'id'            => 'ads-single-mid',
			'description'   => esc_html__( '個別記事の本文中間（自動挿入）に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '広告：記事下', '2colu' ),
			'id'            => 'ads-single-bottom',
			'description'   => esc_html__( '個別記事の本文直後に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( '広告：記事一覧上', '2colu' ),
			'id'            => 'ads-list-top',
			'description'   => esc_html__( '記事一覧ページの最上部に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '広告：記事一覧中段', '2colu' ),
			'id'            => 'ads-list-mid',
			'description'   => esc_html__( '記事一覧ページの中段（3件目後）に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( '広告：記事一覧下', '2colu' ),
			'id'            => 'ads-list-bottom',
			'description'   => esc_html__( '記事一覧ページの最下部に表示される広告エリアです。', '2colu' ),
			'before_widget' => '<div id="%1$s" class="ads-area ads-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="ads-title screen-reader-text">',
			'after_title'   => '</h4>',
		) );

		// フッターウィジェットエリア
		register_sidebar( array(
			'name'          => esc_html__( 'フッターウィジェット', '2colu' ),
			'id'            => 'footer-widget',
			'description'   => esc_html__( 'フッター部分に表示されるウィジェットエリアです。', '2colu' ),
			'before_widget' => '<section id="%1$s" class="footer-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'two_colu_widgets_init' );
endif;