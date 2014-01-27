<?php
$commands['quote'] = function(&$conn, $event, $params) {
    $response = curl_get_contents("http://www.iheartquotes.com/api/v1/random?max_lines=1&show_source=false&show_permalink=false";
    $conn->message($event['from'], trim($response), $event['type']);
}
?>
