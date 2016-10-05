<?php
/**
 * Additional shortcodes for use within the theme.
 *
 * @package News
 * @subpackage Functions
 */
	/* Register sidebars. */
	add_action( 'init', 'yui_news_register_shortcodes', 11 );
/**
 * Registers new shortcodes.
 * 	PMNews Added SHORTCODES for main entry manipulation  

 * @since 0.1.0
 */
function yui_news_register_shortcodes() {
	add_shortcode( 'yui-news-header-logo', 'site_header_logo_shortcode' );
	add_shortcode( 'yui-news-site-description', 'yui_news_site_descriptions_shortcode' );
	add_shortcode( 'entry-sidebar-pagination', 'yui_news_sidebar_pagination_shortcode' );	
	add_shortcode( 'yui-news-site-title', 'yui_news_site_title_shortcode' );	
	
	add_shortcode( 'entry-tweetmeme-link', 'yui_news_entry_tweetmeme_link_shortcode' );
	add_shortcode( 'entry-google-breadcrumb', 'yui_news_google_breadcrumb_menu_shortcode' );
	add_shortcode( 'entry-tags-breadcrumb', 'yui_news_entry_tags_breadcrumb_shortcode' );
	
	add_shortcode('widget','widget'); // registers the shortcode
	add_shortcode('query', 'query_posts_shortcode'); // add the shortcode...
	add_shortcode( 'show_file', 'show_file_func' );
	add_shortcode('permalink', 'do_permalink');

	// special hacks to display news from special dates
	add_shortcode('two-thousand-posts', 'two_thousand_dates_posts_shortcode');	
	add_shortcode('sixties-posts', 'sixties_dates_posts');
	add_shortcode('seventies-posts', 'seventies_dates_posts');
	
	add_shortcode( 'entry-subtitle', 'yui_news_entry_subtitle_shortcode' );
	add_shortcode( 'entry-postnote', 'yui_news_entry_postnote_shortcode' );
	
	add_shortcode( 'the-year', 'hybrid_the_years_shortcode' );
	add_shortcode( 'entry-published', 'yui_news_entry_published_link_shortcode' );
	add_shortcode('posted-time-ago', 'yui_news_posted_time_ago_shortcode');
	add_shortcode('last-modified', 'last_modified_posts_shortcode');	
	add_shortcode( 'entry-terms', 'yui_news_entry_terms_shortcode' );	
	add_shortcode( 'featured-before-entry', 'yui_news_featured_before_entry_shortcode' );	
	add_shortcode( 'featured-after-entry', 'yui_news_featured_after_entry_shortcode' );	
	add_shortcode( 'news-before-entry', 'yui_news_before_entry_shortcode' );
	add_shortcode( 'yui-news-source-meta', 'yui_news_source_meta_shortcode' );
//	
	add_shortcode( 'entry-stumbleupon-link', 'yui_news_entry_stumbleupon_link_shortcode' );
	add_shortcode( 'entry-stumbleupon-count', 'yui_news_entry_stumbleupon_counts_shortcode' );	
	add_shortcode( 'entry-googlereader-link', 'yui_news_entry_googlereader_link_shortcode' );

	// PMNews Additional shortcodes for social-bookmarking/ share news
	add_shortcode( 'entry-googlebuzz-link', 'yui_news_entry_googlebuzz_link_shortcode' );
	add_shortcode( 'entry-yahoobookmark-link', 'yui_news_entry_yahoobookmark_link_shortcode' );
	add_shortcode( 'entry-yahoosave-link', 'yui_news_entry_yahoosave_link_shortcode' );
	add_shortcode( 'entry-posterous-link', 'yui_news_entry_posterous_link_shortcode' );
	add_shortcode( 'entry-technocrati-link', 'yui_news_entry_technocrati_link_shortcode' );
	add_shortcode( 'entry-sphere-link', 'yui_news_entry_sphere_link_shortcode' );
	add_shortcode( 'entry-windowslive-link', 'yui_news_entry_windowslive_link_shortcode' );
	add_shortcode( 'entry-excite-link', 'yui_news_entry_excite_link_shortcode' );
	add_shortcode( 'entry-sharemore-link', 'yui_news_entry_sharemore_link_shortcode' );
	//
	add_shortcode( 'entry-tags-with-count', 'yui_news_entry_tag_with_count_shortcode' );
	add_shortcode( 'entry-category-with-count', 'yui_news_entry_category_with_count_shortcode' );
	add_shortcode( 'entry-cats-with-count', 'yui_news_entry_cats_with_count_shortcode' );
	add_shortcode( 'entry-words-count', 'yui_news_entry_word_count_shortcode' );
	add_shortcode( 'entry-post-count', 'yui_news_entry_post_count_shortcode' );
	add_shortcode( 'entry-font-size', 'yui_news_entry_font_size_shortcode' );
	add_shortcode( 'home-share-link', 'yui_news_home_share_link_shortcode' );
	add_shortcode( 'single-share-link', 'yui_news_entry_share_link_shortcode' );
	add_shortcode( 'comment-count', 'yui_news_comment_count_shortcode' );	
	add_shortcode( 'entry-pdf-link', 'yui_news_entry_pdf_link_shortcode');
	add_shortcode( 'entry-flickr-share', 'yui_news_entry_flickr_share_shortcode');
	add_shortcode('pdf', 'pdflink');
	
	// SHARE BUTTONS WITH COUNT
	add_shortcode( 'entry-linkedin-link', 'yui_news_entry_linkedin_link_shortcode' );
	add_shortcode( 'entry-reddit-count', 'yui_news_entry_reddit_count_shortcode' );
	add_shortcode( 'entry-fblikes-link', 'yui_news_entry_fblikes_link_shortcode' );
	add_shortcode( 'entry-fblike-link', 'yui_news_entry_fblike_link_shortcode' );
	add_shortcode( 'entry-fblike-live-link', 'yui_news_entry_fblike_live_link_shortcode' );
	add_shortcode( 'fblikes-counts', 'yui_news_entry_fblikes_count_link_shortcode' );
	add_shortcode( 'tweets-counts', 'yui_news_entry_tweet_counts_link_shortcode' );
	add_shortcode( 'tweets-small-counts', 'yui_news_entry_small_tweetme_count_link_shortcode' );
	add_shortcode( 'entry-gbuzz-counts', 'yui_news_entry_gbuzz_counts_shortcode' );
	add_shortcode( 'entry-digg-counts', 'yui_news_entry_digg_counts_link_shortcode' );
//
	add_shortcode( 'cakifo-twitter-username', 'cakifo_twitter_shortcode' );
	add_shortcode( 'entry-cakifo-twitter', 'cakifo_entry_twitter_link_shortcode' );
	add_shortcode( 'entry-googleplus-link', 'cakifo_entry_googleplus_link_shortcode' );
	add_shortcode( 'cakifo-entry-format', 'cakifo_entry_format_shortcode' );
	add_shortcode( 'cakifo-entry-type', 'cakifo_entry_type_shortcode' );
	add_shortcode( 'devpress-login-form', 'devpress_login_form_shortcode' );	

	/* the shortcodes from functions i "entries.php" */
	add_shortcode('recent-posts', 'yui_news_recent_posts_shortcode'); // refer to pm-recents.html
	add_shortcode('recent-updated', 'recently_updated_posts_shortcode'); // refer to pm-recents.html
	add_shortcode('recent-comments', 'recent_comments_shortcode');  // refer to pm-recents.html
	add_shortcode('home-archive-content', 'yui_news_home_archive_content_shortcode');  // this is only useful for front-page.php or home.php archieve articles
add_shortcode( 'print-title', 'print_title' );add_shortcode( 'short-title', 'short_title' );
add_shortcode( 'print-archive-title', 'print_archive_title' );
add_shortcode( 'subheader-loop-meta', 'yui_news_subheader_loop_meta' );
}
//PMNEWS HACKS FOR MORE BEFORE AND AFTER CONTENT/ ENTRY
//REFER TO disabled "hybrid_entry_published_shortcode() {" in shortcodes.php lines 187-199
/* refer to header-function.php and add_custom_image_header in theme functions */
if ( ! function_exists( 'site_header_logo_shortcode' ) ) :
function site_header_logo_shortcode() {?>
 	  <a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
				if ( is_singular() &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
					// Houston, we have a new header image!
					echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
				else : ?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		<?php endif;?></a>
<?php
}
endif;
if ( ! function_exists( 'yui_news_site_title_shortcode' ) ) :
function yui_news_site_title_shortcode() {?>
		<hgroup>
		<a href='<?php home_url(); ?>' title='Papua Merdeka News'>
	<div id='site-title'>	
	<h6 class="gr" style="font-size:100%;letter-spacing:10px;">Papua</h6>
	<span style="font-size:70%"><h6 class="g">M</h6><h6 class="o1">e</h6><h6 class="o2">r</h6><h6 class="lg">d</h6><h6 class="l">e</h6><h6 class="e">k</h6><h6 class="g">a</h6><h6 class="e">!</h6><br/><p></p><h6 class="y1" style="text-decoration:none; letter-spacing:0.2em;"><span><em>News</em></span></h6></span>
	</div><!--id="blog-title"-->
<!--id="heading"-->
	</a><br clear="left">
	<span id="site-description">Bersuara Karena & Untuk KEBENARAN!</span>
		</hgroup>
<?php
}
endif;
function yui_news_entry_terms_shortcode() {
echo news_posted_in(); 
}
/* special hack for special posts */
function yui_news_featured_before_entry_shortcode() {?>
<?php echo do_shortcode('[print-archive-title]'); ?>
<div style="font-size:90%;">
<?php echo yui_news_posted_on(); ?>
</div>
<?php } 
function yui_news_featured_after_entry_shortcode() {
echo yui_news_posted_in();
}
function yui_news_posted_time_ago_shortcode() { 
echo '<span class="postDate">';
echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __( '&nbspago&nbsp-', 'hybrid-yui-news' );
echo '</span>';
}
function yui_news_before_entry_shortcode() {
echo yui_news_posted_on();
}
// Post last modified
function last_modified_posts_shortcode($atts){
$u_time = get_the_time('U');
          $u_modified_time = get_the_modified_time('U');
      if ($u_modified_time != $u_time) {
                echo ",&nbsp;and modified on ";
                the_modified_time('F jS, Y');
                echo ".";
          }
}

//PMNEWS HACKS FOR MORE BEFORE AND AFTER CONTENT/ ENTRY
/*
* From this original edited into shortcode
<?php if($subtitle !=='') { ?>
<?php $values = get_post_custom_values("subtitle");
 echo $values[0]; ?><?php } ?>
*/
function yui_news_entry_subtitle_shortcode() {
	global $post;	
	$subtitle = get_post_meta
($post->ID, 'subtitle', $single = true);
if($subtitle !== '') echo '- ' . $subtitle;
}

function yui_news_entry_postnote_shortcode() {
	global $post;
	$postnote = get_post_meta
($post->ID, 'postnote', $single = true);
if($postnote !== '') echo '- ' . $postnote;
}

// SHORTCODES FOR HYBRID NEWS SHORTCODE HACK
// yui_news_entry_tag_with_count_shortcode()
function yui_news_entry_tag_with_count_shortcode() {
	echo tags_with_count( '', __( '<span class=tag-links meta-sep>&nbsp;&Dagger;</span>' , 'hybrid-yui-news' ) .' ', ', ', '' );
}

// A Flickr Badge using WordPress Shortcodes
function yui_news_entry_flickr_share_shortcode() {
echo '<div class="flickr_badge"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=5&display=latest&size=m&layout=h&source=all_tag&tag=papua,west papua,irian,new guinea"></script></div>';
}

function yui_news_entry_cats_with_count_shortcode() {
	echo cats_with_count( '', __( '<span class="meta-sep">&para;</span>' , 'hybrid-yui-news' ) .' ', ', ', '' );
}
//add_shortcode('entry-cats-with-count', 'yui_news_entry_cats_with_count_shortcode');

function yui_news_entry_word_count_shortcode() {
echo '&nbsp;Length:&nbsp;['; 
echo word_count(); 
echo ']&nbsp;words.';
}

//add_shortcode('entry-word-count', 'yui_news_entry_word_count_shortcode');

function yui_news_entry_post_count_shortcode() {
echo '&nbsp;['; the_author_posts();
echo '&nbsp;&nbsp;entries]&nbsp;'; 
}
//add_shortcode('entry-word-count', 'yui_news_entry_word_count_shortcode');

// yui_news_entry_category_with_count_shortcode()
function yui_news_entry_category_with_count_shortcode() {
echo '<span class="cat-links"></span>'; the_category(', ');
echo '&#91;'; 
echo wt_get_category_count(); 
echo '&#93;';
}
//add_shortcode('entry-category-with-count', 'yui_news_entry_category_with_count_shortcode');
function yui_news_entry_published_link_shortcode() {
	/* Get the year, month, and day of the current post. */
	$year = get_the_time( 'Y' );
	$month = get_the_time( 'm' );
	$day = get_the_time( 'd' );
	$out = '';
	/* Add a link to the monthly archive. */
	$out .= '<a class="postDate" href="' . get_month_link( $year, $month ) . '" title="Archive for ' . esc_attr( get_the_time( 'F Y' ) ) . '">' . get_the_time( 'F' ) . '</a>';
	/* Add a link to the daily archive. */
	$out .= ' <a href="' . get_day_link( $year, $month, $day ) . '" title="Archive for ' . esc_attr( get_the_time( 'F d, Y' ) ) . '">' . $day . '</a>';
	/* Add a link to the yearly archive. */
	$out .= ', <a href="' . get_year_link( $year ) . '" title="Archive for ' . esc_attr( $year ) . '">' . $year . '</a>';
	return $out;
};

function hybrid_the_years_shortcode() {
global $wpdb;
$copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
$output = '';
if($copyright_dates) {
$copyright = " " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}
function yui_news_entry_font_size_shortcode() {
return '<span style="letter-spacing:-1px;"><a class="largeview" id="link-large-font" title="Click to Enlarge Font Size" href="javascript:increaseFontSize();">A</a><span class="vsep cms-dynamic"></span>
		<a class="normalviewt" id="link-normal-font" title="Click for Normal Font Size" href="javascript:normalFontSize();" >A</a><span class="vsep cms-dynamic"></span>
		<a class="xsmallview" id="link-small-font" title="Click to Minimize Font Size" href="javascript:decreaseFontSize();" >A</a>
</span>';
}

function yui_news_entry_tags_breadcrumb_shortcode() {
echo '<div class="tagsbreadcrumb"><span class="tagsheading">';
//if (is_singular()) if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'the_post_thumbnail' => false, 'default_size' => 'thumbnail', 'image_scan' => true, 'width' => '125', 'default_image' => 'http://papuapost.com/wp-content/uploads/images/default_thumb.gif' ) ); 
if ( is_home() || is_front_page() || is_page_template('page-template-home.php') || is_page_template('page-template-front-page.php') || is_page_template('page-template-yui-news-front-page.php')) :
		echo 'Welcome! Wa!, Wa!, Salam!';
	 elseif ( is_category() ) :
		//echo do_action( 'taxonomy_image_plugin_print_image_html', 'detail' );
		echo wp_title();
	elseif ( is_tag() ) : 
	//	echo do_action( 'taxonomy_image_plugin_print_image_html', 'detail' ); 
		echo wp_title();
	elseif ( is_archive() ) : 
		echo 'Archives:&nbsp;'; echo wp_title();	
	elseif ( is_attachment() ) : 
		echo 'Image:&nbsp;'; echo the_ID();
	elseif ( is_singular('post') ) :
		echo tagAndCatBreadCrumb(); 
	elseif ( is_search() ) : 
		echo esc_attr( get_search_query() ); 
	elseif ( is_date() ) :	
		echo 'Archives:&nbsp;'; echo wp_title();	
	elseif ( is_page() ) : 
	//	echo do_action( 'taxonomy_image_plugin_print_image_html', 'detail' ); 
		 echo wp_title(); echo tagAndCatBreadCrumb(); 
	elseif ( is_author() ) :
		the_author_meta( 'display_name', $id ); 
	elseif (array( 'post_type') ) :
	$posttype = get_post_type( $post->ID ); if ( $posttype) { echo '(' . $posttype . 's)'; }
	echo tagAndCatBreadCrumb(); 	
	 endif; 	
echo '</span></div>';
 global $page, $paged;
 echo '<span class="newspaper2">';
	// Add a page number if necessary: 
	if ( $paged >= 2 || $page >= 2 ) echo '&nbsp;|&nbsp;' . sprintf( __( 'Page %s', 'hybrid-yui-news' ), max( $paged, $page ) );
echo '</span><br clear="all">'; 

if ( is_home() && is_front_page() ) :
echo '<h3 class="feat-tags1">'; echo googleBreadcrumbs(); echo '</h3>';
elseif ( is_archive() ) :
echo '<h3 class="feat-tags1">'; echo googleBreadcrumbs(); echo '</h3>';
elseif ( is_page('Custom Posts') ) :
echo '<h3 class="feat-tags1">'; echo googleBreadcrumbs(); echo '</h3>';

endif; 	
}
function yui_news_sidebar_pagination_shortcode() {
 global $page, $paged;
 echo '<span class="newspaper2">';
	// Add a page number if necessary: 
	if ( $paged >= 2 || $page >= 2 ) echo '&nbsp;|&nbsp;' . sprintf( __( 'Page %s', 'hybrid-yui-news' ), max( $paged, $page ) );
echo '</span>'; 
}
function yui_news_site_descriptions_shortcode() {
echo '<div class="feat-tags">';
	if (is_home() || is_front_page() || is_page_template('page-front-page.php') || is_page_template('page-home.php')) 
		echo total_posts(); echo '&nbsp;posts&nbsp;<br/>'; 
		echo total_comments(); echo '&nbsp;comments&nbsp;<br />'; 
		echo do_shortcode('[query-counter]');
	if (is_category()) echo category_description();
	if (is_tag()) echo tag_description();
	if (is_tax()) single_term_title();  
	if (is_date()) wp_title();
	if (is_author()) the_author_meta( 'user_nicename', $id );
	if (is_attachment()) wp_title(); echo do_shortcode( '[entry-postnote]' );
	if(is_singular('faq')) { echo 'Frequenty Asked Questions and Answers';}
	if(is_singular('post')) echo do_shortcode( '[entry-postnote]' );
	if(is_page()) echo do_shortcode( '[entry-postnote]' );
echo '</div>';		
}

/**
 * Print link shortcode.
 *
 * @since 0.1.0
 */
function yui_news_google_breadcrumb_menu_shortcode() {
	echo googleBreadcrumbs();
}
function yui_news_home_share_link_shortcode() {
	include(TEMPLATEPATH. '/inc/home/share-home.html');}
function yui_news_comment_count_shortcode() {
	echo '<span style="float:right;">'; echo commentCount(); echo '</span>';
}
function yui_news_entry_share_link_shortcode() {
	include(TEMPLATEPATH. '/inc/share_this_buttons.html');}

//?FACEBOOK LIKE
function yui_news_entry_fblike_link_shortcode() {
	$url = esc_url( 'http://www.facebook.com/plugins/like.php?pub=papua&amp;' . urlencode( get_permalink( get_the_ID() ) ) . '&show_faces=true&width=250&action=like&colorscheme=light' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-fblike" href="' . $url . '" title="' . __( 'Like this at Facebook', hybrid_get_textdomain() ) . '">' . __( '', hybrid_get_textdomain() ) . '</a>';
}

/**
 * Facebook share link shortcode.
 *
 * @note This won't work from your computer (http://localhost). Must be a live site.
 * @link http://developers.facebook.com/docs/reference/plugins/like/
 * @since 1.0
 * @param array $atts
 */
function yui_news_entry_fblike_live_link_shortcode( $atts ) {
	
	static $first = true;

	extract( shortcode_atts( array(
		'before' => '',
		'after' => '',
		'href' => get_permalink(),
		'layout' => 'standard', // standard, button_count, box_count
		'action' => 'like', // like, recommend
		'width' => 450,
		'faces' => 'false', // true, false
		'colorscheme' => 'light', // light, dark
		'locale' => get_locale(), // Language of the button - ex: da_DK, fr_FR
 	), $atts) );
	
	// Set default locale
	$locale = ( isset( $locale ) ) ? $locale : 'en_US';

	// Only add the script once
	$script = ( $first == true ) ? "<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}js = d.createElement(s); js.id = id;js.src = '//connect.facebook.net/$locale/all.js#xfbml=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>" : "";

	$first = false;

	$text = '<div class="fb-like" data-href="' . esc_url( $href ) . '" data-send="false" data-layout="' . esc_attr( $layout ) . '" data-width="' . intval( $width ) . '" data-show-faces="' . esc_attr( $faces ) . '" data-action="' . esc_attr( $action ) . '" data-colorscheme="' . esc_attr( $colorscheme ) . '"></div>';

	return $before . $text . $after . $script;
}
//?FACEBOOK LIKE
function yui_news_entry_fblikes_count_link_shortcode() {
echo '<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fpapuapost.com&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;font=verdana&amp;colorscheme=light&amp;height=21"scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:21px;" allowTransparency="true"></iframe>';
}
function yui_news_entry_fblikes_link_shortcode() {
	if ( is_singular('post') )
		echo '<iframe src="http://www.facebook.com/plugins/like.php?href='. urlencode(get_permalink($post->ID)) .'&amp;layout=standard&amp;show_faces=true&amp;width=250&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; height:70px; overflow:hidden; width:250px;"></iframe>';
}

function yui_news_entry_tweetmeme_link_shortcode() { 
echo '<script type="text/javascript"> .tweetmeme_style =compact;</script><script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>';
}
//?POSTEROUS
function yui_news_entry_posterous_link_shortcode() {
	$url = esc_url( 'http://posterous.com/share?linkto=' . urlencode( get_permalink( get_the_ID() ) ) . '&title=' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-posterous" href="' . $url . '" title="' . __( 'Posterise this news', hybrid_get_textdomain() ) . '">' . __( 'Posterise', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_technocrati_link_shortcode() {
	$url = esc_url( 'http://technorati.com/faves?add=' . urlencode( get_permalink( get_the_ID() ) ) . '&amp;amp;title=' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-technorati" href="' . $url . '" title="' . __( 'Link to Technocrati', hybrid_get_textdomain() ) . '">' . __( 'Technocrati', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_sphere_link_shortcode() {
	$url = esc_url( 'http://www.sphere.com/search?q=sphereit:' . urlencode( get_permalink( get_the_ID() ) ) . '&title=' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-spehere" href="' . $url . '" title="' . __( 'Sphere the Content', hybrid_get_textdomain() ) . '">' . __( 'Sphere', hybrid_get_textdomain() ) . '</a>';	
}

// TWEETER
function yui_news_entry_tweet_count_link_shortcode() {
echo '<script type="text/javascript">size="small";username="papuapost";</script><script type="text/javascript" src="http://www.retweet.com/static/retweets.js"></script>';
}
function yui_news_entry_small_tweetme_count_link_shortcode() {?>
<script type="text/javascript">tweetmeme_style = 'compact';tweetmeme_url = '<data:post.url/>';</script>
<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
<?php
}
function yui_news_entry_tweet_counts_link_shortcode() {?>
<div style="float:right; padding:5px;margin-top:-25px;" class="bt bb">
<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="tricksdaddy">Tweet</a>
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>
<?php
}
//PMNEWS HACKS FOR MORE SOCIAL BOOKMARKING
function yui_news_entry_stumbleupon_link_shortcode() {
	$url = esc_url( 'http://www.stumbleupon.com/submit?url=' . urlencode( get_permalink( get_the_ID() ) ) . '&title=' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-stumble" href="' . $url . '" title="' . __( 'Stumble it!', hybrid_get_textdomain() ) . '">' . __( '', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_stumbleupon_counts_shortcode() {
echo '<div class="stumbleupon_button"><script src="http://www.stumbleupon.com/hostedbadge.php?s=5&r=<?php the_permalink(); ?>"></script></div>';
return '<a target="_blank" rel="nofollow external" class="icon-stumble" href="' . $url . '" title="' . __( 'Stumbled Count!', hybrid_get_textdomain() ) . '">' . __( '', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_gbuzz_counts_shortcode() {
echo '<a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-locale="en_GB" data-url="http://papuapost.com"></a>
<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>';
}

function yui_news_entry_digg_counts_link_shortcode() {
echo '<script type="text/javascript">(function() {
var s =document.createElement("SCRIPT"), s1 =document.getElementsByTagName("SCRIPT")[0];
s.type = "text/javascript";s.async = true;s.src = "http://widgets.digg.com/buttons.js";
s1.parentNode.insertBefore(s, s1);})();</script><a class="DiggThisButton DiggCompact"></a>';
}
//add_action( 'after_entry', 'digg_this', 11 );


function yui_news_entry_reddit_count_shortcode() {
	echo '<script type="text/javascript">reddit_url="[URL]"</script><script type="text/javascript">reddit_title="[TITLE]"</script><script type="text/javascript" src="http://www.reddit.com/button.js?t=1"></script>';
	return '<a target="_blank" rel="nofollow external" class="icon-reddit" href="' . $url . '" title="' . __( 'Submit this news to Reddit', hybrid_get_textdomain() ) . '">' . __( 'Reddit', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_googlereader_link_shortcode() {
	$url =  esc_url( 'http://www.google.com/reader/link?url=' . urlencode( get_permalink( get_the_ID() ) ) . '&srcURL="' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-greader" href="' . $url . '" title="' . __( 'Share on Google Reader', hybrid_get_textdomain() ) . '">' . __( 'GReader', hybrid_get_textdomain() ) . '</a>';
}

function yui_news_entry_googlebuzz_link_shortcode() {
	$url =  esc_url( 'http://www.google.com/buzz/post?url=' . urlencode( get_permalink( get_the_ID() ) ) . '&title="' . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-gbuzz" href="' . $url . '" title="' . __( 'Share post on Google Buzz', hybrid_get_textdomain() ) . '">' . __( 'GBuzz', hybrid_get_textdomain() ) . '</a>';
}

function yui_news_entry_yahoobookmark_link_shortcode() {
	$url = esc_url( 'http://myweb2.search.yahoo.com/myresults/bookmarklet?t=' .'&u=<' . urlencode( get_permalink( get_the_ID() ) ) . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-ybmark" href="' . '$url' . '" title="' . __( 'Bookmark on Yahoo!', hybrid_get_textdomain() ) . '">' . __( 'Y!MyWeb', hybrid_get_textdomain() ) . '</a>';
}
	return '<a class="icon-twitter" href="' . $url . '" title="' . __( 'Share this entry on Twitter', hybrid_get_textdomain() ) . '">' . __( 'Twitter', hybrid_get_textdomain() ) . '</a>';

function yui_news_entry_yahoosave_link_shortcode() {
	$url = esc_url( 'http://bookmarks.yahoo.com/toolbar/savebm?opener=tb&amp;u=' .'&amp;t=' . urlencode( get_permalink( get_the_ID() ) ) . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-ysbmark" href="' . $url . '" title="' . __( 'Save to  Yahoo! Toolbar', hybrid_get_textdomain() ) . '">' . __( 'Y! Toolbar', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_windowslive_link_shortcode() {
	$url = esc_url( 'https://favorites.live.com/quickadd.aspx?marklet=1&amp;url=' .'&amp;title=' . urlencode( get_permalink( get_the_ID() ) ) . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-windowslive" href="' . $url . '" title="' . __( 'Save to  Yahoo! Bookmark', hybrid_get_textdomain() ) . '">' . __( 'Y!Bookmark', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_sharemore_link_shortcode() {
	$url = esc_url( 'http://www.addthis.com/bookmark.php?pub=papua&amp;url=' .'&amp;title=' . urlencode( get_permalink( get_the_ID() ) ) . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-addthis" href="' . $url . '" title="' . __( 'Share More on AddThis', hybrid_get_textdomain() ) . '">' . __( 'AddThis', hybrid_get_textdomain() ) . '</a>';
}
function yui_news_entry_excite_link_shortcode() {
	$url = esc_url( 'http://www.excites.com/save_link/?url=' .'&title=' . urlencode( get_permalink( get_the_ID() ) ) . urlencode( the_title_attribute( 'echo=0' ) ) );
	return '<a target="_blank" rel="nofollow external" class="icon-excite" href="' . $url . '" title="' . __( 'Share on Excites.com', hybrid_get_textdomain() ) . '">' . __( 'Excites', hybrid_get_textdomain() ) . '</a>';
}
// Add a linkedin share button widget = [entry-linkedin-link]
function yui_news_entry_linkedin_link_shortcode() {
	return '<a target="_blank" rel="nofollow external" class="icon-linkedin" href="' . $url . '" title="' . __( 'Share this news to Linkedin', hybrid_get_textdomain() ) . '">' . __( 'Linkedin', hybrid_get_textdomain() ) . '</a>';
	echo '<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-url="<? the_permalink(); ?>" data-counter="top"></script>';
}
//add_action( 'hybrid_after_entry', 'entry-fblikes-link', 11 );
function yui_news_entry_pdf_link_shortcode() {
if ($attr['href']) {
        return '<a class="pdf" href="http://docs.google.com/viewer?url=' . $attr['href'] . '">'.$content.'</a>';
    } else {
        $src = str_replace("=", "", $attr[0]);
        return '<a class="pdf" href="http://docs.google.com/viewer?url=' . $src . '">'.$content.'</a>';
    }
}
function yui_news_entry_socializeit_link_shortcode() {
$tag = "papua"; //change this to fit the title of your page
$tag = urlencode($tag);
$url = "http://papuapost.com/" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; 
$url = urlencode($url);
echo <<<EOD
<a target="_blank" rel="nofollow external" class="icon-socializeit" href="http://www.socialize-it.com/index.php?url=$url&tag=$tag"></a>
EOD;
}

/**
 * Twitter username and/or link.
 *
 * Taken from my Twitter Profile Field plugin
 *
 * @link http://wordpress.org/extend/plugins/twitter-profile-field/
 * @since 1.0
 * @param array $atts
 */
function cakifo_twitter_shortcode( $atts ) {
	extract( shortcode_atts( array(   
    	'link' => true,
		'before' => '',
		'after' => '',
		'username' => hybrid_get_setting( 'twitter_username' ),
		'text' => __( 'Follow me on Twitter', 'cakifo' )
 	), $atts ) );

	if ( empty( $username ) )
		return;

	if ( ! $link )
		return $username;
	else
		return $before . '<a href="http://twitter.com/' . esc_attr( $username ) . '" class="twitter-profile">' . $text . '</a>' . $after;
}

/**
 * Twitter link shortcode.
 *
 * @since 1.0
 * @param array $atts
 */
function cakifo_entry_twitter_link_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'before' => '',
		'after' => '',
		'href' => get_permalink(),
		'text' => the_title_attribute( 'echo=0' ),
		'layout' => 'horizontal', // horizontal, vertical, none
		'via' => hybrid_get_setting( 'twitter_username' ),
		'width' => 55, // Only need to use if there's no add_theme_support( 'cakifo-twitter-button' )
		'height' => 20, // Only need to use if there's no add_theme_support( 'cakifo-twitter-button' )
 	), $atts) );

	// Load the PHP tweet button script if the theme supports it
	if ( current_theme_supports( 'cakifo-twitter-button' ) ) :

		return cakifo_tweet_button( array(
			'before' => $before,
			'after' => $after,
			'layout' => $layout,
			'href' => $href,
			'text' => $text,
			'layout' => $layout,
			'via' => $via,
		) );

	// Load the Twitter iframe
	else :

		// Set the height to 62px if the layout is vertical and the height is the default value
		if ( $layout == 'vertical' && $height == 20 )
			$height = 62;

		// Set width to 110px if the layout is horizontal and the width is the default value
		if ( $layout == 'horizontal' && $width == 55 )
			$width = 110;

		// Build the query
		$query_args = array(
			'url' => $href,
			'via' => esc_attr( $via ),
			'text' => esc_attr( $text ),
			'count' => esc_attr( $layout )
    	);

		return $before . '<iframe src="http://platform.twitter.com/widgets/tweet_button.html?' . http_build_query( $query_args, '', '&amp;' ) . '" class="twitter-share-button" style="width:' . intval( $width ) . 'px; height:' . intval( $height ) . 'px;" scrolling="no" seamless></iframe>' . $after;

	endif;
}

/**
 * Google +1 shortcode
 *
 * @link http://www.google.com/+1/button/
 * @since 1.2
 * @param array $atts
 */
function cakifo_entry_googleplus_link_shortcode( $atts ) {

	static $first = true;

	extract( shortcode_atts( array(
		'before' => '',
		'after' => '',
		'href' => get_permalink(),
		'layout' => 'standard', // small, medium, standard, tall
		'callback' => '',
		'count' => 'true' // true, false
 	), $atts) );

	// Only add the script once
	$script = ( $first == true ) ? "<script>(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();</script>" : "";

	$first = false;

	$text = '<div class="g-plusone" data-size="' . $layout . '" data-count="' . $count . '" data-href="' . $href . '" data-callback="' . $callback . '"></div>';

	return $before . $text . $after . $script;
} 
/**
 * Displays the post format of the current post
 *
 * @since 1.3
 * @param array $atts
 */
function cakifo_entry_format_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'before' => '',
		'after' => ''
	), $atts );

	return $atts['before'] . get_post_format() . $atts['after'];
}

function cakifo_entry_type_shortcode( $posttype ) { 
$posttype = shortcode_atts( array(
		'before' => '<span class="meta-sep">&nbsp&para;&nbsp;&nbsp;',
		'after' => '</span>'
	), $posttype );

	return $posttype['before'] . get_post_type( $post->ID) . $posttype['after'];
}

/*
Plugin Name: Build Own Custom Taxonomy
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
function yui_news_source_meta_shortcode ($taxo_text) {
// Let's find out if we have taxonomy information to display
// Something to build our output in
$taxo_text = "";

// Variables to store each of our possible taxonomy lists
// This one checks for an Operating System classification
$os_list = get_the_term_list( $post->ID, 'yui_news_source', '<strong>News Source(s):</strong> ', ', ', '' );
}
//add_shortcode( 'yui-news-source-meta', 'yui_news_source_meta_shortcode' );	
/*
Plugin Name: Shortcode to display external files on your posts
Plugin URI: http://www.wprecipes.com/shortcode-to-display-external-files-on-your-posts
*/
function show_file_func( $atts ) {
  extract( shortcode_atts( array(
    'file' => ''
  ), $atts ) );
 
  if ($file!='')
    return @file_get_contents($file);
}
//add_shortcode( 'show_file', 'show_file_func' );
// [show_file file="http://www.test.com/test.html"]
/*
Plugin Name: Login form shortcode
Plugin URI: http://www.wprecipes.com/shortcode-to-display-external-files-on-your-posts
*/
function devpress_login_form_shortcode() {
	if ( is_user_logged_in() )
		return '';

	return wp_login_form( array( 'echo' => false ) );
}
add_action( 'init', 'devpress_add_shortcodes' );
// to use it: [devpress-login-form]

function yui_news_home_archive_content_shortcode () { ?> 
	<div id="post-<?php the_ID() ?>" class="post <?php hybrid_entry_class() ?>">
  		<?php do_atomic( 'before_entry' ); // hybrid_before_entry ?>
  	<?php get_the_image( array( 'custom_key' => false, 'the_post_thumbnail' => false, 'default_size' => 'thumbnail', 'image_scan' => true, 'width' => '125', 'default_image' => 'http://papuapost.com/wp-content/uploads/images/default_thumb.gif' ) ); ?>    	
  	<div class="bd">
		<div class="fixed">
   	<?php the_excerpt('350');	?>
    <div class="clear"></div>
		</div><!--.bd-->
	</div><!--.fixed-->
		<div class="entry-meta">
		<?php echo apply_atomic_shortcode( 'entry_meta', '' . __( '[entry-tags-with-count before="Tagged "] [last-modified] [entry-words-count] [cakifo-entry-type] [cakifo-entry-format before=" | "]', 'hybrid-yui-news' ) . '' ); ?>
		</div><!--.entry-meta-->
	</div><!--.hentry-->
 <?php
}
/**
 * Additional helper functions that the framework or themes may use.  The functions in this file are functions
 * that don't really have a home within any other parts of the framework.
 *
 * @package HybridCore
 * @subpackage Functions
 */

/* Add extra support for post types. */
//add_action( 'init', 'hybrid_add_post_type_support' );

/* Add extra file headers for themes. */
//add_filter( 'extra_theme_headers', 'hybrid_extra_theme_headers' );

function pmmews_breadcrumb_tags_title() {
	global $wp_query;
echo '<h5 class="gr"><span class="tagsheading">';
if ( is_home() || is_front_page() || is_page_template('page-template-home.php')) :
		echo 'Welcome! Wa!, Wa!, Salam!';
	 elseif ( is_category() ) :
//	echo do_action( 'taxonomy_image_plugin_print_image_html', 'detail' );
		echo wp_title();
	elseif ( is_tag() ) : 
//	echo do_action( 'taxonomy_image_plugin_print_image_html', 'detail' ); 
		echo wp_title();
	elseif ( is_archive() ) : 
		echo 'Archives:&nbsp;'; echo wp_title();	
	elseif ( is_attachment() ) : 
		echo 'Image:&nbsp;'; echo wp_title();
	elseif ( is_singular('post') ) :
		echo tagAndCatBreadCrumb(); 
	elseif ( is_search() ) : 
		echo esc_attr( get_search_query() ); 
	elseif ( is_date() ) :	
		echo 'Archives:&nbsp;'; echo wp_title();	
	elseif ( is_page() ) : 
	//	echo do_action( 'taxonomy_image_plugin_print_image_html', 'detail' ); 
		 echo wp_title();
	elseif ( is_author() ) :
		the_author_meta( 'display_name', $id ); 
	elseif (array( 'post_type') ) :
	$posttype = get_post_type( $post->ID ); if ( $posttype) { echo '(' . $posttype . 's)'; }
	echo tagAndCatBreadCrumb(); 	
	 endif; 	
echo '</span></h5>';
echo yui_news_sidebar_pagination();
echo '<br clear="left">';
}
function yui_news_header_logo() { ?>
 	  <a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
				if ( is_singular() &&
						has_post_thumbnail( $post->ID ) &&
						( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
						$image[1] >= HEADER_IMAGE_WIDTH ) :
					// Houston, we have a new header image!
					echo get_the_image( array( 'custom_key' => false, 'the_post_thumbnail' => false, 'default_size' => 'header-image', 'image_scan' => true, 'width' => '125', 'default_image' => '../../../../images/logos/default_thumb.gif' ) ); 
				else : ?>
					<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		<?php endif; ?></a>
<?php
}
function yui_news_site_header() {?>
		<hgroup>
		<a href='<?php home_url(); ?>' title='Papua Merdeka News'>
	<div id='site-title'>	
	<h6 class="gr" style="font-size:120%;letter-spacing:6px;">Papua</h6>
	<span style="font-size:55%;"><h6 class="g">M</h6><h6 class="o1">e</h6><h6 class="o2">r</h6><h6 class="lg">d</h6><h6 class="l">e</h6><h6 class="e">k</h6><h6 class="g">a</h6><h6 class="e">!</h6></span><h6 class="y1" style="text-decoration:none; letter-spacing:0.2em;font-size:30px;margin-top:20px;"><span><em>News</em></span></h6>
	</div><!--id="blog-title"-->
<!--id="heading"-->
	</a><br clear="left">
		</hgroup>
<?php 
}

function yui_news_site_description() { 
echo '<div class="feat-tags">';
 if (is_home()) echo hybrid_site_description();
if (is_category()) echo category_description();
if (is_tag()) echo tag_description();
	if (is_tax()) single_term_title();  
	if (is_tax()) echo tagAndCatBreadCrumb();  
	if (is_author()) the_author_meta( 'user_nicename', $id );
	if (is_singular('post')) wp_title();
	if (is_search()) printf( __( 'You are browsing the search results for &quot;%1$s&quot;', hybrid_get_textdomain() ), esc_attr( get_search_query() ) ); 
echo '</div>';	
}

// Link Post Title to External URL
if ( ! function_exists( 'print_title' ) ) :

function print_title() {
	global $post;
    $thePostID = $post->ID;
    $post_id = get_post($thePostID);
    $title = $post_id->post_title;
    $perm = get_permalink($post_id);
    $post_keys = array(); $post_val = array();
    $post_keys = get_post_custom_keys($thePostID);

    if (!empty($post_keys)) {
		foreach ($post_keys as $pkey) {
			if ($pkey=='title_url') {
				$post_val = get_post_custom_values($pkey);
			}
		}
		if (empty($post_val)) {
			$link = $perm;
		} else {
			$link = $post_val[0];
		}
    } else {
		$link = $perm;
    }
    echo '<h3><a class="catheader" href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h3>';
	echo '<div class="entry-subtitle">'; echo apply_atomic_shortcode( 'entry_subtitle', '[entry-subtitle]' );  echo '</div>';
}

endif;
if ( ! function_exists( 'short_title' ) ) :
// to control the post title length
function short_title() {
 $title = get_the_title();
 $count = strlen($title);
 if ($count >= 65) {
 $title = substr($title, 0, 55);
 $title .= '...';
 }
 echo $title;
}
endif;

if ( ! function_exists( 'print_archive_title' ) ) :
/**
 * Displays the published date of an individual post.
 *
 * @since 0.7
 * @param array $attr
 */
// Link Post Title to External URL
// Link Post Title to External URL
function print_archive_title() {
	global $post;
    $thePostID = $post->ID;
    $post_id = get_post($thePostID);
    $title = $post_id->post_title;
    $perm = get_permalink($post_id);
    $post_keys = array(); $post_val = array();
    $post_keys = get_post_custom_keys($thePostID);

    if (!empty($post_keys)) {
		foreach ($post_keys as $pkey) {
			if ($pkey=='title_url') {
				$post_val = get_post_custom_values($pkey);
			}
		}
		if (empty($post_val)) {
			$link = $perm;
		} else {
			$link = $post_val[0];
		}
    } else {
		$link = $perm;
    }
    echo '<h2 class="catheader" style=text-align:left;><a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h2>';
	echo '<h3 class="entry-subtitle">'; echo apply_atomic_shortcode( 'entry_subtitle', '[entry-subtitle]' );  echo '</h3>';	
}
endif;

// yui_news_subheader_loop_meta
if ( ! function_exists( 'yui_news_subheader_loop_meta' ) ) :

function yui_news_subheader_loop_meta() {?>
<div class="yui-cms-accordion multiple fade fixIE">
 <div class="yui-cms-item yui-panel selected">
 				<div class="hd"><span>				
							<?php if ( is_home() || is_front_page() || is_page_template('page-template-home.php') ) : ?>
&nbsp;&raquo;&nbsp;&rang;&nbsp;<?php echo googleBreadcrumbs();?>			
			 <?php elseif ( is_archive() ) : ?>
			 &nbsp;&raquo;&nbsp;&rang;&nbsp;<?php echo googleBreadcrumbs();?>
			  <?php elseif ( is_singular('post') ) : ?>
			<?php echo apply_atomic_shortcode( 'entry_meta', '<span class="">' . __( '&nbsp; [entry-words-count] [last-modified before="| "] [entry-views before=" Views: "]', hybrid_get_textdomain() ) . '</span><div class="clear"></div>' ); ?>
			  
		  <?php else : ?>				 
					<?php endif; ?>		

				</span></div>
<div class="bd">  
	<div class="fixed"> 
  <?php echo pmmews_breadcrumb_tags_title();?>
	</div><!-- .fixed -->
	</div><!-- .bd -->
   <div class="ft"><a href="#" class="accordionToggleItem">
   <?php if ( is_singular()) : ?>
 	<?php elseif ( is_category() ) : ?>
	 <?php $description = category_description( '', get_query_var( 'taxonomy' ) ); ?>
	<?php if ( !empty( $description ) ) echo '<span class="headlines">' . $description . '</span>'; ?>
	 <?php elseif ( is_tag() ) : ?> 
	 	<?php $description = tag_description( '', get_query_var( 'post_tag' ) ); ?>
			<?php if ( !empty( $description ) ) echo '<span class="headlines">' . $description . '</span>'; ?>
		
	 <?php else : ?>				 
	 	<?php echo do_shortcode('[yui-news-site-description]'); ?>			
				<?php endif; ?>		
			</a>
			<?php echo '&nbsp;&nbsp;'; echo yui_news_entry_font_size_shortcode(); ?>
			
			</div>				
	<div class="actions">
	<a href="#" class="accordionToggleItem">&nbsp;</a> 
	<a href="#" class="accordionRemoveItem">&nbsp;</a> 
	</div>
		</div><!-- .yui-cms-item yui-panel -->		

	</div><!-- class="yui-cms-accordion multiple fade fixIE"" -->
<?php
}

endif;