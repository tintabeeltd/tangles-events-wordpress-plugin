<?php
/**
 * Plugin Name:       Tangles Events
 * Description:       The Tangles Events plugin fetches public event information from a Tangle Events community and renders as a calendar widget
 * Version:           0.1.2
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Author:            Tintabee Ltd
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       tangles-events
 *
 * @package           tangles-events
 */

include_once( plugin_dir_path( __FILE__ ) . 'includes/formatters.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/event.php');

class tangles_events_widget extends WP_Widget {
    
    function __construct() {
        parent::__construct('tangles_events_widget',
            __('Tangles Events', 'tangles_events_widget_domain'),
            array( 'description' => __( 'Displays public event information for a Tangles community', 'tangles_events_widget_domain' ), )
            );
    }
    
    public function widget( $args, $instance ) {
        wp_enqueue_style( 'tangles_events_widget_style', plugins_url( 'public/css/tangles_events_widget.css' , __FILE__ ) );
        $title = apply_filters( 'widget_title', $instance['title'] );
        if (tanglesevents_public_key_is_valid($instance)) {
            $public_key = $instance[ 'public_key' ];
            $events = tanglesevents_fetch_community_events($public_key);
        } else {
            $events = null;
        }
        if (array_key_exists('before_widget', $args)) {
            echo $args['before_widget'];
        }
        if ($instance['compact']) {
            include( plugin_dir_path( __FILE__ ) . 'includes/event_list_compact.php');
        } else {
            include( plugin_dir_path( __FILE__ ) . 'includes/event_list.php');
        }
        if (array_key_exists('after_widget', $args)) {
            echo $args['after_widget'];
        }
    }
    
    private function render_event($event) {
        ?>
        <?php include( plugin_dir_path( __FILE__ ) . 'includes/event_row.php'); ?>
        <?php
    }
    
    
    public function form( $instance ) {
        if (isset($instance[ 'title' ])) {
            $title = apply_filters( 'widget_title', $instance['title'] );
        }
        $public_key = isset($instance['public_key']) ? $instance['public_key'] : '';
        $compact = isset($instance['compact']) ? ($instance['compact'] ? 'true' : 'false') : false;
        $status = isset($instance['status']) ? $instance['status'] : '';
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'public_key' ); ?>"><?php _e('Key:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'public_key' ); ?>" name="<?php echo $this->get_field_name('public_key'); ?>" type="text" value="<?php echo esc_attr($public_key); ?>" />
        </p>
    	<p>
        <input class="checkbox" type="checkbox" <?php checked($compact, 'on' ); ?> id="<?php echo $this->get_field_id('compact'); ?>" name="<?php echo $this->get_field_name('compact'); ?>" /> 
        <label for="<?php echo $this->get_field_id('compact'); ?>">Compact view</label>
    	</p>
        <p><small class="tanglesevents_status"><?php echo esc_attr($status); ?></small></p>
        <?php 
    }
     
    public function update( $new_instance, $old_instance ) {
        $public_key = strip_tags($new_instance['public_key']);
        if (!empty($public_key) && strlen($public_key) == 9) {
            $community_name = tanglesevents_fetch_community_name($public_key);
            $status = empty($community_name) ? __( 'Error fetching community', 'tangles_events_widget_domain' ) : '';
        } else {
            $status = __( 'Invalid community key', 'tangles_events_widget_domain' );
            $community_name = '';
        }
        $instance = array();
        $instance['title'] = !empty($community_name) ? sanitize_text_field($community_name) : '';
        $instance['public_key'] = !empty( $new_instance['public_key']) ? sanitize_text_field($new_instance['public_key']) : '';
        $instance['compact'] = $new_instance['compact'];
        $instance['status'] = !empty($status) ? sanitize_text_field($status) : '';
        return $instance;
    }
} 

function tanglesevents_fetch_community_name($public_key) {
    $url = "http://api.tanglesevents.com/api/directory/entry/" . esc_attr($public_key) . "/?site=" . urlencode(get_site_url());
    $options = array();
    $headers = array();
    $response = Requests::get($url, $headers, $options);
    if ($response->success) {
        $json = json_decode($response->body);
        return $json->name;
    }
    return '';
}

function tanglesevents_fetch_community_events($public_key) {
    $current_page = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
    $community_url = "http://api.tanglesevents.com/api/directory/entry/" . esc_attr($public_key) . "/";
    $url = $community_url . "events/?page=" . esc_attr($current_page);
    $options = array();
    $headers = array();
    $response = Requests::get($url, $headers, $options);
    if ($response->success) {
        $json = json_decode($response->body);
        return tangles_events_parse_events($json);
    }
    return null;
}

function tanglesevents_public_key_is_valid($attributes) {
    if (!isset($attributes[ 'public_key' ])) {
        return false;
    }
    $public_key = $attributes[ 'public_key' ];
    if (strlen($public_key) != 9) {
        return false;
    }
    if (isset($attributes[ 'status' ])) {
        return strlen($attributes[ 'status' ]) == 0;
    }
    return true;
}

// Register the block backend
function tanglesevents_render_callback( $block_attributes, $content ) {
    wp_enqueue_style( 'tangles_events_widget_style', plugins_url( 'public/css/tangles_events_widget.css' , __FILE__ ));
    if (tanglesevents_public_key_is_valid($block_attributes)) {
        $public_key = $block_attributes[ 'public_key' ];
        $events = tanglesevents_fetch_community_events($public_key);
    } else {
        $events = null;
    }
    ob_start();
    include( plugin_dir_path( __FILE__ ) . 'includes/event_list.php');
    $output = ob_get_clean();
    return $output;
}

// Register the block
function tanglesevents_block_init() {
    register_block_type( __DIR__ . '/build', array(
        'render_callback' => 'tanglesevents_render_callback',
    ));
    wp_register_script('tangles-events-block', null, plugins_url('/build/index.js', __FILE__), null, true);
    wp_localize_script(
        'tangles-events-block',
        'global_data',
        [ 'site_url' => get_site_url()  ]
        );
    wp_enqueue_script('tangles-events-block');
}
add_action( 'init', 'tanglesevents_block_init' );


// Register the widget
function tanglesevents_load_widget() {
    register_widget( 'tangles_events_widget' );
}
add_action( 'widgets_init', 'tanglesevents_load_widget' );


