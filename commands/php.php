<?php
include_once dirname(__FILE__) . '/../lib/phpQuery-onefile.php';
$commands['php'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$html = file_get_contents("http://www.php.net/manual/en/function." . str_replace("_", "-", $params[0]) . ".php");
		$doc = phpQuery::newDocumentHtml($html);

		// Function type/name/params
		$msg = "<span style='color: #693;'>" . $doc['.methodsynopsis > .type']->text() . "</span> ";
		$function_name = $doc['.methodsynopsis .methodname']->text();
		$msg .= "<a href='http://php.net/" . str_replace("_", "-", $function_name) . "'>{$function_name}</a> ";
		$msg .= "<span style='color: #737373;'>( ";
		foreach($doc['.methodsynopsis .methodparam'] as $i=>$param) {
			$p = pq($param);
			$optional = !!$p->find(".initializer")->text();

			if($i) {
				if($optional) {
					$msg .= " [, ";
				} else {
					$msg .= " , ";
				}
			} elseif($optional) {
				$msg .= "[";
			}

			$msg .= htmlspecialchars($p->text());

			if($optional) {
				$msg .= " ]";
			}
		}
		$msg .= " )</span>";

		// Add description
		foreach($doc['.refsect1.description .para'] as $para) {
			$msg .= "<br />\n" . htmlspecialchars(trim(preg_replace("/\s+/", " ", pq($para)->text())));
		}

		echo $msg;

		$conn->htmlmessage($event['from'], $msg, $event['type']);
	} else {
		$conn->message($event['from'], "Usage: #php <function name>", $event['type']);
	}

}
?>
