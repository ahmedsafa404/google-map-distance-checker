<?php
$user_location = readline("Enter Your Address : ");
$target_location = readline("Enter Target Location : ");

$api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=.$user_location.&destinations=.$target_location.&key={YOUR GOOGLE MAPS API KEY here}");
$callback = json_decode($api);

if($callback->status == "REQUEST_DENIED"){
	throw new Exception("The provided API key is invalid.", 1);
}

if($callback->rows[0]->elements[0]->status == "ZERO_RESULTS"){
	throw new Exception("Not Found", 1);
	
}



try{
	
	
	echo "\n\n";

	echo "\033[1mDistance from\e[0m : ". "\033[42m".$callback->origin_addresses[0] ."\e[0m". " to " . "\033[43m".$callback->destination_addresses[0] ."\e[0m". " is " . "\033[1m" .$callback->rows[0]->elements[0]->distance->text."\e[0m";
	echo "\n\n";
	echo "\033[1mDuration\e[0m : " . "\033[36m" .$callback->rows[0]->elements[0]->duration->text."\e[0m";
	echo "\n\n";

}catch(Exception $e){
	echo 'Error : '.$e->getMessage();
}

