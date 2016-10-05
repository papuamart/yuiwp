<?php
/**
 * Home Sidebar Template
 *
 * The Home Sidebar template houses the HTML used for the 'Utility: After Content' 
 * sidebar. It will first check if the sidebar is active before displaying anything.
 *
 * @package Hybrid
 * @subpackage Template
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 */
if ( is_active_sidebar( 'sidebar-home' ) ) : ?>

	<div id="sidebar-home" class="sidebar utility">

		<?php do_atomic( 'before_home_sidebar' ); // hybrid_before_primary ?>
	
	<div class="wrap">
	
	<?php dynamic_sidebar( 'sidebar-home' ); ?>
	
	</div>
	
		<?php do_atomic( 'after_home_sidebar' ); // hybrid_after_primary ?>

	</div><!-- #sidebar-singular .utility -->
	
<?php else : ?>

 	<div id="sidebar-home" class="sidebar utility">

  <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-home') ) : else : ?>
	<div class="widget-top"><?php _e('Home Sidebar', hybrid_get_textdomain() ); ?></div>
	<div class="nowidget"><a href="<?php echo get_settings('home'); ?>/wp-admin/widgets.php/" target="_self" title="Click to add widgets">Add "Home Sidebar" Widgets</a></div>
	<div class="widget-bottom"></div>
<?php endif; ?>

	</div><!-- #sidebar-archive-sidebar .utility -->
	
<?php endif; ?>