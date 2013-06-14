<?php
$commands['cat'] = function(&$conn, $event, $params) {
	if ($params[0] == "gif")
		$cat_xml = curl_get_contents("http://thecatapi.com/api/images/get?format=xml&type=gif");
	else
		$cat_xml = curl_get_contents("http://thecatapi.com/api/images/get?format=xml");
	$cat = new SimpleXMLElement($cat_xml);
	$conn->message($event['from'], $cat->data->images->image->url, $event['type']);
}
?>
