<?php
/* Plugin Name: jQuery Tabber Widget
Plugin URI: 
Description: 
Version: 1.0
Author: Noumaan
Author URI: http://sabza.org
*/
class TabberWidget extends WP_Widget {
          function TabberWidget() {
                    $widget_ops = array(
                    'classname' => 'TabberWidget',
                    'description' => 'Tabs to display random popular recent posts'
          );
          $this->WP_Widget(
                    'TabberWidget',
                    'Tabber Widgett',
                    $widget_ops
          );
}
          function widget($args, $instance) { // widget sidebar output

function tabber() { 

//adding plugin's stylesheet

wp_register_style('tabber-style', plugins_url('tabber-style.css', __FILE__));

wp_enqueue_style('tabber-style');


//adding jquery to wp_footer

function tabber_widget_jquery() { 

echo "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js?ver=1.8'></script>";

} 

add_action('wp_footer', 'tabber_widget_jquery');

//and more jquery

wp_register_script('tabber-widget-js', plugins_url('tabber.js', __FILE__));
wp_enqueue_script('tabber-widget-js');


?>


<ul class="tabs">
	<li class="active"><a href="#tab1">Recent</a></li>
	<li><a href="#tab2">Popular</a></li>
	<li><a href="#tab3">Random</a></li>
</ul>
<div class="tab_container">
	<div id="tab1" class="tab_content">
		<ul>
			
<?php
	$args = array( 'numberposts' => '5', 'post_type' => 'post', 'post_status' => 'publish' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
	}
?>
		</ul>
	</div>
	<div id="tab2" class="tab_content" style="display:none;">
		<ul>
<?php if (function_exists('wpp_get_mostpopular')) wpp_get_mostpopular("range=weekly&order_by=avg&stats_comments=0&limit=5"); ?>

		</ul>
	</div>
	<div id="tab3" class="tab_content" style="display:none;">
		<ul>
<?php
global $post;
$posts = get_posts('orderby=rand&numberposts=5');
foreach($posts as $post) { ?>

<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</li>

<?php } ?>
		</ul>
	</div>
</div>
<?php

}

                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme

$tabs = tabber(); 

echo $tabs;

                    echo $after_widget; // post-widget code from theme
          }
}
add_action(
          'widgets_init',
          create_function('','return register_widget("TabberWidget");')
);
?>