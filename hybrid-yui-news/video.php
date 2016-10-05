<?php
/**
 * Video Template
 *
 * @package News
 * @subpackage Template
 */

get_header(); ?>

	<!-- Begin featured area. -->
	<!-- Begin featured area. -->
	<div id="feature" class="yui-gc">
<div class="yui-u first">

		<?php while ( have_posts() ) : the_post(); ?>


		<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
			<?php do_atomic( 'before_entry' ); // Before entry hook ?>


				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

			</div><!-- .hentry -->

			<?php do_atomic( 'after_entry' ); // After entry hook ?>

		<?php endwhile; ?>
</div><!-- yui-u firsta. -->
<div class="yui-u">
		<?php get_sidebar( 'video' ); ?>

	</div><!-- End yui-u". -->
	</div> 
	<!-- End featured area. -->



	<div id="content">

	<?php do_atomic( 'before_content' ); // Before content hook ?>

		<div class="hfeed content">

			<?php the_post(); ?>

			<?php do_atomic( 'after_singular' ); // After singular hook ?>

			<?php comments_template( '/comments.php', true ); ?>

		</div><!-- .hfeed -->

	<?php do_atomic( 'after_content' ); // After content hook ?>


	</div><!-- #content -->

<?php get_footer(); ?>