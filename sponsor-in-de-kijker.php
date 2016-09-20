<?php
/*
Plugin Name: Sponsor in de kijker Widget
Plugin URI: http://vijfr.com/
Description: Sponsor in de kijker Widget
Author: Johnnie Eerlings
Version: 1
*/


class SponsorInDeKijkerWidget extends WP_Widget
{
  function SponsorInDeKijkerWidget()
  {
    $widget_ops = array('classname' => 'SponsorInDeKijkerWidget', 'description' => 'Sponsor in de kijker' );
    $this->WP_Widget('SponsorInDeKijkerWidget', 'Sponsor in de kijker', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
// WIDGET CODE GOES HERE
$val = rand(1, 35);

if ($val <= 20) {
	$soort = 'Premium';
} elseif ($val <= 30) {
	$soort = 'Groot';
} else {
	$soort = 'Klein';
}

//echo $val;
//echo $soort;

$wp_query = new WP_Query( array('post_type' => 'sponsor', 'orderby' => 'rand', 'posts_per_page' => '1', 'meta_key' => 'soort', 'meta_value'	=> $soort) );

if( $wp_query->have_posts() ):	 
	
	$wp_query->the_post();
	get_template_part( 'content', 'in-de-kijker' );

endif;

wp_reset_postdata();
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SponsorInDeKijkerWidget");') );?>
