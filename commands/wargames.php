<?php
$commands['wargames'] = function(&$conn, $event, $params) {
	if (!empty($params[0]) && $params[0] == "GLOBAL THERMALNUCLEAR WAR") {
		$conn->message($event['from'], "LOGON:", $event['type']);	
		
	} else if (!empty($params[0]) && $params[0] == "JOSHUA") {
		$conn->message($event['from'], "CPE1704TKS", $event['type']);	
		$conn->message($event['from'], "U.S. FIRST STRIKE", $event['type']);	
		sleep(2);
		$conn->message($event['from'], "WINNER: NONE", $event['type']);	
		$conn->message($event['from'], "USSR FIRST STRIKE", $event['type']);	
		sleep(2);
		$conn->message($event['from'], "WINNER: NONE", $event['type']);	
		$conn->message($event['from'], "NATO / WARSAW PACT: NONE", $event['type']);	
		sleep(2);
		$conn->message($event['from'], "FAR EAST STRATEGY: NONE", $event['type']);	
		sleep(2);
		$conn->message($event['from'], "U.S. USSR ESCALATION: NONE", $event['type']);	
		$conn->message($event['from'], "GREETINGS, PROFESSOR FALKEN.", $event['type']);
		$conn->message($event['from'], "A STRANGE GAME. THE ONLY WINNING MOVE IS NOT TO PLAY.", $event['type']);
		$conn->message($event['from'], "HOW ABOUT A NICE GAME OF CHESS?", $event['type']);
		
	} else if (!empty($params[0]) && $params[0] == "TIC-TAC-TOE") {
		$conn->message($event['from'], "STALEMATE.", $event['type']);
		$conn->message($event['from'], "WANT TO PLAY AGAIN", $event['type']);
	} else if (!empty($params[0]) && implode(" ", $params) == "List Games") {
		$conn->message($event['from'], "FALKEN'S MAZE
		BLACK JACK
		GIN RUMMY
		HEARTS
		BRIDGE
		CHECKERS
		CHESS
		POKER
		FIGHTER COMBAT
		GUERRILLA ENGAGEMENT
		DESERT WARFARE
		AIR-TO-GROUND ACTIONS
		THEATERWIDE TACTICAL WARFARE
		THEATERWIDE BIOTOXIC AND CHEMICAL WARFARE
		
		GLOBAL THERMALNUCLEAR WAR
		", $event['type']);
	} else {
		$conn->message($event['from'], "GREETINGS,", $event['type']);
		$conn->message($event['from'], "SHALL WE PLAY A GAME?", $event['type']);
	}
}
?>
