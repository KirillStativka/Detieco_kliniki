<?php
/**
 * TinyMCE Shortcode Integration
 */
if ( !class_exists('TinyMCE_Shortcodes') ) {

	class TinyMCE_Shortcodes {

		// Constructor
		function __construct() {

			// Init
			add_action( 'admin_init', array( $this, 'init' ) );

			// wp_ajax_... is only run for logged users.
			add_action( 'wp_ajax_theme_check_url_action', array( $this, 'ajax_action_check_url' ) );
			add_action( 'wp_ajax_theme_shortcodes_nonce', array( $this, 'ajax_action_generate_nonce' ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'include_admin_style' ) );
			
			// Output the markup in the footer.
			add_action( 'admin_footer', array( $this, 'output_dialog_markup' ) );
		}

		// Get everything started
		function init() {
			global $pagenow;

			if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && get_user_option( 'rich_editing' ) == 'true' && ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) )  {

				// Add the tinyMCE buttons and plugins.
				add_filter( 'mce_buttons', array( $this, 'filter_mce_buttons' ) );
				add_filter( 'mce_external_plugins', array( $this, 'filter_mce_external_plugins' ) );

				wp_enqueue_style( 'tinymce-shortcodes', TEMPLATE_DIRECTORY_URI . '/inc/shortcodes/admin/css/tinymce-shortcodes.css', false, '1.0', 'all' );
			}
		}
		
		function include_admin_style(){
			wp_enqueue_style( 'font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', false, '3.2.1', 'all' );
		}

		// Add new button to the tinyMCE editor.
		function filter_mce_buttons( $buttons ) {
			array_push( $buttons, '|', 'shortcodes_button' );

			return $buttons;
		}

		// Add functionality to the tinyMCE editor as an external plugin.
		function filter_mce_external_plugins( $plugins ) {
			global $wp_version;

			$suffix = '';
			if ( '3.9' <= $wp_version ) {
				$suffix = '-39';
			}
			
			$plugins['TinyMCEShortcodes'] = wp_nonce_url( esc_url( TEMPLATE_DIRECTORY_URI . '/inc/shortcodes/admin/js/editor-plugin' . $suffix . '.js' ), 'tinymce-shortcodes' );

			return $plugins;
		}

		// Checks if a given url (via GET or POST) exists.
		function ajax_action_check_url() {
			$hadError = true;

			$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';

			if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
				$url          = esc_url( $url );
				$file_headers = @get_headers( $url );
				$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
				$hadError     = false;
			}

			echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';
			wp_die();
		}

		// Generate a nonce.
		function ajax_action_generate_nonce() {
			echo wp_create_nonce( 'tinymce-shortcodes' );
			wp_die();
		}

		/**
		 * Output the HTML markup for the dialog box.
		 */
		public function output_dialog_markup() {
			// URL to TinyMCE plugin folder
			$plugin_url = TEMPLATE_DIRECTORY_URI . '/inc/shortcodes/'; ?>

			<div id="dialog" style="display:none">
				<div class="buttons-wrapper">
					<input type="button" id="cancel-button" class="button alignleft" name="cancel" value="<?php _e( 'Cancel', 'base' ) ?>" accesskey="C" />
					<input type="button" id="insert-button" class="button-primary alignright" name="insert" value="<?php _e( 'Insert', 'base' ) ?>" accesskey="I" />
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<h3 class="sc-options-title"><?php _e('Shortcode Options', 'base') ?></h3>
				<div id="shortcode-options" class="alignleft">
					<table id="options-table">
					</table>
					<input type="hidden" id="selected-shortcode" value="">
				</div>
				<div class="clear"></div>
				<script type="text/javascript" id="base-theme-shortcode-dialog" src="<?php echo TEMPLATE_DIRECTORY_URI . '/inc/shortcodes/admin/dialog-js.php'; ?>"></script>
			</div><!-- #dialog (end) -->
	<?php }
	}

	$tinymce_shortcodes = new TinyMCE_Shortcodes();
} ?>