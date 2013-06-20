<?php
$commands['cat'] = function(&$conn, $event, $params) {
	try {
		if (!empty($params[0])) {
			$categories = array("hats","space","funny","sunglasses","boxes","caturday","ties","dream","kittens","sinks","clothes");
			if($params[0] == "gif") {
				$cat_xml = curl_get_contents("http://thecatapi.com/api/images/get?format=xml&type=gif");
				$cat = new SimpleXMLElement($cat_xml);
				$conn->message($event['from'], $cat->data->images->image->url, $event['type']);
			} elseif(in_array($params[0],$categories)) {
				$url = "http://thecatapi.com/api/images/get?format=xml&category=" . urlencode($params[0]);
				if(!empty($params[1]) && $params[1] == "gif")
					$url .= "&type=gif";
				$cat_xml = curl_get_contents($url);
				$cat = new SimpleXMLElement($cat_xml);
				if(!empty($cat->data->images)) {
					$conn->message($event['from'], $cat->data->images->image->url, $event['type']);
				} else {
					$conn->message($event['from'], "No kittehs here :(", $event['type']);
				}
			} else {
				$conn->message($event['from'], "Available categories: " . implode(" ",$categories), $event['type']);
			}
		} else {
			$cat_xml = curl_get_contents("http://thecatapi.com/api/images/get?format=xml");
			$cat = new SimpleXMLElement($cat_xml);
			$conn->message($event['from'], $cat->data->images->image->url, $event['type']);
		}
	} catch(Exception $ex) {
		echo $cat_xml;
		$conn->message($event['from'], "Failed to get a kitteh!", $event['type']);
	}
}
?>
