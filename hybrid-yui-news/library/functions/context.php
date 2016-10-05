<?php
/**
 * Functions for making various theme elements context-aware.  Controls things such as the smart 
 * and logical body, post, and comment CSS classes as well as context-based action and filter hooks.  
 * The functions also integrate with WordPress' implementations of body_class, post_class, and 
 * comment_class, so your theme won't have any trouble with plugin integration.
 *
 * @package pmmewsCore
 * @subpackage Functions
 */

/**
 * Function for handling what the browser/search engine title should be. Attempts to handle every 
 * possible situation WordPress throws at it for the best optimization.
 *
 * @since 0.1.0
 * @global $wp_query
 */
function pmmews_document_title() {
	global $wp_query;

	/* Set up some default variables. */
	$domain = hybrid_get_textdomain();
	$doctitle = '';
	$separator = ':';

	/* If viewing the front page and posts page of the site. */
	if ( is_front_page() && is_home() )
		$doctitle = __( 'Welcome!, Wa Wa!, Salam!',  'hybrid' );
		
	/* If viewing the posts page or a singular post. */
	elseif ( is_home() || is_singular() ) {

		$doctitle = get_post_meta( get_queried_object_id(), 'Title', true );

		if ( empty( $doctitle ) && is_front_page() )
		$doctitle = __( 'Welcome!, Wa Wa!, Salam!',  'hybrid' );

		elseif ( empty( $doctitle ) )
			$doctitle = the_ID( '', false );
	}

	/* If viewing any type of archive page. */
	elseif ( is_archive() ) {

		/* If viewing a taxonomy term archive. */
		if ( is_category() || is_tag() || is_tax() ) {
			$doctitle = single_term_title( '', false );
		}

		/* If viewing a post type archive. */
		elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_query_var( 'post_type' ) );
			$doctitle = $post_type->labels->name;
		}

		/* If viewing an author/user archive. */
		elseif ( is_author() ) {
			$doctitle = get_user_meta( get_query_var( 'author' ), 'Title', true );

			if ( empty( $doctitle ) )
				$doctitle = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
		}

		/* If viewing a date-/time-based archive. */
		elseif ( is_date () ) {
			if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
				$doctitle = sprintf( __( 'Archive for %1$s',  'hybrid' ), get_the_time( __( 'g:i a',  'hybrid' ) ) );

			elseif ( get_query_var( 'minute' ) )
				$doctitle = sprintf( __( 'Archive for minute %1$s',  'hybrid' ), get_the_time( __( 'i',  'hybrid' ) ) );

			elseif ( get_query_var( 'hour' ) )
				$doctitle = sprintf( __( 'Archive for %1$s',  'hybrid' ), get_the_time( __( 'g a',  'hybrid' ) ) );

			elseif ( is_day() )
				$doctitle = sprintf( __( 'Archive for %1$s',  'hybrid' ), get_the_time( __( 'F jS, Y',  'hybrid' ) ) );

			elseif ( get_query_var( 'w' ) )
				$doctitle = sprintf( __( 'Archive for week %1$s of %2$s',  'hybrid' ), get_the_time( __( 'W',  'hybrid' ) ), get_the_time( __( 'Y',  'hybrid' ) ) );

			elseif ( is_month() )
				$doctitle = sprintf( __( 'Archive for %1$s',  'hybrid' ), single_month_title( ' ', false) );

			elseif ( is_year() )
				$doctitle = sprintf( __( 'Archive for %1$s',  'hybrid' ), get_the_time( __( 'Y',  'hybrid' ) ) );
		}

		/* For any other archives. */
		else {
			$doctitle = __( 'Archives',  'hybrid' );
		}
	}

	/* If viewing a search results page. */
	elseif ( is_search() )
		$doctitle = sprintf( __( 'Search results for &quot;%1$s&quot;',  'hybrid' ), esc_attr( get_search_query() ) );

	/* If viewing a 404 not found page. */
	elseif ( is_404() )
		$doctitle = __( '404 Not Found',  'hybrid' );

	/* If the current page is a paged page. */
	if ( ( ( $page = $wp_query->get( 'paged' ) ) || ( $page = $wp_query->get( 'page' ) ) ) && $page > 1 )
		$doctitle = sprintf( __( '%1$s Page %2$s',  'hybrid' ), $doctitle . $separator, number_format_i18n( $page ) );

	/* Apply the wp_title filters so we're compatible with plugins. */
	$doctitle = apply_filters( 'wp_title', $doctitle, $separator, '' );

	/* Print the title to the screen. */
	echo apply_atomic( 'document_title', esc_attr( $doctitle ) );
}
function pmmews_tabone_content_title() {
	global $wp_query;

	/* Set up some default variables. */
	$domain = hybrid_get_textdomain();
	$doctitle = '';
	$separator = ':';
	
 if ( is_home() && is_front_page() ) : 
	_e( 'Latest News', hybrid_get_textdomain() ); 
	
elseif ( is_singular('post') ) : 
	the_ID(); 
	
elseif ( is_attachment() && is_page() ) : 
	wp_title(); 
			
elseif ( is_category() ) : 
$doctitle = sprintf( __( 'Category:&nbsp;&quot;%1$s&quot;',  'hybrid' ), single_cat_title() );

elseif ( is_tag() ) : 
$doctitle = sprintf( __( 'Tagged:&nbsp;&quot;%1$s&quot;',  'hybrid' ), single_tag_title() );

elseif ( is_tax() ) : 
	single_term_title(); 

elseif ( is_author() ) : 
	$id = get_query_var( 'author' ); 
echo get_avatar( get_the_author_meta( 'user_email', $id ), '100', '', get_the_author_meta( 'display_name', $id ) ); 
	the_author_meta( 'description', $id ); 

elseif ( is_search() ) : 
		$doctitle = sprintf( __( 'Search results for &quot;%1$s&quot;',  'hybrid' ), esc_attr( get_search_query() ) );

elseif ( is_date() ) : 
	$doctitle = sprintf( __( 'Archive for %1$s',  'hybrid' ), get_the_time( __( 'Y',  'hybrid' ) ) );

elseif ( is_archive() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

elseif (array( 'post_type' => 'campaign', 'document', 'book', 'paper', 'newsletter', 'editorial', 'slideshow', 'video', 'gallery', 'faq', 'event', 'site', 'podcast')) : 
	the_ID(); 	         
	 elseif ( is_post_type_archive() ) : 
	 
	$post_type = get_post_type_object( get_query_var( 'post_type' ) ); 
	post_type_archive_title(); 
	 endif;
 } 


function pmmews_tabtwo_content_title() {
	global $wp_query;

	/* Set up some default variables. */
	$domain = hybrid_get_textdomain();
	$doctitle = '';
	$separator = ':';	

	 if ( is_home() && is_front_page() ) : 
	
	 _e( 'Latest Diary of OPM', hybrid_get_textdomain() ); 
	
	 elseif ( is_singular('post') ) : 
	 _e( 'Related News', hybrid_get_textdomain() ); 

 elseif ( is_attachment() ) : 
	 _e( 'More Gallery', hybrid_get_textdomain() ); 
		
	 elseif ( is_page() ) : 
	 _e( 'Sub Page & Archives', hybrid_get_textdomain() ); 	
		
	 elseif ( is_category() ) : 
	 _e( 'Latest 5/ Category', hybrid_get_textdomain() ); 	

	 elseif ( is_tag() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_tax() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_author() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_search() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_date() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_archive() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif (array( 'post_type' => 'campaign', 'document', 'book', 'paper', 'newsletter', 'editorial', 'slideshow', 'video', 'gallery', 'faq', 'event', 'site', 'podcast')) : 
	$doctitle = __( 'More from / Related to:&nbsp;',  'hybrid' );
	$posttype = get_post_type( $post->ID ); if ( $posttype) { echo '(' . $posttype . ')';} 	
	
	 //elseif ( is_post_type_archive() ) : 
	//$doctitle = __( 'Archives',  'hybrid' );
	 endif; 
}

function pmmews_tabtwo_content() {
if ( is_home() && is_front_page() ) : 
	
get_template_part( 'home-custom-posts' ); // Loads the loop-error.php template.
	
	 elseif ( is_singular('post') ) : 
get_template_part( 'pmnews/extensions/after-singular' ); // Loads the loop-error.php template.

 elseif ( is_attachment() ) : 
	 _e( 'More Gallery', hybrid_get_textdomain() ); 
get_template_part( 'pmnews/extensions/after-attachment' ); // Loads the loop-error.php template.

	 elseif ( is_page() ) : 
	 _e( 'Sub Page & Archives', hybrid_get_textdomain() ); 	
		
	 elseif ( is_category() ) : 
	 echo '<h3 class="sidebarheader">&raquo;&nbsp;&rang;&nbsp;';
	_e('Latest 5 Per Category', 'themejunkie');
 echo '</h3>';
		echo posts_by_category();

	 elseif ( is_tag() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_tax() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_author() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_search() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_date() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif ( is_archive() ) : 
	$doctitle = __( 'Archives',  'hybrid' );

	 elseif (array( 'post_type' => 'campaign', 'document', 'book', 'paper', 'newsletter', 'editorial', 'slideshow', 'video', 'gallery', 'faq', 'event', 'site', 'podcast')) : 
	$doctitle = __( 'More from / Related to:&nbsp;',  'hybrid' );
	$posttype = get_post_type( $post->ID ); if ( $posttype) { echo '(' . $posttype . ')';} 	
	
	 //elseif ( is_post_type_archive() ) : 
	//$doctitle = __( 'Archives',  'hybrid' );
	 endif; 
}


function single_term_slug( $prefix = '', $display = true ) {
    $term = get_queried_object();
    if ( !$term )
    return;
    if ( is_category() )
        $term_slug = apply_filters( 'single_cat_slug', $term->slug );
    elseif ( is_tag() )
        $term_slug = apply_filters( 'single_tag_slug', $term->slug );
    elseif ( is_tax() )
        $term_slug = apply_filters( 'single_term_slug', $term->slug );
    else
        return;
    if ( empty( $term_slug ) )
        return;
    if ( $display )
        echo $prefix . $term_slug;
    else
        return $term_slug;
}

function the_category_unlinked($separator = ' ') {
    $categories = (array) get_the_category();
    
    $thelist = '';
    foreach($categories as $category) {    // concate
        $thelist .= $separator . $category->category_nicename;
    }
    
    echo $thelist;
}

if ( ! function_exists( 'news_navigation' ) ) :
// Content Navigation Function in WordPress Footer
function news_navigation() { ?>
	<?php if ( is_home() || is_front_page() || is_page_template('page-template-home.php') || is_page_template('page-template-pmnews-front-page.php') ) : ?>
	<?php global $wp_query;
          $total_pages = $wp_query->max_num_pages;

          if ($total_pages > 1){

            $current_page = max(1, get_query_var('paged'));

            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => '/page/%#%',
                'current' => $current_page,
                'total' => $total_pages,
              ));
          } ?>
	<?php elseif ( is_attachment() ) : ?>
<?php previous_post_link( '%link', '<span class="previous">' . __( '&laquo; Return to entry', hybrid_get_textdomain() ) . '</span>' ); ?>

	<?php elseif ( is_singular( 'post' ) ) : ?>
	<div class="yui-cms-categories">
<p style="text-align:center;">&laquo;<?php previous_post_link( '%link', ' %title' ) ?>&nbsp;&laquo;&nbsp;&nbsp;<a class="highlighted" href="<?php home_url(); ?>/"><span style="color:#a6dc00;">Start</span></a>&nbsp;&nbsp;&raquo;&nbsp;<?php next_post_link( '%link', '%title <span class="nav-next">&raquo;</span>' ) ?></p>
	<?php elseif ( !is_singular() && function_exists( 'wp_pagenavi' ) ) : wp_pagenavi(); ?>
	<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : loop_pagination(); ?>
	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . __( '&laquo; Previous', hybrid_get_textdomain() ) . '</span>', 'nxtlabel' => '<span class="next">' . __( 'Next &raquo;', hybrid_get_textdomain() ) . '</span>' ) ) ) : ?>
	</div>
		<div class="yui-cms-categories">
			<?php echo $nav; ?>
				</div>
	<?php endif; ?>				
<?php }
endif;
?>