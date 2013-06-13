#!/usr/bin/php
<?php
require 'config.php';
error_reporting($errors);

if(!defined('STDIN')) die("Hashbot must be run from the command line.");

echo "Loading XMPP libraries... ";
include("XMPPHP/XMPP.php");
if($old_auth) {
    include("XMPPHP/XMPP_Old.php");
}
echo "done.\n";

if($old_auth) {
    $conn = new XMPPHP_XMPPOld($server, $port, $user, $pass, $clientid, $domain, $printlog=True, $loglevel=XMPPHP_Log::LEVEL_VERBOSE);
} else {
    $conn = new XMPPHP_XMPP($server, $port, $user, $pass, $clientid, $domain, $printlog=True, $loglevel=XMPPHP_Log::LEVEL_INFO);
}
$conn->autoSubscribe();

$vcard_request = array();

try {
    $conn->connect();
    
    while(!$conn->isDisconnected()) {
    	$payloads = $conn->processUntil(array('message', 'presence', 'end_stream', 'session_start', 'vcard'));
    	foreach($payloads as $event) {
    		$pl = $event[1];
    		switch($event[0]) {
    			case 'message':
                    $msg = trim(preg_replace("/\\s+/"," ",$pl['body']));
                    if($msg{0} == "#") {
                    
                        // Split message into command and parameters
                        if(count(explode(" ",$msg)) > 1) {
                            list($cmd,$param_str) = explode(" ",$msg,2);
                            $params = explode(" ",$param_str);
                        } else {
                            $cmd = $msg;
                            $param_str = "";
                            $params = array();
                        }
                        
                        $cmd = strtolower(ltrim($cmd, "#"));
                        echo $pl['from'] . ": {$msg}\n";
                        
                        switch($cmd) {
                            case "help":
                                $conn->message($pl['from'],"I'm not very helpful yet.",$pl['type']);
                                break;
                            case "say":
                                if($param_str{0} == "#") {
                                    $conn->message($pl['from'],"Nope :P",$pl['type']);
                                } else {
                                    $conn->message($pl['from'],$param_str,$pl['type']);
                                }
                                break;
                            case "fp":
                                $img = str_pad(rand(0,45),2,0,STR_PAD_LEFT);
                                $conn->message($pl['from'],"http://facepalm.org/images/{$img}.jpg",$pl['type']);
                                break;
                            case "yt":
                            case "youtube":
                                $url = "http://gdata.youtube.com/feeds/api/videos?q=" . urlencode($param_str) . "&alt=json";
                                $result = json_decode(file_get_contents($url),true);
                                if(isset($result['feed']['entry'][0])) {
                                    $video = $result['feed']['entry'][0];
                                    $conn->message($pl['from'],$video['title']['$t'] . " " . $video['link'][0]['href'],$pl['type']);
                                } else {
                                    $conn->message($pl['from'],"Nothing found!",$pl['type']);
                                }
                                break;
                            case "tell":
                                
                                break;
                            case "spam!":
                                $max = !empty($params[0]) ? intval($params[0]) : 20;
                                for($i=0;$i<$max;$i++) {
                                    $conn->message($pl['from'],sha1(microtime()),$pl['type']);
                                }
                                break;
                            case "whoami":
                                $conn->message($pl['from'],$pl['from'],$pl['type']);
                                break;
                            case "die!":
                                $conn->message($pl['from'],"/me dies",$pl['type']);
                                $conn->disconnect();
                                break;
                            case "!":
                                $conn->message($pl['from'],"New Twitter doesn't use a hashbang anymore, history.pushState() was better.",$pl['type']);
                                break;
                            case "":
                                // Do nothing on "#"
                                break;
                            default:
                                $conn->message($pl['from'],"Unknown command: {$cmd}",$pl['type']);
                        }
                    
                    } else {
                        $greetings = array(
                            "hi hashbot",
                            "hey hashbot",
                            "hi hash",
                            "hey hash"
                        );
                        $basic_msg = trim(preg_replace("/[^a-z0-9 ]/","",strtolower($msg)));
                        if(in_array($basic_msg,$greetings)) {
                            $conn->message($pl['from'],"Hi!",$pl['type']);
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
    				$conn->presence($status="I'm alive!");
                    
                    // Join room (if set)
                    if(!empty($room)) {
                        //$conn->presence(NULL, "available", "{$room}@{$room_server}/{$nick}","available",0,$room_password);
                        $conn->joinRoom($room,$room_server,$nick,$room_password);
                        echo "Joining room {$room}\n";
                    }
                    
                    break;
				case 'vcard':
					// check to see who requested this vcard
					$deliver = array_keys($vcard_request, $pl['from']);
					// work through the array to generate a message
					print_r($pl);
					$msg = '';
					foreach($pl as $key => $item) {
						$msg .= "$key: ";
						if(is_array($item)) {
							$msg .= "\n";
							foreach($item as $subkey => $subitem) {
								$msg .= "  $subkey: $subitem\n";
							}
						} else {
							$msg .= "$item\n";
						}
					}
					// deliver the vcard msg to everyone that requested that vcard
					foreach($deliver as $sendjid) {
						// remove the note on requests as we send out the message
						unset($vcard_request[$sendjid]);
    					$conn->message($sendjid, $msg, 'chat');
					}
                    break;
    		}
    	}
    }
} catch(XMPPHP_Exception $e) {
    die($e->getMessage());
}

function curl_get_contents($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
