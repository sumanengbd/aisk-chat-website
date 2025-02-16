<?php
show_admin_bar(false);
require_once('includes/classes/TableContent.php');
require_once('includes/classes/ACFFieldClass.php');
require_once('includes/classes/BootstrapNavwalker.php');

if ( ! function_exists( 'aisk_setup' ) ) {

	function aisk_setup() {
		/** Make theme available for translation. */
		load_theme_textdomain( 'aisk', get_template_directory() . '/languages' );

		/** Enable support for Post Thumbnails on posts and pages. */
		add_theme_support( 'post-thumbnails' );
		// add_image_size( 'post_thumb', 380, 248, true );
		// add_image_size( 'post_large', 580, 322, true );

		/*** Editor Style */
		add_editor_style(get_template_directory_uri() . '/css/admin-editor.min.css');
		add_editor_style(get_template_directory_uri() . '/css/admin.min.css');

		/** This theme uses wp_nav_menu() in one location. */
		register_nav_menus( array(
		  	'menu-1' => esc_html__( 'Primary Menu', 'aisk' ),
		  	'menu-2' => esc_html__( 'Secondary Menu', 'aisk' ),
		  	'menu-3' => esc_html__( 'Footer Menu 1', 'aisk' ),
		  	'menu-4' => esc_html__( 'Footer Menu 2', 'aisk' ),
		  	'menu-5' => esc_html__( 'Privacy Menu', 'aisk' ),
		) );
	}
}
add_action( 'after_setup_theme', 'aisk_setup' );

/*** Enqueue scripts and styles. */
function aisk_preconnect() {
    echo '<link href="https://fonts.googleapis.com" rel="preconnect">';
    echo '<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=Abel&family=Gelasio:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">';
}
add_action('wp_head', 'aisk_preconnect', 5);

function aisk_scripts() {

	/*** Enqueue styles. */
	wp_enqueue_style(
		'plugins', get_template_directory_uri() . '/css/plugins.css', array(), date("ymd-Gis", filemtime( get_template_directory() . '/css/plugins.css' )), 'all');
	wp_enqueue_style( 'aisk-style', get_stylesheet_uri(), array(), "0.1.0");

	/*** Enqueue scripts. */
	wp_enqueue_script('jquery');
	wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js', array(), date("ymd-Gis", filemtime( get_template_directory() . '/js/plugins.js' )), true);
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), date("ymd-Gis", filemtime( get_template_directory() . '/js/scripts.js' )), true);
}
add_action( 'wp_enqueue_scripts', 'aisk_scripts' );

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/*** Register and enqueue a custom stylesheet in the WordPress admin. */
function aisk_admin_scripts() {
	wp_enqueue_style('sadmin', get_template_directory_uri() . '/css/admin.min.css', array(), false, 'all');
	wp_enqueue_script('sadmin', get_template_directory_uri() . '/js/admin.min.js');
}
add_action( 'admin_enqueue_scripts', 'aisk_admin_scripts' );

/** Options Page Header Background */
function aisk_admin_dashboard_css() {
	echo '<style type="text/css">
		#acf-group_5a2badeb476ba .hndle { flex-grow: initial; }
		#acf-group_5a2badeb476ba .hndle img { max-width: 180px; margin-right: 15px; }
		#acf-group_5a2badeb476ba .hndle span { display: inline-flex; align-items: center; }
	</style>';
}
add_action('admin_head', 'aisk_admin_dashboard_css');

/*** ACF OPTIONS PAGE */
if(function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

/*** Customize the JSON ACF File */
function custom_acf_json_filename( $filename, $post, $load_path ) {
    $filename = str_replace(array(' ', '_' ), array('-', '-'), $post['title']);
    $filename = strtolower( $filename ) . '.json';

    return $filename;
}
add_filter( 'acf/json/save_file_name', 'custom_acf_json_filename', 10, 3 );

/*** Replace {site_link} with site URL on ACF options page output */
add_action('admin_init', function() {
    if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'acf-options') {
        ob_start(function($content) {
            return str_replace('{site_link}', esc_url(site_url()), $content);
        });
        add_action('shutdown', function() { ob_end_flush(); });
    }
});

/*** Reorder dashboard menu */
function aisk_reorder_admin_menu( $__return_true ) {
	return array(
		'index.php',                 		
		'separator1',
		'acf-options',
		'edit.php',
		'edit.php?post_type=page',
		'edit.php?post_type=team',
		'edit.php?post_type=testimonial',
		'gf_edit_forms',
		'upload.php',
		'wpseo_dashboard',
		'gadash_settings',
		'themes.php',
		'edit-comments.php', 
		'users.php',
		'tools.php',
		'options-general.php',
		'plugins.php',
	);
}
add_filter( 'custom_menu_order', 'aisk_reorder_admin_menu' );
add_filter( 'menu_order', 'aisk_reorder_admin_menu' );

/*** Remove dashboard menu */
function aisk_remove_admin_menus() {
	remove_menu_page( 'sharethis-inline-sticky-share-buttons' );
}
add_action( 'admin_menu', 'aisk_remove_admin_menus', 999);

/*** Gravity form user role */
function aisk_gforms_editor_access() {
	$role = get_role( 'editor' );
	$role->add_cap( 'gform_full_access' );
}
add_action( 'after_switch_theme', 'aisk_gforms_editor_access' );

/*** Gravity form anchor */
add_filter( 'gform_confirmation_anchor', '__return_false' );

function aisk_form_submit_button($button, $form) {
	return "<button class='btn btn--big' id='gform_submit_button_{$form["id"]}'>{$form['button']['text']}</button>";
}
add_filter("gform_submit_button", "aisk_form_submit_button", 10, 2);

function aisk_add_grammarly_disable_attribute( $field_content, $field, $value, $lead_id, $form_id ) {
    if ( $field->type == 'textarea' ) 
    {
        $field_content = str_replace( '<textarea', '<textarea data-enable-grammarly="false"', $field_content );
    }

    return $field_content;
}
add_filter( 'gform_field_content', 'aisk_add_grammarly_disable_attribute', 10, 5 );

/*** get permalink by template name */
function get_template_id($temp) {
    $link = null;
    $pages = get_posts(
        array(
        	'post_type' => 'page',
        	'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => $temp
        )
    );

    if(isset($pages[0])){
        $id = $pages[0]->ID;
    }
    return $id;
}

/*** Return an alternate title, without prefix, for every type used in the get_the_archive_title(). */
add_filter('get_the_archive_title', function ($title) {

    if ( is_category() || is_tag() || is_tax('case-study-category') ) 
    {
        $title = single_tag_title( '', false );
    }
    elseif ( is_author() ) 
    {
        $title = get_the_author();
    }

    return $title;
});

/*** Popular Posts */
function aisk_count_post_visits() {
	if ( is_single() ) 
	{
		global $post;

		$views = get_post_meta( $post->ID, 'my_post_viewed', true );

		if ( $views == '' ) 
		{
			update_post_meta( $post->ID, 'my_post_viewed', '1' );	
		} 
		else 
		{
			$views_no = intval( $views );
			
			update_post_meta( $post->ID, 'my_post_viewed', ++$views_no );
		}
	}
}
add_action( 'wp_head', 'aisk_count_post_visits' );

/*** add SVG to allowed file uploads */
function aisk_custom_mime_types( $mimes ) {
	// New allowed mime types.
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	$mimes['doc'] = 'application/msword';
	 
	// Optional. Remove a mime type.
	unset( $mimes['exe'] );
	 
	return $mimes;
}
add_filter( 'upload_mimes', 'aisk_custom_mime_types' );

/**
* Add a toggler button to the end of a specific menu that uses the wp_nav_menu() function
*/
function aisk_menu_toggler_button( $items, $args ) {

	if( $args->theme_location == 'menu-2' && $args->menu_id == 'secondary-menu' ) {
        $items_array = array();

        while ( false !== ( $item_pos = strpos ( $items, '<li', -1 ) ) ) {
            $items_array[] = substr($items, 0, $item_pos);
            $items = substr($items, $item_pos);
        }

        $items_array[] = $items;

        array_splice(
        	$items_array, 5, 0,
        	'<li class="mobile-navbar-toggler d-xl-none">
				<button class="navbar-toggle" type="button">
					<span class="icon-bar"><span class="inner"></span></span>
				  	<span class="icon-bar"><span class="inner"></span></span>
				  	<span class="icon-bar"><span class="inner"></span></span>
			  	</button>
			</li>'
		);				

        $items = implode('', $items_array);
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'aisk_menu_toggler_button', 10, 2);

/**
 * Shortcode function to display copyright information with placeholders.
 *
 * @param array $atts Shortcode attributes (unused in this example).
 * @return string HTML content for displaying copyright information.
 */
function aisk_copyright_shortcode($atts) {
	
    $copyright = get_field('copyright', 'options');

    if (!empty($copyright)) 
    {
    	$output = str_replace(array('{year}', '{site_name}', '{site_link}'), array(date('Y'), get_bloginfo('name'), home_url()), $copyright);
    } 
    else 
    {
        $output = 'Copyright &copy; '. date('Y') .' '. get_bloginfo('name');
    }

    return '<div class="copyright'.( isset($atts['class']) ? ' '.$atts['class'] : '').'"><p>' . wp_kses_post($output) . '</p></div>';
}
add_shortcode('copyright', 'aisk_copyright_shortcode');

/**
 * Rewrite WordPress URLs to Include /blog/ in Post Permalink Structure
 */
function aisk_blog_generate_rewrite_rules( $wp_rewrite ) {
  $new_rules = array(
    '(([^/]+/)*blog)/page/?([0-9]{1,})/?$' => 'index.php?pagename=$matches[1]&paged=$matches[3]',
    'blog/([^/]+)/?$' => 'index.php?post_type=post&name=$matches[1]',
    'blog/[^/]+/attachment/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
    'blog/[^/]+/attachment/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
    'blog/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',   
    'blog/[^/]+/attachment/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'blog/[^/]+/embed/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'blog/([^/]+)/embed/?$' => 'index.php?post_type=post&name=$matches[1]&embed=true',
    'blog/[^/]+/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'blog/([^/]+)/trackback/?$' => 'index.php?post_type=post&name=$matches[1]&tb=1',
    'blog/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
    'blog/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
    'blog/page/([0-9]{1,})/?$' => 'index.php?post_type=post&paged=$matches[1]',
    'blog/[^/]+/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
    'blog/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
    'blog/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&cpage=$matches[2]',
    'blog/([^/]+)(/[0-9]+)?/?$' => 'index.php?post_type=post&name=$matches[1]&page=$matches[2]',
    'blog/[^/]+/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
    'blog/[^/]+/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
    'blog/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'blog/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',
  );
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'aisk_blog_generate_rewrite_rules' );

function aisk_blog_update_post_link( $post_link, $id = 0 ) {
    $post = get_post( $id );

    if ( is_object( $post ) && $post->post_type == 'post' ) 
    {
      	return str_replace( home_url(), home_url('/blog'), $post_link);
    }
    
    return $post_link;
}
add_filter( 'post_link', 'aisk_blog_update_post_link', 1, 3 );

/**
 * Redirect all posts to new url
 * If you get error 'Too many redirects' or 'Redirect loop', then delete everything below
 */
function aisk_blog_redirect_old_urls() {

	if ( is_singular('post') ) {
		global $post;

		if ( strpos( $_SERVER['REQUEST_URI'], '/blog/') === false) {
		   wp_redirect( home_url( user_trailingslashit( "blog/$post->post_name" ) ), 301 );
		   exit();
		}
	}
}
add_filter( 'template_redirect', 'aisk_blog_redirect_old_urls' );

/*** Breadcrumb */
function aisk_breadcrumb( $classes = '' ) {

	global $post;

	$delimiter = '<span class="angle-right">/</span>';
	$home = 'Home'; 
	$before = '<span class="current-page">'; 
	$after = '</span>'; 

	$homeLink = get_bloginfo('url');
	$blogTitle = get_the_title( get_option( 'page_for_posts' ) );
	$blogLink = get_permalink( get_option( 'page_for_posts' ) );

	$events = get_post_type_object('product');

	if ( !is_front_page() ) {
   
		echo '<nav class="breadcrumb'.(!empty( $classes ) ? ' ' . $classes : '').'">';
		    
		    echo '<a href="' . home_url() . '">' . $home . '</a> ' . $delimiter . ' ';
		   
		    if ( is_home() ) {

		        echo $before . ' ' . $blogTitle . ' ' . $after;

		    } elseif ( is_category() ) {

			    global $wp_query;
			    $cat_obj = $wp_query->get_queried_object();
			    $thisCat = $cat_obj->term_id;
			    $thisCat = get_category($thisCat);
			    $parentCat = get_category($thisCat->parent);
			    if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			    echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
			    echo $before . single_cat_title('', false) . $after;

		    } elseif ( is_day() ) {
		      	echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		      	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		      	echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		      	echo $before . get_the_time('d') . $after;
		   
		    } elseif ( is_month() ) {

		      	echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		      	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		      	echo $before . get_the_time('F') . $after;
		   
		    } elseif ( is_year() ) {

		      	echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		      	echo $before . get_the_time('Y') . $after;
		   
		    } else if ( is_author() ) {
		        global $author;
		        $userdata = get_userdata( $author );
		            
		        echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		        echo $before . ' ' . $userdata->display_name . ' ' . $after;
		           
		    } elseif ( is_single() && !is_attachment() ) {

		        global $wp_query;
		        $cat_obj = $wp_query->get_queried_object();

		        if ($cat_obj->post_type === 'solution') {
		        	echo '<a href="' . get_the_permalink( get_template_id('t_solutions.php') ) . '">'.get_the_title( get_template_id('t_solutions.php') ).'</a> ' . $delimiter . ' ';
		        	echo $before . $cat_obj->post_title . $after;

		        } elseif ( get_post_type() != 'post' ) {
		          	$post_type = get_post_type_object(get_post_type());
		          	$slug = $post_type->rewrite;
		          	echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
		          	echo $before . get_the_title() . $after;

		        } else {
		          	$cat = get_the_category(); $cat = $cat[0];
		          	echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		          	//echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		          	echo $before . get_the_title() . $after;
		        }
		    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search() ) {
		    	global $wp_query;
		    	$cat_obj = $wp_query->get_queried_object();
		      	$post_type = get_post_type_object(get_post_type());
		    
		      	if ( is_tax( 'solution-category' ) ) {
		      		echo '<a href="' . get_the_permalink( get_template_id('t_solutions.php') ) . '">'.get_the_title( get_template_id('t_solutions.php') ).'</a> ' . $delimiter . ' ';
		        	echo $before . $cat_obj->name . $after;
		      	}
		      	else {
		        	echo $before . $post_type->labels->singular_name . $after;
		      	}
		   
		    } elseif ( is_attachment() ) {

			    $parent = get_post($post->post_parent);
			    // $cat = get_the_category($parent->ID); $cat = $cat[0];
			    // echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			    echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			    echo $before . get_the_title() . $after;
		   
		    } elseif ( is_page() && !$post->post_parent ) {

		        echo $before . get_the_title() . $after;

		    } elseif ( is_page() && $post->post_parent ) {

		      	$parent_id = $post->post_parent;
		      	$breadcrumbs = array();
		      	while ($parent_id) {
		      		$page = get_page($parent_id);
		      		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		      		$parent_id = $page->post_parent;
		      	}

		      	$breadcrumbs = array_reverse($breadcrumbs);
		      	foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
		        	echo $before . get_the_title() . $after;
		   
		    } elseif ( is_search() ) {

		        // echo $before . ' ' . $blogTitle . ' ' . $after;
		        echo $before . 'Search Results for: "' . get_search_query() . '"' . $after;

		    } elseif ( is_tag() ) {
		        echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		        echo $before . 'Posts with the tag "' . single_tag_title('', false) . '"' . $after;

		    } elseif ( is_tag() ) {

		        echo '<a href="' . $blogLink . '">'.$blogTitle.'</a> ' . $delimiter . ' ';
		        echo $before . 'Posts with the tag "' . single_tag_title('', false) . '"' . $after;

		    } elseif ( is_404() ) {

		        echo $before . 'Error 404' . $after;
		    }
		   
		    if ( get_query_var('paged') ) {
		        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		          echo ': ' . __('Page') . ' ' . get_query_var('paged');
		        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		    }
			
		echo '</nav>';
	} 
}

/** 
 * Display page template's name column into admin
 */
function aisk_pages_add_custom_column( $original_columns ) {
	$new_columns = $original_columns;
	array_splice( $new_columns, 99 );

  	$new_columns['template'] = 'Template';
  	return $new_columns;
}
add_filter( 'manage_posts_columns', 'aisk_pages_add_custom_column' );

// Add the data to the custom column
function aisk_pages_add_custom_column_data( $column, $post_id ) {
  	switch ( $column ) {
    	case 'template' :
      		$post = get_post( $post_id );
      		echo get_post_meta( $post->ID, '_wp_page_template', true );
      		// echo get_page_template_slug( $post ); 
    break;
  }
}
add_action( 'manage_posts_custom_column' , 'aisk_pages_add_custom_column_data', 10, 2 );