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

	public function insert_transaction ($type, $amount, $spanning, $start, $gold_price, $gold_weight)
	{
		$data = array(

			'month'					=> date('F'),
			'year'					=> date('Y'),
			'spanning_month'		=> $spanning,
			'type'					=> $type,
			'amount'				=> $amount,
			'start_payment'			=> $start,
			'gold_price' 			=> $gold_price,
			'weight'				=> $gold_weight

			);

		if($this->db->insert('transactions', $data))
		{
			$transaction_id = $this->db->insert_id();

			$start = explode('-', $start);
			$start_month = $start[1];
			$start_year = $start[0];
			$installment_amount = $amount/$spanning;
			for($i = 0; $i < $spanning ; $i++){
				$date = date('Y-m-d',strtotime($start_year.'-'.$start_month.'-'.$start[2]));

				$data_installment = array(
						'transaction_id' => $transaction_id,
						'due'			 => $date,
						'amount'		 => $installment_amount
					);
				$this->db->insert('installments',$data_installment);
				if ($start_month == 12) {
					$start_year++;
					$start_month = 1;
				}else{
					$start_month++;
				}
				
			}

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

	public function getTransMonth ($month, $type)
	{
		if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row()->transaction_id !=  NULL)
		{
			$transactions = $this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row()->transaction_id;
			$transactions = explode('#', $transactions);
			$count = 0;

			$transaction_all = array();

			foreach($transactions as $transaction)
			{	
				if($count == 0)
				{
					$count++;
					continue;
				}

				$one = $this->db->get_where('transactions', array('id' => $transaction))->row_array();

				array_push($transaction_all, $one);

				$count++;
			}

			return $transaction_all;

		}else
		{
			return false;
		}
	}

	public function getTotalTrans ($type, $month)
	{
		if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->num_rows() > 0)
		{
			if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row()->transaction_id != NULL)
			{
				$all = explode('#', $this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row()->transaction_id);
				$total = 0;
				$count = 0;
				
				foreach($all as $transaction)
				{	
					if($count == 0)
					{
						$count++;
						continue;
					}

					$total += $this->db->get_where('transactions', array('id' => $transaction))->row()->amount;
					$count++;
				}

				return $total;
			}else
			{
				return false;
			}
		}else
		{
			return false;
		}
	}

	public function getTotalTransCicilan ($type, $month)
	{
		if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->num_rows() > 0)
		{
			if($this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row()->transaction_id != NULL)
			{
				$all = explode('#', $this->db->get_where('monthly_limit', array('month' => $month, 'year' => date('Y'), 'type' => $type))->row()->transaction_id);
				$total = 0;
				$count = 0;
				
				foreach($all as $transaction)
				{	
					if($count == 0)
					{
						$count++;
						continue;
					}

					$data = $this->db->get_where('transactions', array('id' => $transaction))->row();

					$total +=  $data->amount/$data->spanning_month;
					$count++;
				}

				return $total;
			}else
			{
				return false;
			}
		}else
		{
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
}
