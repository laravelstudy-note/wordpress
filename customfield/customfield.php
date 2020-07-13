<?php

/*

カスタムフィールドのサンプル
- single.phpでの記述例

<?php
	// カスタムフィールドの値を取得
	$item_name = get_post_meta($post->ID, "item_name", true);
	$item_text = get_post_meta($post->ID, "item_text", true);
	$item_detail = get_post_meta($post->ID, "item_detail", true);
?>

<dl>
	<dt>商品名</dt>
	<dd><?php echo esc_html( $item_name ); ?></dd>

	<dt>商品概要</dt>
	<dd><?php echo esc_html( $item_text ); ?></dd>

	<dt>商品詳細</dt>
	<dd><?php echo wp_kses_post( $item_detail ); ?></dd>
</dl>


*/


add_action( 'admin_menu', 'add_custom_field' );
add_action( 'save_post',  'save_custom_field' );


function add_custom_field() {
	add_meta_box( 'custom-item_name', '商品名', 'create_item_name', 'post', 'normal' );
	add_meta_box( 'custom-item_text', '商品概要', 'create_item_text', 'post', 'normal' );
	add_meta_box( 'custom-item_detail', '商品詳細', 'create_item_detail', 'post', 'normal' );
}

function create_item_name() {
	global $post;

	$keyname = 'item_name';
	
	//値を出力
    $get_value = get_post_meta( $post->ID, $keyname, true );
 
    // nonceの追加
    wp_nonce_field( 'action-' . $keyname, 'nonce-' . $keyname );
 
    // HTMLの出力
    echo '<input name="' . $keyname . '" value="' . $get_value . '">';
}

function create_item_text() {
	global $post;

	$keyname = 'item_text';
	
	//値を出力
    $get_value = get_post_meta( $post->ID, $keyname, true );
 
    // nonceの追加
    wp_nonce_field( 'action-' . $keyname, 'nonce-' . $keyname );
 
    // HTMLの出力
    echo '<textarea name="' . $keyname . '">' . $get_value . '</textarea>';
}

function create_item_detail() {
	global $post;

	$keyname = 'item_detail';
	
    // 保存されているカスタムフィールドの値を取得
    $get_value = get_post_meta( $post->ID, $keyname, true );
 
    // nonceの追加
    wp_nonce_field( 'action-' . $keyname, 'nonce-' . $keyname );
 
    // HTMLの出力
    wp_editor( $get_value, $keyname . '-box', ['textarea_name' => $keyname] );
}

function save_custom_field($post_id) {

	$custom_fields = ['item_name', 'item_text', 'item_detail'];

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