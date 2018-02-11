<?php

$connection = mysqli_connect('127.0.0.1', 'root', '');

if(!$connection){
	echo "There were an error connecting to the server!";
}

mysqli_select_db($connection,'igregladi');

$username = $_POST['username'];
$password = $_POST['password'];

$load_query = "SELECT Predlozi FROM jela WHERE Ime = '$username' AND Sifra = '$password'";

$load_result = mysqli_query($connection, $load_query);

if(!$load_result || mysqli_num_rows($load_result) == 0){
	echo "Nema registrovanog korinika sa unetim imenom i sifrom. Molimo vas prvo registrujte korisnika ili proverite unos.";
}
else{
	foreach($load_result as $data){
		$result_string = $data["Predlozi"];
		$result_array = explode(',',$result_string);
		foreach ($result_array as $key => $value) {
			echo '<p class="input_item"> <a class="remove_item" href="#"><i class="fa fa-times-circle"></i></a><span class="input_item_value">'. trim($value) .'</p>';
		}
	}
}

?>