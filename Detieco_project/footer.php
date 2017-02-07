	<footer>
		<div class="wrapper clearfix">
			<div class="footer-left">
				<noindex>
				<?php if( has_nav_menu( 'primary' ) )
					wp_nav_menu( array(
							'container' => false,
							'theme_location' => 'primary',
							//'menu_id'        => 'navigation',
							'menu_class'     => 'footer-links',
							'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker'         => new Custom_Walker_Nav_Menu
						)
					); ?>
				</noindex>
				<div class="footer-text">
					<?php the_field('copyright', 'options')?>
				</div>
			</div>
			<div class="footer-right">
				<div class="call-back">
					<a href="/contacts/" class="callback-link">Обратная связь</a>
				</div>
				<div class="site-info">
					<?php the_field('counter', 'options')?>
				</div>
			</div>
		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>