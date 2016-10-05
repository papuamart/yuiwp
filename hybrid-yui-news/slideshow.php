<?php
/**
 * Slideshow Template
 *
 * @package News
 * @subpackage Template
 * @since 0.1.0
 * @deprecated 0.3.0 Please include this template in your child theme if you plan to continue using it.
 */

/* Deprecated file in version 0.3.0. */
_deprecated_file( basename( __FILE__ ), '0.3.0', null, sprintf( __( 'Please copy the %s template from this theme into your child theme folder.', 'news' ), basename( __FILE__ ) ) );

get_header(); ?>

	<!-- Begin featured area. -->
	<div id="feature">
	<div class="yui-gc">
	<div class="yui-u first">

		<?php while ( have_posts() ) : the_post(); ?>


			<div class="<?php hybrid_entry_class(); ?>">

				<?php do_atomic( 'open_entry' ); // Open entry hook ?>

				<?php do_atomic( 'before_entry' ); // Before entry hook ?>

				<div class="entry-content">
					<?php echo do_shortcode( '[slideshow id="' . get_the_ID() . '" size="news-slideshow-large"]' ); ?>
				</div><!-- .entry-content -->

			<?php do_atomic( 'after_entry' ); // After entry hook ?>

				<?php do_atomic( 'close_entry' ); // Close entry hook ?>

			</div><!-- .hentry -->


		<?php endwhile; ?>
	</div>
	<div class="yui-u">
		<?php get_sidebar( 'slideshow' ); ?>

	</div>
	</div>
	</div>
 
	<!-- End featured area. -->
 
	<?php do_atomic( 'before_content' ); // Before content hook ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // Open content hook ?>

		<div class="hfeed">

			<?php the_post(); ?>

			<?php do_atomic( 'after_singular' ); // After singular hook ?>

			<?php comments_template( '/comments.php', true ); ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // Close content hook ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // After content hook ?>

<?php get_footer(); ?>