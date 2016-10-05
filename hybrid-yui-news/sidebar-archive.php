<?php
/**
 * Archive Sidebar Template
 *
 * The Singular sidebar first checks for an active sidebar of 'utility-archive'.  If this sidebar isn't
 * active, it displays a list of top articles from the month.  The 'utility-archive' sidebar isn't registered
 * by default.  If you want to use it, you must register a sidebar with that specific ID.
 *
 * @package News
 * @subpackage Template
 */

if ( is_active_sidebar( 'sidebar-archive' ) ) : ?>

	<div id="sidebar-archive" class="sidebar utility">

		<?php do_atomic( 'before_archive_sidebar' ); // hybrid_before_primary ?>
		
	<div class="wrap">
		
		<?php dynamic_sidebar( 'sidebar-archive' ); ?>

		</div>
		<?php do_atomic( 'after_archive_sidebar' ); // hybrid_after_primary ?>
		
	</div><!-- #sidebar-archive-sidebar .utility -->
	
 <?php else : ?>
 
 	<div id="sidebar-archive" class="sidebar utility">
	
  <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-archive') ) : else : ?>
	<div class="widget-top"><?php _e('Archive Sidebar', hybrid_get_textdomain() ); ?></div>
	<div class="nowidget"><a href="<?php echo get_settings('home'); ?>/wp-admin/widgets.php/" target="_self" title="Click to add widgets">Add "Archive Sidebar" Widgets</a></div>
	<div class="widget-bottom"></div>
<?php endif; ?>

	</div><!-- #sidebar-archive-sidebar .utility -->
	
<?php endif; ?>