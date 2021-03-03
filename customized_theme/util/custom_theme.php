<?php
/**
 * テーマカスタマイザー利用のサンプル
 */



//テーマカスタマイザーに追加
add_action('customize_register', function($wp_customize){

	//セクションを作る
	$wp_customize->add_section('mytheme_section', [
		'title' => '住所・電話番号の変更',
		'priority' => 100,
	]);

	//セクションに項目を追加
	$wp_customize->add_setting( 'telephone', [
		'default' => '',
	]);

	//項目の入力値をカスタマイズ
	$wp_customize->add_control( 'telephone', array(
		'section' => 'mytheme_section',
		'settings' => 'telephone',
		'label' =>'電話番号の設定',
		'description' => 'トップページに乗せる電話番号',
		'type' => 'input'
	));

	/* 項目ごとにadd_settingとadd_controlを作る */

	//セクションに項目を追加
	$wp_customize->add_setting( 'address', [
		'default' => '',
	]);

	//項目の入力値をカスタマイズ
	$wp_customize->add_control( 'address', array(
		'section' => 'mytheme_section',
		'settings' => 'address',
		'label' =>'住所の設定',
		'description' => 'トップページに乗せる住所',
		'type' => 'textarea'
	));

});