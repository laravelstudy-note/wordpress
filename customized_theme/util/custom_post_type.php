<?php


//カスタム投稿タイプ + カスタムタクソノミーテスト用
add_action( 'init', function(){

	register_post_type( 'store', [ // 投稿タイプ名の定義
        'labels' => [
            'name'          => '店舗', // 管理画面上で表示する投稿タイプ名
            'singular_name' => '店舗',
			"all_items" => "店舗一覧",
			"add_new" => "店舗を追加"
        ],
        'public'        => true,  // 投稿タイプをpublicにするか
        'has_archive'   => true, // アーカイブ機能ON/OFF
        'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
		'menu_position' => 5, //「投稿」の下に追加
		'taxonomies' => ['store_cat']
	]);

	//カスタムタクソノミーを追加
	register_taxonomy(
        'store_cat',	//カスタムタクソノミー名
        'store',		//このタクソノミーが使われる投稿タイプ
        [
			'label' => '地域',
            'hierarchical' => true,	 //階層あり
			'show_in_rest' => true,  //Gutenberg で表示
            'rewrite' => true
		]
    );


});


//地域カテゴリーを管理画面に追加する
//カスタムタクソノミーのときはこれを入れておくだけで管理画面が便利になります！

//一覧の絞り込み機能に追加する
add_action( 'restrict_manage_posts', function($post_type){
    if ( 'store' == $post_type ) { // カスタム投稿タイプ 'store' の場合
        $term_slug = get_query_var( 'store_cat' );
        wp_dropdown_categories( array(
            'show_option_all'    => "全ての地域",
            'selected'           => $term_slug, // 絞り込んだあとそのタームが選択されている状態を維持
            'name'               => 'store_cat', // select の name 属性
            'taxonomy'           => 'store_cat', // カスタムタクソノミーのスラッグ
            'value_field'        => 'slug', // option の value属性の中身を何にするか
        ));
    }
});

//一覧に地域のカラムを追加する(見出しに追加)
//フィルター: manage_カスタム投稿種別ID_posts_columns
add_filter('manage_store_posts_columns', function($defaults){
	$defaults["store_cat"] = "地域";
	return $defaults;
});

//一覧に追加した地域カラムに値を表示
//フィルター: manage_カスタム投稿種別ID_posts_custom_column
add_action('manage_store_posts_custom_column',function($column_name, $id){
	
	if($column_name == "store_cat"){
		echo get_the_term_list($id, 'store_cat', '', '');
	}
}, 10, 2);
