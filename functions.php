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
		add_image_size( 'post_thumb', 240, 156, true );
		add_image_size( 'post_large', 847, 444, true );

		/*** Editor Style */
		add_editor_style(get_template_directory_uri() . '/css/admin-editor.min.css');
		add_editor_style(get_template_directory_uri() . '/css/admin.min.css');

		/** This theme uses wp_nav_menu() in one location. */
		register_nav_menus( array(
		  	'menu-1' => esc_html__( 'Primary Menu', 'aisk' ),
		  	'menu-2' => esc_html__( 'Secondary Menu', 'aisk' ),
		  	'menu-3' => esc_html__( 'Footer Menu', 'aisk' ),
		) );
	}
}
add_action( 'after_setup_theme', 'aisk_setup' );

/*** Enqueue scripts and styles. */
function aisk_preconnect() {
    echo '<link href="https://fonts.googleapis.com" rel="preconnect">';
    echo '<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>';
    echo '<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">';
}
add_action('wp_head', 'aisk_preconnect', 5);

function aisk_enqueue_scripts() {

	/*** Enqueue styles. */
	wp_enqueue_style('plugins', get_template_directory_uri() . '/css/plugins.css', array(), date("ymd-Gis", filemtime( get_template_directory() . '/css/plugins.css' )), 'all');
	wp_enqueue_style('aisk-style', get_stylesheet_uri(), array(), date("ymd-Gis", filemtime( get_stylesheet_directory() . '/style.css' )), 'all');

	/*** Enqueue scripts. */
	wp_enqueue_script('jquery');
	wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js', array(), date("ymd-Gis", filemtime( get_template_directory() . '/js/plugins.js' )), true);
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), date("ymd-Gis", filemtime( get_template_directory() . '/js/scripts.js' )), true);

	if (is_single() && comments_open()) {
        wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js');
    }
}
add_action( 'wp_enqueue_scripts', 'aisk_enqueue_scripts' );

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

function aisk_recaptcha_in_comment_form() {
    echo '<div class="g-recaptcha" data-sitekey="6LdZu6srAAAAAAlky6uUu1MM_ejfW0OFljidmxgD"></div>';
}
add_action('comment_form_after_fields', 'aisk_recaptcha_in_comment_form');
add_action('comment_form_logged_in_after', 'aisk_recaptcha_in_comment_form');

function verify_recaptcha_comment($commentdata) {
    if (is_user_logged_in()) return $commentdata;

    if (isset($_POST['g-recaptcha-response'])) {
        $response = wp_remote_get(
            "https://www.google.com/recaptcha/api/siteverify?secret=6LdZu6srAAAAAJR5C_0GpSZeuAP2zYUgbbIY6Krl&response=" . $_POST['g-recaptcha-response']
        );

        $response = json_decode(wp_remote_retrieve_body($response), true);

        if (empty($response['success'])) {
            wp_die(__('reCAPTCHA verification failed. Please go back and try again.'));
        }
    } else {
        wp_die(__('Please complete the reCAPTCHA to submit your comment.'));
    }
    return $commentdata;
}
add_filter('preprocess_comment', 'verify_recaptcha_comment');


/** Options Page Header Background */
function aisk_admin_dashboard_css() {
	echo '<style type="text/css">
		#acf-group_5a2badeb476ba .hndle { flex-grow: initial; }
		#acf-group_5a2badeb476ba .hndle img { max-width: 180px; margin-right: 15px; }
		#acf-group_5a2badeb476ba .hndle span { display: inline-flex; align-items: center; }

		#menu-to-edit li.menu-item .menu-item-settings .acf-menu-item-fields { float: none; clear: both; }
		#menu-to-edit li.menu-item .menu-item-settings .acf-menu-item-fields .acf-label { margin: 2px 0 5px; }
		#menu-to-edit li.menu-item .menu-item-settings .acf-menu-item-fields label { font-weight: normal; font-style: italic; margin-bottom: 0; }
		#menu-to-edit li.menu-item.menu-item-depth-0 .acf-menu-item-fields .acf-field.acf-field-image, #menu-to-edit li.menu-item.menu-item-depth-0 .acf-menu-item-fields .acf-field.acf-field-text, #menu-to-edit li.menu-item.menu-item-depth-0 .acf-menu-item-fields .acf-field.acf-field-radio, #menu-to-edit li.menu-item.menu-item-depth-0 .acf-menu-item-fields .acf-field.acf-field-checkbox, #menu-to-edit li.menu-item.menu-item-depth-0 .acf-menu-item-fields .acf-field-repeater, #menu-to-edit li.menu-item.menu-item-depth-0 .acf-menu-item-fields .acf-field.acf-field-true-false .acf-label { display: none; } 
		#menu-to-edit li.menu-item.menu-item-depth-1 .acf-menu-item-fields .acf-field.acf-field-true-false, #menu-to-edit li.menu-item.menu-item-depth-2 .acf-menu-item-fields .acf-field.acf-field-true-false, #menu-to-edit li.menu-item.menu-item-depth-3 .acf-menu-item-fields .acf-field.acf-field-true-false { display: none; }
		#menu-to-edit li.menu-item.menu-item-depth-0:has(.acf-field.acf-field-true-false[data-name="enable_mega_menu"] input[type="checkbox"]:checked) + li.menu-item-depth-1 .acf-menu-item-fields .acf-field.acf-field-radio { display: block; }
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
// add_filter( 'acf/json/save_file_name', 'custom_acf_json_filename', 10, 3 );

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

    if ( is_category() || is_tag() ) 
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
	$mimes['avi'] = 'video/x-msvideo';
	 
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

    return '<div class="footer__copyright'.( isset($atts['class']) ? ' '.$atts['class'] : '').'"><p>' . wp_kses_post($output) . '</p></div>';
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