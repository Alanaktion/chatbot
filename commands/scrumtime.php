<?php

$commands['scrumtime'] = function(&$conn, $pl, $params) {
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

	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;S&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;C&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;R&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;U&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;T&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;I&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;E&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
	usleep(250000);
	$i++;
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:#".$colors[$i] ."; background: #000;'>&nbsp;&nbsp;!&nbsp;&nbsp;&nbsp;</p>", $pl['type']);
}


?>