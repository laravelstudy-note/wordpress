<?php


/* ウィジェットにページの自動生成機能を追加 */

function add_custom_widget() {

	//自動生成で作るページ一覧
	$pages_list = [
		["title" => "問い合わせ", "slug" => "contact"],
		["title" => "会社概要", "slug" => "about"],
	];

	foreach($pages_list as $page){
		$created = get_page_by_path($page["slug"]);
		if ( empty($created)) {
			echo $page["title"] . " - ✕ <br />";
		}else{
			echo $page["title"] . " - OK<br />";
		}
	}
	
}

function update_custom_widget(){

	// basic checks and save the widget settings here
	if(!empty($_POST)){
		if(isset($_POST["widget_id"]) && $_POST["widget_id"] == "custom_widget"){
			auto_create_pages();
		}
	}
 
	echo '<h3>ページの生成</h3>';

	add_custom_widget();

}

add_action( 'wp_dashboard_setup', function(){
	wp_add_dashboard_widget(
		'custom_widget',					//ウィジェットのID
		'マイテーマのカスタムウィジェット',		 //タイトル
		'add_custom_widget',				//表示する内容
		'update_custom_widget'
	);
});

//テーマが有効になったかどうか
function auto_create_pages(){

	//自動生成で作るページ一覧
	$pages_list = [
		["title" => "問い合わせ", "slug" => "contact"],
		["title" => "会社概要", "slug" => "about"],
	];

	foreach($pages_list as $page){
		$created = get_page_by_path($page["slug"]);
		if ( empty($created)) {
			//固定ページがなければ作成する
			$insert_id = wp_insert_post([
					'post_title'   => $page['title'],
					'post_name'    => $page['slug'],
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_content' => '',
			]);
		}
	}

}