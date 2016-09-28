<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_budget extends CI_Controller {

	function __construct ()
	{
		parent::__construct();

		if($this->session->userdata('user_id') == NULL)
		{
			redirect('accounts');
		}
	}

	public function monthly()
	{
		if($this->input->post())
		{
			
			//Put Post Variables
			$month 		= $this->input->post('month');
			$year 		= $this->input->post('year');
			$type 		= $this->input->post('type');
			$gold 		= (!$this->input->post('gold'))? 0 : $this->input->post('gold');
			$budget 	= $this->input->post('amount');


			//Check if the budget has already been created
			if(!$this->budget_model->checkMonth($month, $year, $type))
			{
				$_POST = array();
				redirect("new_budget/edit/$month/$year/$type/$budget/$gold");
			}else
			{
				$this->budget_model->insert($month, $year, $type, $budget, $gold);
				$this->session->set_flashdata('success', 'New ' . $type . ' Budget For ' . $month . ' ' . $year . ' Have Been Created!');
				redirect('main');
			}
		}else
		{
			$data['title'] = "New Monthly Budget";
			$this->template->load('default', 'new/new_budget', $data);
		}
	}

	public function monthly_cicilan()
	{
		if($this->input->post())
		{
			
			//Put Post Variables
			$month 		= $this->input->post('month');
			$year 		= $this->input->post('year');
			$budget 	= $this->input->post('amount');


			//Check if the budget has already been created
			if(!$this->budget_model->checkMonthCicilan($month, $year))
			{
				$_POST = array();
				redirect("new_budget/edit_cicilan/$month/$year/$budget");
			}else
			{
				$this->budget_model->insert_cicilan($month, $year, $budget);
				$this->session->set_flashdata('success', 'New ' . $type . ' Budget Cicilan For ' . $month . ' ' . $year . ' Have Been Created!');
				redirect('main');
			}
		}else
		{
			$data['title'] = "New Monthly Credit Budget";
			$this->template->load('default', 'new/new_cicilan', $data);
		}
	}

	public function edit($month = '', $year = '', $type = '', $budget = '', $gold = '')
	{
		if($this->input->post())
		{
			//Put Post Variables
			$month 		= $this->input->post('month');
			$year 		= $this->input->post('year');
			$type 		= $this->input->post('type');
			$gold 		= $this->input->post('gold');
			$budget 	= $this->input->post('amount');
			$trans_gold	= $this->budget_model->getTotalTrans($type, $month);

			if($budget >= $trans_gold)
			{
				if($this->budget_model->update($month, $year, $type, $budget, $gold)){
					$this->session->set_flashdata('success', 'Edit ' . $type . ' Budget For ' . $month . ' ' . $year . ' Have Been Succeded!');
					redirect('main');
				}
			}else
			{
				$this->session->set_flashdata('failed', 'Edit ' . $type . ' Budget For ' . $month . ' ' . $year . ' Have Been Failed!');
				redirect('new_budget/monthly');
			}
		}else
		{
			$data['title'] 	 = "Edit Monthly Budget";

			$data['type']    = $type;
			$data['month']   = $month;
			$data['gold']	 = $gold;
			$data['year']    = $year;
			$data['amount']  = $budget;

			$this->template->load('default', 'new/edit_budget', $data);
		}
	}

	public function edit_cicilan($month = '', $year = '', $budget = '')
	{
		if($this->input->post())
		{
			//Put Post Variables
			$month 		= $this->input->post('month');
			$year 		= $this->input->post('year');
			$budget 	= $this->input->post('amount');

			if($this->budget_model->update_cicilan($month, $year, $budget))
			{
				$this->session->set_flashdata('success', 'Edit ' . $type . ' Budget For ' . $month . ' ' . $year . ' Have Been Succeded!');
				redirect('main');
			}else
			{
				$this->session->set_flashdata('failed', 'Edit ' . $type . ' Budget For ' . $month . ' ' . $year . ' Have Been Failed!');
				redirect('new_budget/monthly');
			}
		}else
		{
			$data['title'] 	 = "Edit Monthly Budget";

			$data['month']   = $month;
			$data['year']    = $year;
			$data['amount']  = $budget;

			$this->template->load('default', 'new/edit_cicilan', $data);
		}
	}

	public function transaction ()
	{
		if($this->input->post())
		{
			//Put Post Variables
			$type 		= $this->input->post('type');
			$amount 	= $this->input->post('amount');
			$spanning 	= $this->input->post('spanning');
			$start	 	= $this->input->post('start_payment');
			$gold_price = (!$this->input->post('gold'))? 0 : $this->input->post('gold');
			// $totalGold	= $gold_price * $amount;
			$gold_weight = $this->input->post('weight');

			$gold		= $this->budget_model->getMonthlyLimit('gold', date('F'))->limit_transaction;
			$diamond	= $this->budget_model->getMonthlyLimit('diamond', date('F'))->limit_transaction;

			if(!$limit_cicilan = $this->budget_model->getMonthlyLimitCicilan(date('F'))->amount)
			{
				$this->session->set_flashdata('failed', "Please set this month's credit limit!");
				redirect('main');
			}

			$trans_gold		= $this->budget_model->getTotalTrans('gold', date('F'));
			$trans_diamond	= $this->budget_model->getTotalTrans('diamond', date('F'));

			$cicilan 		= $this->budget_model->getTotalTransCicilan('gold', date('F'));
			$cicilan 		+= $this->budget_model->getTotalTransCicilan('diamond', date('F'));

			switch($type)
			{
				case 'gold':
				{
					if($amount+$trans_gold > $gold)
					{
						$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ', You Have Execced Your Monthly Limit!');
						redirect('main');
					}else if(($totalGold/$spanning)+$cicilan > $limit_cicilan)
					{
						$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ', You Have Execced Your Monthly Credit Limit!');
						redirect('main');
					}
				}break;

				case 'diamond':
				{
					
					if($amount+$trans_diamond > $diamond)
					{
						$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ', You Have Execced Your Monthly Limit!');
						redirect('main');
					}else if(($amount/$spanning)+$cicilan > $limit_cicilan)
					{
						$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ', You Have Execced Your Monthly Credit Limit!');
						redirect('main');
					}
				}break;
			}

			if($this->budget_model->insert_transaction($type, $amount, $spanning, $start, $gold_price, $gold_weight))
			{
				$this->session->set_flashdata('success', 'New ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ' Have Been Created!');
				redirect('main');
			}else
			{
				$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . '!');
				redirect('main');
			}

		}else
		{
			$data['title'] = "New Transaction";
			$this->template->load('default', 'new/new_transaction', $data);
		}
	}

}