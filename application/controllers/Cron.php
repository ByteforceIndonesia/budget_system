<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function monthly_limit_reminder(){

	

		$servername = "localhost";
	  $username = "root";
	  $password = "";
	  $dbname = "jewelery";

	  $connection = mysqli_connect(
	                $servername,
	                $username,
	                $password,
	                $dbname
	                );

	    if(!$connection){
	    die("connection failed : ".mysqli_conect_error());
	  }


		
	
		

	

		

	

	

}