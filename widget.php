<?php
class One_Login_Btt extends WP_Widget {
	function __construct() {
		parent::__construct(false, $name = __('One-Login.info'),
			array( 'description' => __( 'Add Login Box' )) );
	}
	function form($instance) {
	if( $instance) {
		 $title = esc_attr($instance['title']);
	} else {
		 $title = '';
	}
	?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e('Title:', 'wp_widget_plugin'); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<?php
	
			
	}
	function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
     return $instance;
}

	function widget($args, $instance) {
		if ( !is_user_logged_in() ){
        
        echo $args['before_widget'];
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        
        ?>
<div id="social_plugins"></div>
<script src="http://<?php echo API_DOMAIN;?>.one-login.info/api/<?php echo API_KEY;?>"></script>
<?php
		echo $args['after_widget'];
		
	}}
}
function register_One_Login_Btt()
{
    register_widget( 'One_Login_Btt' );
}


?>
