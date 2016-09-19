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

	public function insert ($month, $year, $type, $budget)
	{
		$data = array(

			'month'					=> $month,
			'year'					=> $year,
			'type'					=> $type,
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

	public function insert_transaction ($type, $amount, $spanning, $start)
	{
		$data = array(

			'month'					=> date('F'),
			'year'					=> date('Y'),
			'spanning_month'		=> $spanning,
			'type'					=> $type,
			'amount'				=> $amount,
			'start_payment'			=> $start

			);

		if($this->db->insert('transactions', $data))
		{
			$id 	= $this->db->query("SELECT id FROM transactions WHERE (created >= NOW() - INTERVAL 10 MINUTE AND amount = $amount AND type = '".$type."') ORDER BY id Desc")->row()->id;
			$trans  = $this->db->get_where('monthly_limit', array('month' => date('F'), 'year' => date('Y'), 'type' => $type))->row()->transaction_id;

			//Implode New Transaction
			$new_trans	= implode('#',array($trans, $id));

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
