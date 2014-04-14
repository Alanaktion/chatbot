<?php
$commands['rainbowshout2'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		$text = implode(" ",$params);
		$ret = "";
		$colors = array(
			'ff00ff',
			'ff00cc',
			'ff0099',
			'ff0066',
			'ff0033',
			'ff0000',
			'ff3300',
			'ff6600',
			'ff9900',
			'ffcc00',
			'ffff00',
			'ccff00',
			'99ff00',
			'66ff00',
			'33ff00',
			'00ff00',
			'00ff33',
			'00ff66',
			'00ff99',
			'00ffcc',
			'00ffff',
			'00ccff',
			'0099ff',
			'0066ff',
			'0033ff',
			'0000ff',
			'3300ff',
			'6600ff',
			'9900ff',
			'cc00ff'
		);
		$i = 0;
		$textlength = strlen($text);
		while($i <= $textlength) {
			foreach($colors as $value) {
				if ($text[$i] != "") {
					$ret .= '<span style="color:#'.$value.';">' . htmlentities($text[$i]) . "</span>";
				}
				$i++;
			}
		}

		$conn->htmlmessage($event['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>" . $ret . "</p>", $event['type'], "Your client does not support rainbows. Lame.");
	} else {
		$conn->message($event['from'], "Usage: #rainbow <words, yo>", $event['type']);
	}
}
?>