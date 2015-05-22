<?php

/**
 * Set up the content width value based on the theme's design.
 *
 * @see persianGULF_content_width()
 *
 * @since persianGULF 0.1
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'persianGULF_setup' ) ) :
/**
 * persianGULF setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since persianGULF 0.1
 */
function persianGULF_setup() {

	/*
	 * Make persianGULF available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on persianGULF, use a find and
	 * replace to change 'persianGULF' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'persianGULF', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	//add_editor_style( array( 'css/editor-style.css', persianGULF_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'persianGULF-full-width', 1024, 800, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'persianGULF' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'persianGULF' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'persianGULF_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	/*add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'persianGULF_get_featured_posts',
		'max_posts' => 6,
	) );*/

	// This theme uses its own gallery styles.
	//add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'persianGULF_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function persianGULF_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'persianGULF_content_width' );


function persianGULF_scripts() {
  
  // STYLES
  wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
  wp_enqueue_style('main-style', get_template_directory_uri().'/assets/css/main.css');

  
  // SCRIPTS
/*wp_register_script( "urlHelper", get_template_directory_uri().'/assets/js/common/pG_url_helper.js', array('jquery'),'',true );
wp_localize_script( 'urlHelper', 'pgAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
wp_enqueue_script('urlHelper' );*/

$coreHelper = array(
 					'homeUrl' => esc_url(home_url()),
 					);

wp_register_script( 'core_helper', get_template_directory_uri().'/assets/js/core/core_helper.js', array('jquery'), "", true );
wp_localize_script( 'core_helper', 'coreHelper', $coreHelper );

wp_register_script('requireJS', get_template_directory_uri().'/assets/js/vendor/require.js',array('jquery','underscore','backbone','core_helper'),'',true);
wp_enqueue_script('requireJS');

 }

add_action('wp_enqueue_scripts','persianGULF_scripts');

// adding data-main attribute to requireJS handler	
function persianGULF_require_js_config( $tag, $handle ) {
    if ( 'requireJS' === $handle ) {
        return str_replace( ' src', ' data-main="'. get_template_directory_uri().'/assets/js/config" src', $tag );
    } else {
       	return $tag;
    }
}
add_filter( 'script_loader_tag', 'persianGULF_require_js_config',10,2);

/*------------------- url_helper function.----------------------------------------- */

add_action("wp_ajax_persianGULF_param_helper", "persianGULF_param_helper");
add_action("wp_ajax_nopriv_persianGULF_param_helper", "persianGULF_param_helper_approval");

function persianGULF_param_helper() {

global $wp,$wp_query; 

$query_vars = new stdClass();
   
   if ( !wp_verify_nonce( $_REQUEST['nonce'], "persianGULF_param_helper_nonce")) {
      exit("you dont have access");
   }   

   $requested_uri = $_REQUEST["requested_uri"];
   $_SERVER['REQUEST_URI'] = $requested_uri;
   $_SERVER['PHP_SELF'] = '/wordpress/index.php';
	
    
    $wp->parse_request();
    $query_vars = $wp->query_vars;

	       
    $wp_query->parse_query($query_vars);

    $query_vars['is_single'] = $wp_query->is_single;
    $query_vars['is_page'] = $wp_query->is_page;
    $query_vars['is_archive'] = $wp_query->is_archive;
    $query_vars['is_date'] = $wp_query->is_date;
    $query_vars['is_year'] = $wp_query->is_year;
    $query_vars['is_month'] = $wp_query->is_month;
    $query_vars['is_day'] = $wp_query->is_day;
    $query_vars['is_author'] = $wp_query->is_author;
    $query_vars['is_category'] = $wp_query->is_category;
    $query_vars['is_tag'] = $wp_query->is_tag;
    $query_vars['is_tax'] = $wp_query->is_tax;
    $query_vars['is_feed'] = $wp_query->is_feed;
    $query_vars['is_home'] = $wp_query->is_home;
    $query_vars['is_404'] = $wp_query->is_404;
    $query_vars['is_paged'] = $wp_query->is_paged;
    $query_vars['is_admin'] = $wp_query->is_admin;
    $query_vars['is_attachment'] = $wp_query->is_attachment;
    $query_vars['is_singular'] = $wp_query->is_singular;
    $query_vars['is_posts_page'] = $wp_query->is_posts_page;
    $query_vars['is_post_type_archive'] = $wp_query->is_post_type_archive;
    $query_vars['is_comment_feed '] = $wp_query->is_comment_feed;
    $query_vars['is_comment_popup'] = $wp_query->is_comment_popup;


    $query_vars = json_encode($query_vars);
    


  

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      echo $query_vars;
      
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}

function persianGULF_param_helper_approval() {
   echo "You must log in to view";
   die();
}


// --------------Permalink-Helper-------------------------------------------------

add_action("wp_ajax_persianGULF_permalink_helper", "persianGULF_permalink_helper");
add_action("wp_ajax_nopriv_persianGULF_permalink_helper", "persianGULF_permalink_helper_approval");

function persianGULF_permalink_helper() {

$permalinkObj = new stdClass();

$permalink_type = $_REQUEST["permalink_type"];
$permalink_id = $_REQUEST["permalink_id"];

	if($permalink_type === "author"){
		$permalinkObj['permalink'] = get_author_posts_url($permalink_id);
	}
$permalinkObj = json_encode($permalinkObj);

  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      echo $permalinkObj;
      
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();
}


function persianGULF_permalink_helper_approval() {
   echo "You must log in to view";
   die();
}   
   
?>