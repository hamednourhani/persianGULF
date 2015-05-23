<?php
/**
 * Fixy functions and definitions.
 *
 * @package WordPress
 * @subpackage fixy
 * @since Fixy 0.1.0
 */

// Content Width
if ( ! isset( $content_width ) )
	$content_width = 700;

	
/*-- Setup Fixy Features --*/
//textDomain, automatic-feed-link, editor-style, html5, post-formats, nav-menu, post-thumbnails

function fixy_setup(){
	
	load_theme_textdomain( 'fixy', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	add_editor_style('css/editor-style.css');
	register_nav_menu( 'header_menu', __( 'Header Menu', 'fixy' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150,150 , true );
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	
}
add_action( 'after_setup_theme', 'fixy_setup',11 );

//-------------- wp title -----------------------------------------
function fixy_wp_title( $title, $sep ){
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'fixy' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fixy_wp_title', 10, 2 );

/**
 * Registers five widget areas.
 *	1.Sidebar widget area
 *	2.Sticky Widget Area
 *  3.Full Width Footer Widget Area
 *  4.Half Width Footer Widget Area
 *  5.OneThird Width Footer Widget Area
 */
function fixy_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar Widget Area', 'fixy' ),
		'id'            => 'sidebar',
		'description'   =>__('Widgets Area on Right Hand','fixy'),
		'before_widget' => '<aside id="%1$s" class="side-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title" >',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sticky Widget Area', 'fixy' ),
		'id'            => 'sticky-sidebar',
		'description'   =>__('An Sticky Widget Area on top and bottom ','fixy'),
		'before_widget' => '<aside id="%1$s" class="side-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title" >',
		'after_title'   => '</h3>',
	) );
			
	register_sidebar( array(
		'name'          => __( 'Full Width Footer Widget Area', 'fixy' ),
		'id'            => 'footer-fullwidth',
		'description'   => __( 'Shows Widgets in Full Footer Area', 'fixy' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget full-width %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-widget-title" >',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Half Width Footer Widget Area', 'fixy' ),
		'id'            => 'footer-halfwidth',
		'description'   => __( 'Shows Widgets in Half Footer Area', 'fixy' ),
		'before_widget' => '<aside id="%1$s" class="footer-widget half-width %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="footer-widget-title" >',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'OneThird Width Footer Widget Area', 'fixy' ),
		'id'            => 'footer-onethirdwidth',
		'description'   => __( 'Shows Widgets in OneThird Footer Area', 'fixy' ),
		'before_widget' => '<li><aside id="%1$s" class="footer-widget onethird-width %2$s">',
		'after_widget'  => '</aside></li>',
		'before_title'  => '<h3 class="footer-widget-title" >',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'fixy_widgets_init' );



/* Enqueue scripts and styles */

function fixy_scripts_styles() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
			wp_enqueue_style( 'fixy-style', get_stylesheet_uri(), array());
		}
add_action( 'wp_enqueue_scripts', 'fixy_scripts_styles' );

function functions_js(){
wp_enqueue_script('functions',get_template_directory_uri().'/js/functions.js',array('jquery'));
wp_enqueue_script('scrolltofixed',get_template_directory_uri().'/js/scrolltofixed.js',array('jquery'));
wp_enqueue_script('sticky-widget',get_template_directory_uri().'/js/sticky-widget.js',array('jquery','scrolltofixed'));
wp_enqueue_script('jquery-fitvids',get_template_directory_uri().'/js/FitVids/jquery.fitvids.js',array('jquery','scrolltofixed'));
wp_enqueue_script('scrollReveal',get_template_directory_uri().'/js/scrollReveal/scrollReveal.js',array());
wp_enqueue_style('fontello',get_template_directory_uri().'/fonts/font-icon/css/fontello.css');
wp_enqueue_style( 'fixy-style', get_stylesheet_uri(), array(), '2013' );
wp_enqueue_style( 'fixy-ie', get_template_directory_uri() . '/css/ie.css', array( 'fixy-style' ), '2013' );
wp_style_add_data( 'fixy-ie', 'conditional', 'lt IE 9' );
if ( is_rtl() ) {
  wp_deregister_style( 'fixy-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style( 'fixy-rtl', get_template_directory_uri() . '/fixy-rtl.css');
 }
}

add_action('wp_enqueue_scripts','functions_js');

 //-------------- body class -------------------------------------------
 
add_action('wp_head', create_function("",'ob_start();') );
add_action('get_sidebar', 'fixy_sidebar_class');
add_action('wp_footer', 'fixy_sidebar_class_replace');
 
function fixy_sidebar_class($name=''){
	if ((is_active_sidebar('sidebar') || is_active_sidebar('sticky-sidebar'))&& !is_page()) :
		static $class="withsidebar";
		if(!empty($name))$class.=" sidebar-{$name}";
		fixy_sidebar_class_replace($class);
	endif;
}

function fixy_sidebar_class_replace($c=''){
  static $class='';
  if(!empty($c)) $class=$c;
  else {
    echo str_replace('<body class="','<body class="'.$class.' ',ob_get_clean());
    ob_start();
  }
}




//-------------- excerpt more -------------------------------------------
function fixy_excerpt_more( $more ) {
	       global $post;
		   $more_text=__('... Read the full article','fixy');
	return '<a class="more-link" href="'. get_permalink($post->ID) . '">'.$more_text.'</a>';
}
add_filter('excerpt_more', 'fixy_excerpt_more');



//-------------- paginatioin -------------------------------------------
function fixy_pagination(){
	global $wp_query;

			$big = 999999999; 
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text'    => __('<i class="icon-left-open"></i>','fixy'),
				'next_text'    => __('<i class="icon-right-open"></i>','fixy')
			) );
}
//-------------- login panel ----------------------------------------
function fixy_login_panel() {
	         global $current_user,$user_login,$user_url,$user_ID;
			 $custom_logout_url=wp_logout_url($_SERVER['REQUEST_URI']);
			 $user_url=get_bloginfo('url')."/wp-admin/profile.php?author=".$user_ID;
			 if (is_user_logged_in()) : 
				$userpanel='<div class="login-panel">
								<i class="icon-user"></i><a class="ajax-user-button" id="ajax-user-button" href="'.$user_url.'" title="'.__('Profile','fixy').'">'.$user_login.'</a>
								<i class="icon-logout"></i><a class="ajax-logout-button" id="ajax-logout-button" href="'.$custom_logout_url.'" title="'.__('Logout','fixy').'">'.__('Logout','fixy').'</a>
							</div>';

			 else : 
				$userpanel='<div class="login-panel">
								<i class="icon-pencil"></i><a class="register-button" id="register-button" href="'.wp_registration_url().'" title="'.__('register','fixy').'">'.__('Register','fixy').'</a>
								<i class="icon-login"></i><a class="ajax-login-button" id="ajax-show-login" href="" title="'.__('Login','fixy').'">'.__('Login','fixy').'</a>
							</div>';
			 endif;
			 echo $userpanel;
}

//--------------Login Redirect---------------------
function fixy_login_redirect( $redirect_to, $request, $user ){
    //is there a user to check?
    global $user;
    if( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if( in_array( "administrator", $user->roles ) ) {
            $redirect_to=get_admin_url();
            return $redirect_to;
        } else {
            $redirect_to=$_SERVER['REQUEST_URI'];
			return $redirect_to;
        }
    }
    else {
        return $redirect_to;
    }
}
add_filter("login_redirect", "fixy_login_redirect", 10, 3);
	
//-----------Ajax login form----------

function fixy_ajax_login_init(){

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');
	
    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => $_SERVER['REQUEST_URI'],
        'loadingmessage' => __('Sending user info, please wait...','fixy')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'fixy_ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'fixy_ajax_login_init');
}

function fixy_ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.','fixy')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...','fixy')));
    }

    die();
}
//-----------------------------------------
function fixy_tag_cloud_sizes($args) {
$args['smallest'] =8;
$args['largest'] = 14;
return $args; }
add_filter('widget_tag_cloud_args','fixy_tag_cloud_sizes');

//-----------------------------------------
function fixy_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

//------ navigation widget -----------------
add_action( 'widgets_init', 'fixy_widget' );

function fixy_widget() {
	register_widget( 'FIXY_Widget' );
}

class FIXY_Widget extends WP_Widget {

	function FIXY_Widget() {
		$widget_ops = array( 'classname' => 'navigation-widget', 'description' => __('Recommend to use on Sticky Widget Area', 'fixy') );
		
		
		
		$this->WP_Widget( 'navigation-widget', __('Navigation', 'fixy'), $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
			echo '<div class="widget-content"><p></p></div>';
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Navigation', 'fixy') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'fixy'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

//--- Fixy Search Form -------------------------------------
function fixy_search_form($custom_search){
										
$default=array('cat_show'=>false,
								'tag_show'=>false,
								'author_show'=>false,
								'archive_show'=>false,
								'field_show'=>true,
								'label_show'=>false,
								'button_show'=>true,
								'rememberd'=>true,
								'advance_show'=>true,
								'close_show'=>false,
								'echo'=>false
									);//default array

foreach((array)$custom_search as $key=>$value){
	$default[$key]=$value;
}
//--base vars------------------------
global $WP_Query,$query,$wp_user;
$cat_option='';$tag_option='';$author_option='';$archive_option='';
$advance_option='';$close_option='';$field_option='';$button_option='';
$cat_selected=get_query_var('cat');
$tag_selected=get_query_var('tag');
$author_selected=get_query_var('author');
$day_selected=get_query_var('day');
$month_selected=get_query_var('monthnum');
$year_selected=get_query_var('year');

if($day_selected==0)$day_selected='';
if($month_selected==0)$month_selected='';
if($year_selected==0)$year_selected='';



//------------------------------------

//--------category--------------------	
	if($default['cat_show']==1):
	$categories = get_categories(); 
		$cat_option='<li><ul>';
		if($default['label_show']):
			$cat_option .='<li class="cat-label">'.__('Category ','fixy').'</li>';
		endif;	
				$cat_option .='<li class="search-cat"><select name="cat" id="searchcat" ><option value="">'.__('All','fixy').'</option>';
			foreach ($categories as $category) {
				$cat_option .= '<option value="'.$category->cat_ID.'"';
					if(($cat_selected == $category->cat_ID)&&($default['rememberd']==1)):
						$cat_option .=' selected';
					endif;
				$cat_option .= '>'.$category->cat_name;
				$cat_option .= '</option>';
			}
		$cat_option .= '</select></li></ul></li>';
	endif;
//--------tag--------------------		
	if($default['tag_show']==1):
		$tags = get_categories('taxonomy=post_tag'); 
			$tag_option='<li><ul>';
				if($default['label_show']):
					$tag_option .='<li class="tag-label">'.__('Tag ','fixy').'</li>';
				endif;
			$tag_option .='<li class="search-tag" ><select name="tag" id="searchtag" ><option value="">'.__('All','fixy').'</option>';
			
			foreach ($tags as $tag) {
				$tag_option .= '<option value="'.$tag->slug.'"';
					if(($tag_selected == $tag->slug)&&($default['rememberd']==1)):
						$tag_option .=' selected';
					endif;
				$tag_option .= '>'.$tag->cat_name;
				$tag_option .= '</option>';
			}
			$tag_option .= '</select></li></ul></li>';
	endif;
//--------author--------------------		

if($default['author_show']==1):
	$authors=get_users(array('who'=>'authors','fields'=>array('id','display_name')));
	$author_option='<li><ul>';
			if($default['label_show']):
				$author_option .='<li class="author-label">'.__('Author ','fixy').'</li>';
			endif;
			$author_option .='<li class="search-author" ><select name="author" id="searchauthor" ><option value="">'.__('All','fixy').'</option>';
			
			foreach ($authors as $author) {
				$author_option .= '<option value="'.$author->id.'"';
					if(($author_selected == $author->id)&&($default['rememberd']==1)):
						$author_option .=' selected';
					endif;
				$author_option .= '>'.$author->display_name;
				$author_option .= '</option>';
			}
			$author_option .= '</select></li></ul></li>';
	endif;
	

//--------archive--------------------		
if($default['archive_show']==1):
	$archive_option='<li><ul>';
			if($default['label_show']):
				$archive_option .='<li class="archive-label">'.__('Date ','fixy').'</li>';
			endif;
			$archive_option .='<li class="archive-field">
									<input type="text" value="' . $year_selected . '" name="year" id="year" size="3" placeholder="'.__('year','fixy').'" />
									<input type="text" value="' . $month_selected . '" name="monthnum" id="monthnum" size="2" placeholder="'.__('month','fixy').'" />
									<input type="text" value="' . $day_selected. '" name="day" id="day" size="1" placeholder="'.__('day','fixy').'" />
								</li>
		</ul>
	</li>';
	endif;
//--------search field--------------------		
	if($default['field_show']==1):
	$field_option='<li><ul>';
			if($default['label_show']):
				$field_option .='<li class="search-label">'.__('Search for ','fixy').'</li>';
			endif;
			$field_option .='<li class="search-field"><input type="text" value="' . get_search_query() . '" name="s"  placeholder="'.__('Search','fixy').'" /></li>
		</ul>
	</li>';
	endif;

//--------search button--------------------		
	if($default['button_show']==1):
		$button_option='<li>
							<input type="submit" class="search-submit" value="'. esc_attr__( 'Search','fixy' ) .'" />
					   </li>';
	endif;
//--------links--------------------			
	if($default['advance_show']==1):
		$advance_option='<li><a class="advancesearch" href="">'.__('advance search','fixy').'</a></li>';
	endif;
	
	if($default['close_show']==1):
		$close_option='<li><a class="advancesearch-cancel">'.__('cancel','fixy').'<i class="icon-cancel"></i></a></li>';
	endif;
//--------final form-------------------		
		$form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" ><ul>
			'.$cat_option.$tag_option.$author_option.$archive_option.$field_option.$button_option.$advance_option.$close_option.'
			</ul></form>';
		
		if($default['echo']==1):
			echo $form;
		else:
			return $form;
		endif;
	
}
add_filter( 'get_search_form', 'fixy_search_form',10,1 );


//fixy custom header
function fixy_custom_header_setup() {
		$args = array(
		'default-text-color'     => '',
		'default-image'          => '',
		'random-default'         => false,
		'height'                 => 240,
		'width'                  => 1600,
		'flex-height'            => true,
	    'flex-width'             => true,
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => 'fixy_custom_header',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
		);
	
	add_theme_support( 'custom-header', $args );
	
}
add_action( 'after_setup_theme', 'fixy_custom_header_setup' );

function fixy_custom_header() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();
	$output_style='<style type="text/css" id="fixy-header-css">';
if ( ! empty( $header_image ) ) {
		$output_style .='
		.banner{
			background: url('.get_header_image().') no-repeat scroll top;
			background-size: 1600px auto;
		}';
}
if ( ! display_header_text() ) {
	$output_style .='
		.site-title,
		.site-description {
			display:none;
		}';
}
if ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) {
		$output_style .='
		#site-title{
			color: #'.esc_attr( $text_color ).';
		}';
}
$output_style .= '</style>';
echo $output_style;
}

/* fixy custom background */
function fixy_custom_background_setup(){
	global $wp_version;
	$args = array(
			'default-color'          => '',
			'default-image'          => '',
			'wp-head-callback'       => 'fixy_custom_background',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
			);
	
	add_theme_support( 'custom-background',$args ); 

}
add_action( 'after_setup_theme', 'fixy_custom_background_setup' );

function fixy_custom_background(){

			$background = set_url_scheme( get_background_image() );
	        $color = get_theme_mod( 'background_color' );
	
	        if ( ! $background && ! $color )
	                return;
	
	        $style = $color ? "background-color: #$color;" : '';
	
	        if ( $background ) {
	                $image = " background-image: url('$background');";
	
	                $repeat = get_theme_mod( 'background_repeat', 'repeat' );
	                if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
	                        $repeat = 'repeat';
	                $repeat = " background-repeat: $repeat;";
	                $position = get_theme_mod( 'background_position_x', 'left' );
	                if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
	                        $position = 'left';
	                $position = " background-position: top $position;";
	
	                $attachment = get_theme_mod( 'background_attachment', 'scroll' );
	                if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
	                        $attachment = 'scroll';
	                $attachment = " background-attachment: $attachment;";
	
	                $style .= $image . $repeat . $position . $attachment;
	        }	
	
	echo '<style type="text/css" id="fixy-background-css">
	div.content{'.trim( $style ).'}
	</style>';
	
}
//end

//-----------------------------------------------------------
$google_fonts = array(
							''		=> __('Default','fixy'),
							'ABeeZee'		=> 'ABeeZee',
							'Abel'		=> 'Abel',
							'Abril+Fatface'		=> 'Abril Fatface',
							'Acme'		=> 'Acme',
							'Allan'		=> 'Allan',
							'Allerta+Stencil'		=> 'Allerta Stencil',
							'Allura'		=> 'Allura',
							'Amarante'		=> 'Amarante',
							'Anaheim'		=> 'Anaheim',
							'Andika'		=> 'Andika',
							'Arbutus'		=> 'Arbutus',
							'Atomic+Age'		=> 'Atomic Age',
							'Audiowide'		=> 'Audiowide',
							'Autour'		=> 'Autour',
							'Average'		=> 'Average',
							'Averia'		=> 'Averia',
							'Bad+Script'		=> 'Bad Script',
							'Basic'		=> 'Basic',
							'Berkshire Swash'		=> 'Berkshire Swash',
							'Black+Ops+One'		=> 'Black Ops One',
							'Boogaloo'		=> 'Boogaloo',
							'Bowlby+One'		=> 'Bowlby One',
							'Bree+Serif'		=> 'Bree Serif',
							'Cagliostro'		=> 'Cagliostro',
							'Cambo'		=> 'Cambo',
							'Capriola'		=> 'Capriola',
							'Changa'		=> 'Changa',
							'Chango'		=> 'Chango',
							'Chau+Philomene'		=> 'Chau Philomene',
							'Chelsea+Market'		=> 'Chelsea Market',
							'Comfortaa'		=> 'Comfortaa',
							'Convergence'		=> 'Convergence',
							'Courgette'		=> 'Courgette',
							'Cuprum'		=> 'Cuprum',
							'Delius+Swash+Caps'		=> 'Delius Swash Caps',
							'Electrolize'		=> 'Electrolize',
							'Exo'		=> 'Exo',
							'Fascinate'		=> 'Fascinate',
							'Fugaz'		=> 'Fugaz',
							'Gabriela'		=> 'Gabriela',
							'Glegoo'		=> 'Glegoo',
							'Henny+Penny'		=> 'Henny Penny',
							'Inder'		=> 'Inder',
							'Kavoon'		=> 'Kavoon',
							'Kaushan+Script'		=> 'Kaushan Script',
							'Kite'		=> 'Kite',
							'Lemon'		=> 'Lemon',
							'Lily'		=> 'Lily',
							'Limelight'		=> 'Limelight',
							'Marko+One'		=> 'Marko One',
							'Merienda'		=> 'Merienda',
							'Open+Sans'		=> 'Open Sans',
							'Source'		=> 'Source',
							'Share+Tech'    => 'Share Tech',
							'Tauri'		=> 'Tauri',
							'Viga'		=> 'Viga'
						);
						
	$font_api_ir = array(
							''		=> __('Default','fixy'),
							'Andalus'		=> 'Andalus',
							'B+Arshia'		=> 'B Arshia',
							'B+Esfehan'		=> 'B Esfehan',
							'B+Elham'		=> 'B Elham',
							'Iranian+Sans'		=> 'Iranian Sans',
							'B+Baran'		=> 'B Baran',
							'B+Bardiya'		=> 'B Bardiya',
							'B+Tabassom'		=> 'B Tabassom',
							'B+Traffic'		=> 'B Traffic',
							'B+Tawfig'		=> 'B Tawfig',
							'B+Tehran'		=> 'B Tehran',
							'B+Titr'		=> 'B Titr',
							'B+Jadid'		=> 'B Jadid',
							'B+Jalal'		=> 'B Jalal',
							'B+Hamid'		=> 'B Hamid',
							'B+Roya'		=> 'B Roya',
							'B+Ziba'		=> 'B Ziba',
							'B+Setareh'		=> 'B Setareh',
							'B+Sina'		=> 'B Sina',
							'B+Shiraz'		=> 'B Shiraz',
							'B+Fantezy'		=> 'B Fantezy',
							'B+Ferdosi'		=> 'B Ferdosi',
							'B+Farnaz'		=> 'B Farnaz',
							'B+Kamran'		=> 'B Kamran',
							'B+Koodak'		=> 'B Koodak',
							'B+Kourosh'		=> 'B Kourosh',
							'B+Lotus'		=> 'B Lotus',
							'B+Morvarid'		=> 'B Morvarid',
							'B+Mehr'		=> 'B Mehr',
							'B+Mahsa'		=> 'B Mahsa',
							'B+Mitra'		=> 'B Mitra',
							'B+Nazanin'		=> 'B Nazanin',
							'B+Narm'		=> 'B Narm',
							'B+Nasim'		=> 'B Nasim',
							'B+Vahid'		=> 'B Vahid',
							'B+Helal'		=> 'B Helal',
							'B+Homa'		=> 'B Homa',
							'B+Yas'		=> 'B Yas',
							'B+Yagut'		=> 'B Yagut',
							'B+Yekan'		=> 'B Yekan',
							'Google'		=> 'Google'
						);
	if(get_bloginfo('language') == 'fa-IR'):
		$font_list = $font_api_ir;
	else:
		$font_list = $google_fonts;
	endif;
						
function fixy_font_sanitize( $input ) {
   global $font_list;
        
    if ( array_key_exists( $input, $font_list ) ) {
        return $input;
    } else {
        return '';
    }
}

function fixy_register_theme_customizer( $wp_customize ) {

global $font_list;
	
//-------------------------
	$wp_customize->add_section(
		'fixy_font_options',
		array(
			'title'     => __('Fonts','fixy'),
			'priority'  => 200
		)
	);

	// Headers Font
	$wp_customize->add_setting(
		'fixy_headers_font',
		array(
			'default'    =>  '',
			'sanitize_callback' => 'fixy_font_sanitize'
			
		)
	);

	$wp_customize->add_control(
		'fixy_headers_font',
		array(
			'section'   => 'fixy_font_options',
			'label'     => __('Headers Font','fixy'),
			'type'       => 'select',
            'choices'    => $font_list
		)
	);
	
	//Body Font
	$wp_customize->add_setting(
		'fixy_body_font',
		array(
			'default'    =>  '',
			'sanitize_callback' => 'fixy_font_sanitize'
			
		)
	);

	$wp_customize->add_control(
		'fixy_body_font',
		array(
			'section'   => 'fixy_font_options',
			'label'     => __('Body Font','fixy'),
			'type'       => 'select',
            'choices'    => $font_list
		)
	);
	
	//Theme styles
	$light_dark = array(
							'light-style'		=> __('Light','fixy'),
							'dark-style'		=> __('Dark','fixy')
						);
						
	$colors_style = array(
							'colorfull'		=> __('ColorFull','fixy'),
							'red'		=> __('Red','fixy'),
							'blue'		=> __('Blue','fixy'),
							'green'		=> __('Green','fixy'),
							'orange'		=> __('Orange','fixy'),
							'violet'		=> __('Violet','fixy'),
							'pink'		=> __('Pink','fixy'),
							'dark-blue'		=> __('Dark Blue','fixy'),
							'grey'		=> __('Grey','fixy')
						);
	$wp_customize->add_section(
		'fixy_colors_options',
		array(
			'title'     => __('Theme Style','fixy'),
			'priority'  => 200
		)
	);

	//Light Dark
	$wp_customize->add_setting(
		'fixy_light_dark',
		array(
			'default'    =>  'light-style'
			
		)
	);

	$wp_customize->add_control(
		'fixy_light_dark',
		array(
			'section'   => 'fixy_colors_options',
			'label'     => __('Light or Dark?','fixy'),
			'type'       => 'select',
            'choices'    => $light_dark
		)
	);
	
	//Colors Style
	$wp_customize->add_setting(
		'fixy_colors_style',
		array(
			'default'    =>  'colorfull'
			
		)
	);

	$wp_customize->add_control(
		'fixy_colors_style',
		array(
			'section'   => 'fixy_colors_options',
			'label'     => __('Colors Style','fixy'),
			'type'       => 'select',
            'choices'    => $colors_style
		)
	);
	// Layout
	$wp_customize->add_section(
		'fixy_archive_layout_options',
		array(
			'title'     => __('Archives Layout','wordplus'),
			'priority'  => 200
		)
	);
	
	$wp_customize->add_setting(
		'fixy_auto_excerpt',
		array(
			'default'    =>  'yes'
			
		)
	);
	 $wp_customize->add_control( 'fixy_auto_excerpt', array(
            'label'      => __( 'Auto excerpt posts for Home and archive pages?','fixy' ),
            'section'    => 'fixy_archive_layout_options',
            'type'       => 'radio',
            'choices'    => array(
				'yes'     => __('Yes','fixy'),
			   'no'  => __('No, I will excerpt posts manualy','fixy')
                
                
            ),
        ) );

	//links
		$wp_customize->add_section(
		'fixy_links_options',
		array(
			'title'     => __('Links','fixy'),
			'priority'  => 200
		)
	);
		
		$wp_customize->add_setting(
		'fixy_external_links_show',
		array(
			'default'    =>  'no'
						
		)
	);
	 $wp_customize->add_control( 'fixy_external_links_show', array(
            'label'      => __( 'show External Links in iframe? ','fixy' ),
            'section'    => 'fixy_links_options',
            'type'       => 'radio',
            'choices'    => array(
				'yes'     => __('Yes','fixy'),
			   'no'  => __('No','fixy')
                
                
            ),
        ) );
		
		//Lazy Content
		$wp_customize->add_section(
		'fixy_lazy_options',
		array(
			'title'     => __('Lazy Content','fixy'),
			'priority'  => 200
		)
	);
		
		$wp_customize->add_setting(
		'fixy_lazy_content',
		array(
			'default'    =>  'yes'
						
		)
	);
	 $wp_customize->add_control( 'fixy_lazy_content', array(
            'label'      => __( 'Enable Lazy Content Effects ','fixy' ),
            'section'    => 'fixy_lazy_options',
            'type'       => 'radio',
            'choices'    => array(
				'yes'     => __('Yes','fixy'),
			   'no'  => __('No','fixy')
                
                
            ),
        ) );

} 
add_action( 'customize_register', 'fixy_register_theme_customizer' );

function fixy_customizer_css() {
	$light_dark='';
	$color_style='';
	$final_fonts='';
	$fonts=array();
	$light_dark = trim(get_theme_mod('fixy_light_dark'));
	$color_style = trim(get_theme_mod('fixy_colors_style'));
	$headers_font = esc_attr(get_theme_mod( 'fixy_headers_font' ));
	$headers_font = trim(ucwords(str_replace ( '+',' ', $headers_font )));
	$body_font = esc_attr(get_theme_mod( 'fixy_body_font' ));
	$body_font = trim(ucwords(str_replace ( '+',' ', $body_font )));

		if(!$light_dark):
			$light_dark ='light-style';
		endif;
			wp_enqueue_style('light-dark',get_template_directory_uri().'/css/'.$light_dark.'.css');
		if(!$color_style):
			$color_style ='colorfull';
		endif;
			wp_enqueue_style('color-style',get_template_directory_uri().'/css/color-'.$color_style.'.css');
		if( $headers_font) :
			$fonts[]=$headers_font;
		endif;
		
		if( $body_font):
			$fonts[]=$body_font;
		endif;
		
		if($fonts):
			$final_fonts=implode('|',$fonts);
		endif;
			
		if($final_fonts): 
			
			if(get_bloginfo('language') !== 'fa-IR'): ?>
				<link href='http://fonts.googleapis.com/css?family=<?php echo $final_fonts;?>' rel='stylesheet' type='text/css'>
			<?php 
			else:
			
				foreach($fonts as $key => $value){ 
					if(!$value =='Google'): ?>
						<link href='http://www.font-api.ir/css/<?php echo $value;?>={font-api.ir}.css' rel='stylesheet' type='text/css'>
					<?php else: ?>
						<link href='http://www.itstar.ir/fonts/google.css' rel='stylesheet' type='text/css'>
					<?php endif; ?>
				<?php }
			endif; ?>
			
			<style id="fonts-style" rel='stylesheet' type="text/css">
				<?php if($body_font): ?>
					body {font-family : <?php echo $body_font; ?>,'<?php echo $body_font; ?>' }
				<?php endif; ?>
				
				<?php if($headers_font): ?>
					h1,h2,h3,h4,h5,h6 { font-family: <?php echo $headers_font; ?>,'<?php echo $headers_font; ?>'; }
				<?php else:
						if(!is_rtl()): ?>
							h1,h2,h3,h4,h5,h6 { font-family: "Open Sans", Helvetica, Arial, sans-serif; }
						<?php else: ?>
							h1,h2,h3,h4,h5,h6 { font-family: Tahoma; }
						<?php endif; ?>
				<?php endif; ?>
				
			</style>
	     
		 <?php endif; 
	 
}
add_action( 'wp_head', 'fixy_customizer_css' );

 //SVG Enabled
 function fixy_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'fixy_mime_types' );

?>