<?php

/* CUSTOM FUNCTIONS
---------------------------------------------------------------------- */
	
	// Load theme styles
	function load_theme_styles() {
		// Download the WP LESS plugin and uncomment this if you want to use LESS
		// wp_register_style('less-styles', get_template_directory_uri()  . '/less/main.less', array(), null);
		// wp_enqueue_style('less-styles');

		// Load traditional styles -- Comment each of these out if you choose to use LESS
		wp_register_style('normalize', get_template_directory_uri()  . '/css/normalize.css', array(), null);
		wp_enqueue_style('normalize');
		
		wp_register_style('boilerplate', get_template_directory_uri()  . '/css/boilerplate.css', array(), null);
		wp_enqueue_style('boilerplate');
		
		wp_register_style('theme-style', get_stylesheet_uri());
		wp_enqueue_style('theme-style');
		
		wp_register_style('helper-classes', get_template_directory_uri()  . '/css/helper-classes.css', array(), null);
		wp_enqueue_style('helper-classes');
	}
	add_action( 'wp_enqueue_scripts', 'load_theme_styles' );
	
	// Load custom login page styles
	function custom_login_styles() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/custom-login.css" />';
	}
	add_action('login_head', 'custom_login_styles');	
	
	// Load theme scripts
	function load_theme_scripts() {
		// Load Modernizr
		wp_register_script('modernizer', get_template_directory_uri()  . '/js/libs/modernizr-2.6.2.min.js', array(), '20130217', false);
		wp_enqueue_script('modernizer');
		// Load js plugins
		wp_register_script('plugins', get_template_directory_uri()  . '/js/plugins.js', array('jquery'), '20130217', true);
		wp_enqueue_script('plugins');
		// Load js functions
		wp_register_script('functions', get_template_directory_uri()  . '/js/functions.js', array('jquery'), '20130217', true);
		wp_enqueue_script('functions');						
	}
	add_action( 'wp_enqueue_scripts', 'load_theme_scripts' );
		
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

/* Custom Post Types
---------------------------------------------------------------------- */

	add_action( 'init', 'create_all_post_types' );
	function create_all_post_types() {
		// Comunicados / Press Releases
		register_post_type( 'opc_communicado',
			array(
				'labels' => array(
					'name' => __( 'Comunicados' ), // general name for the post type, usually plural. The same as, and overridden by $post_type_object->label
					'singular_name' => __( 'Comunicado' ), // name for one object of this post type. Defaults to value of name
					'menu_name' => __( 'Comunicados' ), // the menu name text. This string is the name to give menu items. Defaults to value of name
					'all_items' => __( 'Comunicados' ), //  the all items text used in the menu. Default is the Name label
					'add_new' => __( 'Add New Comunicado' ), //  the add new text. The default is Add New for both hierarchical and non-hierarchical types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
					'add_new_item' => __( 'Add New Comunicado' ), // the add new item text. Default is Add New Post/Add New Page
					'edit_item' => __( 'Edit Comunicado' ), // the edit item text. Default is Edit Post/Edit Page
					'new_item' => __( 'New Comunicado' ), // the new item text. Default is New Post/New Page
					'view_item' => __( 'View comunicado' ), // the view item text. Default is View Post/View Page
					'search_items' => __( 'Search Comunicados' ), // the search items text. Default is Search Posts/Search Pages
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
			'supports' => array('title','editor'),
			'menu_position' => 7,
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
			// 'supports' => array('title','editor'),
			'menu_position' => 5,
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
			if($ordered_posts[$post->sponsor_type] == null){
				$ordered_posts[$post->sponsor_type] = array();
			}
			array_push($ordered_posts[$post->sponsor_type], $post);
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

	function generate_youtube_embed_code($youtube_id, $width = 315, $height = 237){
		return '<iframe width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . $youtube_id . '" frameborder="0" allowfullscreen></iframe>';
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

	function get_comminucado_download_links($post_id){
		$return = array();
		// Get PDF
		if(get_post_meta($post_id, 'pdf_file', true)){
			$pdf = new stdClass();
			$pdf->href = wp_get_attachment_url(get_post_meta($post_id, 'pdf_file', true));
			$pdf->type = 'pdf';
			array_push($return, $pdf);
		}
		// Get Image Link
		if(get_post_meta($post_id, 'image_file', true)){
			$image = new stdClass();
			$image->href = wp_get_attachment_url(get_post_meta($post_id, 'image_file', true));
			$image->type = 'image';
			array_push($return, $image);
		}
		if(count($return) > 0){
			return $return;
		}
		else {
			return false;
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

	function get_acf_gallery_images($post_id, $number_of_images = 5){
		$image_ids = get_field('main_gallery', $post_id);
		$return = array();
		if( $image_ids ){
			for($i = 0; $i < count($image_ids); $i++ ) {
				if($i < $number_of_images){
					$image = new stdClass();
					$image->src = $image_ids[$i]['sizes']['thumbnail'];
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

/* Custom OPC Settings Page
---------------------------------------------------------------------- */

	// create custom plugin settings menu
	add_action('admin_menu', 'opc_create_menu');

	function opc_create_menu() {

		//create new top-level menu
		add_menu_page('opc Plugin Settings', 'opc Settings', 'administrator', __FILE__, 'opc_settings_page');

		//call register settings function
		add_action( 'admin_init', 'register_mysettings' );
	}


	function register_mysettings() {
		//register our settings
		register_setting( 'opc-settings-group', 'facebook_link' );
		register_setting( 'opc-settings-group', 'twitter_link' );
		register_setting( 'opc-settings-group', 'youtube_link' );
	}

	function opc_settings_page() {
	?>
	<div class="wrap">
	<h2>Overseas Preass Club Custom Settings</h2>

	<form method="post" action="options.php">
	    <?php settings_fields( 'opc-settings-group' ); ?>
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
	    
	    <?php submit_button(); ?>

	</form>
	</div>
	<?php }
?>