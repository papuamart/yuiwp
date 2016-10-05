<?php 
 
if ( current_theme_supports( 'front-page-template' )) {	
 function hybrid_yui_home_register_sidebars() {
    $allWidgetizedAreas = array("home-1", "home-2", "home-3", "home-4");    
    foreach ($allWidgetizedAreas as $WidgetAreaName) {    
    register_sidebar(array(
        'name'=> $WidgetAreaName,
		'description' => 'This is to be placed on Home Top, Home Middle and Home Bottom widgets.',			
			'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-inside">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
        ));    
    }
}
add_action( 'init', 'hybrid_yui_home_register_sidebars', 11 );
} // if current_theme_supports

if ( current_theme_supports( 'hybrid-yui-core-sidebars' )  ) {
/**
 * Register additional widget areas
 *
 * @since 0.3.0
 */
 function hybrid_yui_core_register_sidebars() {
	    $allWidgetizedAreas = array("utilityheader","sidebar-home", "sidebar-archive");    
    foreach ($allWidgetizedAreas as $WidgetAreaName) {    
    register_sidebar(array(
        'name'=> $WidgetAreaName,
		'description' => 'This is to be placed on additional widgets at the header widget and tertiary sidebar widgets.',			
			'before_widget' => '<div id="%1$s" class="widget %2$s widget-%2$s"><div class="widget-inside">',
			'after_widget' => '</div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
        ));    
    }
}
add_action( 'init', 'hybrid_yui_core_register_sidebars', 11 );
} // if current_theme_supports
 
?>