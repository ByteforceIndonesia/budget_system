<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	private $emaslm;
	private $emas24;
	private $dollar;

	function __construct ()
	{
		parent::__construct();

		if($this->session->userdata('user_id') == NULL)
		{
			redirect('accounts');
		}

		$conf = $this->db->get('configuration')->row();
		$this->emaslm = $conf->emas_lm;
		$this->emas24 = $conf->emas_24;
		$this->dollar = $conf->dollar;
		if($this->emaslm == 0 || $this->emas24 == 0 || $this->dollar == 0){
			redirect('rate');
		}
	}

	public function index()
	{
		$data['title'] = "Home";
		$data['month'] = date('F');

		$conf = $this->db->get('configuration')->row();
		$this->dollar = $conf->dollar;

		//Get Data
		$data['gold']		= (!$this->budget_model->getMonthlyLimit('gold', date('F')))? 1 : $this->budget_model->getMonthlyLimit('gold', date('F'))->limit_transaction;
		$data['diamond']	= (!$this->budget_model->getMonthlyLimit('diamond', date('F')))? 1 : $this->budget_model->getMonthlyLimit('diamond', date('F'))->limit_transaction;

		$data['trans_gold']		= (!$this->budget_model->getTotalTrans('gold', date('F'),date('Y')))? 0 : $this->budget_model->getTotalTrans('gold', date('F'),date('Y'));
		$data['trans_diamond_rupiah'] =  (!$this->budget_model->getTotalTransDiamond(date('F'),date('Y'),'rupiah'))? 0 : $this->budget_model->getTotalTransDiamond(date('F'),date('Y'), 'rupiah');
		$data['trans_diamond_rupiah'] = $data['trans_diamond_rupiah'] / $this->dollar; 
		$data['trans_diamond_dollar'] =  (!$this->budget_model->getTotalTransDiamond(date('F'),date('Y'),'dollar'))? 0 : $this->budget_model->getTotalTransDiamond(date('F'),date('Y'), 'dollar');
		$data['trans_diamond']	= $data['trans_diamond_rupiah'] + $data['trans_diamond_dollar'];

		$data['trans_cicilan'] = (!$this->budget_model->getTotalTransCicilan('diamond', date('Y-m')))? 0 : $this->budget_model->getTotalTransCicilan('diamond', date('Y-m'));
		$data['trans_emas'] = (!$this->budget_model->getTotalTransCicilan('gold', date('Y-m')))? 0 : $this->budget_model->getTotalTransCicilan('gold', date('Y-m'));

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
		$data['trans_emas'] = (!$this->budget_model->getTotalTransCicilan('gold', date('Y-m',strtotime($date[1].'-'.$date[0]))))? 0 : $this->budget_model->getTotalTransCicilan('gold', date('Y-m',strtotime($date[1].'-'.$date[0])));
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
		$data['configuration'] = $this->db->get('configuration')->row();
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

	public function detail_cicilan($month = '',$type = ''){
		if($type == ''){
			$type = 'gold';
		}
		if($month == ''){
			$month = date('Y-m');
			$data['month'] = date('F');
		}else{
			
			$data['month'] = date('F',strtotime($month));
		}
		$data['configuration'] = $this->db->get('configuration')->row();
		$data['title'] = "Detail Cicilan";
		$data['type'] = $type;
		$this->db->select('installments.*,transactions.month,transactions.year,transactions.created,transactions.description,transactions.type, transactions.payment_type, transactions.diamond_type,transactions.weight,supplier.name');
		$this->db->from('transactions');
		$this->db->join('supplier','supplier.id = transactions.supplier_id','left');
		$this->db->join('installments','installments.transaction_id = transactions.id');
		$this->db->where("installments.due LIKE '$month%'");
		$this->db->where("transactions.type", $type);
		$data['installments'] = $this->db->get()->result();
		
		$this->template->load('default', 'detail_cicilan', $data);

	}


	public function setting_timer(){

		if($this->input->post()){
			print_r($this->input->post());

			$time1 = $this->input->post('day-1');
			$time2 = $this->input->post('day');

			$this->db->update('configuration',array('day-1' => $time1, 'day' => $time2));
			$this->session->set_flashdata('success', 'Jam Berhasil Diubah');
			redirect('main');

		}else{
			$data['configuration'] = $this->db->get('configuration')->row_array();
			$data['title'] = "Atur Jam";
			$this->template->load('default', 'setting_timer', $data);
			
		}

		
	}

	public function cicilan_tahunan($type = '',$year = ''){
		if($type == ''){
			$type = 'gold';
		}
		if($year==''){
			$year = date('Y');
			$data['year'] = date('Y');
		}else{
			$data['year'] = $year;
		}

		$data['title'] = 'Overview Tahunan';
		$cicilan_dollar=array();
		$cicilan_rupiah=array();
		$cicilan = array();
		$month = date('m',strtotime($year.'-01'));
		
		if($type == 'gold'){
			for($i = $month; $i <= 12; $i++){
				$amount = (!$this->budget_model->getTotalTransCicilan($type, date('Y-m',strtotime($year.'-'.$i))))? 0 : $this->budget_model->getTotalTransCicilan($type, date('Y-m',strtotime($year.'-'.$i)));
				array_push($cicilan,$amount);
			}		
			$data['cicilan'] = $cicilan;
		}else{
			for($i = $month; $i <= 12; $i++){
				$rupiah = (!$this->budget_model->getTotalTransCicilanDiamond('rupiah', date('Y-m',strtotime($year.'-'.$i))))? 0 : $this->budget_model->getTotalTransCicilanDiamond('rupiah', date('Y-m',strtotime($year.'-'.$i)));
				array_push($cicilan_rupiah,$rupiah);
				$dollar = (!$this->budget_model->getTotalTransCicilanDiamond('dollar', date('Y-m',strtotime($year.'-'.$i))))? 0 : $this->budget_model->getTotalTransCicilanDiamond('dollar', date('Y-m',strtotime($year.'-'.$i)));
				array_push($cicilan_dollar,$dollar);
			}
			for($i = 0; $i < count($cicilan_rupiah); $i++){
					$data['cicilan'][$i] = rupiah($cicilan_rupiah[$i]).' | '.NZD($cicilan_dollar[$i]);
				}
		}

		

		
		$data['type'] = $type;
		// for($i = $month; $i <= 12; $i++){
		// 	$amount = (!$this->budget_model->getTotalTransCicilan($type, date('Y-m',strtotime($year.'-'.$i))))? 0 : $this->budget_model->getTotalTransCicilan($type, date('Y-m',strtotime($year.'-'.$i)));
		// 	array_push($cicilan,$amount);
		// }	
		// $data['type'] = $type;
		// $data['cicilan'] = $cicilan;

		$this->template->load('default','cicilan_tahunan',$data);
	}

}
