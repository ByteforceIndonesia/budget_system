<?php 

		include_once("../application/libraries/config.php");

		date_default_timezone_set("Asia/Jakarta");

		$this_month = date('F');

		$date = date('Y-m');

		$config = mysqli_query($connection, "SELECT * FROM configuration");
		$config = mysqli_fetch_array($config,MYSQLI_ASSOC);

		$user = mysqli_query($connection, "SELECT * FROM users");
		$user = mysqli_fetch_array($user,MYSQLI_ASSOC);

		$transactions = mysqli_query($connection, "SELECT installments.*,transactions.description,transactions.weight,transactions.created,transactions.spanning_month,transactions.gold_price,transactions.type, transactions.amount AS total_amount FROM installments INNER JOIN transactions
			ON installments.transaction_id=transactions.id");
	

		$data = array();
		$data_prabayar = array();
		while($month = mysqli_fetch_array($transactions,MYSQLI_ASSOC)){

			if(date('Y-m-d',strtotime("+ 1 day")) == date('Y-m-d',strtotime($month['due'])) ){
				if(date('H:i') == date('H:i',strtotime($config['day-1']))){
					//email reminder
					array_push($data_prabayar,$month);
				}
			}
			elseif(date('Y-m-d') == date('Y-m-d',strtotime($month['due'])) ){
				if(date('H:i') == date('H:i',strtotime($config['day']))){
					//email reminder
					array_push($data,$month);
					
				}
			}
			
		};

		

		if(count($data) > 0){
			$total_diamond = 0;
			$total_gold =0;
			$subject = "Reminder Pembayaran Hari Ini";
			$content = '<tr><td colspan="5"><h4>Detail Pembayaran untuk tanggal '.date('d-M-Y').'</h4></td></tr>';

			foreach($data as $row){
				$content .= '<tr style="border: 1px solid black;">';
				$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Pembelian Tanggal '.'</th>';
				$content .= '<td colspan="2">'.date('d-m-Y',strtotime($row['created'])).'</td>';
				$content .= '</tr><tr style="border-bottom: 1px solid black">';
				$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Keterangan '.'</th>';
				$content .= '<td  colspan="2">'.$row['description'].'</td>';
				$content .= '</tr><tr>';
				if($row['type'] == 'diamond'){

					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Jumlah yang harus dibayar bulan ini '.'</th>';
					$content .= '<td  colspan="2">$ '.number_format($row['amount'],2).'</td>';
					$total_diamond +=$row['amount'];
				}else{

					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Jumlah Emas(gr) '.'</th>';
					$content .= '<td  colspan="2">'.$row['weight'].'gr</td>';

					$content .= '</tr><tr>';
					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Harga Emas / gr '.'</th>';
					$content .= '<td  colspan="2">Rp. '.number_format($row['gold_price'],2,',','.').' / gr</td>';
					$content .= '</tr><tr>';
					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Jumlah yang harus dibayar bulan ini '.'</th>';
					$content .= '<td  colspan="2">Rp. '.number_format($row['amount'],2,',','.').'</td>';
					
					$total_gold +=$row['amount'];
				}
				$content .= '</tr><tr><td colspan="5"><hr></td></tr>';
			
			}
			$content .= '<tr>';
			$content .= '<th colspan="5"><h3>Total Pembayaran Hari ini </h3></th>';
			$content .= '</tr><tr>';
			$content .= '<th colspan="3" style="text-align:left">Diamond</th>';
			$content .= '<td  colspan="2">$ '.number_format($total_diamond,2).'</td>';
			$content .= '</tr><tr>';
			$content .= '<th colspan="3" style="text-align:left">Emas</th>';
			$content .= '<td  colspan="2">Rp. '.number_format($total_gold,2,',','.').'</td>';
			$content .= '</tr>';


			$to = $user['email'];
		
			
			
			$message = <<<EOD
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			
			<table class="table" style="width:100%; height:100%;">
				<tr>
					<td colspan="5" style="background:#34495e;color:white; padding:2em 1em 1em 1em;">
						<p align="center"><img src ="http://grandsaerah.gethassee.com/img/logo.png" width="200"></p>
					</td>
				</tr>
				
				{$content}
				
				
			</table>
EOD;

			$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: Grand Saerah Reminder <reminder@gethassee.com> '. "\r\n" .
						'Reply-To: office@gethassee.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			// $total_transactions = mysql_query("SELECT SUM(weight)".
			// 				"FROM transactions".
			// 				"WHERE month = date('F') AND type = 'gold' ");

			mail($to, $subject, $message, $headers);
			
		}
			

		if(count($data_prabayar) > 0){
			$subject = "Reminder Pembayaran untuk Tanggal ".date('d-M-Y',strtotime("+ 1 day"));
			$total_diamond = 0;
			$total_gold =0;
			$content = '<tr><td colspan="5"><h4>Detail Pembayaran untuk tanggal '.date('d-M-Y',strtotime("+ 1 day")).'</h4></td></tr>';

			foreach($data_prabayar as $row){
				$content .= '<tr style="border: 1px solid black;">';
				$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Pembelian Tanggal '.'</th>';
				$content .= '<td colspan="2">'.date('d-m-Y',strtotime($row['created'])).'</td>';
				$content .= '</tr><tr style="border-bottom: 1px solid black">';
				$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Keterangan '.'</th>';
				$content .= '<td  colspan="2">'.$row['description'].'</td>';
				$content .= '</tr><tr>';
				if($row['type'] == 'diamond'){

					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Jumlah yang harus dibayar bulan ini '.'</th>';
					$content .= '<td  colspan="2">$ '.number_format($row['amount'],2).'</td>';
					$total_diamond +=$row['amount'];
				}else{

					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Jumlah Emas(gr) '.'</th>';
					$content .= '<td  colspan="2">'.$row['weight'].'gr</td>';

					$content .= '</tr><tr>';
					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Harga Emas / gr '.'</th>';
					$content .= '<td  colspan="2">Rp. '.number_format($row['gold_price'],2,',','.').' / gr</td>';
					$content .= '</tr><tr>';
					$content .= '<th colspan="3" style="width: 60%; text-align:left">'.'Jumlah yang harus dibayar bulan ini '.'</th>';
					$content .= '<td  colspan="2">Rp. '.number_format($row['amount'],2,',','.').'</td>';
					
					$total_gold +=$row['amount'];
				}
				$content .= '</tr><tr><td colspan="5"><hr></td></tr>';
			
			}
			$content .= '<tr>';
			$content .= '<th colspan="5"><h3>Total Pembayaran Tanggal '.date('d-M-Y',strtotime("+ 1 day")).' </h3></th>';
			$content .= '</tr><tr>';
			$content .= '<th colspan="3" style="text-align:left">Diamond</th>';
			$content .= '<td  colspan="2">$ '.number_format($total_diamond,2).'</td>';
			$content .= '</tr><tr>';
			$content .= '<th colspan="3" style="text-align:left">Emas</th>';
			$content .= '<td  colspan="2">Rp. '.number_format($total_gold,2,',','.').'</td>';
			$content .= '</tr>';


			$to = $user['email'];
		
			
			$message = <<<EOD
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			
			<table class="table" style="width:100%; height:100%;">
				<tr>
					<td colspan="5" style="background:#34495e;color:white; padding:2em 1em 1em 1em;">
						<p align="center"><img src ="http://grandsaerah.gethassee.com/img/logo.png" width="200"></p>
					</td>
				</tr>
				
				{$content}
				
				
			</table>
EOD;

			$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: Grand Saerah Reminder <reminder@gethassee.com>' . "\r\n" .
						'Reply-To: office@gethassee.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			// $total_transactions = mysql_query("SELECT SUM(weight)".
			// 				"FROM transactions".
			// 				"WHERE month = date('F') AND type = 'gold' ");

			mail($to, $subject, $message, $headers);
		}

 ?>