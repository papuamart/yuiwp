<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */
?>

<?php get_sidebar( 'after-container' ); // sidebar_after_container ?>

	</div><!-- #container -->
	</section><!-- #container -->

	<footer id="footer-container">
	
		<?php do_atomic( 'before_footer' ); // hybrid_before_footer ?>

		<div id="ft">


		<div id="footer">

			<?php do_atomic( 'footer' ); // hybrid_footer ?>

		</div><!-- #footer -->


	</div><!-- #footer-container -->
	
		<?php do_atomic( 'after_footer' ); // hybrid_after_footer ?>

		</footer><!-- #footer-container -->

</div><!-- #body-container -->

<?php do_atomic( 'after_html' ); // hybrid_after_html ?>

<?php wp_footer(); // wp_footer ?>

</body>
</html>