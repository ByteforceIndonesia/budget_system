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

		$this_month = date('F');

		$date = date('Y-m');

		$all_transaction = mysqli_query($connection,"SELECT SUM(amount) AS Total FROM transactions WHERE month = '$this_month'");

		$monthly_limit = mysqli_query($connection,"SELECT *
                        FROM monthly_limit WHERE month = '$this_month' ");

		$transactions = mysqli_query($connection, "SELECT installments.*,transactions.description,transactions.created,transactions.spanning_month, transactions.amount AS total_amount FROM installments INNER JOIN transactions
			ON installments.transaction_id=transactions.id WHERE installments.due LIKE '%'");
		echo"<pre>";

		while($month = mysqli_fetch_array($transactions,MYSQLI_ASSOC)){

			print_r($month);

			echo date('Y-m-d',strtotime($month['due'] ." + 1 day")) ;
		};

		while($row = mysqli_fetch_array($all_transaction,MYSQLI_ASSOC)){
			print_r($row);
		}

		echo "</pre>";

		// $total_transactions = mysql_query("SELECT SUM(weight)".
		// 				"FROM transactions".
		// 				"WHERE month = date('F') AND type = 'gold' ");

		
	
	}

}