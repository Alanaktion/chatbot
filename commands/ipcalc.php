<?php
$commands['ipcalc'] = function(&$conn, $event, $params) {
	if (!function_exists("cidr2netmask")) {

		function cidr2netmask($cidr) {
			for($i = 1; $i <= 32; $i++)
				$bin .= $cidr >= $i ? '1' : '0';

			$netmask = long2ip(bindec($bin));

			if ($netmask == "0.0.0.0")
				return false;

			return $netmask;
		}

		function cidr2network($ip, $cidr) {
			return long2ip((ip2long($ip)) & ((-1 << (32 - (int)$cidr))));
		}

		function netmask2cidr($netmask) {
			$bits = 0;
			$netmask = explode(".", $netmask);

			foreach($netmask as $octect)
				$bits += strlen(str_replace("0", "", decbin($octect)));

			return $bits;
		}

		function cidr_match($ip, $network, $cidr) {
			if ((ip2long($ip) & ~((1 << (32 - $cidr)) - 1) ) == ip2long($network)) {
				return true;
			}
			return false;
		}

	}
	if (!empty($params[0])) {
		if(preg_match("/([0-9]+\.){2}[0-9]+\/[0-9]{1,2}/", $params[0])) {
			$netmask = cidr2netmask(substr($params[0], strpos($params[0], "/") + 1));
			$cidr = netmask2cidr($netmask);
			$address = cidr2network(substr($params[0], 0, strpos($params[0], "/")), $cidr);
		} else {
			$conn->message($event["from"], "Invalid Address/CIDR", $event["type"]);
			return;
		}

		$out = "\n";
		$out .= "Address: $address";
		$out .= "Netmask: $netmask = $cidr";
		$conn->message($event["from"], $out, $event["type"]);

	} else {
		$conn->message($event["from"], "Usage: #ipcalc <IP/CIDR>", $event["type"]);
	}
}
?>
