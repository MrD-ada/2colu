<?php
/**
 * 2colu Theme Customizer.
 *
 * @package 2colu
 */

function two_colu_customize_register( $wp_customize ) {
	// パネルの追加
	$wp_customize->add_panel( 'two_colu_theme_options', array(
		'title'       => esc_html__( 'テーマ設定', '2colu' ),
		'description' => esc_html__( 'テーマの基本的な設定を行います。', '2colu' ),
		'priority'    => 160,
	) );
	
	// カラー設定セクションの追加
	$wp_customize->add_section( 'two_colu_color_settings', array(
		'title'    => esc_html__( 'カラー設定', '2colu' ),
		'priority' => 10,
		'panel'    => 'two_colu_theme_options',
	) );

	// 背景色の設定
	$wp_customize->add_setting( 'background_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label'    => esc_html__( 'グローバル背景色', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'background_color',
	) ) );

	// 文字色の設定
	$wp_customize->add_setting( 'text_color', array(
		'default'           => '#333333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
		'label'    => esc_html__( 'グローバル文字色', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'text_color',
	) ) );

	// アクセントカラーの設定
	$wp_customize->add_setting( 'accent_color', array(
		'default'           => '#e63946',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'    => esc_html__( 'アクセントカラー', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'accent_color',
	) ) );

	// リンクカラーの設定
	$wp_customize->add_setting( 'link_color', array(
		'default'           => '#e63946',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'    => esc_html__( 'リンクカラー', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'link_color',
	) ) );
	
	// ヘッダー背景色の設定
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'    => esc_html__( 'ヘッダー背景色', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'header_background_color',
	) ) );

	// ヘッダー文字色の設定
	$wp_customize->add_setting( 'header_text_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
		'label'    => esc_html__( 'ヘッダー文字色', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'header_text_color',
	) ) );

	// フッター背景色の設定
	$wp_customize->add_setting( 'footer_background_color', array(
		'default'           => '#222222',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
		'label'    => esc_html__( 'フッター背景色', '2colu' ),
		'section'  => 'two_colu_color_settings',
		'settings' => 'footer_background_color',
	) ) );
}
add_action( 'customize_register', 'two_colu_customize_register' );

// カスタマイザーで設定された値をCSSに出力
function two_colu_customize_css() {
	?>
	<style type="text/css">
		body {
			background-color: <?php echo get_theme_mod( 'background_color', '#ffffff' ); ?>;
			color: <?php echo get_theme_mod( 'text_color', '#333333' ); ?>;
		}
		a {
			color: <?php echo get_theme_mod( 'link_color', '#e63946' ); ?>;
		}
		.site-header {
			background-color: <?php echo get_theme_mod( 'header_background_color', '#000000' ); ?>;
		}
		.site-branding,
		.site-branding a {
			color: <?php echo get_theme_mod( 'header_text_color', '#ffffff' ); ?>;
		}
		.site-footer {
			background-color: <?php echo get_theme_mod( 'footer_background_color', '#222222' ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'two_colu_customize_css' );