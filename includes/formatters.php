<?php
if (!class_exists(Parsedown::class)) {
    include_once( plugin_dir_path( __FILE__ ) . 'third-party/parsedown/Parsedown.php');
}
	
    function tangles_events_extract_day($date_time) {
	    return $date_time->format("D");
	}
	
	function tangles_events_extract_date($date_time) {
	    return $date_time->format("d");
	}
	
	function tangles_events_extract_short_month($date_time) {
	    return strtoupper($date_time->format("M"));
	}
	
	function tangles_events_extract_month_year($timestamp) {
	    $date_time = new DateTime($timestamp);
	    return $date_time->format("F Y");
	}
	
	function tangles_events_get_ident($name) {
	    $clean = esc_attr($name);
	    if (strlen($clean) > 0) {
	        return strtoupper($clean[0]);
	    }
	    return '';
	}

	function tangles_events_start_date_summary($date_time) {
	    return tangles_events_date_summary($date_time, 'start');
	}

	function tangles_events_end_date_summary($date_time) {
	    return tangles_events_date_summary($date_time, 'end');
	}

	function tangles_events_date_summary($date_time, $modfifier) {
	    $time = $date_time->format("H:i");
	    $now = new DateTime();
	    $today = strtotime('today', $now->getTimestamp());
	    if ($date_time->getTimestamp() > $now->getTimestamp()) {
	        $tomorrow = new DateTime('@' . $today);
            $tomorrow->add(new DateInterval('P1D'));
            $base = 'Due to ' . $modfifier . ' ';
            if ($date_time->getTimestamp() < $tomorrow->getTimestamp()) {
               return $base . 'today at ' . $time;
            }
            $days = abs($date_time->diff($tomorrow)->days);
            if ($days == 0) {
               return $base . 'tomorrow at ' . $time;
            }
            if ($days < 6) {
               return $base . $date_time->format("l") . ' at ' . $time;
            }
            return $base . $date_time->format("j M") . ' at ' .  $time;
	    } else {
	        $base = 'Was due to ' . $modfifier . ' ';
	        if ($date_time->getTimestamp() > $today) {
	            return $base . 'today at ' . $time;
	        }
	        $yesterday = new DateTime('@' . $today);
	        $yesterday->sub(new DateInterval('P1D'));
	        if ($date_time->getTimestamp() >  $yesterday->getTimestamp()) {
	            return $base . 'yesterday at ' . $time;
	        }
	        $days = abs($date_time->diff(new DateTime('@' . $today))->days);
	        if ($days < 6) {
	            return $base . 'last ' . $date_time->format("l") . ' at ' .  $time;
	        }
	        return $base . $date_time->format("j M") . ' at ' .  $time;
	    }
	    return "";
	}
	
	function tangles_events_short_address($event) {
	    if (!empty($event->short_address)) {
	        return esc_attr($event->short_address);
	    }
	    return esc_attr($event->full_address);
	}
	
	function tangles_events_markdown($content) {
	    $parsedown = new Parsedown();
	    return force_balance_tags(wp_trim_words($parsedown->text(esc_attr($content))));
	    return force_balance_tags(html_entity_decode(wp_trim_words(htmlentities(wpautop($parsedown->text(esc_attr($content)))))));
	}
?>