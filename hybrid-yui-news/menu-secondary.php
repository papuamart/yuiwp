<?php
/**
 * Secondary Menu Template
 *
 * Displays the Secondary Menu if it has active menu items.
 * @link http://themehybrid.com/themes/hybrid/menus
 *
 * @package HybridNews
 * @subpackage Template
 */

if ( has_nav_menu( 'secondary-menu' ) ) : ?>

	<div id="secondary-menu" class="menu-container">

		<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container_class' => 'menu', 'menu_class' => '', 'fallback_cb' => '' ) ); ?>

		<?php get_search_form(); ?>

	</div><!-- #secondary-menu .menu-container -->

<?php endif; ?>