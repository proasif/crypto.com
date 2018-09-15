<?php
// Prevent direct script access
if ( !defined( 'ABSPATH' ) )
	die ( 'No direct script access allowed' );

function crypto_script_enqueue(){
	wp_enqueue_style('style', get_template_directory_uri().'/style.css', array(), '1.0', 'all');
	wp_enqueue_style('grid', get_template_directory_uri().'assets/css/grid.min.css', array(), '1.0', 'all');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'assets/css/bootstrap.min.css', array(), '1.0', 'all');
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array(), '1.0', 'true');
	wp_enqueue_script('jquery');
	wp_enqueue_script('velocity', get_template_directory_uri().'/assets/js/jquery.velocity.min.js', array(), '1.0', 'true');
	wp_enqueue_script('particles', get_template_directory_uri().'/assets/js/particles.min.js', array(), '1.0', 'true');
	wp_enqueue_script('inviewport', get_template_directory_uri().'/assets/js/jquery.inviewport.min.js', array(), '1.0', 'true');
	wp_enqueue_script('common', get_template_directory_uri().'/assets/js/common.js', array(), '1.0', 'true');
}

add_action('wp_enqueue_scripts', 'crypto_script_enqueue');

function crypto_theme_setup()
{
	add_theme_support('menus');
	add_theme_support('custom-logo');
	register_nav_menu('primary','Header Menu'); 
}

include ( get_template_directory() . '/inc/customizer.php' );
include ( get_template_directory() . '/inc/front/head.php' );

add_action('init', 'crypto_theme_setup');
add_action('customize_register', 'ju_customize_register');
add_action('wp_head', 'ju_head');
add_action( 'customize_register', 'm1_customize_register' );


// Functions From AintViral


/**
* Child Theme Setup
* 
* Always use child theme if you want to make some custom modifications. 
* This way theme updates will be a lot easier.
*/

/**
KEY NOTES

1. js/front.js is very critical and we have overwritten it for Auto Load, Just copy the front.js and change init_auto_load_next_post_template part on each update

*/

// 0.1 ENABLE write_log CUSTOM COMMAND
if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}

// 0.2 IMPLEMENT ENABLE / DISABLE PAGESPEED MOD UNDER AV PANEL

/*function append_query_string(){
	if (current_user_can('administrator') && !is_admin()) {
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if ($_GET['QueryAppended'] !== "1") {
			$enablePageSpeed = get_option( 'enable_pagespeed_for_admin' );

			if (!$enablePageSpeed) {	
				$url = add_query_arg('ModPagespeed', 'Off', $url);
				$url = add_query_arg('QueryAppended', '1', $url);
				
				wp_redirect( $url, 301 );
				exit;
			}
		}
	}    
}
add_action('template_redirect', 'append_query_string');
*/

// 0.3 INSERT HEADER FUNCTION
function headerRelatedFunctions(){
	if ( !is_admin() ) {
		insertFBSDK();
		
	 	$enableFBPxl = true;
		if (current_user_can('administrator')) {
			$enableFBPxl = get_option( 'crypto_panel_enable_fb_pixel_for_admin' );
		}
		
		if ($enableFBPxl) {
			insertFBPixel();
		}
		
		$enableGA = true;
		if (current_user_can('administrator')) {
			$enableGA = get_option( 'crypto_panel_enable_analytics_for_admin' );
		}
		
		if ($enableGA) {
			insertGA();
		}
		
		$enableGTag = true;
		if (current_user_can('administrator')) {
			$enableGTag = get_option( 'crypto_panel_enable_gtags_for_admin' );
		}
		
		if ($enableGTag) {
			insertGTHeader();
		}
		
		$enableAutoAds = true;
		if (current_user_can('administrator')) {
			$enableAutoAds = get_option( 'crypto_panel_enable_auto_ads_for_admin' );
		}
		
		if ($enableAutoAds) {
			insertGoogleAutoAds();
		}
		
		$enableHotJar = true;
		if (current_user_can('administrator')) {
			$enableHotJar = get_option( 'crypto_panel_enable_hotjar_for_admin' );
		}
		
		if ($enableHotJar) {
			insertHotJarSDK();
		}
	}
}
add_action( 'wp_head', 'headerRelatedFunctions', 10 );

// 0.4  FACEBOOK SDK + PIXEL
function insertFBSDK() {
?>
	<!-- Start Facebook SDK Code -->
	<!--<script>
	window.fbAsyncInit = function() {
		FB.init({
			//appId      		  	 : '143487366003021', Commented appId
			autoLogAppEvents : true,
			xfbml            : true,
			version          : 'v3.0'
		});
	};
	
	(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
	</script>-->
	<!-- End Facebook SDK Code -->
<?php	
}


function insertFBPixel() {
?>
	<!-- Facebook Pixel Code -->
	<!--<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '1717186665171468');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=1717186665171468&ev=PageView&noscript=1"
	/></noscript>-->
	<!-- End Facebook Pixel Code -->
<?php	
}

// 0.5  GOOGLE ANALYTICS
function insertGA() {
?>
	<!--<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-65289275-1', 'auto');
	  ga('send', 'pageview');
	
	</script>-->
<?php
}

// 0.6 GOOGLE TAG MANAGER
// * Header
function insertGTHeader() {
?>
	<!-- Google Tag Manager -->
	<!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NF9LC5G');</script>-->
	<!-- End Google Tag Manager -->
<?php
}

// * Body
function insertGTBody() {
?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NF9LC5G"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php
}

// * Logic - Header is done, check if body needs to be done
function insertGTBodyLogic() {
	$enableGTag = true;
	if (current_user_can('administrator')) {
		$enableGTag = get_option( 'crypto_panel_enable_gtags_for_admin' );
	}

	if ($enableGTag) {
		insertGTBody();
	}
}
add_action( 'poke_body_start', 'insertGTBodyLogic');

// 0.7 GOOGLE AUTO ADS
function insertGoogleAutoAds() {
?>
	<!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		 (adsbygoogle = window.adsbygoogle || []).push({
			  google_ad_client: "ca-pub-3579343809189257",
			  enable_page_level_ads: true
		 });
	</script>-->
<?php
}

// 0.8 HOTJAR SDK
function insertHotJarSDK() {
	?>
	<!-- Hotjar Tracking Code for https://aintviral.com -->
	<!--<script>
		(function(h,o,t,j,a,r){
			h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		//	h._hjSettings={hjid:951085,hjsv:6};   Commented HotJar ID
			a=o.getElementsByTagName('head')[0];
			r=o.createElement('script');r.async=1;
			r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
			a.appendChild(r);
		})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>-->
	<?php
}

// 0.8 Detect Mobile
function isMobile() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];

	if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
		return true;	
	}
	
	return false;
}
// --- 0 ---

// 1. RUN AFTER PARENT THEME SETUP
function init_child_setup() {  //CHANGED FROM init TO INIT
	dequeu_scripts();
	overwrite_image_sizes();
}

function dequeu_scripts() {
	//wp_dequeue_script('init-front');
	
	// disable libgif of init and enbale ours for styling
	wp_dequeue_script('libgif');
}

function overwrite_image_sizes() { /*
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'init-grid-standard',     364,        round( 364 * 0.4 ), true );
	add_image_size( 'init-grid-standard-2x',  364 * 2,    round( 364 * 2 * 0.4 ), true );
		
	add_image_size( 'init-grid-fancy',        364,		round( 364 * 0.4 ), true );
	add_image_size( 'init-grid-fancy-2x',     364 * 2,	round( 364 * 2 * 0.4 ), true );
	
	add_image_size( 'init-list-standard',     364,        round( 364 * 9 / 16 ), true );
	add_image_size( 'init-list-standard-2x',  364 * 2,    round( 364 * 2 * 9 / 16 ), true );

	add_image_size( 'init-list-fancy',        364,        round( 364 * 9 / 16 ), true );
	add_image_size( 'init-list-fancy-2x',		364 * 2,    round( 364 * 2 * 9 / 16 ), true );
	
	add_image_size( 'av-grid-fancy',        	364,        round( 364 * 0.7 ), true );
	add_image_size( 'av-grid-fancy-2x',			364 * 2,    round( 364 * 2 * 0.7 ), true );
	
	add_image_size( 'av-featured',       	 	720,			240, true );
	add_image_size( 'av-featured-2x',       	1440,			480, true );
	
	add_image_size( 'av-post-image',       	 	550,			184);
	add_image_size( 'av-post-image-2x',			550 * 2,		184 * 2);   */  // Commented Image Sizes
} 
add_action( 'after_setup_theme', 'init_child_setup', 999);
// --- 1 ---

// 2. DISABLE FRONT END ADMIN BAR
add_filter('show_admin_bar', '__return_false');
// --- 2 ---

// 3. ENQUEUE THE SCRIPTS
function enqueue_scripts() {	
	//$version = init_get_theme_version();

	//enqueue roboto condensed as well
	wp_enqueue_style( 'AVCustomFont', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,400,500,600', false );
	
	if (current_user_can('administrator')) {	
		$parent_style = 'init-dynamic-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
		wp_enqueue_style( 'init-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'init-dynamic-style', 'g1-main', 'init-snax-extra', 'init-buddypress' ),
			filemtime( get_stylesheet_directory() . '/style.css' )
		);
	}
	else {
		$parent_style = 'init-dynamic-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
		wp_enqueue_style( 'init-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'init-dynamic-style', 'g1-main', 'init-snax-extra', 'init-buddypress' )
		);
	}
	//use only for testing
	//wp_enqueue_style( 'AVTempStyle', get_stylesheet_directory_uri() . '/style2.css', array(), '4.5.4' );
		
	//for easing effects of jQuery UI
	wp_enqueue_script('jquery-effects-core');
	
	 //to enable init version and get front.js, only useful for auto load which we are not doing
	//wp_enqueue_script( 'init-front', get_stylesheet_directory_uri() . '/js/front.js', array( 'jquery', 'enquire' ), $version, true );

	//to enable custom rgb style of libgif/libgif.js
	wp_enqueue_script( 'libgif', get_stylesheet_directory_uri() . '/js/libgif/libgif.js', array( 'jquery', 'enquire' ), /*$version,*/ true ); // $version is undefined
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
// --- 3 ---

// 3.1 DEFER THESE JS FILES
function defer_js( $tag, $handle, $src ) {
	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array( 
	);

    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }
    
    return $tag;
}

add_filter( 'script_loader_tag', 'defer_js', 10, 3 );
// --- 3.1 ---

// 4. GS NAV ADD NEW MENU
function register_custom_menus() {
  register_nav_menus(
    array(
	  'subm-footer' => __( 'Footer SubMenu' ), //id and label
	  'social-icons' => __( 'Footer Social Icons' ),
	  'footer-menu' => __( 'Footer Bottom' ),
    )
  );
}

add_action( 'init', 'register_custom_menus' );
// --- 4 ---

// 5. INTERPRETING MENU
function clean_custom_menu( $theme_location, $includenav, $navclasses, $includeul, $ulclasses, $liclasses, $anchorclasses) {
	// theme_location is menu identity in appearance
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
 	
		if (!$navclasses) {
			$navclasses = "";	
		}
		
		if (!$ulclasses) {
			$ulclasses = "";
		}
		
		if (!$liclasses) {
			$liclasses = "";
		}
		
		if (!$anchorclasses) {
			$anchorclasses = "";
		}
		
        $menu_list = '';
		if ($includenav) {
			$menu_list = '<nav class="navigation ' . $navclasses . '">' . "\n";	
		}
		
		if ($includeul) {
       		$menu_list .= '<ul class="list ' . $ulclasses . '">' . "\n";
		}
 
        $count = 0;
        $submenu = false;
         
        foreach( $menu_items as $menu_item ) {
             
            $link = $menu_item->url;
            $title = $menu_item->title;
			$desc = $menu_item->description;
			$classes = "";
			$target = "";
			$anchclass = $anchorclasses;
			
			if ($desc) {
				$desc = '<i class="' . $desc . '"></i>';	
			}
            
			//special case
			if ($anchorclasses == "socialfooter") {
				$title = "";	
				
				if(!(strpos($link,'3magicshots.com') !== false || strpos($link,"/") === '0'))  {
					$target = "target='_blank'";
				}
				
				$anchclass = $menu_item->xfn;
			}
			
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;
                 
                $menu_list .= '<li class="item ' . $liclasses . '">' ."\n";
				$altTitle = wp_strip_all_tags($title);
                $menu_list .= '<a href="'.$link.'" class="title ' . $anchclass . '"  title="Link to open ' . $altTitle . ' page" '. $target .' >' . $desc . '<span>'.$title.'</span></a>' ."\n";
            }
 
            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="sub-menu ' . $ulclasses . '">' ."\n";
                }
 
                $menu_list .= '<li class="item av_sub ' . $liclasses . '">' ."\n";
                $menu_list .= '<a href="'.$link.'" class="title av_sub ' . $anchclass . '" title="Link to open ' . $title . ' page">' . $desc . '<span>'.$title.'</span></a>' ."\n";
                $menu_list .= '</li>' ."\n";
                     
 
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul>' ."\n";
                    $submenu = false;
                }
 
            }
			
			if ($count+1 > $menu_items){
				break;
 
            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { //check
                $menu_list .= '</li>' ."\n";      
                $submenu = false;
				
            }
				
 			
         
		if ($includeul) {
	        $menu_list .= '</ul>' ."\n";
		}
		
		if ($includenav) {
	        $menu_list .= '</nav>' ."\n";
		}	
			$count++;
			}
    } 
	}
	else 
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    
    echo $menu_list;
}
// --- 5 ---