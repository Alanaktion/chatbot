<?php
$commands['everybody'] = function(&$conn, $pl, $params) {
    if(!empty($params[0]) && intval($params[0])) {
        if($params[0] > 20) {
            $conn->message($pl['from'], "Uh... no.", $pl['type']);
        } else {
            $conn->message($pl['from'], trim(str_repeat("everybody, ", $params[0]), ", "), $pl['type']);
        }
    } else {
        $conn->message($pl['from'], "Usage: #everybody <count>", $pl['type']);
    }
}
?>
