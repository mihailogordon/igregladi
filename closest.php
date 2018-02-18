<?php

function distance($lat1, $lon1, $lat2, $lon2) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $kilometers = $dist * 60 * 1.1515 * 1.609344;
  
  return $kilometers;

}

$lat1 = $_POST['latitude'];
$lon1 = $_POST['longitude'];
$price = $_POST['price'];
$food = $_POST['food'];
$_POST['radius'] != "" ? $lowest_distance = $_POST['radius'] : $lowest_distance = 20039;
$lowest_name = "";

$connection = mysqli_connect('127.0.0.1', 'root', '');

if(!$connection){
	echo "There were an error connecting to the server!";
}

mysqli_select_db($connection,'igregladi');

$closest_query = "SELECT * FROM Restorani";

$closest_result = mysqli_query($connection, $closest_query);

$results = array();

if(!$closest_result || mysqli_num_rows($closest_result) == 0){
	echo "Nema nijednog restorana u bazi.";
}
else{
	foreach($closest_result as $data){
		$lat2 = $data['Latitude'];
		$lon2 = $data['Longitude'];
		$distance1 = distance($lat1, $lon1, $lat2, $lon2);
		if(intval($distance1) < intval($lowest_distance)){
			$results[$data['ID']] = $data['Ime'];
		}
	}
}

$i = 0;
$output = "<p class='result_message results'>Sledeci restorani sa sledecim jelima zadovoljava unete kriterijume:</p>";

if(count($results) > 0){
	foreach ($results as $key => $value) {

		/*echo $value . ": <br><br>";*/

		$query = "SELECT * FROM `$value`";

		if($price!=''){
			$query .= " WHERE Cena<=$price";

			if($food!=''){
				$query .= " AND Jelo LIKE '%$food%'";
			}
		}

		else if($food!=''){
			$query .=" WHERE Jelo LIKE '%$food%'";
		}

		$query_result = mysqli_query($connection, $query);

		if($query_result && mysqli_num_rows($query_result) != 0){
			$output .= "<div class='restaurant'>" . $value . "</div>";
			$output .= "<div class='restaurant_item_list'>";
			foreach($query_result as $data){
				$output .= "<div class='restaurant_item";
				if($data['Akcija'] == 1){
					$output .= " on_action";
				}
				$output .= "'> <div class='restaurant_item_name'>" . $data['Jelo'] . ":</div><div class='restaurant_item_price'>" . $data['Cena'] . "din</div></div>"; 
			}
			$output .= '</div>';
			$i++;
		}
	}
}

if($i == 0){
	echo "<p class='result_message no_results'>Nema restorana koji zadovoljava uneti kriterijum.</p>";
}

else{
	echo $output;
}