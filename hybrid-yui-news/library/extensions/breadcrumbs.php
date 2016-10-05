<?php
/*
* Categories and first few tags as bread crumb
*/
	function tagAndCatBreadCrumb() {
		$posttags = get_the_tags();
		$count=0;
		if ($posttags) {
			 foreach($posttags as $tag) {
				 $count++;
				 // no. of tags to show
				 if ($count <= 3) {
				 	$ptags[] = '<a class="tag-links" href="'. get_tag_link($tag->term_id) . '" rel="tag">'. ucwords($tag->name) . '</a>';
				 }
			 }

			 $tagCatBreadCrumb = the_category(', ') . ' &gt; ' . implode(', ', $ptags);
			 return $tagCatBreadCrumb;
		}
		else { 
$tagCatBreadCrumb = the_category(', ');
return $tagCatBreadCrumb;
}	
}
/* Google Breadcrumb for WordPress Navigation
* for archive and home-page breadcrumb only
*/
function googleBreadcrumbs($display = TRUE, $separator = '<b>&rsaquo;</b>', $before = '<span style="text-transform:capitalize;">', $after = '</span>') {
	global $wp_query, $post, $googleBreadcrumbs;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	?>
     <?php if (!is_page() && !is_single()) { ?>
		<span class="">&nbsp;<?php _e( 'results', hybrid_get_textdomain() ); ?> <b><?php if (!is_404()) echo (($paged-1)*$posts_per_page)+1; else echo '0'; ?></b> - <b><?php if ($paged*$posts_per_page < $numposts) echo $paged*$posts_per_page; else echo $numposts; ?></b> <?php _e( 'of about', hybrid_get_textdomain() ); ?> <b><?php echo $numposts ?></b> <?php _e( 'for', hybrid_get_textdomain() ); ?> <b>
        <?php
		if (is_home()) echo '*';
		if (is_category()) single_cat_title();
		if (is_tag()) single_tag_title();
		if (is_day()) the_time('F jS, Y');
		if (is_month()) the_time('F, Y');
		if (is_year()) the_time('Y');
		if (is_search()) the_search_query();
		?>
        </b>. (<b><?php timer_stop(1); ?></b> <?php _e( 'seconds', hybrid_get_textdomain() ); ?>)&nbsp;</span>
	<?php } else { ?>
		<span>&nbsp;<?php _e( 'results', hybrid_get_textdomain() ); ?> <b>1</b> - <b>1</b> <?php _e( 'of about', hybrid_get_textdomain() ); ?> <b>1</b> <?php _e( 'for', hybrid_get_textdomain() ); ?> <b><?php the_title(); ?></b>. (<b><?php timer_stop(1); ?></b> <?php _e( 'seconds', hybrid_get_textdomain() ); ?>)&nbsp;</span>
<?php 
}
}
?>