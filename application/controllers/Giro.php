<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Giro extends CI_Controller {
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

	public function index(){
		$data['title'] = "Giro";
		$data['transactions'] = $this->db->get('transactions')->result();
		$this->template->load('default', 'giro/new', $data);
	}


	
	public function delete($id = ''){
		
		
		$data['supplier'] = $this->db->get_where('supplier', array('id' => $id))->row();
		$this->db->update('transactions',array('supplier_id' => 0),array('supplier_id' => $id));
		$this->db->delete('supplier',array('id' => $id));
		redirect('supplier');
		
	}

	public function get_transaction($id){
		$configuration = $this->db->get('configuration')->row();
		$transaction = $this->db->get_where('transactions',array('id' => $id))->row();

		if($transaction->type == 'diamond'){
			echo NZD($transaction->amount);
		}else{
			if($transaction->diamond_type == 'Logam Mulia'){
				echo rupiah($configuration->emas_lm * $transaction->weight);
			}else{
				echo rupiah($configuration->emas_24 * $transaction->weight);
			}
		}

	}

	public function new(){
		if($this->input->post('submit')){
			for($i = 0; $i <  count($this->input->post('nomor')); $i++){
				$data_insert = array(
						'giro' => $this->input->post('nomor')[$i],
						'due' => $this->input->post('tanggal')[$i],
						'amount' => $this->input->post('jumlah')[$i],
						'transaction_id' => $this->input->post('transaction'),

					);
				$this->db->insert('installments',$data_insert);
			}

			redirect('main');
		}
	}

	public function get_type($id){
		
		$transaction = $this->db->get_where('transactions',array('id' => $id))->row();

		echo $transaction->type;

	}


}