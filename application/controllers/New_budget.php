<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_budget extends CI_Controller {
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

	public function edit($month = '', $year = '', $type = '', $budget = '')
	{
		if($this->input->post())
		{

			
			//Put Post Variables
			$month 		= $this->input->post('month');
			$year 		= $this->input->post('year');
			$type 		= $this->input->post('type');
			$budget 	= $this->input->post('amount');
			$trans_gold	= $this->budget_model->getTotalTrans($type, $month,$year);
			

			if($budget >= $trans_gold)
			{	


				if($this->db->get_where('monthly_limit',array('month' => $month,'year' => $year, 'type' => $type))->num_rows() > 0){
					$this->budget_model->update($month, $year, $type, $budget);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Limit Bulan '.$month);
					redirect('main');
				}else{
					$data_insert = array(
							'month' => $month,
							'year' => $year,
							'limit_transaction' => $budget,
							'type' => $type,
							'created' => date('Y-m-d H:i:s')
						);

					$this->db->insert('monthly_limit',$data_insert);
					$this->session->set_flashdata('success', 'Berhasil Mengubah Limit Bulan '.$month);
					redirect('main');
				}
			}else
			{
				$this->session->set_flashdata('failed', 'Edit Limit ' . $type . ' untuk Bulan ' . $month . ' ' . $year . ' Gagal !');
				redirect('main');
			}
		}else
		{
			$data['title'] 	 = "Edit Monthly Budget";

			$data['type']    = $type;
			$data['month']   = $month;
			$data['year']    = $year;
			$data['amount']  = $this->db->get_where('monthly_limit',array('month' => $month,'year' => $year, 'type' => $type))->row('limit_transaction');

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

			
			$spanning 	= $this->input->post('spanning');
			$start	 	= $this->input->post('start_payment');
			$gold_price = (!$this->input->post('gold'))? 0 : $this->input->post('gold');
			// $totalGold	= $gold_price * $amount;
			$gold_weight = $this->input->post('weight');

			if($type == 'gold'){
				$amount = $gold_price * $gold_weight;
			}else{
				$amount = $this->input->post('amount');
			}
			$description = $this->input->post('description');
			$gold		= $this->budget_model->getMonthlyLimit('gold', date('F'))->limit_transaction;
			$diamond	= $this->budget_model->getMonthlyLimit('diamond', date('F'))->limit_transaction;

			$trans_gold = $this->budget_model->getTotalTrans('gold',date('F'),date('Y'));
			$trans_diamond = $this->budget_model->getTotalTrans('diamond' , date('F'),date('Y'));
			$supplier = $this->input->post('supplier');
			$jenis = $this->input->post('jenis');

			switch($type)
			{
				case 'gold':
				{
					if($gold_weight+$trans_gold > $gold)
					{
						$this->session->set_flashdata('failed', 'Gagal Menambahkan Transaksi ' . $type . ' Untuk Bulan ' . date('F') . ' ' . date('Y') . ', Limit Tidak Cukup !');
						redirect('main');
					}
				}break;

				case 'diamond':
				{
					
					if($amount+$trans_diamond > $diamond)
					{
						$this->session->set_flashdata('failed', 'Gagal Menambahkan Transaksi ' . $type . ' Untuk Bulan ' . date('F') . ' ' . date('Y') . ', Limit Tidak Cukup !');
						redirect('main');
					}
				}break;
			}

			if($this->budget_model->insert_transaction($type, $amount, $spanning, $start, $gold_price, $gold_weight, $description,$jenis,$supplier))
			{

				$this->session->set_flashdata('success', 'Transaksi ' . $type . ' Untuk Bulan ' . date('F') . ' ' . date('Y') . ' Berhasil dibuat !');
				redirect('main');
			}else
			{
				$this->session->set_flashdata('failed', 'Gagal Membuat Transaksi !');
				redirect('main');
			}

		}else
		{
			$data['title'] = "New Transaction";
			$data['suppliers'] = $this->db->get('supplier')->result();
			$this->template->load('default', 'new/new_transaction', $data);
		}
	}

	
}