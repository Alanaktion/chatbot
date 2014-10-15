<?php
$commands['md5'] = function(&$conn, $event, $params) {
	if(empty($params)) {
		$conn->message($event['from'], "Usage: #md5 <string>", $event['type']);
	} else {
		$conn->message($event['from'], md5(implode(" ",$params)), $event['type']);
	}
}
?>
