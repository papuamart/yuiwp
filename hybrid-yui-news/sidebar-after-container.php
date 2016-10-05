<?php
/**
 * After Container Utility
 *
 * This template displays widgets for Utility: Before Content.
 * If no widgets are added, nothing is displayed.
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 *
 * @package Hybrid
 * @subpackage Template
 */

?>
	</div><!-- .yui-u -->
		</div><!-- .yui-gd -->
		</div><!-- .yui-b -->
	</div><!-- #yui-main -->

	<div class="yui-b">		
	<?php if ( is_archive() && !is_search() ) : ?>
<?php get_sidebar( 'archive' ); // Loads the sidebar-archive.php template. ?>
<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
	<?php elseif ( is_home() && is_front_page() ) : ?>
<?php get_sidebar( 'home' ); // Loads the sidebar-home.php template. ?>
 <?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
<?php else : ?>
<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
	<?php endif; ?>
	</div><!-- .yui-b -->