<?php
/**
 * Before Container Utility
 *
 * This template displays widgets for Utility: Before Content.
 * If no widgets are added, nothing is displayed.
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 *
 * @package Hybrid
 * @subpackage Template
 */
?>

<?php /* If this is home page and orthers */ if (is_attachment()
 || is_page_template('page-front-page.php') 
 || is_page_template('page-pmnews-home.php') 
 || is_page('archives') 
 || is_page('facebook') 
 || is_page('forum') 
 || is_page('Category Archives') 
 || is_page('google-archive') 
 || is_page('yui-portal') 
 || is_singular('video') 
 || is_singular('slideshow') 
 || is_attachment('image') ) { ?> 
 
   <div id="yui-main" class="body-border">
	   <div>
	   <div id="dynamic-area">
	   <div>

<?php /* If this is a page template home */ } elseif (is_page_template('page-home.php') ) { ?>

   <div id="yui-main" class="body-border">

<div class="yui-b">	

<!--?php if (!is_paged()) include( get_stylesheet_directory() . '/library/home/yui-dynamic-roundups.html' ); // Loads the loop-meta.php template. ?-->

 <div id="dynamic-area" class="yui-gc">	 

  <div class="yui-u first">

<?php /* If this is a page and is singular post */ } elseif (is_singular()) { ?>

   <div id="yui-main" class="body-border">

<div class="yui-b">	

<div id="dynamic-area">	
	
<div>
	   <?php } else { ?>
	   
   <div id="yui-main" class="body-border">

<div class="yui-b">	

	<div  id="dynamic-area" class="yui-gf">

    <div class="yui-u first">

<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>	
	  
	  </div><!-- .yui-u first-->
		
    <div class="yui-u">
	<!-- YOUR DATA GOES HERE -->
	<?php } ?>	 