<?php
$commands['nutrition'] = function(&$conn, $event, $params) {
	if(!empty($params[0])) {
		$search = strtolower(implode(" ", $params));
		if($search == "pizza") {
			$conn->message($event['from'], "Bad", $event['type']);
			return;
		}
		$result =file_get_contents("https://api.nutritionix.com/v1_1/search/" . urlencode($search) . "?results=0:1&fields=item_name,brand_name,nf_calories,nf_total_fat,nf_trans_fatty_acid,nf_cholestorol,nf_sodium,nf_total_carbohydrate,nf_dietary_fiber,nf_sugars,nf_protein,nf_vitamin_a_dv,nf_vitamin_c_dv,nf_calcium_dv,nf_iron_dv,nf_serving_size_unit,nf_serving_size_qty,nf_serving_weight_grams&appId=39f195bb&appKey=580ad3c3d167b790a9bc80e4a9f0b299");
		$result = json_decode($result);
		if(!empty($result->hits[0])) {
			$name = $result->hits[0]->fields->item_name;
			$brand = $result->hits[0]->fields->brand_name;

			$serving_size = $result->hits[0]->fields->nf_serving_size_qty . " " . $result->hits[0]->fields->nf_serving_size_unit;
			$protein = $result->hits[0]->fields->nf_protein;
			$fat = $result->hits[0]->fields->nf_total_fat;
			$calories = $result->hits[0]->fields->nf_calories;
			$tran = $result->hits[0]->fields->nf_trans_fatty_acid;
			$cholestorol = $result->hits[0]->fields->nf_cholestorol;
			$carbs = $result->hits[0]->fields->nf_total_carbohydrate;
			$fiber = $result->hits[0]->fields->nf_dietary_fiber;
			$sugars = $result->hits[0]->fields->nf_sugars;
			$sodium = $result->hits[0]->fields->nf_sodium;
			$vit_a = $result->hits[0]->fields->nf_vitamin_a_dv;
			$vit_c = $result->hits[0]->fields->nf_vitamin_c_dv;
			$calcium = $result->hits[0]->fields->nf_calcium_dv;
			$iron = $result->hits[0]->fields->nf_iron_dv;

			$html_text = "<br /><b>Name: </b>{$name}<br />";
			$html_text .= "<b>Brand: </b>{$brand}<br />";
			$html_text .= "<b>Serving Size: </b>{$serving_size}<br />";
			if(!empty($calories)){
				$html_text .= " <b>Calories: </b>{$calories}<br />";
			}
			if(!empty($protein)){
				$html_text .= " <b>Protein: </b>{$protein}g<br />";
			}
			if(!empty($fat)){
				$html_text .= "<b>Fat: </b>{$fat}g<br />";
			}
			if(!empty($tran)){
				$html_text .= "<b>Trans Fat:</b> {$tran}g<br />";
			}
			if(!empty($cholestorol)){
				$html_text .= "<b>Cholestorol:</b> {$cholestorol}g<br />";
			}
			if(!empty($carbs)){
				$html_text .= "<b>Carbs:</b> {$carbs}g<br />";
			}
			if(!empty($fiber)){
				$html_text .= " <b>Fiber: </b>{$fiber}g<br />";
			}
			if(!empty($sugars)){
				$html_text .= "<b>Sugars:</b> {$sugars}g<br />";
			}
			if(!empty($sodium)){
				$html_text .= "<b>Sodium:</b> {$sodium}g<br />";
			}
			if(!empty($vit_a)){
				$html_text .= "<b>Vitamin A:</b> {$vit_a}% daily value<br />";
			}
			if(!empty($vit_c)){
				$html_text .= "<b>Vitamin C:</b> {$vit_c}% daily value<br />";
			}
			if(!empty($calcium)){
				$html_text .= "<b>Calcium:</b> {$calcium}% daily value<br />";
			}
			if(!empty($iron)){
				$html_text .= "<b>Iron:</b> {$vit_a}% daily value<br />";
			}

			$conn->htmlmessage($event['from'], $html_text, $event['type']);
		} else {
			$conn->message($event['from'], "No nutritional data found.", $event['type']);
		}
	} else {
		$conn->message($event['from'], "Usage: #nutrition <food>", $event['type']);
	}
}
?>