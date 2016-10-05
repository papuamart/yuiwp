<?php
/**
 * Template Name: Front Page
 *
 * Useful for sites that need a news-type front page.
 *
 * @package HybridNews
 * @subpackage Template
 */

get_header(); ?>

	<div class="hfeed content">

		<?php do_atomic( 'before_content' ); // Before content hook ?>

		<!-- Begin feature slider. -->
	<div class="yui-gc">
	
		<div id="slider-container" class="yui-u first">

			<div id="slider">

			<?php
				if ( hybrid_get_setting( 'feature_category' ) )
					$feature_query = array( 'cat' => hybrid_get_setting( 'feature_category' ), 'showposts' => hybrid_get_setting( 'feature_num_posts' ), 'ignore_sticky_posts' => true );
				else
					$feature_query = array( 'post__in' => get_option( 'sticky_posts' ), 'showposts' => hybrid_get_setting( 'feature_num_posts' ) );
			?>

				<?php $loop = new WP_Query( $feature_query ); ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = $post->ID; ?>

					<div class="<?php hybrid_entry_class( 'feature' ); ?>">

 				<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'Medium', 'Feature Image' => false, 'default_size' => 'thumbnail', 'image_scan' => true, 'default_image' => './wp-content/uploads/images/default_thumb.gif' ) ); ?>

						<?php do_atomic( 'before_entry' ); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Full Story &raquo;', 'hybrid-news' ); ?></a>
						</div>

						<?php do_atomic( 'after_entry' ); ?>

					</div>

				<?php endwhile; ?>

			</div>

			<div class="slider-controls">
				<a class="slider-prev" title="<?php esc_attr_e( 'Previous Post', 'hybrid-news' ); ?>"><?php _e( 'Previous', 'hybrid-news' ); ?></a>
				<a class="slider-pause" title="<?php esc_attr_e( 'Pause', 'hybrid-news' ); ?>"><?php _e( 'Pause', 'hybrid-news' ); ?></a>
				<a class="slider-next" title="<?php esc_attr_e( 'Next Post', 'hybrid-news' ); ?>"><?php _e( 'Next', 'hybrid-news' ); ?></a>
			</div>

		</div>		<!-- End feature slider. and yui-u first -->


			<div id="aside" class="yui-u">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('home-1') ) : else : ?>
	<div class="widget-top"><?php _e('Home 1', hybrid_get_textdomain() ); ?></div>
	<div class="nowidget"><a href="<?php echo get_settings('home'); ?>/wp-admin/widgets.php/" target="_self" title="Click to add widgets">Add "Home 1" Widgets</a></div>
	<div class="widget-bottom"></div>
	<?php endif; ?> 	
		</div>
		</div><!-- End yui-gc. -->
 						<!-- Begin excerpts section. -->

		<div class="yui-ge">
		<div id="" class="yui-u first">
		
				<?php $loop = new WP_Query( array( 'cat' => hybrid_get_setting( 'excerpt_category' ), 'showposts' => hybrid_get_setting( 'excerpt_num_posts' ), 'ignore_sticky_posts' => true, 'post__not_in' => $do_not_duplicate ) ); ?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = $post->ID; ?>

				<div class="<?php hybrid_entry_class(); ?>">

				<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'Thumbnail' => false, 'default_size' => 'thumbnail', 'image_scan' => true, 'default_image' => './wp-content/uploads/images/default_thumb.gif' ) ); ?>
					
					<?php do_atomic( 'before_entry' ); ?>

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>

					<?php do_atomic( 'after_entry' ); ?>

				</div>

			<?php endwhile; ?>
		</div><!-- End excerpts section .yui-u first. -->

				<!-- Begin category headlines section. -->

		<?php $categories = hybrid_get_setting( 'headlines_category' ); ?>

		<?php if ( !empty( $categories ) ) : $i = 0; $alt = 'odd'; ?>
		<div id="" class="yui-u">
	 
			<?php foreach ( $categories as $category ) : ?>

				<?php $headlines = get_posts( array(
					'numberposts' => hybrid_get_setting( 'headlines_num_posts' ), 
					'category' => $category, 
					'post__not_in' => $do_not_duplicate
				) ); ?>

				<?php if ( !empty( $headlines ) ) : ?>

					<div class="section <?php echo $alt; ?>">

						<?php $cat = get_category( $category ); ?>

						<h3 class="section-title"><a href="<?php echo get_category_link( $category ); ?>" title="<?php echo esc_attr( $cat->name ); ?>"><?php echo $cat->name; ?></a></h3>

						<ul>
						<?php foreach ( $headlines as $post ) : $do_not_duplicate[] = $post->ID; ?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
						</ul>

					</div>

					<?php $alt = ( ( $i++ % 2 == 0 ) ? 'even' : 'odd' ); ?>

				<?php endif; ?>

			<?php endforeach; ?>
		</div>	<!-- End category headlines section .yui-u -->

		</div><!-- End yui-ge -->
		
	<?php endif; // End check if headline categories were selected. ?>

<div class="yui-gd">			
<div class="yui-u first">			
	<?php get_sidebar( 'feature' ); ?>
</div>
	
	<div class="yui-u">			
<?php get_sidebar( 'home' ); // Loads the sidebar-primary.php template. ?>
			</div>
			</div>
		
<div class="yui-gb">
<div class="yui-u first">	
 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('home-2') ) : else : ?>
	<div class="widget-top"><?php _e('Home 2', hybrid_get_textdomain() ); ?></div>
	<div class="nowidget"><a href="<?php echo get_settings('home'); ?>/wp-admin/widgets.php/" target="_self" title="Click to add widgets">Add "Home 2" Widgets</a></div>
	<div class="widget-bottom"></div>
<?php endif; ?>
</div>
<div class="yui-u">	
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('home-3') ) : else : ?>
	<div class="widget-top"><?php _e('Home 3', hybrid_get_textdomain() ); ?></div>
	<div class="nowidget"><a href="<?php echo get_settings('home'); ?>/wp-admin/widgets.php/" target="_self" title="Click to add widgets">Add "Home 3" Widgets</a></div>
	<div class="widget-bottom"></div>
<?php endif; ?>
</div>

<div class="yui-u">	
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('home-4') ) : else : ?>
	<div class="widget-top"><?php _e('Home 4', hybrid_get_textdomain() ); ?></div>
	<div class="nowidget"><a href="<?php echo get_settings('home'); ?>/wp-admin/widgets.php/" target="_self" title="Click to add widgets">Add "Home 4" Widgets</a></div>
	<div class="widget-bottom"></div>
<?php endif; ?>
</div>
</div>
		<?php do_atomic( 'after_singular' ); // After singular hook ?>

		<?php do_atomic( 'after_content' ); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>