<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package woocommerce_theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'woocommerce_theme' ); ?></a>
	<!-- Topbar Menu -->
	<div class="topbar pt-2">
		<div class="container">
			<div class="row">
				<div class="col-5">
					<ul class="topbar__list-left d-flex justify-content-start gap-3 flex-md-column flex-lg-row">
						<li class="d-flex align-items-center">
							<i class="bi bi-telephone rounded-circle"></i>
							<a class="text-decoration-none" href="tel:0123456789">+84 123 456 789</a>
						</li>
						<li class="d-flex align-items-center">
							<i class="bi bi-envelope rounded-circle"></i>
							<a class="text-decoration-none" href="mailto:vochuong57@gmail.com">vochuong57@gmail.com</a>
						</li>
					</ul>
				</div>
				<div class="col-7">
					<ul class="topbar__list-left d-flex justify-content-end gap-lg-5 flex-md-column flex-lg-row gap-md-3">
						<li class="d-flex align-items-center">
							<i class="bi bi-truck rounded-circle"></i>
							Free VN Shipping
						</li>
						<li class="d-flex align-items-center">
							<i class="bi bi-clock-history rounded-circle"></i>
							30 Day Menu Back
						</li>
						<li class="d-flex align-items-center">
							<i class="bi bi-person rounded-circle"></i>
							24/7 Customer Support
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<header id="masthead" class="site-header">
		<div class="container pt-2 pb-2">
			<div class="row align-items-center">
				<!-- logo -->
				<div class="col-md-4 col-12 d-flex justify-content-center justify-content-md-start">
					<?php the_custom_logo(); ?>
				</div>
				<!-- search -->
				<div class="col-md-5 col-12">
					<?php aws_get_search_form( true ); ?>
				</div>
				<!-- cart -->
				<div class="col-md-3 col-12 d-flex justify-content-center justify-content-md-end gap-2">
					<a class="text-decoration-none" href="<?php echo wc_get_cart_url(); ?>"><i class="bi bi-bag-dash"></i></a>
					<a class="cart-customlocation text-decoration-none text-black-50" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> – <?php echo WC()->cart->get_cart_total(); ?></a>
				</div>
			</div>
		</div>
		<!-- menu -->
		<nav id="site-navigation" class="main-navigation bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-12 d-flex justify-content-center align-items-center">
						<i class="bi bi-list d-sm-block d-md-none"></i>
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'woocommerce_theme' ); ?></button>
					</div>
					<div class="col-12 d-md-flex justify-content-md-center text-center">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>
					</div>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
