<?php

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

$commands['scrumtime'] = function(&$conn, $pl, $params) {
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>S</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>C</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>R</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>U</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>M</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>T</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>I</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>M</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>E</p>", $pl['type']);
	sleep(1);
	$conn->htmlmessage($pl['from'], "<p style='font-size: xx-large; font-weight: bold; color:yellow; background: #000;'>!</p>", $pl['type']);
}


?>