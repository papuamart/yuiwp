<?php
/**
 * Subsidiary Menu Template
 *
 * Displays the Subsidiary Menu if it has active menu items.
 *
 * @package Hybrid
 * @subpackage Template
 * @link http://themehybrid.com/themes/hybrid/menus
 */

if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<div id="subsidiary-menu" class="menu-container">

		<?php do_atomic( 'before_subsidiary_menu' ); // hybrid_before_primary_menu ?>

		<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container_class' => 'menu', 'menu_class' => '', 'fallback_cb' => '' ) ); ?>

		<?php do_atomic( 'after_subsidiary_menu' ); // hybrid_after_primary_menu ?>

	</div><!-- #subsidiary-menu .menu-container -->

<?php endif; ?>