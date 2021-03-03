<?php
get_header();
?>

<main>

<?php get_template_part("parts/custom_tax_test"); ?>

<?php while ( have_posts() ) {  the_post(); ?>
<section>
	<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>

	<p> <?php echo get_the_date(); ?> by  <?php echo get_the_author(); ?> </p>

	<?php echo get_the_content(); ?>

</section>
<?php } ?>
</main>

<aside>
	<?php get_sidebar(); ?>
</aside>
	
<?php
get_footer();
