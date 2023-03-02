<div class="event_row_container">
	<div class="event_row_date">
		<span class="event_row_day_of_week"><?php esc_html_e(strtoupper(tangles_events_extract_day($event->start_datetime))) ?></span>
		<span class="event_row_day_of_month"><?php esc_html_e(tangles_events_extract_date($event->start_datetime)) ?></span>
		<?php if (!empty($event->logo_url)) {?>
			<button type="button" class="btn-logo-sm" style="background-image:url('<?php echo esc_url($event->logo_url) ?>')"></button>
		<?php } else {?>
			<button type="button" class="btn-logo-sm"><?php esc_html_e(tangles_events_get_ident($event->name)) ?></button>
		<?php }?>
	</div>
	<div class="event_row_body">
		<h4 class="event_row_title"><?php echo esc_attr($event->name); ?></h4>
		<div class="event_row_block">
	 		<span class="event_row_img_calendar"></span>
			<span class="event_row_block_body"><?php esc_html_e(tangles_events_start_date_summary($event->start_datetime)) ?></span>
		</div>
		<div class="event_row_block">
	 		<span class="event_row_img_calendar"></span>
			<span class="event_row_block_body"><?php esc_html_e(tangles_events_end_date_summary($event->end_datetime)) ?></span>
		</div>
		<?php if (!empty($event->full_address)) {?>
			<div class="event_row_block">
		 		<span class="event_row_img_map_pin"></span>
				<span class="event_row_block_body"><?php esc_html_e($event->full_address) ?></span>
			</div>
		<?php }
		if (!empty($event->description)) {
		    echo '<p>' . wp_kses_post(apply_filters('the_excerpt', tangles_events_markdown($event->description))) . '</p>';
		}?>
	</div>
	<div class="event_row_image_container">
		<?php if (!empty($event->featured)) {?>
		<img src="<?php echo esc_url($event->featured) ?>" class="event_row_image"/>
		<?php } else {?>			
		<img src="<?php echo esc_url(plugins_url( 'public/img/UjxL9x0nwQ8.jpg' , __FILE__ )); ?> class="event_row_image"/>
		<?php }?>
	</div>
</div>
