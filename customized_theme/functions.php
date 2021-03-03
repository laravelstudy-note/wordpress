<?php
/*
 * このファイルは常に読み込まれます
 */


//wp_title()は非推奨でfunctions.phpに下記を追加が正解でした
add_theme_support( 'title-tag' );


//サンプルごとに別ファイルにわけてあります。
//それぞれutilディレクトリの中にあります。

//サイドバー
require __DIR__ . "/util/sidebar.php";

//メニュー
require __DIR__ . "/util/navmenu.php";

//カスタム投稿タイプ
require __DIR__ . "/util/custom_post_type.php";

//テーマカスタマイザーの利用
require __DIR__ . "/util/custom_theme.php";

//エディタのカスタム
require __DIR__ . "/util/custom_editor.php";

//ダッシュボードのカスタム
require __DIR__ . "/util/custom_dashboard.php";

