<?php
//Add Country column in cities listing
add_filter('manage_edit-cities_kliniki_columns', 'columns_head_city_order');
add_action('manage_cities_kliniki_posts_custom_column', 'columns_content_city_order', 10, 2);
function columns_head_city_order($defaults) {
    $new = array();
    foreach($defaults as $key => $title) {
        if ($key=='comments')
            $new['country'] = __('Страна', 'base');
        $new[$key] = $title;
    }
    return $new;
}
function columns_content_city_order($column_name, $post_ID) {
    if ($column_name == 'country') {
        $country = get_post( get_post_meta( $post_ID, 'country', true ) );
        echo $country->post_title;
    }
}

// Register custom rewrite rules
add_action('init', 'tdd_add_rewrite_rules');
function tdd_add_rewrite_rules() {
    global $wp_rewrite;
    $tpl_id = get_tpl_id('pages/template-houses.php');
    $tpl_obj = get_post($tpl_id[0]);

    $wp_rewrite->add_rewrite_tag('%kliniki%', '([^/]*)', 'kliniki=');
    $wp_rewrite->add_rewrite_tag('%countries_kliniki%', '([^/]+)', 'countries_kliniki=');
    $wp_rewrite->add_rewrite_tag('%cities_kliniki%', '([^/]*)', 'cities_kliniki=');

    $wp_rewrite->add_rewrite_tag('%type_organisation%', '([^/]*)', 'type_organisation=');

    $wp_rewrite->add_permastruct('kliniki', $tpl_obj->post_name . '/%countries_kliniki%/%cities_kliniki%/%type_organisation%/%kliniki%', false);
    $wp_rewrite->add_permastruct('countries_kliniki', $tpl_obj->post_name . '/%countries_kliniki%', false);
    $wp_rewrite->add_permastruct('cities_kliniki', $tpl_obj->post_name . '/%countries_kliniki%/%cities_kliniki%', false);
}

//kliniki custom permalink
add_filter('post_type_link', 'tdd_permalinks', 10, 3);
function tdd_permalinks($permalink, $post, $leavename){
    $no_data = 'no-speciality';
    $post_id = $post->ID;

    if($post->post_type != 'kliniki' || empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft')))
        return $permalink;

    $var1 = get_post_meta($post_id, 'countries_field', true);
    $var2 = get_post_meta($post_id, 'city_field', true);
    $var3 = get_post_meta($post_id, 'type_organisation', true);

    $var1 = get_post( sanitize_title($var1) );
    $var1 = $var1->post_name;

    $var2 = get_post( sanitize_title($var2) );
    $var2 = $var2->post_name;

    $var3 = sanitize_title($var3);

    if(!$var1) { $var1 = $no_data; }
    if(!$var2) { $var2 = $no_data; }
    if(!$var3) { $var3 = $no_data; }

    $array1 = array('%countries_kliniki%', '%cities_kliniki%', '%type_organisation%');
    $array2 = array($var1, $var2, $var3);

    $permalink = str_replace($array1, $array2, $permalink);
    return $permalink;
}

//city custom permalink
add_filter('post_type_link', 'tdd_permalinks1', 10, 3);
function tdd_permalinks1($permalink, $post, $leavename){
    $no_data = 'no-speciality';
    $post_id = $post->ID;

    if($post->post_type != 'cities_kliniki' || empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft')))
        return $permalink;

    $var1 = get_post_meta($post_id, 'country', true);

    $var1 = get_post( sanitize_title($var1) );
    $var1 = $var1->post_name;

    if(!$var1) { $var1 = $no_data; }

    $array1 = array('%countries_kliniki%');
    $array2 = array($var1);

    $permalink = str_replace($array1, $array2, $permalink);
    return $permalink;
}

//remove 404 conflict in kliniki post type
function true_rewrite_conflicts( $request ) {
    if(!is_admin() && isset($request['kliniki']))
        $request['post_type'] = array('kliniki', 'post', 'page');
    return $request;
}
add_filter( 'request',  'true_rewrite_conflicts' );

//getting 404s in custom permalinks
add_action( 'template_redirect', 'my_page_template_redirect' );
function my_page_template_redirect() {
    global $wp_query, $post;

    $country_id = get_post_meta( $post->ID, 'country', true );
    $country_object = get_post($country_id);
    $cntr = get_query_var('countries_kliniki');
    $ct = get_query_var('cities_kliniki');
    $type = get_query_var('type_organisation');
    $types = array('gos', 'chastnie');

    if( !is_search() &&  ($post->post_type == 'cities_kliniki') && ($cntr != $country_object->post_name || (!empty($type) && !in_array($type, $types)) ) ){
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }

    $country_kliniki = get_post_meta( $post->ID, 'countries_field', true );
    $city_kliniki = get_post_meta( $post->ID, 'city_field', true );
    $type_kliniki = get_post_meta( $post->ID, 'type_organisation', true );
    $country_kliniki = get_post($country_kliniki);
    $city_kliniki = get_post($city_kliniki);

    if( !is_search() && ($post->post_type == 'kliniki') && ($cntr != $country_kliniki->post_name || $ct != $city_kliniki->post_name || $type_kliniki != $type) ) {
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
}

// Script for getting cities on choose country
function filter_cities($country) {
    // Verify nonce
    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'nonce' ) )
        die('Permission denied');

    $country = $_POST['country'];

    $args = array(
        'post_type' => 'cities_kliniki',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    );

    if( $country ) {
        $args['meta_query'] = array(
            'relation' => 'OR',
            array(
                'key' => 'country',
                'value' => $country,
                'type' => 'NUMERIC'
            ),
        );
    }

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) :  ?>

        <option value="choose" class="hidden"><?php _e('Город', 'base'); ?></option>
        <?php while($query->have_posts()): $query->the_post(); ?>
            <option value="<?php echo $query->post->ID; ?>"><?php the_title(); ?></option>
        <?php endwhile; ?>

    <?php else: ?>
        <option value="choose" class="hidden"><?php _e('Город', 'base'); ?></option>
        <option value="choose"><?php _e('Не найдено', 'base'); ?></option>
    <?php endif;

    die();
}
add_action('wp_ajax_filter_cities', 'filter_cities');
add_action('wp_ajax_nopriv_filter_cities', 'filter_cities');

// custom breadcrumbs
function filter_my_breadcrumbs($obj){
    //create a breadcrumb that links to the custom post type archive page:
    global $post;
     $link = '<span class="li" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%link%" itemprop="url" title="Перейти на страницу %title%" class="%type%"><span itemprop="title">%htitle%</span></a></span>';
    
     if(is_singular('cities_kliniki')) {
        $country_field = get_field('country', $post->ID);
        $country_object = get_post($country_field);
        $type = get_query_var('type_organisation');
        $types = get_field_object('field_56a553b6a9c8a')['choices'];
    }
     if(is_singular('kliniki')) {
        $country_field = get_field('countries_field', $post->ID);
        $country_object = get_post($country_field);
        $city_field = get_field('city_field', $post->ID);
        $city_object = get_post($city_field);
        $type = get_field('type_organisation');
        $types = get_field_object('field_56a553b6a9c8a')['choices'];

        $type_obj = new bcn_breadcrumb(
            $types[$type],
            $link,
            array('archive', 'taxonomy', 'my-categories'),
            get_permalink($city_field) . $type . '/'
        );

        $country_obj = new bcn_breadcrumb(
            $country_object->post_title,
            $link,
            array('archive', 'taxonomy', 'my-categories'),
            get_permalink($country_field)
        );

        $city_obj = new bcn_breadcrumb(
            $city_object->post_title,
            $link,
            array('archive', 'taxonomy', 'my-categories'),
            get_permalink($city_object->ID)
        );
    }

    $country = new bcn_breadcrumb(
        $country_object->post_title,
        $link,
        array('archive', 'taxonomy', 'my-categories'),
        get_permalink($country_field)
    );
    $city = new bcn_breadcrumb(
        $post->post_title,
        $link,
        array('archive', 'taxonomy', 'my-categories'),
        get_permalink($post->ID)
    );
    $kliniki = new bcn_breadcrumb(
        'Клиники',
        $link,
        array('archive', 'taxonomy', 'my-categories'),
        home_url() . '/kliniki/'
    );
    $type_add = new bcn_breadcrumb(
        $types[$type],
        $link,
        array('archive', 'taxonomy', 'my-categories'),
        NULL
    );
    //Insert the breadcrumb above into trail after HOME on custom taxonomy pages and custom single posts:
    if(is_singular('cities_kliniki') && array_key_exists($type, $types)){
        //Pop the HOME link off the end of the (reverse) array:
        $home = array_pop($obj->trail);
        $last = array_shift($obj->trail);
        //Push the $archive breadcrumb from above onto the end of the (reverse) array:
        array_unshift($obj->trail, $type_add);
        array_push($obj->trail, $city);
        array_push($obj->trail, $country);
        array_push($obj->trail, $kliniki);
        //Return the HOME link:
        array_push($obj->trail, $home);
    } elseif(is_singular('cities_kliniki')){
        //Pop the HOME link off the end of the (reverse) array:
        $home = array_pop($obj->trail);
        //Push the $archive breadcrumb from above onto the end of the (reverse) array:
        array_push($obj->trail, $country);
        array_push($obj->trail, $kliniki);
        //Return the HOME link:
        array_push($obj->trail, $home);
    }
    if(is_singular('countries_kliniki')){
        //Pop the HOME link off the end of the (reverse) array:
        $home = array_pop($obj->trail);
        //Push the $archive breadcrumb from above onto the end of the (reverse) array:
        array_push($obj->trail, $kliniki);
        //Return the HOME link:
        array_push($obj->trail, $home);
    }
    if(is_singular('kliniki')){
        //Pop the HOME link off the end of the (reverse) array:
        $home = array_pop($obj->trail);
        //Push the $archive breadcrumb from above onto the end of the (reverse) array:
        array_push($obj->trail, $type_obj);
        array_push($obj->trail, $city_obj);
        array_push($obj->trail, $country_obj);
        array_push($obj->trail, $kliniki);
        //Return the HOME link:
        array_push($obj->trail, $home);
    }
}
add_action('bcn_after_fill', 'filter_my_breadcrumbs');