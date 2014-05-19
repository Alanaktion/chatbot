<?php
$commands['nutrition'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$params[0] = strtolower($params[0]);
		if($params[0] == "pizza") {
			$conn->message($event['from'], "Bad", $event['type']);
			return;
		}
		$result =file_get_contents("https://api.nutritionix.com/v1_1/search/" . urlencode($params[0]) . "?results=0:1&fields=item_name,brand_name,nf_calories,nf_total_fat,nf_cholestorol,nf_sodium_nf_total_carbohydrate,nf_dietary_fiber,nf_sugars,nf_protein,nf_vitamin_a,nf_vitamin_c,nf_calcium,nf_iron&appId=39f195bb&appKey=580ad3c3d167b790a9bc80e4a9f0b299");
		$result = json_decode($result);
		if(!empty($result->hits[0])) {
			$name = $result->hits[0]->fields->item_name;
			$brand = $result->hits[0]->fields->brand_name;
			$calories = $result->hits[0]->fields->nf_calories;
			$fat = $result->hits[0]->fields->nf_total_fat;
			$fiber = $result->hits[0]->fields->nf_dietary_fiber;
			$sugars = $result->hits[0]->fields->nf_sugars;
			$protein = $result->hits[0]->fields->nf_protein;

			$html_text = "<br /><b>Name: </b>{$name} <br /> <b>Brand: </b>{$brand} <br /> <b>Calories: </b>{$calories} <br /> <b>Protein: </b>{$protein}g<br /> <b>Fat: </b>{$fat}g <br /> <b>Fiber: </b>{$fiber}g <br /> <b>Sugars:</b> {$sugars}g <br /> ";

			$conn->htmlmessage($event['from'], $html_text, $event['type']);
		} else {
			$conn->message($event['from'], "No nutritional data found.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #nutrition <food>", $event['type']);
	}
}
?>
