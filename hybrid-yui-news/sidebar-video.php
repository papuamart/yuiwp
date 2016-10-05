<?php
/**
 * Video Sidebar Template
 *
 * The Video sidebar first checks for an active sidebar of 'utility-video'.  If this sidebar isn't active, it 
 * displays a tabbed recent/popular list of videos.  The 'utility-video' sidebar isn't registered by default.  
 * If you want to use it, you must register a sidebar with that specific ID.
 *
 * @package News
 * @subpackage Template
 */

if ( is_active_sidebar( 'video' ) ) : ?>

	<div id="sidebar-video" class="sidebar utility">

		<?php dynamic_sidebar( 'video' ); ?>

	</div><!-- #sidebar-video .utility -->

<?php else : ?>

	<div id="" class="sidebar utility">
   <div id="sidebarVideoyui2TabView" class="yui-navset">

				 <ul class="yui-nav">
					<li class="selected"><a href="#video-tabs-1"><em><?php _e( 'Recent', hybrid_get_textdomain() ); ?></em></a></li>
					<li><a href="#video-tabs-2"><em><?php _e( 'Popular', hybrid_get_textdomain() ); ?></em></a></li>
				</ul><!-- .ui-tabs-nav -->
				
						<div class="yui-content">

				<div id="video-tabs-1" class="ui-tabs-panel">

					<?php $loop = new WP_Query( array( 'post_type' => apply_filters( 'news_video_post_type', 'video' ), 'posts_per_page' => 3 ) ); ?>

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<div class="<?php hybrid_entry_class(); ?>">

 		<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'Thumbnail' => false, 'default_size' => 'live-wire-thumbnail', 'image_scan' => true, 'width' => '80', 'default_image' => 'http://papuapost.com/wp-content/uploads/images/default_thumb.gif' ) ); ?>

							<?php echo apply_atomic_shortcode( 'entry_title', the_title( '<h3 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h3>', false ) ); ?>

							<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">[entry-published]</div>' ); ?>

						</div><!-- .hentry -->

					<?php endwhile; ?>

				</div><!-- .ui-tabs-panel -->

				<div id="video-tabs-2" class="ui-tabs-panel">

					<?php $loop = new WP_Query( array( 'post_type' => apply_filters( 'news_video_post_type', 'video' ), 'orderby' => 'comment_count', 'posts_per_page' => 3 ) ); ?>

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<div class="<?php hybrid_entry_class(); ?>">

 		<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'Thumbnail' => false, 'default_size' => 'live-wire-thumbnail', 'image_scan' => true, 'width' => '85', 'default_image' => 'http://papuapost.com/wp-content/uploads/images/default_thumb.gif' ) ); ?>

							<?php echo apply_atomic_shortcode( 'entry_title', the_title( '<h3 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></h3>', false ) ); ?>

							<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">[entry-published]</div>' ); ?>

						</div><!-- .hentry -->

					<?php endwhile; ?>

				</div><!-- .ui-tabs-panel -->

			</div><!-- .ui-tabs-wrap -->

		</div><!-- .ui-tabs -->
<!--script type="text/javascript" charset="utf-8">
var oTabView = new YAHOO.widget.TabView("sidebarVideoyui2TabView");
</script-->
		<?php wp_reset_query(); ?>

	</div><!-- #sidebar-video .utility -->

<?php endif; ?>