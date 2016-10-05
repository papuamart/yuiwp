<?php
/**
 * Header Sidebar
 *
 * The Heder Sidebar template houses the HTML used for the 'Utility: Header' 
 * widget area. It will first check if the widget area is active before displaying anything.
 *
 * @package HybridNews
 * @subpackage Template
 */

	if ( is_active_sidebar( 'utilityheader' ) ) : ?>

		<div id="utility-header" class="sidebar sidebar-header utility">

			<?php dynamic_sidebar( 'utilityheader' ); ?>

		</div><!-- #utility-header .utility -->

	<?php endif; ?>