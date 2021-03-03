<?php wp_footer(); ?>

<p>電話番号: <?php echo get_theme_mod( 'telephone', true ); ?></p>

<footer>

	<?php wp_nav_menu(['theme_location' => 'footer_menu']); ?>

	&copy; xxxxxx
</footer>
</body>
</html>