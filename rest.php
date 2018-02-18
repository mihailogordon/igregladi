<?php

$connection = mysqli_connect('127.0.0.1', 'root', '');

if(!$connection){
	echo "There were an error connecting to the server!";
}

mysqli_select_db($connection,'igregladi');

$query = "SHOW TABLES FROM igregladi";
$result = mysqli_query($connection,$query);

$restaurants = "";

if(!$result || mysqli_num_rows($result) == 0){
	echo "Nema nijednog registrovanog restorana trenutno.";
}
else{
	while ($row = mysqli_fetch_row($result)) {
	    if($row[0] != 'restorani' && $row[0] != 'jela'){
    		$restaurants .= $row[0] . ";";
    	}
	}
	echo $restaurants;
}