<?php 
	$servername = "localhost";
	  $username = "gethasse_saerah";
	  $password = "Mhbl2016";
	  $dbname = "gethasse_grandsaerah";

	  $connection = mysqli_connect(
	                $servername,
	                $username,
	                $password,
	                $dbname
	                );

	    if(!$connection){
	    die("connection failed : ".mysqli_conect_error());
	  }

	  
 ?>