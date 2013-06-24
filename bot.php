#!/usr/bin/php
<?php
if (!defined('STDIN'))
	die("Hashbot must be run from the command line.");

$start_time = time();

if(!defined('__DIR__'))
	define('__DIR__', dirname(__FILE__));

require __DIR__ . '/config.php';
@error_reporting($errors);

echo "Loading libraries... ";
require __DIR__ . "/lib/XMPPHP/XMPP.php";
include __DIR__ . "/lib/Unirest.php";
include __DIR__ . "/lib/chatterbotapi.php";
if ($old_auth) {
	require __DIR__ . "/lib/XMPPHP/XMPP_Old.php";
}
echo "done.\n";

// Build base $commands object
$commands = array();

if ($old_auth) {
	$conn = new XMPPHP_XMPPOld($server, $port, $user, $pass, $clientid, $domain, $printlog = True, $loglevel = XMPPHP_Log::LEVEL_INFO);
} else {
	$conn = new XMPPHP_XMPP($server, $port, $user, $pass, $clientid, $domain, $printlog = True, $loglevel = XMPPHP_Log::LEVEL_INFO);
}
$conn->autoSubscribe();

$vcard_request = array();

try {
	$conn->connect();

	while (!$conn->isDisconnected()) {
		$payloads = $conn->processUntil(array('message', 'presence', 'end_stream', 'session_start', 'vcard'));
		foreach ($payloads as $event) {
			$pl = $event[1];
			switch ($event[0]) {
				case 'message':
					// Ensure previous messages in the room are not processed
					if (time() - $start_time > 3) {
						$msg = trim(preg_replace("/\\s+/", " ", $pl['body']));

						$pl['realfrom'] = $pl['from'];

						// Send group messages to the room, not the sender (weird)
						if ($pl['type'] == "groupchat")
							$pl['from'] = $room . "@" . $room_server;
						// Don't require a hash for direct messages
						elseif ($msg{0} != "#")
							$msg = '#' . $msg;

						$greetings = array(
							"hi hashbot",
							"hey hashbot",
							"hello hashbot",
							"hi hash",
							"hey hash"
						);
						$basic_msg = trim(preg_replace("/[^a-z ]/", "", strtolower($msg)));

						// Greetings
						if (in_array($basic_msg, $greetings)) {
							$conn->message($pl['from'], "Hi!", $pl['type']);

						// Colors
						} elseif (preg_match("/^(#[0-9A-Fa-f]{6})$/",trim($msg))) {
							$conn->message($pl['from'], "http://www.colorhexa.com/" . strtolower(trim($msg,"#")) . ".png", $pl['type']);

						// Commands
						} elseif ($msg{0} == "#") {

							// Split message into command and parameters
							if (count(explode(" ", $msg)) > 1) {
								list($cmd, $param_str) = explode(" ", $msg, 2);
								$params = explode(" ", $param_str);
							} else {
								$cmd = $msg;
								$params = array();
							}

							$cmd = trim(strtolower(ltrim($cmd, "#")));
							$short_from = substr($pl['from'],0,strpos($pl['from'],"@"));
							echo $short_from . ": {$msg}\n";

							if (is_file(dirname(__FILE__) . "/commands/" . $cmd . ".php")) {
								include dirname(__FILE__) . "/commands/" . $cmd . ".php";
								$commands[$cmd]($conn, $pl, $params);
							} elseif($cmd == "help") {
								$h = opendir(dirname(__FILE__) . "/commands/");
								$cmd_list = array();
								while($f = readdir($h)) {
									if($f == "." | $f == "..")
										continue;
									$cmd_list[] = preg_replace("/\\.php$/", "", $f);
								}
								closedir($h);
								$conn->message($pl['from'], "Available commands: " . implode(", ",$cmd_list), $pl['type']);
								echo "Available commands: " . implode(", ",$cmd_list) . "\n";
							} elseif(!$cmd) {
								// empty command, do nothing
							} else {
								$conn->message($pl['from'], "Unknown command: {$cmd}", $pl['type']);
							}
						}
					}
					break;
//				case 'presence':
//					print "Presence: {$pl['from']} [{$pl['show']}] {$pl['status']}\n";
//					break;
				case 'session_start':
					print "Session Start\n";
					$conn->getRoster();

					// Go online
					$conn->presence($status = "I'm alive!");

					// Join room (if set)
					if (!empty($room)) {
						$conn->joinRoom($room, $room_server, $nick, $room_password);
						echo "Joining room {$room}\n";
					}

					// Set start time again (delays 2 seconds before processing any commands)
					$start_time = time();

					break;
				case 'vcard':
					// check to see who requested this vcard
					$deliver = array_keys($vcard_request, $pl['from']);
					// work through the array to generate a message
					print_r($pl);
					$msg = '';
					foreach ($pl as $key => $item) {
						$msg .= "$key: ";
						if (is_array($item)) {
							$msg .= "\n";
							foreach ($item as $subkey => $subitem) {
								$msg .= "  $subkey: $subitem\n";
							}
						} else {
							$msg .= "$item\n";
						}
					}
					// deliver the vcard msg to everyone that requested that vcard
					foreach ($deliver as $sendjid) {
						// remove the note on requests as we send out the message
						unset($vcard_request[$sendjid]);
						$conn->message($sendjid, $msg, 'chat');
					}
					break;
			}
		}
	}
} catch (XMPPHP_Exception $e) {
	die($e->getMessage());
}

function curl_get_contents($url,$user_agent = null) {
	if (in_array('curl', get_loaded_extensions())) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		if($user_agent) {
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('User-Agent: ' . $user_agent));
		}
		$data = curl_exec($curl);
		curl_close($curl);
	} else {
		$data = file_get_contents($url);
	}
	return $data;
}

function curl_post_get_contents($url,$post_data = array(),$content_type = "application/json") {
	if (in_array('curl', get_loaded_extensions())) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		if($content_type) {
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: ' . $content_type));
		}
		$data = curl_exec($curl);
		curl_close($curl);
	} else {
		$data = file_get_contents($url);
	}
	return $data;
}
