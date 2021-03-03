<?php
/**
 * GuternbergにCSSを読み込むサンプル
 */


//エディタ用のCSSを読み込むコード
add_action( 'enqueue_block_editor_assets', function(){
	$editor_style_url = get_theme_file_uri('/css/editor.css');
	wp_enqueue_style('theme-editor-style', $editor_style_url);
});

