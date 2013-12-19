<?php
include_once dirname(__FILE__) . '/../lib/domain.class.php';
$commands['whois'] = function(&$conn, $pl, $params) {
	if(!empty($params[0])) {
		$domain = new domain($params[0]);
		if($domain->is_valid()) {
			echo "Whois Server: ", $domain->get_whois_server(), "\n";

			$response = $domain->info();
			if($domain->is_available()){
				$conn->message($pl['from'], "Domain " . $domain->get_domain() . "." . $domain->get_tld() . " is not registered.", $pl['type']);
				return;
			}

			echo $response;

			if($pos = strpos($response, "REGISTRANT CONTACT INFO")) {
				$info = substr($response + 23, $pos);
				$info = substr($info, 0, strpos($info, "\n\n"));
			} else {
				$lines = explode("\n", $info);
				$registrant = array();
				foreach($lines as $l) {
					if(strpos($l, "Registrant") !== false) {
						$registrant[] = trim(substr($l, strlen("Registrant")));
					}
				}
				if(!empty($registrant)) {
					$info = "\n" . implode("\n", $registrant);
				} else {
					$info = "Response format not supported. ";
					$info .= "<a href='http://alanaktion.net/tools/whois.php?domain=" . $domain->get_domain() . "." . $domain->get_tld() . "'>Full response</a>";
					$conn->htmlmessage($pl['from'], $info, $pl['type'], "Response format not supported.");
					return false;
				}
			}

			$conn->message($pl['from'], $info, $pl['type']);
		} else {
			$conn->message($pl['from'], "Invalid domain name.", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "Usage: #whois <domain>", $pl['type']);
	}
}
?>
