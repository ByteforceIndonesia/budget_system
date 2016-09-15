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
			$budget 	= $this->input->post('amount');


			//Check if the budget has already been created
			if(!$this->budget_model->checkMonth($month, $year, $type))
			{
				$_POST = array();
				redirect("new_budget/edit/$month/$year/$type/$budget");
			}else
			{
				$this->budget_model->insert($month, $year, $type, $budget);
				$this->session->set_flashdata('success', 'New ' . $type . ' Budget For ' . $month . ' ' . $year . ' Have Been Created!');
				redirect('main');
			}
		}else
		{
			$data['title'] = "New Monthly Budget";
			$this->template->load('default', 'new/new_budget', $data);
		}
	}

	public function edit($month = '', $year = '', $type = '', $budget = '')
	{
		if($this->input->post())
		{
			//Put Post Variables
			$month 		= $this->input->post('month');
			$year 		= $this->input->post('year');
			$type 		= $this->input->post('type');
			$budget 	= $this->input->post('amount');

			if($this->budget_model->update($month, $year, $type, $budget))
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

			$data['type']    = $type;
			$data['month']   = $month;
			$data['year']    = $year;
			$data['amount']  = $budget;

			$this->template->load('default', 'new/edit_budget', $data);
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

			$gold		= $this->budget_model->getMonthlyLimit('gold', date('F'))->limit_transaction;
			$diamond	= $this->budget_model->getMonthlyLimit('diamond', date('F'))->limit_transaction;

			$trans_gold		= $this->budget_model->getTotalTrans('gold', date('F'));
			$trans_diamond	= $this->budget_model->getTotalTrans('diamond', date('F'));

			switch($type)
			{
				case 'gold':
				{
					if($amount+$trans_gold > $gold)
					{
						$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ', You Have Execced Your Monthly Limit!');
						redirect('main');
					}
				}break;

				case 'diamond':
				{
					if($amount+$trans_diamond > $diamond)
					{
						$this->session->set_flashdata('failed', 'Failed Creating ' . $type . ' Transaction For ' . $month . ' ' . date('Y') . ', You Have Execced Your Monthly Limit!');
						redirect('main');
					}
				}break;
			}

			if($this->budget_model->insert_transaction($type, $amount, $spanning, $start))
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