<?php
$commands['wiseman'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "I know.", $pl['type']);
}
?>
