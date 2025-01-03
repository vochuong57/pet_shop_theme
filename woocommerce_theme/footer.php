<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woocommerce_theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="bg-primary text-white pt-5 pb-5">
			<div class="container">
				<div class="row">
					<div class="col-2">
						<?php dynamic_sidebar( 'footer_col_one' ); ?> 
					</div>

					<div class="col-2">
						<?php dynamic_sidebar( 'footer_col_two' ); ?> 
					</div>

					<div class="col-md-4 ms-auto">
						<h3>Keep in touch</h3>
						<?php dynamic_sidebar( 'footer_col_three' ); ?> 
					</div>
				</div>
			</div>
		</div>

		<div class="container pb-2 pt-2">
			<div class="row d-flex align-items-center">
				<div class="col">
					<p><?php echo get_theme_mod( 'set-copyright' , '© Woocommerce Pet Shop 2024 created by Group 10 Dev' ) ?></p>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<!-- B2: tạo html cho quick view -->
<div class="quick-view-modal" style="display:none;">
    <div class="quick-view-content">
        <span class="close-quick-view">×</span>
        <div class="quick-view-product"></div>
    </div>
</div>

</body>
</html>
