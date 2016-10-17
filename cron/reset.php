<?php 

	include_once("../application/libraries/config.php");
	date_default_timezone_set("Asia/Jakarta");



	$config = mysqli_query($connection, "SELECT * FROM configuration");
	$config = mysqli_fetch_array($config,MYSQLI_ASSOC);

	if(date('H') == date('H',strtotime('00:00')) ){
		mysqli_query($connection,"UPDATE configuration SET emas_lm = 0, emas_24 = 0, dollar = 0 WHERE id = 1");
	}

?>