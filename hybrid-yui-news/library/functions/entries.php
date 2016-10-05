<?php 
/**
 * The core functions file for the pmmews framework. Functions defined here are generally
 * used across the entire framework to make various tasks faster. This file should be loaded
 * prior to any other files because its functions are needed to run the framework.
 *
 * @package pmmewsCore
 * @subpackage Functions
 */

if ( ! function_exists( 'featured_entry_content_shortcode' ) ) :
function featured_entry_content_shortcode() {?>
		<div id="post-<?php the_ID(); ?>"  <?php post_class('block') ?> class="<?php hybrid_entry_class(); ?>">
<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'Thumbnail' => false, 'default_size' => 'thumbnail', 'image_scan' => true, 'width' => '125', 'default_image' => 'http://papuapost.com/wp-content/uploads/images/default_thumb.gif' ) ); ?>		
		
		<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
		<?php echo apply_atomic_shortcode( 'entry_subtitle', '[entry-subtitle]' ); ?>
		
				<?php echo news_posted_on (); // hybrid_after_entry ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links pages">' . __( 'Pages:', hybrid_get_textdomain() ), 'after' => '</p>' ) ); ?>
				</div><!-- .entry-content -->
				<?php echo news_posted_in (); // hybrid_after_entry ?>

		<div class="clear"></div>
		</div><!-- .hentry -->
<?php }
add_shortcode( 'featured-entry-content', 'featured_entry_content_shortcode' );
endif;
if ( ! function_exists( 'entry_archive_shortcode' ) ) :
function entry_archive_shortcode() {
echo '<div class="hentry">';
 if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'custom_key' => false, 'Thumbnail' => false, 'default_size' => 'thumbnail', 'image_scan' => true, 'width' => '125', 'default_image' => 'http://papuapost.com/wp-content/uploads/images/default_thumb.gif' ) ); 
	echo'<div class="entry-content">	
			<div class="bd">	
			<div class="fixed">';
		 echo the_content_rss('', TRUE, '', 20);
			echo '</div><!--<div class="fixed"-->
			</div><!--<div class="bd"-->';
	do_atomic( 'news_after_entry' ); // hybrid_before_entry 
			echo '</div><!--<div class="entry-content"-->';
			echo '</div><!--<div class="entry-content"-->';
}
add_shortcode( 'archive-entry', 'entry_archive_shortcode' );		
endif;		

/*
Plugin Name: Recent Comments Plugin
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/

function mdv_recent_comments($no_comments = 6, $comment_lenth = 30, $before = '<ul class=listing><li>', $after = '</li></ul>', $show_pass_post = false, $comment_style = 0) {
    global $wpdb;
    $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, post_title FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID WHERE post_status IN ('publish','static') ";
	if(!$show_pass_post) $request .= "AND post_password ='' ";
	$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
    $output = '';
	if ($comments) {
		foreach ($comments as $comment) {
			$comment_author = stripslashes($comment->comment_author);
			if ($comment_author == "")
				$comment_author = "anonymous"; 
			$comment_content = strip_tags($comment->comment_content);
			$comment_content = stripslashes($comment_content);
			$words=split(" ",$comment_content); 
			$comment_excerpt = join(" ",array_slice($words,0,$comment_lenth));
			$permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;

			if ($comment_style == 1) {
				$post_title = stripslashes($comment->post_title);
				
				$url = $comment->comment_author_url;

				if (empty($url))
					$output .= $before . $comment_author . ' on ' . $post_title . '.' . $after;
				else
					$output .= $before . "<a href='$url' rel='external'>$comment_author</a>" . ' on ' . $post_title . '.' . $after;
			}
			else {
				$output .= $before . '<strong class="author">' . $comment_author . ':</strong>  <a href="' . $permalink;
				$output .= '" title="View the entire comment by ' . $comment_author.'">' . $comment_excerpt.'</a>' . $after;
			}
		}
		$output = convert_smilies($output);
	} else {
		$output .= $before . "None found" . $after;
	}
    echo $output;
}

/*
Plugin Name: Recently Updated Posts Plugin
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/

// RECENT POSTS/PAGE UPDATED
function get_recently_updated ($num_posts = 5)
	 {
	   global $wpdb, $tableposts, $post, $tablepost2cat;	 
	   if (!isset($tablepost2cat)) $tablepost2cat = $wpdb->post2cat;
	   if (!isset($tableposts)) $tableposts = $wpdb->posts;	 
	   $orderby = "$tableposts.post_$orderby";	 
	  $now = current_time('mysql');
	   $sql = "SELECT DISTINCT * FROM $tableposts ";
	   $sql .= "WHERE $tableposts.post_date <= '$now' AND ( $tableposts.post_status = 'publish' ";
	   $sql .= "OR $tableposts.post_status = 'sticky' ";
	   $sql .= ") ";
	   $sql .= "GROUP BY $tableposts.ID ORDER BY $tableposts.post_date DESC";
	  $sql .= " LIMIT 0, $num_posts";	  
	   $posts = array();
	   $posts = $wpdb->get_results($sql);
	   if (empty($posts)) return;	  
	    echo '<ul class=listing>';	 
	   foreach ($posts as $post) {	 
	    $title = the_title('', '', false);
	    echo '<li>';
				echo '<span class=postDate>';
		echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '&nbsp;ago </span>&nbsp;';
	    echo '<a href="'.get_permalink().'" title="View Post '.htmlspecialchars(strip_tags($title)).'">'.$title.'</a>';
	    echo '</li>';
	   }	 
	   echo '</ul>';	  
	  } //end function get_recent_entries()	
function recent_comments_shortcode(){
echo mdv_recent_comments();
}
// please not that the "add_shortcode_ functions are in pm-shortcodes.html
add_shortcode('recent-comments', 'recent_comments_shortcode');
function recently_updated_posts_shortcode(){
echo get_recently_updated();
}
add_shortcode('recent-updated', 'recently_updated_posts_shortcode');

/*
Plugin Name: Recently Posted Posts Plugin
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
// Recent Posts Shortcode
function pmnews_recent_posts_shortcode($atts){
	extract(shortcode_atts(array('limit' => 5), $atts)); 
	$q = new WP_Query('posts_per_page=' . $limit); 
	$list = '<ul class="listing">'; 
	while($q->have_posts()) : $q->the_post();
		$list .= '<li>' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>&nbsp;<span class=red>-&nbsp;' . do_shortcode( '[entry-published]' ); '</span></li>';
	endwhile; 
	wp_reset_query(); 
	return $list . '</ul>';
	} 
//end function get_recent_updates()		  
//add_shortcode('recent-posts', 'pmnews_recent_posts_shortcode');

/*
Plugin Name: Latest Post Per Category with Category Description Plugin
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
* fb_posts_by_category lists latest post per category
* unformated (non yui-css-grid) lists latest news per category
*/
function fb_posts_by_category() {
	global $wpdb, $post;
 
	$mylimit = '3'; // limit for posts, -1 for all
	$sort_code = 'ORDER BY name ASC, post_date DESC';
	$the_output = '';
 
	$last_posts = (array)$wpdb->get_results("
		SELECT $wpdb->terms.name, $wpdb->terms.term_id
		FROM $wpdb->terms, $wpdb->term_taxonomy
		WHERE $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id
		AND $wpdb->term_taxonomy.taxonomy = 'category'
		{$hide_check} 
	");
 
	if ( empty($last_posts) )
		return NULL;
 
	$used_cats = array();
	$i = 0;
	foreach ($last_posts as $posts) {
		if ( in_array($posts->name, $used_cats) ) {
			unset($last_posts[$i]);
		} else {
			$used_cats[] = $posts->name;
		}
		$i++;
	}
	$last_posts = array_values($last_posts);
 
	foreach ($last_posts as $posts) {
		$class = 'cat-item cat-item-' . $posts->term_id;
		$catsy = get_the_category();
		$current_category = $catsy[0]->cat_ID;
		if ( isset($current_category) && $current_category && ($posts->term_id == $current_category) )
		$class .=  ' current-cat';
		elseif ( isset($_current_category) && $_current_category && ($posts->term_id == $_current_category->parent) )
		$class .=  'current-cat-parent';
		$the_output .= '<h3 class="' . $class . '"><a class="category" href="' . get_category_link($posts->term_id) . '">' . apply_filters('list_cats', $posts->name, $posts) . '</a></h3>';
		$where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'" , $r );
 
		if ('-1' !== $mylimit)
			$limit = ' LIMIT ' . (int) $mylimit;
		else
			$limit = '';
 
		$arcresults = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (Select object_id FROM $wpdb->term_relationships, $wpdb->terms WHERE $wpdb->term_relationships.term_taxonomy_id =" . $posts->term_id . ") ORDER BY post_date DESC$limit");
		if (isset($arcresults) && $arcresults) {
			$the_output .= '<ul cass="listing">';
			foreach ( $arcresults as $arcresult ) {
				$class = 'post-item post-item-' . $arcresult->ID;
				$current_post = get_the_ID();
				if ( isset($current_post) && $current_post && is_singular() && ($arcresult->ID == $current_post) )
				$class .=  'current-post';
 
				$the_output .= '<li class="' . $class . '"><a class="post" href="' . get_permalink($arcresult->ID) . '">' . apply_filters('the_title', $arcresult->post_title) . '</a></li>';
			}
			$the_output .= '</ul>';
		}
 
	}

	echo $the_output;
}

/*
Plugin Name: Latest Post Per Category without Category Description Plugin
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
*/
/* posts_by_category lists latest post per category
* archive in yui-css-grids format
*/
function posts_by_category() {  
global $wpdb, $post; $cats = get_categories("hierarchical=0"); ?> 
<div role="contentinfo" class="yui-gb">
<?php if($cats != NULL) { ?> 
				<?php foreach ($cats as $cat) { ?>
					<div role="contentinfo" class="yui-u first" style="margin:auto 5px; 3px 5px">
					<div class="box yui-cms-accordion multiple fade fixIE" id="mylist-third-accordion">
					<div class="yui-cms-item yui-panel">
			<?php if($cat != NULL) { $base_url = home_url('home') . "/category/" . $cat->slug; ?>
			<div class="yui-cms-categories"><h3 class="hd"><a href="<?php echo $base_url?>"><?php echo $cat->cat_name?></a><?php } ?> 
				<span class="icon-rss"><?php $this_category = get_category($cat);// This line just gets the active category information
				print '<a href="'.get_category_feed_link($this_category->cat_ID, '').'">RSS</a>';?></span>
				</h3>
				<?php if ($cat->category_description != NULL) ?><div class="ft path"><?php echo $cat->category_description ?></div>
				<div class="bd">
				<div class="fixed">
				<?php $myposts = get_posts("category=$cat->cat_ID"); ?> 
				<?php foreach($myposts as $post) : ?>
				<ul class="catArchive"><li><?php echo do_shortcode('[entry-published]') ?>. <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li></ul>
				<?php endforeach;
				echo '</div></div>';
				echo '<div class="actions">
	 <a href="#" class="accordionToggleItem">&nbsp;</a> 
	</div>';
				echo '</div></div></div>';
			echo '</div>';	
//Reset Query
wp_reset_query();
}
echo '</div>';
}
}

function related_by_tag_shortcode( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '10',
	), $atts));

	global $wpdb, $post, $table_prefix;
	if ($post->ID) {
		$retval = '<ul class=listing>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {			
		$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a>,&nbsp;<span class=red>&#64;&nbsp;<em>'.do_shortcode ('[entry-published]').'</em></span></li>';
			}
			
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		return $retval;
	}
	return;
}
add_shortcode('related-by-tag', 'related_by_tag_shortcode');
// echo do_shortcode( '[related-by-tag]' );
/////////
function related_by_category_shortcode( $atts ) {
$tags = wp_get_post_tags($post->ID);
			$post_not_in = array($post->ID);
			if ($tags) {
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args=array(
					'tag__in' => $tag_ids,
					'post__not_in' => $post_not_in,
					'showposts'=>10, // Number of related posts that will be shown.
					'caller_get_posts'=>1
				);
				$my_query = new wp_query($args);
				if( $my_query->have_posts() ) {
					echo '&raquo;&nbsp;&rang;&nbsp;Related News by Category';
					while ($my_query->have_posts()) {
						$my_query->the_post();
					?>
						<ul><li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class=date>,&nbsp;<em>&#64;&nbsp;<?php echo do_shortcode( '[entry-published]' ); ?></em></span></li></ul>
					<?php
					}			
				}}
}
add_shortcode('related_by_category', 'related_by_category_shortcode');
//
// RELATED by words or terms used in the post content
function related_by_content_shortcode() {
//for in the loop, display all "content", regardless of post_type,
//that have the same custom taxonomy (e.g. words) terms as the current post
$backup = $post;  // backup the current object
$found_none = '<h2>No related posts found!</h2>';
$taxonomy = 'words,terms';//  e.g. post_tag, category, custom taxonomy
$param_type = 'words,terms'; //  e.g. tag__in, category__in, but genre__in will NOT work
$post_types = get_post_types( array('public' => true), 'names' );
$tax_args=array('orderby' => 'none');
$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
if ($tags) {
  foreach ($tags as $tag) {
    $args=array(
      "$param_type" => $tag->slug,
      'post__not_in' => array($post->ID),
      'post_type' => $post_types,
      'showposts'=>5,
      'caller_get_posts'=>1    );
    $my_query = null;
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
       <ul class="listing"><li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a><span class=red>,&nbsp;<em>&#64;&nbsp;<?php echo do_shortcode( '[entry-published]' ); ?></em></span></li></ul>
        <?php $found_none = '';
		$post_not_in[] = get_the_ID();
      endwhile;
    }
  }
}
if ($found_none) {
echo $found_none;
}
$post = $backup;  // copy it back
wp_reset_query(); // to use the original query again
}
add_shortcode('related_by_content', 'related_by_content_shortcode');

////////////
function more_articles_shortcode() {
if ( is_page('home') || is_archive() || is_single()) :
			global $post;
			$categories = get_the_category();
			foreach ($categories as $category) :?>
			<ul class="listing"><?php
			$posts = get_posts('numberposts=5&offset=1&category='. $category->term_id);
			foreach($posts as $post) : ?>
			<li class="on"><a target="_self" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class=red>,&nbsp;<em>&#64;&nbsp;<?php echo do_shortcode( '[entry-published]' ); ?></em></span></li><?php endforeach; ?><p></p>
			<li><h4>[+]<a href="<?php echo get_category_link($category->term_id);?>" title="<?php _e('Go to '); ?>
			<?php echo $category->name; ?>"> <?php _e('Go to '); ?> <strong>'<?php echo $category->name; ?>'</strong> 
			<?php _e('Archive'); ?> &raquo;</a></h4></li>
			<?php endforeach; endif ;
	echo '</ul>';
}
add_shortcode('more-articles', 'more_articles_shortcode');

// 4. Adding Previous Entries From The Same Category
function prev_related($atts, $content = null) {
		extract(shortcode_atts(array(
				"num" => '5',
				"cat" => ''
		), $atts));
		global $post;
		$myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=random&category='.$cat);
		$retour='<ul class=listing>';
		foreach($myposts as $post) :
				setup_postdata($post);
			 $retour.='<li><a href="'.get_permalink().'">'.the_title("","",false).'</a>,&nbsp;<span class=red>&#64;&nbsp;'.do_shortcode ('[entry-published]').'</span></li>';
		endforeach;
		$retour.='</ul> ';
		return $retour;
}
//add_shortcode('related-prev', 'prev_related');
// In this example the shortcode [related] will randomly display 5 entries from the same category.
// WordPress Custom Fields: Listing A Series Of Posts
function article_series() {
	global $post;
	$series = get_post_meta($post->ID, 'Series', true);
	if($series) :
		$args = array(
			'numberposts' => -1,
			'meta_key' => 'Series',
			'meta_value' => $series,
		);
		$series_posts = get_posts($args);
		if($series_posts) :
			$class = preg_replace("/[^a-z0-9\\040\\.\\-\\_\\\\]/i", "", $series);
			$class = strtolower(str_replace(array(' ', '&nbsp;'), '-', $class));
			echo '<div class="series series-' . $class . '"><h4 class="series-title">' . __('Articles in this series') . '</h4><ul>';
			foreach($series_posts as $serial) :
				if($serial->ID == $post->ID)
					echo '<li class="current-post">' . $serial->post_title . '</li>';
				else
					echo '<li><a href="' . get_permalink($serial->ID) . '" title="' . str_replace('"', '"', $serial->post_title) . '">' . str_replace('"', '"', $serial->post_title) . '</a></li>';
			endforeach;
			echo '</ul></div>';
		endif;
	endif;
}
function related_from_google() {?>
<div id="gajax" style="width:600px;">
<script src="http://www.google.com/jsapi?partner-pub-1092473475447397:9613820256"></script>
    <script language="Javascript" type="text/javascript">
      google.load('search', '1.0');
      function OnLoad() {
        // create a tabbed mode search control
        var tabbed = new google.search.SearchControl();

			tabbed.addSearcher(new google.search.BlogSearch());
			tabbed.addSearcher(new google.search.VideoSearch());
			tabbed.addSearcher(new google.search.NewsSearch());
 			tabbed.addSearcher(new google.search.WebSearch());
			tabbed.addSearcher(new google.search.ImageSearch());
			tabbed.addSearcher(new google.search.BookSearch());
			tabbed.addSearcher(new google.search.LocalSearch());
        // draw in tabbed layout mode
        var drawOptions = new google.search.DrawOptions();
        drawOptions.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED);
        tabbed.draw(document.getElementById("search_control_tabbed"), drawOptions);
        tabbed.execute("<?php the_title(); ?>");
      }
      google.setOnLoadCallback(OnLoad, true);

    </script>
    <div style="float: left;width:600px;" class="search-control" id="search_control_tabbed">Loading</div>
</div>
<?php
}
?>