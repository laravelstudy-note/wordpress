<?php
/*
 * サイドバーを複数登録するサンプル
 */

register_sidebar( array(
	'name' => 'サイドメニュー1',
	'id' => 'sidebar1',
	'before_widget' => '<div class=”widget”>',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
) );

register_sidebar( array(
	'name' => 'サイドメニュー2',
	'id' => 'sidebar2',
	'before_widget' => '<div class=”widget”>',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
) );
