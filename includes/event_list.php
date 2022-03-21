<div>
	<?php if ($events != null && array_key_exists('live', $events)) {?>
	<div class="mb-4">
		<h4 class="d-flex justify-content-between align-items-center mb-3">
			<span class="text-muted"><?php echo __( 'LIVE', 'tangles_events_widget_domain' )?></span>
		</h4>
		<?php foreach ($events['live'] as $month => $live) {?>
    		<div class="event_calendar_month_separator">
    			<?php echo esc_attr(tangles_events_extract_month_year($month)); ?>
    		</div>
    		<?php foreach ($live as $event) {?>
        		<div class="list-group mb-3">
    			<?php include( plugin_dir_path( __FILE__ ) . 'event_row.php'); ?>
        		</div>
    		<?php }
        } ?>
	</div>
	<?php }
	if ($events != null && array_key_exists('upcoming', $events)) {?>
	<div class="mb-4">
		<h4 class="d-flex justify-content-between align-items-center mb-3">
			<span class="text-muted"><?php echo __( 'UPCOMING', 'tangles_events_widget_domain' )?></span>
		</h4>
		<?php foreach ($events['upcoming'] as $month => $upcoming) {?>
    		<div class="event_calendar_month_separator">
    			<?php echo esc_attr(tangles_events_extract_month_year($month)); ?>
    		</div>
    		<?php foreach ($upcoming as $event) {?>
        		<div class="list-group mb-3">
        		<?php include( plugin_dir_path( __FILE__ ) . 'event_row.php'); ?>
        		</div>
			<?php }
        } ?>
	</div>
	<?php }
	if (($events == null) || (!array_key_exists('live', $events) && !array_key_exists('upcoming', $events))) {?>
	<div>
		<p><?php echo __( 'No events to display', 'tangles_events_widget_domain' )?></p>
	</div>
    <?php } else if (($events != null) && array_key_exists('total', $events)) { ?>
    <div>
        <?php $args = array('total' => $events['total']);
        echo paginate_links($args); ?>
    </div>
	<?php } ?>
</div>




