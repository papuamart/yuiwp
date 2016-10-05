<?php
/**
 * This is your child theme functions file.  In general, most PHP customizations should be placed within this
 * file.  Sometimes, you may have to overwrite a template file.  However, you should consult the theme 
 * documentation and support forums before making a decision.  In most cases, what you want to accomplish
 * can be done from this file alone.  This isn't a foreign practice introduced by parent/child themes.  This is
 * how WordPress works.  By utilizing the functions.php file, you are both future-proofing your site and using
 * a general best practice for coding.
 *
 * All style/design changes should take place within your style.css file, not this one.
 *
 * The functions file can be your best friend or your worst enemy.  Always double-check your code to make
 * sure that you close everything that you open and that it works before uploading it to a live site.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package HybridNews
 * @subpackage Functions
 * @version 0.4.0
 * @author Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2011, Justin Tadlock
 * @link http://themehybrid.com/themes/hybrid-yui-news
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Set up the Hybrid News child theme and its default functionality. */
add_action( 'after_setup_theme', 'hybrid_yui_news_setup', 11 );

/**
 * Adds all the default actions and filters to their appropriate hooks and sets up anything
 * else needed by the theme.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_setup() {

	/* Get the parent theme prefix for use with its hooks. */
	$prefix = hybrid_get_prefix();
	
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/core.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/shortcodes-news.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/shortcodes-yui-news.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/context.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/entries.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/entries-count.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/functions/hooks-filters.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/extensions/subtitler.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/extensions/breadcrumbs.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/extensions/postnotes.php' );
	require_once( trailingslashit( STYLESHEETPATH ) . 'library/extensions/swc_shortcodes.php' );

	/* Load any translation files for the user. */
	load_child_theme_textdomain( 'hybrid-yui-news', get_stylesheet_directory() );

	/* Add support for the Cleaner Gallery extension. */
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'subsidiary', 'after-content', 'after-singular' ) );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'entry-views' );
	add_theme_support( 'entry-series' );
	add_theme_support( 'hybrid-yui-core-sidebars' );
	add_theme_support( 'front-page-template' );

	/* Register additional widgets. */
	add_action( 'widgets_init', 'hybrid_news_register_widgets' );
	
	/* Register additional menus. */
	add_action( 'init', 'hybrid_yui_news_register_menus', 11 );

	/* Register additional sidebars. */
	
		/* Register additional js script for scoll up. */
	add_action( 'init', 'hybrid_news_enqueue_script', 11 );	

	/* Perform specific functions for the front page template. */
	add_action( 'template_redirect', 'hybrid_yui_news_front_page_template' );

	/* Add the secondary menu before the header. */
 	/* Load the primary menu. */
	add_action( "{$prefix}_before_html", 'hybrid_get_yui_css_grids' );
	add_action( "{$prefix}_before_html", 'hybrid_get_header_ygma_menu' );

	//remove_action( "{$prefix}_after_header", 'hybrid_get_primary_menu' );
	//add_action( "{$prefix}_before_header", 'hybrid_get_primary_menu' );
	add_action( "{$prefix}_before_header", 'hybrid_yui_news_get_secondary_menu' );
	add_action( "{$prefix}_after_primary_menu", 'hybrid_yui_news_get_posttypes_menu' );	
	
	/* Add the header sidebar to the header. */
	add_action( "{$prefix}_header", 'hybrid_yui_news_get_utility_header', 11 );

 	/* Add the primary and secondary sidebars after the container. */
	remove_action( "{$prefix}_after_container", 'hybrid_get_primary' );
	remove_action( "{$prefix}_after_container", 'hybrid_get_secondary' );
	

	/* Add the title, byline, and entry meta before and after the entry. */
	remove_action( "{$prefix}_before_entry", 'hybrid_entry_title' );
	remove_action( "{$prefix}_before_entry", 'hybrid_byline' );
	remove_action( "{$prefix}_after_entry", 'hybrid_entry_meta' );
	
	/* Add the title, byline, and entry meta before and after the entry. */
	add_action( "{$prefix}_before_entry", 'hybrid_news_entry_title' );
	add_action( "{$prefix}_before_entry", 'news_posted_on' );
	add_action( "{$prefix}_after_entry", 'news_posted_in' );
	
	/* Add the post author box after singular posts. */
	add_action( "{$prefix}_singular-post_after_singular", 'hybrid_yui_news_author_box' );

	/* Set up the theme settings meta box. */
	add_action( 'admin_menu', 'hybrid_yui_news_create_meta_box' );

	/* Save the theme settings meta box settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'hybrid_yui_news_save_meta_box' );
	add_action( "{$prefix}_before_footer", 'hybrid_yui_news_get_subsidiary_menu' );	
	add_action( "{$prefix}_after_html", 'hybrid_get_yui_css_grids_ends' );


}
/**
 * Displays the post title.
 *
 * @since 0.5.0
 */
function hybrid_news_entry_title() {
	echo apply_atomic_shortcode( 'entry_title', '[entry-title]' );
	echo '<span class=entry-subtitle>';
	echo apply_atomic_shortcode( 'entry_subtitle', '[entry-subtitle]' );
	echo '</span>';
}

/**
 * Registers additional nav menus for use with this theme.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_register_menus() {
	register_nav_menu( 'secondary-menu', __( 'Secondary Menu', 'hybrid-yui-news' ) );
	register_nav_menu( 'subsidiary-menu', __( 'Subsidiary Menu', 'hybrid-yui-news' ) );
	register_nav_menu( 'posttypes-menu', __( 'Post Types Menu', 'hybrid-yui-news' ) );
}

/**
 * Loads the menu-secondary.php template, which displays the Secondary Menu.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_secondary_menu() {
	locate_template( array( 'menu-secondary.php', 'menu.php' ), true );
}

/**
 * Loads the menu-subsidiary.php template, which displays the Secondary Menu.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_subsidiary_menu() {
	locate_template( array( 'menu-subsidiary.php', 'menu.php' ), true );
}

/**
 * Loads the menu-posttypes.php template, which displays the Secondary Menu.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_posttypes_menu() {
	locate_template( array( 'menu-posttypes.php', 'menu.php' ), true );
}

/**
 * Loads the menu-ygma.php template.
 *
 */
function hybrid_get_header_ygma_menu() {
	get_template_part( 'menu', 'ygma-header' );
}
 
/**
 * Loads the sidebar-header.php template, which loads the Utility: Header sidebar.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_utility_header() {
	get_sidebar( 'header' );
}

/**
 * Loads the sidebar-home.php template, which displays the Tertiary sidebar.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_home_sidebar() {
	get_sidebar( 'home' );
}

/**
 * Loads the sidebar-archive.php template, which displays the Tertiary sidebar.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_archive_sidebar() {
	get_sidebar( 'archive' );
}

/**
 * Loads the sidebar-singular.php template, which displays the Tertiary sidebar.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_get_singular_sidebar() {
	get_sidebar( 'singular' );
} 

/**
 * Adds JavaScript and CSS to Front Page page template.
 * Also removes the breadcrumb menu.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_front_page_template() {

	/* If we're not looking at the front page template, return. */
	if ( !is_page_template( 'page-front-page.php' ) )
		return;

	/* Load the jQuery Cycle plugin JavaScript and custom JavaScript for it. */
	wp_enqueue_script( 'slider', get_stylesheet_directory_uri() . '/js/jquery.cycle.js', array( 'jquery' ), 0.1, true );

	/* Load the front page stylesheet. */
	wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/css/front-page.css', false, '0.1', 'screen' );

	/* Remove the breadcrumb trail. */
	add_filter( 'breadcrumb_trail', '__return_false' );
}
/**
 * Loads extra widget files and registers the widgets.
 * 
 * @since 0.1.0
 */
function hybrid_news_register_widgets() {

	/* Load the popular tabs widget. */
	if ( current_theme_supports( 'entry-views' ) ) {
		require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/widget-popular-tabs.php' );
		register_widget( 'News_Widget_Popular_Tabs' );
	}

	/* Load the image stream widget. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/widget-image-stream.php' );
	register_widget( 'News_Widget_Image_Stream' );

	/* Load the newsletter widget. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/widget-newsletter.php' );
	register_widget( 'News_Widget_Newsletter' );
	
	/* Load the newsletter widget. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/custom-posts-widget.php' );
	//register_widget( 'n2wp_latest_cpt_init' );
	
	/* Load the newsletter widget. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/single-bottom-widget.php' );
	register_widget( 'PMNews_Widget_Post_Navigation' );		
	
	/* Load the newsletter widget. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/widget-about.php' );
	register_widget( 'about_widget' );	
	
	/* Load the newsletter widget. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/beeb-widget.php' );
	register_widget( 'PMThemeList' );
	register_widget( 'PMThemeLatestList' );
	register_widget( 'PMThemeCatLight' );
	register_widget( 'PMThemeThumbs' );
	register_widget( 'PMThemeVideo' );	
	
	/* Load the widgets for fron-page layout. */
	require_once( trailingslashit( CHILD_THEME_DIR ) . 'library/classes/widget-papua.php' );
}

/**
 * Loads the theme JavaScript files.
 *
 * @since 0.1.0
 */
function hybrid_news_enqueue_script() {
	wp_register_script( 'jquery-scrolltopcontrol', esc_url( apply_atomic( 'pmnews_scrolltop_scripts', trailingslashit( CHILD_THEME_URI ) . 'js/scrolltopcontrol.js' ) ), array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'jquery-scrolltopcontrol' );
	wp_register_script( 'comment-ajax-scripts', esc_url( apply_atomic( 'pmnews_comment_ajax_scripts',  get_bloginfo('stylesheet_directory') .'/js/comments-ajax.js' ) ), array( 'jquery' ), '1.3', true );
	wp_enqueue_script( 'comment-ajax-scripts' );
  	
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'news-theme', CHILD_THEME_URI . '/js/news-theme.js', array( 'jquery' ), '1.4.8', true );
}
/**
 * Shows an author description after the post but before the comments section on
 * singular post views.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_author_box() { ?>
	<div class="author-profile vcard">
		<?php echo get_avatar( get_the_author_meta( 'email' ), '96' ); ?>
		<h4 class="author-name fn n"><?php the_author_posts_link(); ?></h4>
		<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
	</div><?php
}

/**
 * Saves the theme settings for Hybrid News if the user has added any.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_save_meta_box( $settings ) {

	$settings['feature_category'] = empty( $settings['feature_category'] ) ? '' : absint( $settings['feature_category'] );
	$settings['excerpt_category'] = empty( $settings['excerpt_category'] ) ? '' : absint( $settings['excerpt_category'] );
	$settings['feature_num_posts'] = empty( $settings['feature_num_posts'] ) ? 3 : absint( $settings['feature_num_posts'] );
	$settings['excerpt_num_posts'] = empty( $settings['excerpt_num_posts'] ) ? 3 : absint( $settings['excerpt_num_posts'] );
	$settings['headlines_num_posts'] = empty( $settings['headlines_num_posts'] ) ? 5 : absint( $settings['headlines_num_posts'] );
	$settings['headlines_category'] = empty( $settings['headlines_category'] ) || !is_array( $settings['headlines_category'] ) ? '' : $settings['headlines_category'];

	return $settings;
}

/**
 * Adds a meta box to the theme settings page in the admin.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_create_meta_box() {
	add_meta_box( 'hybrid-yui-news-front-page-box', __( 'Front Page template settings', 'hybrid-yui-news' ), 'hybrid_yui_news_front_page_meta_box', 'appearance_page_theme-settings', 'normal', 'low' );
}

/**
 * Outputs the meta box and its form for the theme settings page.
 *
 * @since 0.3.0
 */
function hybrid_yui_news_front_page_meta_box() {
	$categories = get_categories(); ?>

	<table class="form-table">

		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'feature_category' ); ?>"><?php _e( 'Feature Category:', 'hybrid-yui-news' ); ?></label></th>
			<td>
				<select id="<?php echo hybrid_settings_field_id( 'feature_category' ); ?>" name="<?php echo hybrid_settings_field_name( 'feature_category' ); ?>">
					<option value="" <?php selected( hybrid_get_setting( 'feature_category' ), '' ); ?>></option>
				<?php foreach ( $categories as $cat ) { ?>
					<option value="<?php echo $cat->term_id; ?>" <?php selected( hybrid_get_setting( 'feature_category' ), $cat->term_id ); ?>><?php echo esc_html( $cat->name ); ?></option>
				<?php } ?>
				</select> 
				<?php _e( 'Leave blank to use sticky posts.', 'hybrid-yui-news' ); ?>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'feature_num_posts' ); ?>"><?php _e( 'Featured Posts:', 'hybrid-yui-news' ); ?></label></th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'feature_num_posts' ); ?>" name="<?php echo hybrid_settings_field_name( 'feature_num_posts' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'feature_num_posts' ) ); ?>" size="2" maxlength="2" />
				<label for="<?php echo hybrid_settings_field_id( 'feature_num_posts' ); ?>"><?php _e( 'How many feature posts should be shown?', 'hybrid-yui-news' ); ?></label>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'excerpt_category' ); ?>"><?php _e( 'Excerpts Category:', 'hybrid-yui-news' ); ?></label></th>
			<td>
				<select id="<?php echo hybrid_settings_field_id( 'excerpt_category' ); ?>" name="<?php echo hybrid_settings_field_name( 'excerpt_category' ); ?>">
					<option value="" <?php selected( hybrid_get_setting( 'excerpt_category' ), '' ); ?>></option>
					<?php foreach( $categories as $cat ) { ?>
						<option value="<?php echo $cat->term_id; ?>" <?php selected( hybrid_get_setting( 'excerpt_category' ), $cat->term_id ); ?>><?php echo esc_html( $cat->name ); ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'excerpt_num_posts' ); ?>"><?php _e( 'Excerpts Posts:', 'hybrid-yui-news' ); ?></label></th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'excerpt_num_posts' ); ?>" name="<?php echo hybrid_settings_field_name( 'excerpt_num_posts' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'excerpt_num_posts' ) ); ?>" size="2" maxlength="2" />
				<label for="<?php echo hybrid_settings_field_id( 'excerpt_num_posts' ); ?>"><?php _e('How many excerpts should be shown?', 'hybrid-yui-news' ); ?></label>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'headlines_category' ); ?>"><?php _e( 'Headline Categories:', 'hybrid-yui-news' ); ?></label></th>
			<td>
				<label for="<?php echo hybrid_settings_field_id( 'headlines_category' ); ?>"><?php _e( 'Multiple categories may be chosen by holding the <code>Ctrl</code> key and selecting.', 'hybrid-yui-news' ); ?></label>
				<br />
				<select id="<?php echo hybrid_settings_field_id( 'headlines_category' ); ?>" name="<?php echo hybrid_settings_field_name( 'headlines_category' ); ?>[]" multiple="multiple" style="height:150px;">
				<?php foreach( $categories as $cat ) { ?>
					<option value="<?php echo $cat->term_id; ?>" <?php if ( is_array( hybrid_get_setting( 'headlines_category' ) ) && in_array( $cat->term_id, hybrid_get_setting( 'headlines_category' ) ) ) echo ' selected="selected"'; ?>><?php echo esc_html( $cat->name ); ?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo hybrid_settings_field_id( 'headlines_num_posts' ); ?>"><?php _e('Headlines Posts:', 'hybrid-yui-news' ); ?></label></th>
			<td>
				<input type="text" id="<?php echo hybrid_settings_field_id( 'headlines_num_posts' ); ?>" name="<?php echo hybrid_settings_field_name( 'headlines_num_posts' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'headlines_num_posts' ) ); ?>" size="2" maxlength="2" />
				<label for="<?php echo hybrid_settings_field_id( 'headlines_num_posts' ); ?>"><?php _e( 'How many posts should be shown per headline category?', 'hybrid-yui-news' ); ?></label>
			</td>
		</tr>

	</table><!-- .form-table --><?php
}

/* 20 Dec-21 Dec. 2011
/*
* Adds additional but major change to hybrid theme for YUI CSS GRIDS Layout
* --add_action( 'init', 'pmnews_register_menus', 11 );--
* This is related to 'yui_css_grid_layout' function in pmcore.php and
* '_before_html' hook at the top of functions.php 
* this hook enables yui_css_grids_layout functions to be executre
* in pmcore.php
* in the future, this function needs to be executed from a separate 'yui-css-grids.php'
* but for now, pmnews does not know how to integrate into hybrid theme.
*/
function yui_css_grid_color_scheme() {
    $scheme = get_option('yui_css_grid_color_scheme');
    $style = '/red.css';
    if ($scheme) {
        $style = '/' . $scheme . '.css';
    }
    $css_link = "<link rel='stylesheet' type='text/css' href=\"" . get_stylesheet_directory_uri() . $style . "\" />" ;
	echo $css_link;
}

function yui_css_grid_layout() {
    $page_layout = '<div id="doc4" class="yui-t6">';
    $page_width = get_option('yui_css_grid_page_width');
    $layout = get_option('yui_css_grid_layout');
    if (($page_width) && ($layout)) {
        $page_layout = '<div id="' . $page_width . '" class="' . $layout . '" >';
    }
    echo $page_layout;
}

add_action('admin_menu', 'yui_css_grid_add_theme_page');

function yui_css_grid_add_theme_page() {
	if ( isset( $_GET['page'] ) && $_GET['page'] == basename(__FILE__) ) {
		if ( isset( $_REQUEST['action'] ) && 'save' == $_REQUEST['action'] ) {
			check_admin_referer('yui-css-grid-custom');
			$layout = $_REQUEST['layout'];
			$page_width = $_REQUEST['page-width'];
			$color_scheme = $_REQUEST['color-scheme'];
			update_option('yui_css_grid_layout', $layout);
			update_option('yui_css_grid_page_width', $page_width);
			update_option('yui_css_grid_color_scheme', $color_scheme);
			
			//print_r($_REQUEST);
			wp_redirect("themes.php?page=functions.php&saved=true");
			die;
		}    
		add_action('admin_head', 'yui_css_grid_theme_css');
	}
	add_theme_page(__('Customize YUI GRIDS'), __('Customize YUI GRIDS'), 'edit_themes', basename(__FILE__), 'yui_css_grid_theme_page');
}

function yui_css_grid_theme_css() {
?>
<style type='text/css'>
    label {
        font-weight: bold;
        width: 40px;
        text-align: right;
    }
    
    select {
        margin-bottom: 8px;
        padding-bottom: 8px;
        width: 150px;
        text-align: left
    }
    
	#headwrap {
		text-align: center;
	}
	
	.description {
		margin-top: 16px;
		color: #fff;
	}

	#nonJsForm {
		text-align: center;
	}
	#nonJsForm input.submit, #nonJsForm input.button {
		padding: 0px;
		margin: 0px;
	}
	#advanced {
		text-align: center;
		width: 620px;
	}
</style>
<?php } ?>
<?php
function yui_css_grid_theme_page() {
	if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';
?>
<div class='wrap'>
	<h2><?php _e('Customize Layout and Theme'); ?></h2>
	<div id="yui-css-grid-header">
		<div id="headwrap">
			<div id="header">
				<div id="headerimg">
					<h1><?php bloginfo('name'); ?></h1>
					<div class="description"><?php bloginfo('description'); ?></div>
					<h3>Select Your Layout and Theme Settings:</h3>
				</div>
			</div>
		</div>
		<br />
		<div id="nonJsForm">
			<form method="post" action="">
				<?php wp_nonce_field('yui-css-grid-custom'); ?>
				<label>Page Width:</label>
				<select id='page-width' name='page-width'>
<?php
    $widths = array("doc4" => "974px Centered", 
               "doc2" => "950px Centered",
               "doc"  => "750px Centered",
               "doc3" => "100% Fluid",
               "doc-custom" => "Custom Width");
    $current_width = get_option('yui_css_grid_page_width');
    foreach ($widths as $k => $v) {
        $selected = '';
        if ($k === $current_width) { 
            $selected = 'selected="selected"'; 
        };
        echo "<option value='" . $k . "' " . $selected . ">" . $v . "</option>";    
    }
?>				
				</select>&nbsp;&nbsp;<br/>
				<label>Page Layout:</label>
    			<select id='layout' name='layout'>
<?php
    $layouts = array("yui-t1" => "L+L, Outer Fixed 160px, Inner Flexible: 180px - 300px", 
                    "yui-t2" => "L+L, Outer 160px, Inner Flexible: 160px - 240px ",
                    "yui-t3" => "L+L, Outer 300px, Inner Flexible: 160px - 180px",
                    "yui-t4" => "L+R, R Smaller, L 240px - 300px, R fixed 160px",
                    "yui-t5" => "L+R , L Flexible 150px - 240px, R fixed 240px",
                    "yui-t6" => "L+R, L Flexible 150px - 180px R Fixed 300px");
    $current_layout = get_option('yui_css_grid_layout');
    foreach ($layouts as $k => $v) {
        $selected = '';
        if ($k === $current_layout) { 
            $selected = 'selected="selected"'; 
        };
        echo "<option value='" . $k . "' " . $selected . ">" . $v . "</option>";    
    }
?>				
    			</select>&nbsp;&nbsp;<br/>
    			<label>Color Scheme:</label>
    			<select id='color-scheme' name='color-scheme'>
<?php
    $schemes = array("dark_blue" => "Dark Blue", 
                     "fbook" => "FBook",
                     "green" => "Green",
                     "greenish" => "Greenish",
                     "orange" => "Orange",
                     "purple" => "Purple",
                     "red" => "Red",
                     "tan_blue" => "Tan Blue",
                     "custom" => "Custom");
    $current_scheme = get_option('yui_css_grid_color_scheme');
    foreach ($schemes as $k => $v) {
        $selected = '';
        if ($k === $current_scheme) { 
            $selected = 'selected="selected"'; 
        };
        echo "<option value='" . $k . "' " . $selected . ">" . $v . "</option>";    
    }
?>				
    			</select>&nbsp;&nbsp;
    			<input type="hidden" name="action" value="save" />
				<br/>
				<p><input type="submit" name="defaults" value="Save Settings" /></p>
			</form>
			<br/>
		</div>
	</div>
			<div style="text-algin:left;float:left;">
		<p>Please note that  the Hybrid Theme Framework's <em>Primary-Menu</em> is repreented by <strong>"L" or "Inner"</strong></p>
			<p>whereas <em>Secondary-Menu</em> is represented by <strong>"R" or "Outer"</strong></p>
	<h3>default tu theme sizes</h3><p>
	doc4-yt1 = left 160px</p><p>
	doc4-yt2 = left 180px</p><p>
	doc4-yt3 = left 300px</p><p>
	</p><p></p>
	doc4-yt4 = right 180px<p>
	doc4-yt5 = right 240px</p><p>
	doc4-yt6 = right 300px	</p>	
		</div>
</div>
<?php 
}
 function hybrid_get_yui_css_grids() { 
 yui_css_grid_layout(); 
} 

function hybrid_get_yui_css_grids_ends() { 
 echo '</div>';
}
?>