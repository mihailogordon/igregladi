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

$connection = mysqli_connect('127.0.0.1', 'root', '');

if(!$connection){
	echo "There were an error connecting to the server!";
}

mysqli_select_db($connection,'igregladi');

$restaurant = $_POST["restaurant"];

$query1 = "SELECT * FROM `$restaurant`";

$query2 = "SELECT * FROM `restorani` WHERE `Ime` = '$restaurant'";

$result1 = mysqli_query($connection,$query1);

$result2 = mysqli_query($connection,$query2);

$distance1 = 0;

if(!$result2 || mysqli_num_rows($result2) == 0){
	echo "Izabrani restoran jos uvek nema jela na jelovniku.";
}
else{
	foreach($result2 as $data){
		$lat2 = $data['Latitude'];
		$lon2 = $data['Longitude'];
		$distance1 = round(distance($lat1, $lon1, $lat2, $lon2),2);	
	}
}

if(!$result1 || mysqli_num_rows($result1) == 0){
	echo "Izabrani restoran jos uvek nema jela na jelovniku.";
}
else{
	$output = "<div class='restaurant'> $restaurant </div> <div class='restaurant_distance'> Udaljen ";
	if($distance1<1.5){
		$output .=  $distance1*1000 . " metara od Vase trenutne lokacije";
	}

	else{
		$output .=  $distance1 . " kilometara od Vase trenutne lokacije";
	}

	$output .= "</div>";
	$output .= "<div class='restaurant_item_list'>";
	foreach($result1 as $data){
		$output .= "<div class='restaurant_item";
			if($data['Akcija'] == 1){
				$output .= " on_action";
			}
			$output .= "'> <div class='restaurant_item_name'>" . $data['Jelo'] . ":</div><div class='restaurant_item_price'>" . $data['Cena'] . "din</div></div>";
	}
	$output .= "</div>";

	echo $output;
}