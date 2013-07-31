<?php
$commands['poll'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		switch($params[0]) {
			case "new":
				if(empty($params[1])) {
					$conn->message($event['from'], "Usage: #poll new [choice1, choice2, ...]" . implode("\n", $stats), $event['type']);
					return;
				}
				if(isset($GLOBALS['poll'])) {
					$conn->message($event['from'], "There is already a running poll. The creator of the current poll can end it with #poll end." . implode("\n", $stats), $event['type']);
					return;
				}
				break;
			case "end":
				if(isset($GLOBALS['poll'])) {
					$conn->message($event['from'], "There is already a running poll. The creator of the current poll can end it with #poll end." . implode("\n", $stats), $event['type']);
					return;
				}
				break;
			case "vote":
				if(empty($params[1])) {
					$conn->message($event['from'], "Usage: #poll vote <choice #>" . implode("\n", $stats), $event['type']);
					return;
				}
				break;
		}
	} else {
		if(isset($GLOBALS['poll'])) {
			$stats = array();
			$conn->message($event['from'], "Current poll statistics: " . implode("\n", $stats), $event['type']);
		} else {
			$conn->message($event['from'], "No open polls. Use \"#poll new [choice1, choice2, ...]\" to start a new poll.", $event['type']);
		}
	}
};
