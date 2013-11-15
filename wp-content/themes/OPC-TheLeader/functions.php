<?php

include(TEMPLATEPATH . '/leader_functions.php');

/* CUSTOM FUNCTIONS
---------------------------------------------------------------------- */
	
	// Load theme styles
	function load_theme_styles() {
		wp_enqueue_style("font-lato","http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic");
		wp_register_style('theme-main-style', get_template_directory_uri()  . '/css/main.css', array(), null);
		wp_enqueue_style('theme-main-style');
	}
	add_action( 'wp_enqueue_scripts', 'load_theme_styles' );
	
	// Load custom login page styles
	function custom_login_styles() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/custom-login.css" />';
	}
	add_action('login_head', 'custom_login_styles');	
	
	// Load theme scripts
	function load_theme_scripts() {

		wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.js');
        // if(etheme_get_option('product_img_hover') == 'tooltip')
        //     wp_enqueue_script('tooltip', get_template_directory_uri().'/js/tooltip.js');
        wp_enqueue_script('jquery');
        // wp_enqueue_script('less', get_template_directory_uri().'/js/less-1.4.1.min.js',array(),false,true);
        wp_enqueue_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js');
        wp_enqueue_script('waypoints', get_template_directory_uri().'/js/waypoints.min.js',array(),false,true);
        wp_enqueue_script('etheme', get_template_directory_uri().'/js/etheme.js',array('waypoints'),false,true);
        wp_enqueue_script('emodal', get_template_directory_uri().'/js/emodal.js',array('waypoints'),false,true);
        wp_enqueue_script('hoverIntent', get_template_directory_uri().'/js/jquery.hoverIntent.js',array(),false,true);
        wp_enqueue_script('masonry', get_template_directory_uri().'/js/jquery.masonry.min.js',array(),false,true);
        wp_enqueue_script('mousewheel', get_template_directory_uri().'/js/jquery.mousewheel.js');
        wp_enqueue_script('easing', get_template_directory_uri().'/js/jquery.easing-1.3.js');
        wp_enqueue_script('iosslider', get_template_directory_uri().'/js/jquery.iosslider.min.js');
        wp_enqueue_script('touch', get_template_directory_uri().'/js/touch.js');
        wp_enqueue_script('cookie', get_template_directory_uri().'/js/cookie.js',array(),false,true);
        wp_enqueue_script('zoom', get_template_directory_uri().'/js/zoom.js');
        wp_enqueue_script('cbpQTRotator', get_template_directory_uri().'/js/jquery.cbpQTRotator.min.js',array(),false,true);
        wp_enqueue_script('nicescroll', get_template_directory_uri().'/js/jquery.nicescroll.min.js',array(),false,true);
        wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js',array(),false,true);
        

		// Load js plugins
		wp_register_script('plugins', get_template_directory_uri()  . '/js/plugins.js', array('jquery'), '20130217', true);
		wp_enqueue_script('plugins');
		// Load js functions
		wp_register_script('functions', get_template_directory_uri()  . '/js/functions.js', array('jquery'), '20130217', true);
		wp_enqueue_script('functions');		

				
	}
	add_action( 'wp_enqueue_scripts', 'load_theme_scripts' );




	function load_theme_amdin_scripts(){
		wp_enqueue_script('media-upload');
        wp_enqueue_media();		
	}

	add_action( 'admin_enqueue_scripts', 'load_theme_amdin_scripts' );
		
	// Add post thumbnail support and declare image sizes
	add_theme_support('post-thumbnails');
	/* add_image_size( 'handle', width, height, crop ); view params at: http://codex.wordpress.org/Function_Reference/add_image_size */
	
	
/* BOILERPLATE FUNCTIONS - *DO NOT EDIT*
---------------------------------------------------------------------- */

	// Clean up the <head>
	function removeHeadLinks() {
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	add_action('init', 'removeHeadLinks');
	remove_action('wp_head', 'wp_generator');

	// Register sidebars if applicable
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => __('Sidebar Widgets','html5reset' ),
			'id'   => 'sidebar-widgets',
			'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>'
		));
	}

	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	    require_once($locale_file);  

	// Clean up the title and meta title tags in the head
	function custom_title( $title, $sep ) {
		global $paged, $page;
		if ( is_feed() )
			return $title;
		$title .= get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );	
		return $title;
	}
	add_filter( 'wp_title', 'custom_title', 10, 2 );		

	// Custom pagination for blog index
	function pagination($prev = '&laquo;', $next = '&raquo;') {
	  global $wp_query, $wp_rewrite;
	  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	  $pagination = array(
		  'base' => @add_query_arg('paged','%#%'),
		  'format' => '',
		  'total' => $wp_query->max_num_pages,
		  'current' => $current,
		  'prev_text' => __($prev),
		  'next_text' => __($next),
		  'type' => 'plain'
	);
	  if( $wp_rewrite->using_permalinks() )
	  	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	  if( !empty($wp_query->query_vars['s']) )
	  	$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	  echo paginate_links( $pagination );
	}

	// Copyright formula
	function copyright($first_year) {
		$this_year = date('Y');
		if($first_year == $this_year) {
			return $this_year;
		} else {
			return $first_year . '-' . $this_year;
		}
	}

	// Add 3.1 post format theme support.
	add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video'));

	// Add RSS links to <head> section
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();	

	register_nav_menus( array(
		'main_menu' => 'Main Navigation Menu',
		'footer_menu' => 'Footer Menu'
	) );

	function filter_search($query) {
		if(($query->is_search() || $query->is_category()) && 
			(get_query_var('post_type') == 'post' || get_query_var('post_type') == 'page' || get_query_var('post_type') == '')) {
			$query->set('post_type', array('post', 'page', 'opc_communicado', 'opc_gallery'));
		};
		return $query;
	};
	add_filter('pre_get_posts', 'filter_search');

/* Custom Post Types
---------------------------------------------------------------------- */

	add_action( 'init', 'create_all_post_types' );
	function create_all_post_types() {
		// Communicados / Press Releases
		register_post_type( 'opc_communicado',
			array(
				'labels' => array(
					'name' => __( 'Comunicados' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
					'singular_name' => __( 'Comunicados' ), // name for one object of this post type. Defaults to value of name
					'menu_name' => __( 'Comunicados' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
					'all_items' => __( 'Comunicados' ), //  the all items text used in the menu. Default is the Name label
					'add_new' => __( 'Add New Comunicado' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => __( 'Add New Comunicado' ), // the add new item text. Default is Add New Post/Add New Page
					'edit_item' => __( 'Edit Comunicado' ), // the edit item text. Default is Edit Post/Edit Page
					'new_item' => __( 'New Comunicado' ), // the new item text. Default is New Post/New Page
					'view_item' => __( 'View Comunicado' ), // the view item text. Default is View Post/View Page
					'search_items' => __( 'Search Comunicado' ), // the search items text. Default is Search Posts/Search Pages
					'not_found' => __( 'No Comunicados found' ), // the not found text. Default is No posts found/No pages found
					'not_found_in_trash' => __( 'No Comunicados Found in Trash' ), //  the not found in trash text. Default is No posts found in Trash/No pages found in Trash
				),
			'description' => 'Comunicados/Press Releases contain a title, text, a featuted image and a featured PDF',
			'public' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'taxonomies' => array('category'),
			'supports' => array('title','editor','thumbnail','author','revisions'),
			'menu_position' => 6,
			'show_in_nav_menus' => true,
			)
		);
		// Radio Show
		register_post_type( 'opc_radio_show',
			array(
				'labels' => array(
					'name' => __( 'OPC Radios Shows' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
					'singular_name' => __( 'Radio Show' ), // name for one object of this post type. Defaults to value of name
					'menu_name' => __( 'Radio Shows' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
					'all_items' => __( 'OPC Radios Shows' ), //  the all items text used in the menu. Default is the Name label
					'add_new' => __( 'Add New Radio Show' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => __( 'Add New Radio Show' ), // the add new item text. Default is Add New Post/Add New Page
					'edit_item' => __( 'Edit Radio Show' ), // the edit item text. Default is Edit Post/Edit Page
					'new_item' => __( 'New Radio Show' ), // the new item text. Default is New Post/New Page
					'view_item' => __( 'View Radio Show' ), // the view item text. Default is View Post/View Page
					'search_items' => __( 'Search Radio Shows' ), // the search items text. Default is Search Posts/Search Pages
					'not_found' => __( 'No Radio Show found' ), // the not found text. Default is No posts found/No pages found
					'not_found_in_trash' => __( 'No Radio Shows Found in Trash' ), //  the not found in trash text. Default is No posts found in Trash/No pages found in Trash
				),
			'description' => 'OPC Radios Shows ("Lo que es Noticia") is OPC\'s weekly radio show. These contain a title, description and audio files input fields',
			'public' => true,
			'has_archive' => true,
			'supports' => array('title','editor','thumbnail'),
			'menu_position' => 7,
			'show_in_nav_menus' => true,
			)
		);
		// Gallery
		register_post_type( 'opc_gallery',
			array(
				'labels' => array(
					'name' => __( 'Galleries' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
					'singular_name' => __( 'Gallery' ), // name for one object of this post type. Defaults to value of name
					'menu_name' => __( 'Galleries' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
					'all_items' => __( 'Galleries' ), //  the all items text used in the menu. Default is the Name label
					'add_new' => __( 'Add New Gallery' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => __( 'Add New Gallery' ), // the add new item text. Default is Add New Post/Add New Page
					'edit_item' => __( 'Edit Gallery' ), // the edit item text. Default is Edit Post/Edit Page
					'new_item' => __( 'New Gallery' ), // the new item text. Default is New Post/New Page
					'view_item' => __( 'View Gallery' ), // the view item text. Default is View Post/View Page
					'search_items' => __( 'Search Gallery' ), // the search items text. Default is Search Posts/Search Pages
					'not_found' => __( 'Gallery Not Found' ), // the not found text. Default is No posts found/No pages found
					'not_found_in_trash' => __( 'Gallery Not Found in Trash' ), //  the not found in trash text. Default is No posts found in Trash/No pages found in Trash
				),
			'description' => 'Galleries contain a collecition of images with a title and a text field for description',
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array('category'),
			// 'supports' => array('title','editor'),
			'menu_position' => 5,
			'show_in_nav_menus' => true,
			)
		);
		
		// Video 
		register_post_type( 'opc_video',
			array(
				'labels' => array(
					'name' => __( 'OPC Videos' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
					'singular_name' => __( 'OPC Video' ), // name for one object of this post type. Defaults to value of name
					'menu_name' => __( 'Videos' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
					'all_items' => __( 'OPC Videos' ), //  the all items text used in the menu. Default is the Name label
					'add_new' => __( 'Add New OPC Video' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => __( 'Add New OPC Video' ), // the add new item text. Default is Add New Post/Add New Page
					'edit_item' => __( 'Edit OPC Video' ), // the edit item text. Default is Edit Post/Edit Page
					'new_item' => __( 'New OPC Video' ), // the new item text. Default is New Post/New Page
					'view_item' => __( 'View OPC Video' ), // the view item text. Default is View Post/View Page
					'search_items' => __( 'Search OPC Video' ), // the search items text. Default is Search Posts/Search Pages
					'not_found' => __( 'No OPC Video found' ), // the not found text. Default is No posts found/No pages found
					'not_found_in_trash' => __( 'No OPC Videos found in trash' ), //  the not found in trash text. Default is No posts found in Trash/No pages found in Trash
				),
			'description' => 'OPC Videos are Youtube videos stored in the site. They are tied to a youtube id. These videos only show up in the home page.',
			'public' => true,
			'has_archive' => true,
			'supports' => array('title'),
			'menu_position' => 8,
			'show_in_nav_menus' => true,
			)
		);
		// Calendar
		// register_post_type( 'opc_calendar_event',
		// 	array(
		// 		'labels' => array(
		// 			'name' => __( 'OPC Calendar Events' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
		// 			'singular_name' => __( 'OPC Calendar Event' ), // name for one object of this post type. Defaults to value of name
		// 			'menu_name' => __( 'OPC Calendar Events' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
		// 			'all_items' => __('OPC Calendar Events' ), //  the all items text used in the menu. Default is the Name label
		// 			'add_new' => __( 'Add New OPC Calendar Event' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
		// 			'add_new_item' => __( 'Add New OPC Calendar Event' ), // the add new item text. Default is Add New Post/Add New Page
		// 			'edit_item' => __( 'Edit OPC Calendar Event' ), // the edit item text. Default is Edit Post/Edit Page
		// 			'new_item' => __( 'New OPC Calendar Event' ), // the new item text. Default is New Post/New Page
		// 			'view_item' => __( 'View OPC Calendar Event' ), // the view item text. Default is View Post/View Page
		// 			'search_items' => __( 'Search OPC Calendar Event' ), // the search items text. Default is Search Posts/Search Pages
		// 			'not_found' => __( 'No OPC Calendar Event found' ), // the not found text. Default is No posts found/No pages found
		// 			'not_found_in_trash' => __( 'No OPC Calendar Events found in trash' ), //  the not found in trash text. Default is No posts found in Trash/No pages found in Trash
		// 		),
		// 	'description' => 'OPC Calendar events are organized by their dates. Apart form the usual information they also a Date/Time Field.',
		// 	'public' => true,
		// 	'has_archive' => true,
		// 	'supports' => array('title','editor','excerpt'),
		// 	'menu_position' => 5,
		// 	)
		// );
		// OPC Sponsor
		register_post_type( 'opc_sponsor',
			array(
				'labels' => array(
					'name' => __( 'OPC Sponsors' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
					'singular_name' => __( 'OPC Sponsor' ), // name for one object of this post type. Defaults to value of name
					'menu_name' => __( 'Sponsors' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
					'all_items' => __('OPC Sponsors' ), //  the all items text used in the menu. Default is the Name label
					'add_new' => __( 'Add New OPC Sponsor' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => __( 'Add New OPC Sponsor' ), // the add new item text. Default is Add New Post/Add New Page
					'edit_item' => __( 'Edit OPC Sponsor' ), // the edit item text. Default is Edit Post/Edit Page
					'new_item' => __( 'New OPC Sponsor' ), // the new item text. Default is New Post/New Page
					'view_item' => __( 'View OPC Sponsor' ), // the view item text. Default is View Post/View Page
					'search_items' => __( 'Search OPC Sponsor' ), // the search items text. Default is Search Posts/Search Pages
					'not_found' => __( 'No OPC Sponsor found' ), // the not found text. Default is No posts found/No pages found
					'not_found_in_trash' => __( 'No OPC Sponsors found in trash' ), //  the not found in trash text. Default is No posts found in Trash/No pages found in Trash
				),
			'description' => 'OPC Sponsors have the name and logo image of each opc sponsor, along with its sponsorship level. These only appear in the homge page.',
			'public' => true,
			'has_archive' => false,
			'supports' => array('title','thumbnail'),
			'menu_position' => 9,
			)
		);
	}

	function remove_dashboard_widgets() {
		global $wp_meta_boxes;

		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

	}

	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


	// Remove certain things form the right side menu on the backend
    function my_remove_menu_pages() {
        remove_menu_page('tools.php');
        remove_menu_page('edit.php');           
        remove_menu_page('links.php');           
        remove_menu_page('edit-comments.php');           
    }
    add_action( 'admin_menu', 'my_remove_menu_pages' );

	function get_sponsors(){
		$args = array(
			'posts_per_page'   => 50,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'post_type'        => 'opc_sponsor',
			'post_status'      => 'publish',
			'suppress_filters' => true );
		$posts_array = get_posts( $args );

		foreach($posts_array as $post){
			$post->sponsor_type = get_post_meta($post->ID, 'sponsor_type', true);
			$post->sponsor_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		}

		// Obtain a list of columns
		foreach ($posts_array as $key => $row) {
			$sponsor_type[$key] = $row->sponsor_type;
		}

		// Sort the data with volume descending, edition ascending
		// Add $data as the last parameter, to sort by the common key
		array_multisort($sponsor_type, SORT_ASC, $posts_array);

		$ordered_posts = array();

		foreach($posts_array as $post){
			if(isset($post)){
				if(!isset($ordered_posts[$post->sponsor_type])){
					$ordered_posts[$post->sponsor_type] = array();
				}
				array_push($ordered_posts[$post->sponsor_type], $post);
			}
		}
		return $ordered_posts;
	}

	function get_sponsor_types(){
		$categories = array(
			'Auspicio de primera plana (diamante)',
			'Auspiciador de avances de platino',
			'Aupiciadores titulares de oro (premios especiales)',
			'Auspiciadores titulares de oro'
			);
		return $categories;
	}

	function get_videos($limit=5){
		$args = array(
			'posts_per_page'   => $limit,
			'offset'           => 0,
			'orderby'          => '',
			'post_type'        => 'opc_video',
			'post_status'      => 'publish',
			'suppress_filters' => true );
		$posts_array = get_posts( $args );

		foreach($posts_array as $post){
			$post->youtube_id = get_post_meta($post->ID, 'youtube_id', true);
		}

		return $posts_array;
	}

	function generate_youtube_embed_code($youtube_id, $width = 210, $height = 157){
		return '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $youtube_id . '" frameborder="0" allowfullscreen></iframe>';
	}

	function has_communicado_image($post_id){
		if(get_post_thumbnail_id($post_id)) {
			return true;
		}
		else if(get_post_meta($post_id, 'image_file', true)){
			return true;
		}
		else {
			return false;
		}
	}

	function get_latest_communicados(){
		$args = array(
			'post_type' => 'opc_communicado',
			'posts_per_page'   => 3,
		);

		$return = new WP_Query( $args );
		return $return;
	}

	function get_communicados_featured_image($post_id, $size = 'full'){ // Returns an image url
		if(get_post_thumbnail_id($post_id)) {
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		}
		else if(get_post_meta($post_id, 'image_file', true)){
			$feat_image = wp_get_attachment_url(get_post_meta($post_id, 'image_file', true));
		}
		else {
			$feat_image = false;
		}
		return $feat_image;
	}

	function echo_comminucado_download_links($post_id){
		// Get PDF
		if(get_post_meta($post_id, 'image_file', true)){
			$image = new stdClass();
			$image->href = wp_get_attachment_url(get_post_meta($post_id, 'image_file', true));
			$image->type = 'image';
		}
		// Get Image Link
		if(get_post_meta($post_id, 'pdf_file', true)){
			$pdf = new stdClass();
			$pdf->href = wp_get_attachment_url(get_post_meta($post_id, 'pdf_file', true));
			$pdf->type = 'pdf';
		}
		if(isset($pdf) || isset($image)){
			echo '<div class="download-links gray-box">';
			if(isset($image)){
				echo '<a href="' . $image->href . '">Descargar Comunicado</a>';
			}
			if(isset($pdf)){
				echo '<a href="' . $pdf->href . '">Descargar PDF</a>';
			}
			echo '</div>';
		}
	}

	function opc_get_the_author($post_author, $before){
		$author_name = get_the_author_meta( 'display_name', $post_author );
		$author_url = get_the_author_meta( 'user_url', $post_author );
		if($author_url){
			$html =  $before . ' ' . '<a href="' . $author_url . '">' . $author_name . '</a>';
		}
		else {
			$html = $before . ' ' . $author_name;
		}
		return $html;
	}

	function get_radio_show_player($post_id){
		$link =  wp_get_attachment_url(get_post_meta( $post_id, 'audio_file', true )); 
		$mime_type = wp_check_filetype( $link );
		$html = '<audio controls>
			<source src="' . $link . '" type="' . $mime_type['type'] . '">
			<a href="' . $link . '">Descargar Audio</a>
		</audio>';
		return $html;
	}

	function get_acf_gallery_shortcode($post_id){
		$image_ids = get_field('main_gallery', $post_id, false);
		$shortcode = '[gallery ids="' . implode(',', $image_ids) . '"]';
		return do_shortcode( $shortcode );
	}

	function echo_the_categories(){
		if(count(get_the_category(get_the_ID())) > 0){
			echo '<p>Categorías: '. get_the_category_list(', ', 'single', get_the_ID()) . '</p>';
		}
	}

	function get_acf_gallery_images($post_id, $number_of_images = 5){
		$image_ids = get_field('main_gallery', $post_id);
		$return = array();
		if( $image_ids ){
			for($i = 0; $i < count($image_ids); $i++ ) {
				if($i < $number_of_images){
					$image = new stdClass();
					$image->src = $image_ids[$i]['sizes']['large'];
					$image->alt = $image_ids[$i]['alt'];
					array_push($return, $image);
                }
                else {
                	break;
                }
            }
        }
  		return $return;       
  	}

  	function get_social_media_links($type){
  		if($type == 'facebook' && get_site_option('facebook_link') != ''){
  			return get_site_option('facebook_link'); 
  		}
  		else if($type == 'twitter' && get_site_option('twitter_link') != ''){
  			return get_site_option('twitter_link'); 
  		}
  		else if($type == 'youtube' && get_site_option('youtube_link') != '') {
  			return get_site_option('youtube_link'); 
  		}
  		else {
  			return false;
  		}  		
  	}

  	function get_custom_text($type, $return_fallback = true){
		if($type == 'home_page_videos_title'){
			if(get_site_option('home_page_videos_title') != ''){
				return get_site_option('home_page_videos_title'); 
			}
			else {
				return "Nuestros Videos"; 
			}
		}
  		else if($type == 'home_page_communicados_text'){
  			if(get_site_option('home_page_communicados_text') != ''){
  				return get_site_option('home_page_communicados_text'); 
  			}
  			else {
  				return "Nuestros Últimos Comunicados"; 
  			}
  		}
  		else if($type == 'home_page_sponsors_text'){
  			if(get_site_option('home_page_sponsors_text') != ''){
  				return get_site_option('home_page_sponsors_text'); 
  			}
  			else {
  				return "Nuestros Auspiciadores"; 
  			}
  		}
  		else if($type == 'home_page_sponsor_0'){
  			if(get_site_option('home_page_sponsor_0') != ''){
  				return get_site_option('home_page_sponsor_0'); 
  			}
  			else {
  				return "Auspicio de primera plana"; 
  			}
  		}
  		else if($type == 'home_page_sponsor_1'){
  			if(get_site_option('home_page_sponsor_1') != ''){
  				return get_site_option('home_page_sponsor_1'); 
  			}
  			else {
  				return "Auspiciador de avance de platino"; 
  			}
  		}
  		else if($type == 'home_page_sponsor_2'){
  			if(get_site_option('home_page_sponsor_2') != ''){
  				return get_site_option('home_page_sponsor_2'); 
  			}
  			else {
  				return "Auspiciadores titulares de oro (Premios Especiales)"; 
  			}
  		}
  		else if($type == 'home_page_sponsor_3'){
  			if(get_site_option('home_page_sponsor_3') != ''){
  				return get_site_option('home_page_sponsor_3'); 
  			}
  			else {
  				return "Auspiciadores titulares de oro"; 
  			}
  		}
  		else if($type == 'logo_image'){
  			if(get_site_option('logo_image') != ''){
  				return get_site_option('logo_image'); 
  			}
  			else if($return_fallback){
  				return get_bloginfo('template_url') . '/img/Overseas-Press-Club-Puerto-Rico-Logo-200.png';
  			}
  			else {
  				return false;
  			}
  		}
  		else if($type == 'logo_image_width'){
  			if(get_site_option('logo_image_width') != ''){
  				return get_site_option('logo_image_width'); 
  			}
  			else if($return_fallback){
  				return '200';
  			}
  			else {
  				return false;
  			}
  		}
  		else {
  			return get_site_option($type);
  		}  		
  	}


/* Custom OPC Settings Page
---------------------------------------------------------------------- */

	// create custom plugin settings menu
	add_action('admin_menu', 'opc_create_menu');

	function opc_create_menu() {

		//create new top-level menu
		add_menu_page('OPC Plugin Settings', 'OPC Settings', 'administrator', __FILE__, 'opc_settings_page');

		//call register settings function
		add_action( 'admin_init', 'register_mysettings' );
	}


	function register_mysettings() {
		//register our settings
		register_setting( 'opc-settings-group', 'facebook_link' );
		register_setting( 'opc-settings-group', 'twitter_link' );
		register_setting( 'opc-settings-group', 'youtube_link' );
		register_setting( 'opc-settings-group', 'home_page_videos_title' );
		register_setting( 'opc-settings-group', 'home_page_comunicados_text' );
		register_setting( 'opc-settings-group', 'home_page_sponsors_text' );
		register_setting( 'opc-settings-group', 'home_page_sponsor_0' );
		register_setting( 'opc-settings-group', 'home_page_sponsor_1' );
		register_setting( 'opc-settings-group', 'home_page_sponsor_2' );
		register_setting( 'opc-settings-group', 'home_page_sponsor_3' );
		register_setting( 'opc-settings-group', 'logo_image' );
		register_setting( 'opc-settings-group', 'logo_image_width' );
	}

	function opc_settings_page() {
	?>
	<div class="wrap">
	<h2>Overseas Preass Club Custom Settings</h2>

	<form method="post" action="options.php">
	    <?php settings_fields( 'opc-settings-group' ); ?>
	    <h4>Social Media Links</h4>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">Facebook Link</th>
			<td><input type="text" name="facebook_link" value="<?php echo get_option('facebook_link'); ?>" /></td>
			</tr>
			 
			<tr valign="top">
			<th scope="row">Twitter Link</th>
			<td><input type="text" name="twitter_link" value="<?php echo get_option('twitter_link'); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">Youtube Link</th>
			<td><input type="text" name="youtube_link" value="<?php echo get_option('youtube_link'); ?>" /></td>
			</tr>
		</table>
		<h4>Customize Text Snippets</h4>
		<table class="form-table">

			<tr valign="top">
			<th scope="row">Home Page Communicados Title ('NUESTROS ÚLTIMOS COMUNICADOS')</th>
			<td><input type="text" name="home_page_comunicados_text" value="<?php echo get_option('home_page_comunicados_text'); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">Home Page Sponsors Title ('NUESTROS AUSPICIADORES')</th>
			<td><input type="text" name="home_page_sponsors_text" value="<?php echo get_option('home_page_sponsors_text'); ?>" /></td>
			</tr>
			 
			<tr valign="top">
			<th scope="row">Home Page Videos Page Title ('OPC VIDEOS')</th>
			<td><input type="text" name="home_page_videos_title" value="<?php echo get_option('home_page_videos_title'); ?>" /></td>
			</tr> 

			<tr valign="top">
			<th scope="row">AUSPICIO DE PRIMERA PLANA</th>
			<td><input type="text" name="home_page_sponsor_0" value="<?php echo get_option('home_page_sponsor_0'); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">AUSPICIADOR DE AVANCES DE PLATINO</th>
			<td><input type="text" name="home_page_sponsor_1" value="<?php echo get_option('home_page_sponsor_1'); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">AUPICIADORES TITULARES DE ORO</th>
			<td><input type="text" name="home_page_sponsor_2" value="<?php echo get_option('home_page_sponsor_2'); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">AUSPICIADORES TITULARES DE ORO</th>
			<td><input type="text" name="home_page_sponsor_3" value="<?php echo get_option('home_page_sponsor_3'); ?>" /></td>
			</tr>
		</table>
		
		

		
		<h4>Logo</h4>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Page Logo (Image on Header)</th>
				<td>
					<div id="logo-image-upload"class="uploader">
						<input id="upload_image_logo_opc" type="text" name="logo_image" value="<?php echo get_option('logo_image'); ?>" />
						<input type="button" class="button" name="logo_image_button" id="logo_image_button" value="Upload" />
					</div>
				</td>
			</tr>
			 
			<tr valign="top">
			<th scope="row">Logo Width (in pixels)</th>
			<td><input  type="text" name="logo_image_width" value="<?php echo get_option('logo_image_width'); ?>" /></td>
			</tr>
		</table>
	    <script>
			jQuery(document).ready(function($){

				var _custom_media = false,
					_orig_send_attachment = wp.media.editor.send.attachment;

				wp.media.editor.send.attachment = function(props, attachment){
					console.log('attachment.url: ' + attachment.url);
					$("#upload_image_logo_opc").val(attachment.url);
					// if ( _custom_media ) {
						
					// } else {
					// 	return _orig_send_attachment.apply( this, [props, attachment] );
					// };
				}
				$('.uploader .button').click(function(e) {
					var send_attachment_bkp = wp.media.editor.send.attachment;
					var button = $(this);
					var id = button.attr('id').replace('_button', '');
					wp.media.editor.open(button);
					return false;
				});
				// $('.add_media').on('click', function(){
				// 	_custom_media = false;
				// })
			});

	    </script>
	    <?php submit_button(); ?>

	</form>
	</div>
	<?php } ?>
