<?php
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/button.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/blockquote.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/mark.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/promo.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/address.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/map.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/columns.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/posts-grid.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/posts-list.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/tags.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/recent_comments.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/misc.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/title.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/table.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/pricing-tables.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/banner.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/categories.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/service-box.php' );
//include_once( TEMPLATE_DIRECTORY . '/inc/shortcodes/site-map.php' );

//include_once( TEMPLATE_DIRECTIRY . '/inc/shortcodes/testimonials.php' );
//include_once( TEMPLATE_DIRECTIRY . '/inc/shortcodes/video_preview.php' );
//include_once( TEMPLATE_DIRECTIRY . '/inc/shortcodes/tabs.php' );
//include_once( TEMPLATE_DIRECTIRY . '/inc/shortcodes/toggle.php' );
//include_once( TEMPLATE_DIRECTIRY . '/inc/shortcodes/progressbar.php' );
//include_once( TEMPLATE_DIRECTIRY . '/inc/shortcodes/team.php' );

//base shortcodes

//Add [email]...[/email] shortcode
function shortcode_email( $atts, $content ) {
    return antispambot( $content );
}
add_shortcode( 'email', 'shortcode_email' );

//Register tag [template-url]
function filter_template_url( $text ) {
    return str_replace( '[template-url]', get_template_directory_uri(), $text );
}
add_filter( 'the_content', 'filter_template_url' );
add_filter( 'widget_text', 'filter_template_url' );

//Register tag [site-url]
function filter_site_url( $text ) {
    return str_replace( '[site-url]', home_url(), $text );
}
add_filter( 'the_content', 'filter_site_url' );
add_filter( 'widget_text', 'filter_site_url' );

if( class_exists( 'acf' ) && !is_admin() ) {
    add_filter( 'acf/load_value', 'filter_template_url' );
    add_filter( 'acf/load_value', 'filter_site_url' );
}