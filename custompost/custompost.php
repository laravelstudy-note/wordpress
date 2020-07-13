<?php
/**
 * カスタム投稿タイプのサンプル
 */
add_action( 'init', 'create_post_type' );

$REQUIRE_CUSTOM_FIELD = true;

function create_post_type() {
   
	register_post_type( 'news', [ // 投稿タイプ名の定義
        'labels' => [
            'name'          => 'お知らせ', // 管理画面上で表示する投稿タイプ名
            'singular_name' => 'news',    // カスタム投稿の識別名
        ],
        'public'        => true,  // 投稿タイプをpublicにするか
        'has_archive'   => false, // アーカイブ機能ON/OFF
        'menu_position' => 5,     // 管理画面上での配置場所
        'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
	]);

	register_post_type( 'staff', [ // 投稿タイプ名の定義
        'labels' => [
            'name'          => 'スタッフ紹介', // 管理画面上で表示する投稿タイプ名
            'singular_name' => 'staff',    // カスタム投稿の識別名
        ],
        'public'        => true,  // 投稿タイプをpublicにするか
        'has_archive'   => false, // アーカイブ機能ON/OFF
        'menu_position' => 5,     // 管理画面上での配置場所
        'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
	]);
	
	register_post_type( 'shop', [ // 投稿タイプ名の定義
        'labels' => [
            'name'          => '店舗情報', // 管理画面上で表示する投稿タイプ名
            'singular_name' => 'shop',    // カスタム投稿の識別名
        ],
        'public'        => true,  // 投稿タイプをpublicにするか
        'has_archive'   => false, // アーカイブ機能ON/OFF
        'menu_position' => 5,     // 管理画面上での配置場所
        'show_in_rest'  => true,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
    ]);
}

/*

- single-staff.phpでの記述例

<?php
	// カスタムフィールドの値を取得
	$staff_name = get_post_meta($post->ID, "staff_name", true);
	$staff_text = get_post_meta($post->ID, "staff_text", true);
?>

<dl>
	<dt>スタッフ</dt>
	<dd><?php echo esc_html( $staff_name ); ?></dd>

	<dt>スタッフ紹介</dt>
	<dd><?php echo esc_html( $staff_text ); ?></dd>
</dl>


*/

if($REQUIRE_CUSTOM_FIELD){

	add_action( 'admin_menu', 'add_staff_custom_field' );
	add_action( 'save_post',  'save_staff_custom_field' );

}


function add_staff_custom_field() {
	add_meta_box( 'custom-staff_name', 'スタッフ名', 'create_staff_name', 'staff', 'normal' );
	add_meta_box( 'custom-staff_text', 'スタッフ紹介', 'create_staff_text', 'staff', 'normal' );
}

function create_staff_name() {
	global $post;

	$keyname = 'staff_name';
	
	//値を出力
    $get_value = get_post_meta( $post->ID, $keyname, true );
 
    // nonceの追加
    wp_nonce_field( 'action-' . $keyname, 'nonce-' . $keyname );
 
    // HTMLの出力
    echo '<input name="' . $keyname . '" value="' . $get_value . '">';
}

function create_staff_text() {
	global $post;

	$keyname = 'staff_text';
	
	//値を出力
    $get_value = get_post_meta( $post->ID, $keyname, true );
 
    // nonceの追加
    wp_nonce_field( 'action-' . $keyname, 'nonce-' . $keyname );
 
    // HTMLの出力
    echo '<textarea name="' . $keyname . '">' . $get_value . '</textarea>';
}


function save_staff_custom_field($post_id) {

	$custom_fields = ['staff_name', 'staff_text'];

	foreach( $custom_fields as $d ) {
		if ( isset( $_POST['nonce-' . $d] ) && $_POST['nonce-' . $d] ) {
			
			if( check_admin_referer( 'action-' . $d, 'nonce-' . $d ) ) {
				
				if( isset( $_POST[$d] ) && $_POST[$d] ) {
					update_post_meta( $post_id, $d, $_POST[$d] );
				} else {
					delete_post_meta( $post_id, $d, get_post_meta( $post_id, $d, true ) );
				}
			}
		}
	}

}