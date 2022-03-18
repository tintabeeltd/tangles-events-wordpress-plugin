<div class="event_row_container event_row_container_compact">
	<div class="event_row_date">
		<span class="event_row_day_of_week"><?php echo strtoupper(tangles_events_extract_day($event->start_date)) ?></span>
		<span class="event_row_day_of_month"><?php echo tangles_events_extract_date($event->start_date) ?></span>
		<span class="event_row_month"><?php echo tangles_events_extract_short_month($event->start_date) ?></span>
	</div>
	<div class="event_row_body_compact">
		<h4 class="event_row_title"><?php echo esc_attr($event->name); ?></h4>
			<div class="event_row_block">
		 		<span class="event_row_img_calendar"></span>
				<span class="event_row_block_body"><?php echo tangles_events_start_date_summary($event->start_date) ?></span>
			</div>
			<?php if (!empty($event->full_address)) {?>
				<div class="event_row_block">
			 		<span class="event_row_img_map_pin"></span>
					<span class="event_row_block_body"><?php echo esc_attr($event->full_address) ?></span>
				</div>
			<?php }?>
		</a>
	</div>
</div>
