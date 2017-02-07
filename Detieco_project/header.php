<?php ($_GET && !empty($_GET)) ? go_filter() : ''; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
		<link rel="icon" href="http://test.detieco.ru/favicon.png" type="image/x-icon">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-7636537690094524",
    enable_page_level_ads: true
  });
</script>
        
	</head>
<body <?php body_class(); ?>>
	<a href="#top" class="gotop"></a>
	<header id="top">
		<div class="header-top">
			<div class="wrapper">
				<a href="<?php bloginfo('url'); ?>" class="logo">
					<?php echo wp_get_attachment_image(get_field('logo', 'options'), 'thumbnail_187x58'); ?>
				</a>
				<div class="header-links">
					<?php the_field('info_block', 'options')?>
				</div>
				<div class="contact_top">
					<ul>
						<li><a href="tel:+74991124151">+7(499)11-24-151</a></li>
						<li><a href="tel:+3809471047741">+3(8094)71-04-774</a></li>
					</ul>
				</div>
			</div>
		</div>
		<nav>
				<div class="contact_top_mobile">
					<ul>
						<li><a href="tel:+74991124151">+7(499)11-24-151</a></li>
						<li><a href="tel:+3809471047741">+3(8094)71-04-774</a></li>
					</ul>
				</div>
			<div class="wrapper clearfix">
				<?php if( has_nav_menu( 'primary' ) )
					wp_nav_menu( array(
							'container' => false,
							'theme_location' => 'primary',
							//'menu_id'        => 'navigation',
							'menu_class'     => 'menu',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							//'walker'         => new Custom_Walker_Nav_Menu
						)
					); ?>
				<div class="search-wrap">
					<?php get_search_form(); ?>
				</div>
				<a href="#" class="nav-opener"><span><?php _e('Меню', 'base'); ?></span></a>
			</div>
		</nav>
	</header>
