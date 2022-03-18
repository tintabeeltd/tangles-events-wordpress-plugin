<?php
    function tangles_events_parse_events($event_page) {
        if ($event_page != null && $event_page->results) {            
            $event_list = array();
            $events = $event_page->results;
            $live_event_list = array();
            $upcoming_event_list = array();
            foreach ($events as $event) {
                if (tangles_events_event_live($event)) {
                    tangles_events_list_append($live_event_list, $event, tangles_events_month_start($event));
                } else if (tangles_events_event_upcoming($event)) {
                    tangles_events_list_append($upcoming_event_list, $event, tangles_events_month_start($event));
                }
            }
            if (count($live_event_list) > 0) {
                ksort($live_event_list);
                $event_list['live'] = $live_event_list;
            }
            if (count($upcoming_event_list)  > 0) {
                ksort($upcoming_event_list);
                $event_list['upcoming'] = $upcoming_event_list;
            }
            $event_list['total'] = $event_page->pages ? intval($event_page->pages) : 1;
            $event_list['current'] = $event_page->current ? intval($event_page->current ) : 1;
            return $event_list;
        }
        return null;
    }

	function tangles_events_event_live($event) {
	    return in_array(esc_attr($event->state), ['ENROL', 'INPROGRESS', "PAUSED"]);
	}
	
	function tangles_events_event_upcoming($event) {
	    $now = new DateTime();
	    $end_date = new DateTime(esc_attr($event->end_date));
	    return ($end_date->getTimestamp() > $now->getTimestamp()) && in_array(esc_attr($event->state), ['NOTSTARTED', 'ENROL', "PAUSED"]);
	}
	
	function tangles_events_list_append(&$events, $event, $month) {
	    if (array_key_exists($month, $events)) {
	        array_push($events[$month],$event);
	   } else {
	       $events[$month] = [$event];
	   }
	}
	
	function tangles_events_month_start($event) {
	    $start_date = new DateTime(esc_attr($event->start_date));
	    return $start_date->modify('first day of this month')->format("Ymd");
	}
?>