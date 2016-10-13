<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
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
	
		$data['title'] = 'Daftar Supplier';
		$data['suppliers'] = $this->db->get('supplier')->result();
		
		$this->template->load('default', 'supplier/list', $data);
		
	}

	public function add_supplier(){
		if($this->input->post('add')){
			$address = nl2br($this->input->post('address'));
			$data_insert = array(
				'name' => $this->input->post('name'),
				'phone' => $this->input->post('phone'),
				'address' => $address,

				);

			$this->db->insert('supplier',$data_insert);

			redirect('supplier');
		}else{
			$data['title'] = 'Tambah Supplier';
			
			$this->template->load('default', 'supplier/new', $data);
		}
	}

	public function edit($id = ''){
		if($this->input->post('update')){
			$address = nl2br($this->input->post('address'));
			$data_update = array(
				'name' => $this->input->post('name'),
				'phone' => $this->input->post('phone'),
				'address' => $address,

				);

			$this->db->update('supplier',$data_update,array('id' => $id));

			redirect('supplier');
		}else{
			$data['title'] = 'Edit Supplier';
			$data['supplier'] = $this->db->get_where('supplier', array('id' => $id))->row();
			$this->template->load('default', 'supplier/edit', $data);
		}
	}
	public function delete($id = ''){
		
		
		$data['supplier'] = $this->db->get_where('supplier', array('id' => $id))->row();
		$this->db->update('transactions',array('supplier_id' => 0),array('supplier_id' => $id));
		$this->db->delete('supplier',array('id' => $id));
		redirect('supplier');
		
	}

}