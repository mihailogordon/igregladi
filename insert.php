<?php

$connection = mysqli_connect('127.0.0.1', 'root', '');

if(!$connection){
	echo "There were an error connecting to the server!";
}

mysqli_select_db($connection,'igregladi');

$username = $_POST['username'];
$password = $_POST['password'];
$input_content = $_POST['input_content'];

$search_query = "SELECT * FROM jela WHERE Ime = '$username' AND Sifra = '$password'";

$search_result = mysqli_query($connection,$search_query);

if(!$search_result || mysqli_num_rows($search_result) == 0){

	$input_query = "INSERT INTO jela (Ime, Sifra, Predlozi) VALUES ('$username','$password','$input_content')";

	$input_result = mysqli_query($connection,$input_query);

	if($input_result){
		echo "Uspesno zabelezen predlog";
	}
}

else{
	$input_query = "UPDATE jela SET Predlozi = '$input_content' WHERE Ime = '$username' AND Sifra = '$password'";

	$input_result = mysqli_query($connection,$input_query);

	if($input_result){
		echo "Uspesno ste promenili svoje predloge!";
	}
}

?>