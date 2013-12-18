<?php
include_once dirname(__FILE__) . '/../lib/domain.class.php';
$commands['whois'] = function(&$conn, $pl, $params) {
	if(!empty($params[0])) {
		$domain = new domain($params[0]);
		if($domain->is_valid()) {
			echo "Whois Server: ", $domain->get_whois_server(), "\n";

			if($domain->is_available()){
				$conn->message($pl['from'], "Domain " . $domain->get_domain() . "." . $domain->get_tld() . " is not registered.", $pl['type']);
				return;
			}

			$response = $domain->info();
			if($pos = strpos($response, "REGISTRANT CONTACT INFO")) {
				$info = substr($response, $pos);
				$info = substr($info, 0, strpos($info, "\n\n"));
			} else {
				$info = "This WHOIS format is not yet supported.";
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
