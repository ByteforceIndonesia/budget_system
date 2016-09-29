<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct ()
	{
		parent::__construct();

		if($this->session->userdata('user_id') == NULL)
		{
			redirect('accounts');
		}
	}

	public function index()
	{
		$data['title'] = "Home";
		$data['month'] = date('F');

		//Get Data
		$data['gold']		= (!$this->budget_model->getMonthlyLimit('gold', date('F')))? 1 : $this->budget_model->getMonthlyLimit('gold', date('F'))->limit_transaction;
		$data['diamond']	= (!$this->budget_model->getMonthlyLimit('diamond', date('F')))? 1 : $this->budget_model->getMonthlyLimit('diamond', date('F'))->limit_transaction;

		$data['trans_gold']		= (!$this->budget_model->getTotalTrans('gold', date('F'),date('Y')))? 0 : $this->budget_model->getTotalTrans('gold', date('F'),date('Y'));
		$data['trans_diamond']	= (!$this->budget_model->getTotalTrans('diamond', date('F'),date('Y')))? 0 : $this->budget_model->getTotalTrans('diamond', date('F'),date('Y'));

		$data['trans_cicilan'] = (!$this->budget_model->getTotalTransCicilan('diamond', date('Y-m')))? 0 : $this->budget_model->getTotalTransCicilan('diamond', date('Y-m'));

		$data['ratio_gold'] 	= $data['trans_gold']/$data['gold'];
		$data['ratio_diamond'] 	= $data['trans_diamond']/$data['diamond'];

		$this->template->load('default', 'home', $data);
	}

	public function month($month)
	{
		//Get Month Number and Year For future use
		$date = explode ('-', $month);
		$month = date('F', mktime(0, 0, 0, $date[0], 1, $date[1]));

		$data['title'] = $month . "'s Budget";
		$data['month'] = $month;

		//Get Data
		$data['gold']		= (!$this->budget_model->getMonthlyLimit('gold', $month))? 1 : $this->budget_model->getMonthlyLimit('gold', $month)->limit_transaction;
		$data['diamond']	= (!$this->budget_model->getMonthlyLimit('diamond', $month))? 1 : $this->budget_model->getMonthlyLimit('diamond', $month)->limit_transaction;

		$data['trans_gold']		= (!$this->budget_model->getTotalTrans('gold', $month, $date[1]))? 0 : $this->budget_model->getTotalTrans('gold', $month,$date[1]);
		$data['trans_diamond']	= (!$this->budget_model->getTotalTrans('diamond', $month, $date[1]))? 0 : $this->budget_model->getTotalTrans('diamond', $month,$date[1]);
		$data['trans_cicilan'] = (!$this->budget_model->getTotalTransCicilan('diamond', date('Y-m',strtotime($date[1].'-'.$date[0]))))? 0 : $this->budget_model->getTotalTransCicilan('diamond', date('Y-m',strtotime($date[1].'-'.$date[0])));

		$data['ratio_gold'] 	= $data['trans_gold']/$data['gold'];
		$data['ratio_diamond'] 	= $data['trans_diamond']/$data['diamond'];

		$this->template->load('default', 'home', $data);
	}

	public function year_overview ()
	{
		$data['title'] = "Year Overview";

		$data['gold']		= $this->budget_model->getYearly('gold');
		$data['diamond']	= $this->budget_model->getYearly('diamond');

		$this->template->load('default', 'year_overview', $data);
	}

	public function all_transactions ($month = '')
	{

		if($month == ''){
			$month = date('F');
			$year = date('Y');
			$data['month'] = date('F');
		}else{			
			$date = explode('-', $month);
			$month = date('F',strtotime($date['1'].'-'.$date[0]));
			$year = $date[1];
			$data['month'] = date('F',strtotime($date['1'].'-'.$date[0]));
		}
		
		$data['title'] = "Transactions";

		$data['gold'] 	 = $this->budget_model->getTransMonth($month,$year, 'gold');
		$data['diamond'] = $this->budget_model->getTransMonth($month,$year, 'diamond');

		$this->template->load('default', 'all_transactions', $data);
	
	}

	public function delete ($id)
	{
		$this->db->delete('installments',array('transaction_id' => $id));
		//Get Data From Transactions
		$data = $this->db->get_where('transactions', array('id' => $id))->row();

		//Delete From Transaction
		$this->db->where('id', $id);
		$this->db->delete('transactions');

		//Delete From Monthly Limit
		$voong = $this->db->get_where('monthly_limit', array('month' => $data->month, 'year' => $data->year, 'type' => $data->type))->row()->transaction_id;
		$voong = str_replace('#' . $id, '', $voong);

		$this->db->where(array('month' => $data->month, 'year' => $data->year, 'type' => $data->type));
		$this->db->set('transaction_id', $voong);
		$this->db->update('monthly_limit');

		//Redirect
		$this->session->set_flashdata('success', 'You Have Deleted A Transaction!');
		redirect('main/all_transactions');
	}

	public function detail_cicilan($month = ''){
		if($month == ''){
			$month = date('Y-m');
			$data['month'] = date('F');
		}else{
			
			$data['month'] = date('F',strtotime($month));
		}

		$data['title'] = "Detail Cicilan";

		$this->db->select('installments.*,transactions.month,transactions.year,transactions.created,transactions.description');
		$this->db->from('transactions');
		$this->db->join('installments','installments.transaction_id = transactions.id');
		$this->db->where("installments.due LIKE '$month%'");
		$data['installments'] = $this->db->get()->result();
		
		$this->template->load('default', 'detail_cicilan', $data);

	}
}
