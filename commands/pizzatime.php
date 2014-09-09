<?php
$commands['pizzatime'] = function(&$conn, $event, $params) {
	$ascii = <<<EOT
  //\\        PPPPP IIII ZZZZZ ZZZZZ    A
 // O \\      PP  PP II    ZZ    ZZ    A A
|| O o  \\    PPPPP  II   ZZ    ZZ    AAAAA
||__o__O__\\  PP    IIII ZZZZZ ZZZZZ A     A
EOT;
	$ascii_array = explode("\n", $ascii);
	$conn->htmlmessage($event['from'], nl2br("\n") . "<p style='font-family: monospace;'> " . nl2br($ascii) . "</p>", $event['type']);
}
?>
