<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_model extends CI_Model {

	public function checkMonth ($month, $year, $type)
	{
		if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => $year, 'type' => $type))->num_rows() > 0)
		{
			return false;
		}else
		{
			return true;
		}
	}

	public function checkMonthCicilan ($month, $year)
	{
		if($this->db->get_where('monthly_limit_cicilan', array('month' => $month, 'year' => $year))->num_rows() > 0)
		{
			return false;
		}else
		{
			return true;
		}
	}

	public function insert ($month, $year, $type, $budget, $gold)
	{
		$data = array(

			'month'					=> $month,
			'year'					=> $year,
			'type'					=> $type,
			// 'gold_price'			=> $gold,
			'limit_transaction'		=> $budget

			);

		if($this->db->insert('monthly_limit', $data))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function insert_cicilan ($month, $year, $budget)
	{
		$data = array(

			'month'					=> $month,
			'year'					=> $year,
			'amount'				=> $budget

			);

		if($this->db->insert('monthly_limit_cicilan', $data))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function update ($month, $year, $type, $budget)
	{
		$data = array(

			'type'					=> $type,
			'limit_transaction'		=> $budget

			);

		$this->db->where(array('month' => $month, 'year' => $year, 'type' => $type));
		$this->db->set($data);

		if($this->db->update('monthly_limit'))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function update_cicilan ($month, $year, $budget)
	{
		$data = array(

			'amount'		=> $budget

			);

		$this->db->where(array('month' => $month, 'year' => $year));
		$this->db->set($data);

		if($this->db->update('monthly_limit_cicilan'))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function getMonthlyLimit ($type, $month)
	{
		if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->num_rows() > 0)
		{
			return $this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row();
		}else
		{
			return false;
		}
	}

	public function getMonthlyLimitCicilan ($month)
	{
		if($this->db->get_where('monthly_limit_cicilan', array('month' => $month, 'year' => date('Y')))->num_rows() > 0)
		{
			return $this->db->get_where('monthly_limit_cicilan', array('month' => $month, 'year' => date('Y')))->row();
		}else
		{
			return false;
		}
	}

	public function insert_transaction ($type, $amount, $spanning, $start, $gold_price, $gold_weight,$description,$jenis,$supplier)
	{
		$data = array(

			'month'					=> date('F'),
			'year'					=> date('Y'),
			'spanning_month'		=> $spanning,
			'type'					=> $type,
			'amount'				=> $amount,
			'start_payment'			=> $start,
			'gold_price' 			=> $gold_price,
			'weight'				=> $gold_weight,
			'description'			=> $description,
			'supplier_id'				=> $supplier,
			'diamond_type'			=> $jenis

			);

		if($this->db->insert('transactions', $data))
		{
			$transaction_id = $this->db->insert_id();

			// $start = explode('-', $start);
			// $start_month = $start[1];
			// $start_year = $start[0];
			// $installment_amount = $amount/$spanning;
			// for($i = 0; $i < $spanning ; $i++){
			// 	$date = date('Y-m-d',strtotime($start_year.'-'.$start_month.'-'.$start[2]));

			// 	$data_installment = array(
			// 			'transaction_id' => $transaction_id,
			// 			'due'			 => $date,
			// 			'amount'		 => $installment_amount
			// 		);
			// 	$this->db->insert('installments',$data_installment);
			// 	if ($start_month == 12) {
			// 		$start_year++;
			// 		$start_month = 1;
			// 	}else{
			// 		$start_month++;
			// 	}
				
			// }

			$trans  = $this->db->get_where('monthly_limit', array('month' => date('F'), 'year' => date('Y'), 'type' => $type))->row()->transaction_id;

			//Implode New Transaction
			$new_trans	= implode('#',array($trans, $transaction_id));

			//Insert into monthly limit for backup
			$data 	= array('transaction_id' => $new_trans);
			$where  = array(
				'type'	  => $type,
				'month'	  => date('F'),
				'year'	  => date('Y')
				);

			$this->db->where($where);
			if($this->db->update('monthly_limit', $data))
			{
				return true;
			}else
			{
				return false;
			}
		}else
		{
			return false;
		}
	}

	public function getTransMonth ($month,$year, $type)
	{
		$this->db->select('transactions.*,supplier.name');
		$this->db->from('transactions');
		$this->db->join('supplier','supplier.id = transactions.supplier_id','left');
		$this->db->where('month' , $month);
		$this->db->where('year', $year);
		$this->db->where('type', $type);
		return $this->db->get()->result();
	}

	public function getTransaction(){
		$this->db->select('transactions.*,supplier.name');
		$this->db->from('transactions');
		$this->db->join('supplier','supplier.id = transactions.supplier_id','left');
		$this->db->where('giro' , 0);
		return $this->db->get()->result();
	}
	public function getTransactionById($id){
		$this->db->select('transactions.*,supplier.name');
		$this->db->from('transactions');
		$this->db->join('supplier','supplier.id = transactions.supplier_id','left');
		$this->db->where('transactions.id' , $id);
		return $this->db->get()->row();
	}
	public function getTransaction1(){
		$this->db->select('transactions.*,supplier.name');
		$this->db->from('transactions');
		$this->db->join('supplier','supplier.id = transactions.supplier_id','left');
		
		return $this->db->get()->result();
	}


	public function getTotalTrans ($type, $month,$year)
	{
		if($type == 'gold'){
			$this->db->select_sum('weight');
			$row = 'weight';
		}elseif($type == 'diamond'){
			$this->db->select_sum('amount');
			$row = 'amount';
		}
		$this->db->from('transactions');
		$this->db->where(array('type' => $type,'month' => $month,'year' => $year));
		$result = $this->db->get()->row($row);

		return $result;
	}

	public function getTotalTransCicilan ($type, $month)
	{	
		$this->db->select('transactions.type,installments.*,transactions.amount AS total');
		if ($type == 'gold') {
			$this->db->select_sum('transactions.weight');
		}else{
			$this->db->select_sum('installments.amount');
		}
		
		$this->db->from('installments');
		$this->db->join('transactions','transactions.id = installments.transaction_id');
		$this->db->where("installments.due LIKE '$month%'");
		$this->db->where('transactions.type',$type);
		if ($type == 'gold') {
			$total = $this->db->get()->row('weight');
		}else{
			$total = $this->db->get()->row('amount');
		}
		
		
		if($total){
			return $total;
		}else{
			return false;
		}
	}

	public function getYearly ($type)
	{
		$apples = $this->db->get_where('monthly_limit', array('year' => date('Y'), 'type' => $type))->result();
		$potatos = array(0,0,0,0,0,0,0,0,0,0,0,0);

		foreach($apples as $apple)
		{
			switch($apple->month)
			{
				case 'january':
				{
					$potatos[0] = $apple->limit_transaction;
				}break;

				case 'february':
				{
					$potatos[1] = $apple->limit_transaction;
				}break;

				case 'march':
				{
					$potatos[2] = $apple->limit_transaction;
				}break;

				case 'april':
				{
					$potatos[3] = $apple->limit_transaction;
				}break;

				case 'may':
				{
					$potatos[4] = $apple->limit_transaction;
				}break;

				case 'june':
				{
					$potatos[5] = $apple->limit_transaction;
				}break;

				case 'july':
				{
					$potatos[6] = $apple->limit_transaction;
				}break;

				case 'august':
				{
					$potatos[7] = $apple->limit_transaction;
				}break;

				case 'september':
				{
					$potatos[8] = $apple->limit_transaction;
				}break;

				case 'october':
				{
					$potatos[9] = $apple->limit_transaction;
				}break;

				case 'november':
				{
					$potatos[10] = $apple->limit_transaction;
				}break;

				case 'desember':
				{
					$potatos[11] = $apple->limit_transaction;
				}break;

			}
		}

		$potatos = implode(',', $potatos);

		return $potatos;
	}

	public function send_email($email,$content)
	{
		$to = $email;
		$subject = "Promotion Email";
		$message = <<<EOD
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		
		<table style="width:100%; height:100%;">
			<tr>
				<td colspan="5" style="background:#34495e; padding:2em 1em 1em 1em;">
					<p align="center"><img src="http://ezpztest.gethassee.com/assets/logo.png" width="80"></p>
				</td>
			</tr>
			<tr>
			{$content}
			</tr>
			<tr>
				<td colspan="5" style="background:#34495e; color:#fff; height:20%; padding:1em 0 1em 0">
					<div class="row" style="padding: 10px; " >
					 
				      <center style="overflow:hidden"><div><img src="http://ezpztest.gethassee.com/images/logo.png" width="50" style="margin-right:1em;"></div>
				      <div style="vertical-align: middle;">&copy; Hassee 2016. All Rights Reserved under LRM Corporation</div>
				      </center>
				      </div>
				    
				</td>
			</tr>
		</table>
EOD;

		$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: ordering@ezpzdelivery.co.nz' . "\r\n" .
					'Reply-To: contact@ezpzdelivery.co.nz' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		
		if(!mail($to, $subject, $message, $headers))
		{
			return false;
		}else
		{
			return true;
		}
	}

}
