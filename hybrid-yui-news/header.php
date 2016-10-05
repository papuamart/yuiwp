<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php hybrid_document_title(); ?></title>
 <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<!--link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.7.0/build/reset-fonts-grids/reset-fonts-grids.css&2.7.0/build/base/base-min.css&2.7.0/build/assets/skins/sam/skin.css" /--> 
<!--Include YUI Loader: -->

<?php do_atomic( 'head' ); // @deprecated 0.9.0. Use 'wp_head'. ?>
<?php wp_head(); // wp_head ?>
</head>
	
<?php flush(); // flush the stylesheets and javascripts ?>

<body id="cms-story" class="yui3-skin-mine yui-skin-sam <?php hybrid_body_class(); ?>">

<?php do_atomic( 'before_html' ); // hybrid_before_html ?>

			<div id="header-container">

<?php if ( current_theme_supports( 'dispatch-multicolour' ) ) { get_template_part ( 'library/content/dispatch-multicolour.html' ); } ?>

<?php if (is_home() && !is_paged() && current_theme_supports( 'news-ticker' ) ) { get_template_part ( 'library/home/newsticker.html' ); } ?>

<?php if(current_theme_supports('custom-image-header') && (function_exists ('twentyeleven_header_style')))  { ?>	

		<?php do_atomic( 'before_header' ); // hybrid_before_header ?>
		
	<header id="hd" class="hd">

		<div   id="header" class="yui-gc">
	
		<div class="yui-u first">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( get_header_image() ) echo '<img class="header-image" src="' . get_header_image() . '" alt="" />'; ?>
		</a>

			</div><!-- .yui-u first -->

	<div class="yui-u">

 	<?php echo do_shortcode( '[entry-tags-breadcrumb]' ); // live-wire_close_header ?>

	</div><!-- .yui-u -->

		</div><!-- .yui-g -->

	</header><!-- #header-container -->

		<?php do_atomic( 'after_header' ); // hybrid_after_header ?>

<?php } else { ?>

		<?php do_atomic( 'before_header' ); // hybrid_before_header ?>
		
	<header id="hd" class="hd">

	<div class="yui-g" id="header" >

		<div class="yui-u first">

			<?php do_atomic( 'header' ); // hybrid_header ?>			

		</div><!-- #header -->
		
 <div class="yui-u">
 
 	<?php echo do_shortcode( '[entry-tags-breadcrumb]' ); // live-wire_close_header ?>
	
	</div><!-- class="yui-u" -->
	
	</div><!-- yui-gb -->

		</header><!-- #header-container -->

	<?php do_atomic( 'after_header' ); // hybrid_after_header ?>
	
<?php } ?>

	</div><!-- #header-container -->

	<?php do_atomic( 'before_main' ); // hybrid_after_header ?>

		<!-- ENTERING BODY: follow some template_parts to properly display grids-->

     <section id="main" class="panels">	 

  <div id="bd" role="main" class="yui-cms-accordion multiple fade fixIE">  
	
<?php get_sidebar( 'before-container' ); // sidebar_before_container ?>
