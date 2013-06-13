#!/usr/bin/php
<?php
require 'config.php';
error_reporting($errors);

if (!defined('STDIN'))
	die("Hashbot must be run from the command line.");

$start_time = time();

echo "Loading libraries... ";
include("lib/XMPPHP/XMPP.php");
include("lib/Unirest.php");
if ($old_auth) {
	include("lib/XMPPHP/XMPP_Old.php");
}
echo "done.\n";

// Build base $commands object
$commands = array(
	"help" => function(&$conn, $event, $params) {
		$conn->message($event['from'], "I'm not very helpful yet. But I am object-based now!", $event['type']);
	}
);

if ($old_auth) {
	$conn = new XMPPHP_XMPPOld($server, $port, $user, $pass, $clientid, $domain, $printlog = True, $loglevel = XMPPHP_Log::LEVEL_INFO);
} else {
	$conn = new XMPPHP_XMPP($server, $port, $user, $pass, $clientid, $domain, $printlog = True, $loglevel = XMPPHP_Log::LEVEL_INFO);
}
$conn->autoSubscribe();

$vcard_request = array();

start:
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

						// Process #commands
						if ($msg{0} == "#") {

							// Split message into command and parameters
							if (count(explode(" ", $msg)) > 1) {
								list($cmd, $param_str) = explode(" ", $msg, 2);
								$params = explode(" ", $param_str);
							} else {
								$cmd = $msg;
								$param_str = "";
								$params = array();
							}

							$cmd = strtolower(ltrim($cmd, "#"));
							echo $pl['from'] . ": {$msg}\n";

							switch ($cmd) {

								case "help":
									$conn->message($pl['from'], "I'm not very helpful yet.", $pl['type']);
									break;

								case "fp":
									$img = str_pad(rand(0, 45), 2, 0, STR_PAD_LEFT);
									$conn->message($pl['from'], "http://facepalm.org/images/{$img}.jpg", $pl['type']);
									break;

								case "weather":
									if (!empty($param_str)) {
										$conn->message($pl['from'], "Checking the forecast for " . $param_str . "...", $pl['type']);
										$response = Unirest::get("https://george-vustrey-weather.p.mashape.com/api.php?_method=getForecasts&location=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
										$str = "Forecast for " . $param_str;
										$str.= "\nToday: ▲ " . round($response->body[0]->high) . "  ▼ " . round($response->body[0]->low) . "  " . $response->body[0]->condition;
										$str.= "\nTomorrow: ▲ " . round($response->body[1]->high) . "  ▼ " . round($response->body[1]->low) . "  " . $response->body[1]->condition;
										$conn->message($pl['from'], $str, $pl['type']);
									} else {
										$conn->message($pl['from'], "Usage: #weather <location>", $pl['type']);
									}
									break;

								case "cat":
									if ($params[0] == "gif")
										$cat_xml = curl_get_contents("http://thecatapi.com/api/images/get?format=xml&type=gif");
									else
										$cat_xml = curl_get_contents("http://thecatapi.com/api/images/get?format=xml");
									$cat = new SimpleXMLElement($cat_xml);
									$conn->message($pl['from'], $cat->data->images->image->url, $pl['type']);
									break;

								case "yoda":
									if (!empty($param_str)) {
										$response = Unirest::get("https://yoda.p.mashape.com/yoda?sentence=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
										$conn->message($pl['from'], $response->raw_body, $pl['type']);
									} else {
										$conn->message($pl['from'], "Usage: #yoda <sentence>", $pl['type']);
									}
									break;

								case "yt":
								case "youtube":
									if (!empty($param_str)) {
										$url = "http://gdata.youtube.com/feeds/api/videos?q=" . urlencode($param_str) . "&alt=json";
										$result = json_decode(file_get_contents($url), true);
										if (isset($result['feed']['entry'][0])) {
											$video = $result['feed']['entry'][0];
											$conn->message($pl['from'], $video['title']['$t'] . " " . $video['link'][0]['href'], $pl['type']);
										} else {
											$conn->message($pl['from'], "Nothing found!", $pl['type']);
										}
									} else {
										$conn->message($pl['from'], "Usage: #yt|youtube <search terms>", $pl['type']);
									}
									break;

								case "q":
								case "go":
									if (!empty($param_str)) {
										$url = "http://www.faroo.com/api?q=" . urlencode($param_str) . "&length=1&l=en&src=web&i=false&f=json";
										$result = json_decode(file_get_contents($url), true);
										if (isset($result['results'][0])) {
											$top = $result['results'][0];
											$conn->message($pl['from'], $top['title'] . " " . $top['url'], $pl['type']);
										} else {
											$conn->message($pl['from'], "Nothing found!", $pl['type']);
										}
									} else {
										$conn->message($pl['from'], "Usage: #q|go <search terms>", $pl['type']);
									}
									break;

								case "timer":
									if (empty($params[0])) {
										if (!empty($timer)) {
											$conn->message($pl['from'], "Timer running, " . (time() - $timer) . " seconds", $pl['type']);
										} else {
											$conn->message($pl['from'], "Timer isn't running!", $pl['type']);
										}
									} elseif ($params[0] == "start") {
										$timer = time();
										$conn->message($pl['from'], "Starting timer", $pl['type']);
									} elseif ($params[0] == "stop") {
										if (!empty($timer)) {
											$conn->message($pl['from'], "Time: " . (time() - $timer) . " seconds", $pl['type']);
											unset($timer);
										} else {
											$conn->message($pl['from'], "Timer isn't running!", $pl['type']);
										}
									}
									break;

								case "ip":
									$response = Unirest::get("https://mark-sutuer-ip-utils.p.mashape.com/api.php?_method=getMyIp", array("X-Mashape-Authorization" => $mash_key));
									$conn->message($pl['from'], $response->body->myIp, $pl['type']);
									break;

								case "rip":
								case "rdns":
									if (!empty($params[0])) {
										$response = Unirest::get("https://mark-sutuer-ip-utils.p.mashape.com/api.php?_method=resolveIp&address=" . urlencode($params[0]), array("X-Mashape-Authorization" => $mash_key));
										$conn->message($pl['from'], $response->body->host, $pl['type']);
									} else {
										$conn->message($pl['from'], "Usage: #rdns|rip <ip address>", $pl['type']);
									}
									break;

								case "qr":
									if (!empty($param_str)) {
										$response = Unirest::get("https://mutationevent-qr-code-generator.p.mashape.com/generate.php?content=" . urlencode($param_str), array("X-Mashape-Authorization" => $mash_key));
										$conn->message($pl['from'], $response->body->image_url, $pl['type']);
									} else {
										$conn->message($pl['from'], "Usage: #qr <text>", $pl['type']);
									}
									break;

								case "whois":
									if (!empty($params[0])) {
										$response = json_decode(curl_get_contents("https://whoiz.herokuapp.com/lookup.json?url=" . urlencode($params[0])));
										$conn->message($pl['from'], $response, $pl['type']);
									} else {
										$conn->message($pl['from'], "Usage: #whois <domain>", $pl['type']);
									}
									break;

//                                case "spam!":
//                                    $max = !empty($params[0]) ? intval($params[0]) : 20;
//                                    for ($i = 0; $i < $max; $i++) {
//                                        $conn->message($pl['from'], sha1(microtime()), $pl['type']);
//                                    }
//                                    break;

								case "whoami":
									$conn->message($pl['from'], $pl['from'], $pl['type']);
									break;

								case "restart!":
									$conn->message($pl['from'], "/me doesn't do anything, 'cause Alan doesn't know how to do that yet.", $pl['type']);
									$conn->disconnect();
									goto start;
									break;

//                                case "die!":
//                                    $conn->message($pl['from'], "/me dies", $pl['type']);
//                                    $conn->disconnect();
//                                    break;

								case "it":
									$conn->message($pl['from'], "/me pounds it.", $pl['type']);
									break;

								case "!":
									$conn->message($pl['from'], "New Twitter doesn't use a hashbang anymore, history.pushState() was better.", $pl['type']);
									break;

								case "":
									// Do nothing on "#"
									break;

								default:
									$conn->message($pl['from'], "Unknown command: {$cmd}", $pl['type']);
							}
						} else {
							$greetings = array(
								"hi hashbot",
								"hey hashbot",
								"hello hashbot",
								"hi hash",
								"hey hash"
							);
							$basic_msg = trim(preg_replace("/[^a-z0-9 ]/", "", strtolower($msg)));
							if (in_array($basic_msg, $greetings)) {
								$conn->message($pl['from'], "Hi!", $pl['type']);
							}
						}
					}
					break;
				case 'presence':
					print "Presence: {$pl['from']} [{$pl['show']}] {$pl['status']}\n";
					break;
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

function curl_get_contents($url) {
	if (in_array('curl', get_loaded_extensions())) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		$data = curl_exec($curl);
		curl_close($curl);
	} else {
		$data = file_get_contents($url);
	}
	return $data;
}
