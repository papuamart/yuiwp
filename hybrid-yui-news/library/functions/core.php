<?php
if ( ! function_exists( 'news_globalnav' ) ) :
function news_globalnav() {
	echo "\t\t\t<div id=\"globalnav\" class=\"yui-navset\"><ul class=\"nav\">";
	if ( !is_front_page() ) { ?><li class="home orange"><a href="<?php bloginfo('home'); ?>/" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?>" rel="home"><?php _e('Home', 'bubblepapua') ?></a></li><?php }
	$menu = wp_list_pages('title_li=&sort_column=menu_order&echo=0'); // Params for the page list in header.php
	echo str_replace(array("\r", "\n", "\t"), '', $menu);
	echo "</ul></div>\n";
}
endif;
if ( ! function_exists( 'news_globalcatnav' ) ) :
function news_globalcatnav() {
	echo "\t\t\t<div id=\"yui-nav\" class=\"yui-navset\"><ul class=\"nav\">";
	$menu = wp_list_categories('title_li=&sort_column=menu_order&echo=0'); // Params for the page list in header.php
	echo str_replace(array("\r", "\n", "\t"), '', $menu);
	echo "</ul></div>\n";
}
endif; 

if ( ! function_exists( 'news_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post�date/time and author.
 * @since Twenty Ten 1.0
 */
function news_posted_on() {
echo '<p class="byline path bb">'; 
echo do_shortcode( '[entry-author] <span class="meta-sep"></span>&nbsp;[entry-published] [entry-edit-link before=" <span class=vsep>&equiv;</span>&nbsp; "]');
if (!is_singular('post') && !is_page()){
echo apply_atomic_shortcode( 'news_byline', '&nbsp;<span class="meta-sep"></span>[entry-views before=" Views: "]'); 
}
echo '</p>';
}
endif;

if ( ! function_exists( 'news_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 * @since Twenty Ten 1.0
 */
function news_posted_in() {
echo '<p class=entry-meta>';
// Retrieves tag list of current post, separated by commas.
if (!is_home() || !is_front_page() || !is_page_template('page-template-pmnews-front-page.php') || !is_page_template('page-template-news-home.php') ){
echo apply_atomic_shortcode( 'entry_meta', '[entry-cats-with-count]' ); 
}
echo apply_atomic_shortcode( 'entry_meta', '[entry-tags-with-count]' ); 
if (!is_singular('post') && !is_page()){
echo do_shortcode('[cakifo-entry-type] [cakifo-entry-format before=" | "]');
echo apply_atomic_shortcode( 'entry_meta', '<span class="meta-sep"></span>[last-modified] [entry-words-count]'); 
}
echo '</p>';	
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
add_shortcode( 'entry-short-title', 'short_title' );
endif;

if ( ! function_exists( 'pmnews_entry_title' ) ) :
/**
 * Displays the published date of an individual post.
 *
 * @since 0.7
 * @param array $attr
 */
// Link Post Title to External URL
// Link Post Title to External URL
function pmnews_entry_title() {
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
    echo '<h3 class="widget-title" style=text-align:left;><a href="'.$link.'" rel="bookmark" title="'.$title.'">'.$title.'</a></h3>';
	echo '<h4 class="entry-subtitle">'; echo apply_atomic_shortcode( 'entry_subtitle', '[entry-subtitle]' );  echo '</h4>';	
}
add_shortcode( 'pmnews-entry-title', 'pmnews_entry_title' );
endif;


if ( ! function_exists( 'news_sidebar_pagination' ) ) :
function news_sidebar_pagination() {
 global $page, $paged;
 echo '<span class="newspaper2">';
	// Add a page number if necessary: 
	if ( $paged >= 2 || $page >= 2 ) echo '&nbsp;|&nbsp;' . sprintf( __( 'Page %s', 'hybrid' ), max( $paged, $page ) );
echo '</span>'; 
}
endif;

if ( ! function_exists( 'current_post_tags_list' ) ) :
/**
 * Displays the published date of an individual post.
 *
 * @since 0.7
 * @param array $attr
 */
// Link Post Title to External URL
// Link Post Title to External URL
function current_post_tags_list() {
// Retrieves tag list of current post, separated by commas.
echo '<span class="permalink">';
edit_post_link(__('Edit', 'hybrid'), "\t\t\t\t\t<span class=\"meta-sep\">&equiv;</span>\n\t\t\t\t\t<span class='entry-edit'>", "</span>\n");
the_permalink(); 
echo '</span>&nbsp;';
echo '['; word_count(); 
echo ']&nbsp;words.';
echo 'Posted in:&nbsp;'; the_category(', ');
echo '&nbsp;&#91;'; 
echo cats_with_count(); 
echo '&#93;&nbsp;';
echo '<span>&nbsp;&Dagger;</span>'; 
tags_with_count( '', __( 'Tagged as:&nbsp;' , 'hybrid' ) .' ', ', ', '' );
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'hybrid' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'hybrid' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'hybrid' );
	}	
$u_time = get_the_time('U'); $u_modified_time = get_the_modified_time('U'); if ($u_modified_time != $u_time) {
echo "&nbsp;Last modified <span style=font-size:10px;>&nbsp;&#64;&nbsp;</span>"; the_modified_time('F jS, Y'); 
echo ". "; 
edit_post_link(__('Edit', 'hybrid'), "\t\t\t\t\t<span class=\"meta-sep\">&equiv;</span>\n\t\t\t\t\t<span class='entry-edit'>", "</span>\n");
}
echo '</div>';	
}
endif;
add_shortcode( 'post-tags-list', 'current_post_tags_list' );
// echo do_shortcode('[post-tags-list]');?-->

/*
Plugin Name: Image Hack
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
//Post thumbnails
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
	/* Register new image sizes. */
	add_action( 'init', 'news_register_image_sizes' );	
	function news_register_image_sizes() {
    set_post_thumbnail_size(600, 9999); // Normal post thumbnails
    add_image_size('single-post-thumbnail', 600, 9999);
	add_image_size( 'news-slideshow', 500, 300, true );
	add_image_size( 'news-slideshow-large', 640, 430, true );
	add_image_size( 'news-thumbnail', 100, 75, true );
	add_image_size( 'post-thumbnail', 100, 100, true );
	add_image_size( 'live-wire-thumbnail', 120, 120, true );
}
}

/**
 * Displays an attachment image's metadata and exif data while viewing a singular attachment page.
 *
 * Note: This function will most likely be restructured completely in the future.  The eventual plan is to 
 * separate each of the elements into an attachment API that can be used across multiple themes.  Keep 
 * this in mind if you plan on using the current filter hooks in this function.
 *
 * @since 0.1.0
 */
function news_fitted_image_info() {

	/* Set up some default variables and get the image metadata. */
	$meta = wp_get_attachment_metadata( get_the_ID() );
	$items = array();
	$list = '';

	/* Add the width/height to the $items array. */
	$items['dimensions'] = sprintf( __( '<span class="prep">Dimensions:</span> %s', 'retro-fitted' ), '<span class="image-data"><a href="' . esc_url( wp_get_attachment_url() ) . '">' . sprintf( __( '%1$s &#215; %2$s pixels', 'retro-fitted' ), $meta['width'], $meta['height'] ) . '</a></span>' );

	/* If a timestamp exists, add it to the $items array. */
	if ( !empty( $meta['image_meta']['created_timestamp'] ) )
		$items['created_timestamp'] = sprintf( __( '<span class="prep">Date:</span> %s', 'retro-fitted' ), '<span class="image-data">' . date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $meta['image_meta']['created_timestamp'] ) . '</span>' );

	/* If a camera exists, add it to the $items array. */
	if ( !empty( $meta['image_meta']['camera'] ) )
		$items['camera'] = sprintf( __( '<span class="prep">Camera:</span> %s', 'retro-fitted' ), '<span class="image-data">' . $meta['image_meta']['camera'] . '</span>' );

	/* If an aperture exists, add it to the $items array. */
	if ( !empty( $meta['image_meta']['aperture'] ) )
		$items['aperture'] = sprintf( __( '<span class="prep">Aperture:</span> %s', 'retro-fitted' ), '<span class="image-data">' . sprintf( __( 'f/%s', 'retro-fitted' ), $meta['image_meta']['aperture'] ) . '</span>' );

	/* If a focal length is set, add it to the $items array. */
	if ( !empty( $meta['image_meta']['focal_length'] ) )
		$items['focal_length'] = sprintf( __( '<span class="prep">Focal Length:</span> %s', 'retro-fitted' ), '<span class="image-data">' . sprintf( __( '%s mm', 'retro-fitted' ), $meta['image_meta']['focal_length'] ) . '</span>' );

	/* If an ISO is set, add it to the $items array. */
	if ( !empty( $meta['image_meta']['iso'] ) )
		$items['iso'] = sprintf( __( '<span class="prep">ISO:</span> %s', 'retro-fitted' ), '<span class="image-data">' . $meta['image_meta']['iso'] . '</span>' );

	/* If a shutter speed is given, format the float into a fraction and add it to the $items array. */
	if ( !empty( $meta['image_meta']['shutter_speed'] ) ) {

		if ( ( 1 / $meta['image_meta']['shutter_speed'] ) > 1 ) {
			$shutter_speed = '1/';

			if ( number_format( ( 1 / $meta['image_meta']['shutter_speed'] ), 1 ) ==  number_format( ( 1 / $meta['image_meta']['shutter_speed'] ), 0 ) )
				$shutter_speed .= number_format( ( 1 / $meta['image_meta']['shutter_speed'] ), 0, '.', '' );
			else
				$shutter_speed .= number_format( ( 1 / $meta['image_meta']['shutter_speed'] ), 1, '.', '' );
		} else {
			$shutter_speed = $meta['image_meta']['shutter_speed'];
		}

		$items['shutter_speed'] = sprintf( __( '<span class="prep">Shutter Speed:</span> %s', 'retro-fitted' ), '<span class="image-data">' . sprintf( __( '%s sec', 'retro-fitted' ), $shutter_speed ) . '</span>' );
	}

	/* Allow devs to overwrite the array of items. */
	$items = apply_atomic( 'image_info_items', $items );

	/* Loop through the items, wrapping each in an <li> element. */
	foreach ( $items as $item )
		$list .= "<li>{$item}</li>";

	/* Format the HTML output of the function. */
	$output = '<div class="image-info"><h3>' . __( 'Image Info', 'retro-fitted' ) . '</h3><ul>' . $list . '</ul></div>';

	/* Display the image info and allow devs to overwrite the final output. */
	echo apply_atomic( 'image_info', $output );
}

/**
 * Returns a set of image attachment links based on size.
 *
 * @since 0.1.0
 * @return string Links to various image sizes for the image attachment.
 */
function my_life_get_image_size_links() {

	/* If not viewing an image attachment page, return. */
	if ( !wp_attachment_is_image( get_the_ID() ) )
		return;

	/* Set up an empty array for the links. */
	$links = array();

	/* Get the intermediate image sizes and add the full size to the array. */
	$sizes = get_intermediate_image_sizes();
	$sizes[] = 'full';

	/* Loop through each of the image sizes. */
	foreach ( $sizes as $size ) {

		/* Get the image source, width, height, and whether it's intermediate. */
		$image = wp_get_attachment_image_src( get_the_ID(), $size );

		/* Add the link to the array if there's an image and if $is_intermediate (4th array value) is true or full size. */
		if ( !empty( $image ) && ( true === $image[3] || 'full' == $size ) )
			$links[] = "<a class='showThumbnail image-size-link' href='" . esc_url( $image[0] ) . "'>{$image[1]} &times; {$image[2]}</a>";
	}

	/* Join the links in a string and return. */
	return join( ' <span class="sep">/</span> ', $links );
}
//
// Add filter to plugin init function
add_filter('post_type_link', 'gallery_permalink', 10, 3);	
// Adapted from get_permalink function in wp-includes/link-template.php
function gallery_permalink($permalink, $post_id, $leavename) {
	$post = get_post($post_id);
	$rewritecode = array(
		'%year%',
		'%monthnum%',
		'%day%',
		'%hour%',
		'%minute%',
		'%second%',
		$leavename? '' : '%postname%',
		'%post_id%',
		'%category%',
		'%author%',
		$leavename? '' : '%pagename%',
	);
 
	if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
		$unixtime = strtotime($post->post_date);
 
		$category = '';
		if ( strpos($permalink, '%category%') !== false ) {
			$cats = get_the_category($post->ID);
			if ( $cats ) {
				usort($cats, '_usort_terms_by_ID'); // order by ID
				$category = $cats[0]->slug;
				if ( $parent = $cats[0]->parent )
					$category = get_category_parents($parent, false, '/', true) . $category;
			}
			// show default category in permalinks, without
			// having to assign it explicitly
			if ( empty($category) ) {
				$default_category = get_category( get_option( 'default_category' ) );
				$category = is_wp_error( $default_category ) ? '' : $default_category->slug;
			}
		}
 
		$author = '';
		if ( strpos($permalink, '%author%') !== false ) {
			$authordata = get_userdata($post->post_author);
			$author = $authordata->user_nicename;
		}
 
		$date = explode(" ",date('Y m d H i s', $unixtime));
		$rewritereplace =
		array(
			$date[0],
			$date[1],
			$date[2],
			$date[3],
			$date[4],
			$date[5],
			$post->post_name,
			$post->ID,
			$category,
			$author,
			$post->post_name,
		);
		$permalink = str_replace($rewritecode, $rewritereplace, $permalink);
	} else { // if they're not using the fancy permalink option
	}
	return $permalink;
}
/////////////
function gallery_prettyPhoto ($content) {
 
    // add checks if you want to add prettyPhoto on certain places (archives etc).
 
    return str_replace("<a", "<a rel='prettyPhoto'", $content);
 
}

/*
Plugin Name: Comment Hack
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
/**
 Email Me With The Reply 1.0 By IT???
 Usage:Simple copy this code to your functions.php file, and it works. :)
 This is based on comment_mail_notify v1.0 by willin kan.
 */
//-- Here begins --------------------------------------
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // are you willing to receive the mail? 1 is yes.
  $admin_email = get_bloginfo ('admin_email'); // you can change $admin_email to your e-mail optionaly.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = __('You got a reply from ', 'hybrid') . ' [' . get_option("blogname") . ']';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . __('Hello:', 'hybrid') . '</p>
      <p>' . trim(get_comment($parent_id)->comment_author) .__('. Your wrote a comment on ', 'hybrid') . get_the_title($comment->comment_post_ID) . ':<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . __('replied you', 'hybrid') . ':<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>' . __('You can ', 'hybrid') . '<a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">' . __('Click here to see the whole comments.', 'hybrid') . '</a></p>
      <p> <a href="' . home_url() . '">' . get_option('blogname') . '</a></p>
      <p>(System mail, Do Not Reply.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

/* Auto checked */
function add_checkbox() {
  echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" /><label for="comment_mail_notify">Email Me with The Reply</label>';
}
add_action('comment_form', 'add_checkbox'); 

/*
Plugin Name: Make Pages Taggable
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
// Make the metabox appear on the page editing screen
if ( ! function_exists( 'tags_for_pages' ) ) :
function tags_for_pages() {
	register_taxonomy_for_object_type('post_tag', 'page', 'post_type');	
}
add_action('init', 'tags_for_pages');
endif;
if ( ! function_exists( 'tags_archives' ) ) :
// When displaying a tag archive, also show pages
function tags_archives($wp_query) {
	if ( $wp_query->get('tag') )
		$wp_query->set('post_type', 'any');
}
add_action('pre_get_posts', 'tags_archives');
endif;

/*
Plugin Name: Make Custom Post Types Taggable
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
if ( ! function_exists( 'post_type_tags_fix' ) ) :
// tags doesn't list other post types?	
// this is the hack for post-types to list tags	
function post_type_tags_fix($request) {
	if ( isset($request['tag']) && !isset($request['post_type']) )
	$request['post_type'] = 'any';
	return $request;
} 
add_filter('before_entry', 'post_type_tags_fix');
endif;

/*
Plugin Name: Admin Login Hack
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/

// custom admin login logo
function news_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image: url('.get_bloginfo('stylesheet_directory').'/images/default_thumb.gif) !important; }
	</style>';
}
add_action('login_head', 'news_login_logo');

/*
Plugin Name: Admin Contact Method Hack
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
// Add contact methods to profile, Twitter, Facebook, Flickr
function add_remove_contactmethods( $contactmethods ) {
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['linkedin'] = 'Linked In';
	$contactmethods['flickr'] = 'Flickr';
        // this will remove existing contact fields
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	return $contactmethods;
}

/**
 * Extend the user contact methods to include Twitter, Facebook and Google+
 *
 * @since Quark 1.0
 *
 * @param array List of user contact methods
 * @return array The filtered list of updated user contact methods
 */
function pmnews_new_contactmethods( $contactmethods ) {
	// Add Twitter
	$contactmethods['twitter'] = 'Twitter';

	//add Facebook
	$contactmethods['facebook'] = 'Facebook';

	//add Google Plus
	$contactmethods['googleplus'] = 'Google+';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'quark_new_contactmethods', 10, 1 );

/*
Plugin Name: Admin Dashboard Hack
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
// Change the Default Gravatar in WordPress
add_action('wp_dashboard_setup', 'pmnews_custom_dashboard_widgets');
function pmnews_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {?>
Thank you for using&nbsp;<strong><?php echo do_shortcode('[theme-link]'); ?>&nbsp;
WP Theme</strong> Framework developed based on the <a href="ttp://themehybrid.com/themes/hybrid" target="_blank">Hybrid</a> Theme Framework<br>
Need help? Contact the developer <a href="mailto:wp@papua.pw">here</a>. For WordPress Tutorials visit: <a href="http://www.papuawp.wordpress.com" target="_blank">West Papua WordPress Blog</a></p> 
<?php
}

/*
Plugin Name: Post Blog Using Email
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
// Post to your blog using email
add_action('shutdown', 'retrieve_post_via_mail');
function retrieve_post_via_mail() {
	flush();
	if(get_transient('retrieve_post_via_mail')) {
		return;
	} else {
		$mail = wp_remote_get(get_bloginfo('wpurl').'/wp-mail.php');
		if(!is_wp_error($mail)) {
			set_transient('retrieve_post_via_mail', 1, 60 * 15);
		} else {
			set_transient('retrieve_post_via_mail', 1, 60 * 5);
		}
	}
}
add_filter('user_contactmethods','add_remove_contactmethods',10,1);
/*
Plugin Name: �Next-page" button in WYSIWYG-editor
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}

/**
*	Plugin Name: Google Translation
*	Plugin URI: http://papuawp.wordpress.com/google-tools/
 *
*************************/ 
function google_translation_links() { ?>
<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'id', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-36284727-1'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php
} 
function google_translation_utility() { ?>
<P align=center>
<h3>Google Translate to Your Language</h3>
<script src="http://www.gmodules.com/ig/ifr?url=http://cowburn.info/wp-content/themes/cowburn/translate.xml&amp;synd=open&amp;w=192&amp;h=40&amp;title=We+speak+your+language!&amp;border=%23ffffff%7C0px%2C1px+solid+%23993333%7C0px%2C1px+solid+%23bb5555%7C0px%2C1px+solid+%23DD7777%7C0px%2C2px+solid+%23EE8888&amp;output=js"></script>
</p>
<?php
} 
function google_currency_converter() { ?>
<h3>Google Currency Converter</h3>
<script src="http://www.gmodules.com/ig/ifr?url=http://www.donalobrien.net/apps/google/currency.xml&amp;up_def_from=USD&amp;up_def_to=EUR&amp;synd=open&amp;w=320&amp;h=170&amp;title=Currency+Converter&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
<?php
} 
function google_multisearch_utility() { ?>
<h3>Multi Search Light</h3>
<script src="http://www.gmodules.com/ig/ifr?url=http://blogoscoped.com/homepage/multi-search-light.xml&amp;synd=open&amp;w=320&amp;h=200&amp;title=Multi+Search+Light&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
<?php
} 
function google_translate_utility() { ?>
<h3>_MSG_gadgettitle</h3>
<script src="http://www.gmodules.com/ig/ifr?url=http://gd.gadgetwe.com/ig/translate/translate.xml&amp;up_src_lang=en&amp;up_dst_lang=fr&amp;synd=open&amp;w=320&amp;h=142&amp;title=__MSG_gadgettitle__&amp;lang=all&amp;country=ALL&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
<?php
}

/*
Plugin Name: Build Own Custom Taxonomy
*/
// Custom Taxonomy Code
/**
* This special hack adds more taxonomies under
* "post_tag" and "category" on the main admin menu
**/
add_action( 'init', 'build_taxonomies', 0 );

function build_taxonomies() {
register_taxonomy( 
'news_source', 
'post', 
array( 'hierarchical' => false, 
'label' => 'News Source', 'query_var' => true, 
'rewrite' => true ) );
}

/*
Plugin Name: Admin User Information
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
/***********************************
Getting User Information
*************************************/
function user_info($what) {
	global $current_user;
    get_currentuserinfo();
	print $current_user->$what;
}
function J_ShowAbout() { ?>
<div class="">
<h2 class="archiveheader">About</h2>
<div class="sidebarheader">
<h2 class="home">
<a href="<?php home_url('home'); ?>"><img  width="170" height="25" border="0" alt="Google" align="left" src="<?php bloginfo('stylesheet_directory'); ?>/images/doopm.gif">
</a><br clear="all">
<span style="font-size:16px;"><strong>Salam Jumpa! @PAPUApost.com</strong></span><br>
<span class="middle-headline">PAPUA Merdeka! News</span> <br /> <span class="small-headline">Bersuara Karena & Untuk KEBENARAN!</span></h2>		
Layanan WPNews Group Online. Sebagai Berita Tangan Pertama Keempat, Langsung dari Rimba Raya New Guinea Melayani untuk West Papua yang Merdeka dan Berdaulat di Luar NKRI. Bersuara sejak 1 Desember 2004.
</div></div>
<?php }
/*
Plugin Name: Post Types Query
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
/*
 * the following is from posttypes.php
 * they are post-types query
***/

/* Query the post types 
***************************************
*/
/**
 * Add additional post meta boxes.
 * - Feature image input box.
 *
 * @since 0.1
 */
 
function news_post_meta_boxes( $meta_boxes ) {
	$meta_boxes['medium'] = array( 'name' => 'Medium', 'default' => '', 'title' => __('Medium/Feature:', 'news'), 'type' => 'text', 'show_description' => false, 'description' => false );
	return $meta_boxes;
}
/**
 * Adds "class='video-wrap'" to the opening <p> element around video embeds.
 *
 * @since 0.1.0
 */
function news_video_embed_wrapper( $content ) {

	if ( is_singular( 'video' ) && in_the_loop() )
		$content = preg_replace( array( "/<p>(.*?)<object/", "/<p>(.*?)<iframe/" ), array( "<p class='video-wrap'>$1<object", "<p class='video-wrap'>$1<iframe" ), $content );

	return $content;
}
/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 0.1.0
 */
function news_embed_defaults( $args ) {
	if ( is_singular( 'video' ) || is_singular( 'slideshow' ) )
		$args['width'] = 640;
	else
		$args['width'] = 560;

	return $args;
}
/**
 * Function for grabbing a post ID by meta key and meta value.  We're using this in the sidebar-feature.php 
 * file to check if a page has been given the 'page-template-popular.php' page template.
 *
 * @since 0.1.0
 */
function news_get_post_by_meta( $meta_key = '', $meta_value = '' ) {
	global $wpdb;

	$post_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value = %s LIMIT 1", $meta_key, $meta_value ) );

	if ( !empty( $post_id ) )
		return $post_id;

	return false;
}

function get_custom_field($key, $echo = FALSE) {
    global $post;
    $custom_field = get_post_meta($post->ID, $key, true);
    if ($echo == FALSE) return $custom_field;
    echo $custom_field;
}

//
function ilc_cpt_custom_column($column_name, $post_id) {
    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);

    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
	}
    else echo '<i>No terms.</i>';
}

// Define what post types to search
function searchAll( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post_type', array( 'post', 'page', 'feed', 'campaign', 'document', 'book', 'paper', 'video', 'slideshow', 'podcast' ));
	}
	return $query;
}

// The hook needed to search ALL content
add_filter( 'the_search_query', 'searchAll' );
/*
	 * labels
	 *      (array) (optional) labels - An array of labels for this taxonomy. By default tag labels are used for non-hierarchical types and category labels for hierarchical ones.
	        * Default: if empty, name is set to label value, and singular_name is set to name value 
	        * 'name' - general name for the taxonomy, usually plural. The same as and overridden by $tax->label. Default is _x( 'Post Tags', 'taxonomy general name' ) or _x( 'Categories', 'taxonomy general name' ). When internationalizing this string, please use a gettext context matching your post type. Example: _x('Writers', 'taxonomy general name', hybrid_get_textdomain() ); 
	        * 'singular_name' - name for one object of this taxonomy. Default is _x( 'Post Tag', 'taxonomy singular name' ) or _x( 'Category', 'taxonomy singular name' ). When internationalizing this string, please use a gettext context matching your post type. Example: _x('Writer', 'taxonomy singular name', hybrid_get_textdomain() ); 
	        * 'search_items' - the search items text. Default is __( 'Search Tags' ) or __( 'Search Categories' )
	        * 'popular_items' - the popular items text. Default is __( 'Popular Tags' ) or __( 'Popular Category' )
	        * 'all_items' - the all items text. Default is __( 'All Tags' ) or __( 'All Categories' )
	        * 'parent_item' - the parent item text. This string is not used on non-hierarchical taxonomies such as post tags. Default is null or __( 'Parent Category' )
	        * 'parent_item_colon' - The same as parent_item, but with colon : in the end null, __( 'Parent Category:' )
	        * 'edit_item' - the edit item text. Default is __( 'Edit Tag' ) or __( 'Edit Category' )
	        * 'update_item' - the update item text. Default is __( 'Update Tag' ) or __( 'Update Category' )
	        * 'add_new_item' - the add new item text. Default is __( 'Add New Tag' ) or __( 'Add New Category' )
	        * 'new_item_name' - the new item name text. Default is __( 'New Tag Name' ) or __( 'New Category Name' )
	 *
	 */
// Improving WP_Query performance for multiple taxonomies
add_filter( 'posts_join', 'tax_posts_join', 10, 2 );
add_filter( 'posts_where', 'tax_posts_where', 10, 2 );
add_filter( 'posts_request', 'tax_posts_request' );

function tax_posts_join( $sql, $wp_query ){
    if( $tax_ids = $wp_query->get('term_taxonomy_ids_in') )
        $sql .= " INNER JOIN wp_term_relationships ON ( wp_posts.ID = wp_term_relationships.object_id )";

    return $sql;
}

function tax_posts_where( $sql, $wp_query ){
    if( $tax_ids = $wp_query->get('term_taxonomy_ids_in') ){
        $tax_ids = implode( ', ', $tax_ids );
        $sql .= " AND ( wp_term_relationships.term_taxonomy_id IN (".$tax_ids.") ) ";
    }   

    return $sql;
}

function tax_posts_request( $sql ){
    //var_dump( $sql );
    return $sql;
}


$args = array(
    'term_taxonomy_ids_in' => array(23, 5, 11, 10)
);

$tax_posts = new WP_Query( $args );

/**
* Text highlight for searched-terms i search.php
*******************************/
function hybrid_child_text_highlight($text){
  if(is_search()){
    global $wp_query; //we need this for the search terms
    $keys = explode(" ",$wp_query->query_vars['s']);
    $text =
      preg_replace(
        '/('.implode('|', $keys) .')/iu',
        '<span style="background-color: #fc0; font-weight:400;">\0</span>',
        $text);

  }
    return $text;
}
add_filter('the_excerpt','hybrid_child_text_highlight');
 ?>