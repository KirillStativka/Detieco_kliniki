<?php
// Mark
if ( ! function_exists( 'mark_shortcode' ) ) {
    function mark_shortcode( $atts, $content = null, $shortcodename = '' ) {
        //remove wrong nested <p>
        $content = remove_invalid_tags( $content, array( 'p' ) );

        $output = '<div class="marked-text">';
        $output .= do_shortcode( $content );
        $output .= '</div><!-- promo-block (end) -->';

        $output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

        return $output;
    }
    add_shortcode( 'mark', 'mark_shortcode' );
}