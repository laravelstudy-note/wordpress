<h2>関西一覧</h2>

<?php

$the_query = new WP_Query([
	"post_type" => "store",
	"tax_query" => [
		[
			"taxonomy" => "store_cat",
			"field" => "slug",
			"terms" => "kansai",
			'include_children' => true,
        	'operator' => 'IN'
		]
	]
]);

if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<li>' . get_the_title() . '</li>';
	}
	echo '</ul>';
	wp_reset_postdata();
}

?>

<h2>関東一覧</h2>

<?php

$the_query = new WP_Query([
	"post_type" => "store",
	"tax_query" => [
		[
			"taxonomy" => "store_cat",
			"field" => "slug",
			"terms" => "kanto"
		]
	]
]);

if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<li>' . get_the_title() . '</li>';
	}
	echo '</ul>';
	wp_reset_postdata();
}

?>