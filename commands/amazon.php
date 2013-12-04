<?php
include_once dirname(__FILE__) . "/../lib/AmazonECS.class.php";
$commands['amazon'] = function(&$conn, $event, $params) {
	global $amazon_associate_tag, $amazon_key, $amazon_secret;

	if(empty($amazon_associate_tag) || empty($amazon_key)) {
		$conn->message($event['from'], "Amazon Associate Tag and Key must be set in configuration.", $event['type']);
		return false;
	}

	try {
		if (!empty($params[0])) {
			$amazonEcs = new AmazonECS($amazon_key, $amazon_secret, 'com', $amazon_associate_tag);
			$result = $amazonEcs->Category('All')->responseGroup('ItemAttributes,Offers')->search(implode(" ", $params));

			if(!empty($result->Items->Item)) {
				$first = $result->Items->Item[0];

				// Top hit
				$html = "<a href='{$first->DetailPageURL}' style='font-size: larger;'>" . htmlentities($first->ItemAttributes->Title). "</a>";
				$html .= " - <strong>{$first->ItemAttributes->ListPrice->FormattedPrice}</strong>";
				if(!empty($first->ItemAttributes->Feature)) {
					$html .= "\n<br />&#8226; " . implode("\n<br />&#8226; ", $first->ItemAttributes->Feature);
				}

				// Next few results
				foreach($result->Items->Item as $i=>$item) {
					// Show first 5 products
					if($i == 0 || $i >= 5) {
						continue;
					}

					$html .= "\n<br /><a href='{$item->DetailPageURL}' style='font-size: larger;'>" . htmlentities($item->ItemAttributes->Title). "</a> - <strong>{$item->ItemAttributes->ListPrice->FormattedPrice}</strong>";
				}

				$conn->htmlmessage($event['from'], $html, $event['type']);
			} else {
				$conn->message($event['from'], "Nada.", $event['type']);
			}
		} else {
			$conn->message($event['from'], "Usage: #amazon <search query>", $event['type']);
		}
	} catch(Exception $ex) {
		$conn->message($event['from'], "Amazon item lookup failed.", $event['type']);
	}
}
?>
