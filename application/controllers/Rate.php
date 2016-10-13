<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {
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
		
	}

	public function index(){
		if($this->input->post('update')){
			
		}else{
			$data['title'] = 'Harga Hari Ini';
			$data['emaslm'] = $this->emaslm;
			$data['emas24'] = $this->emas24;
			$data['dollar'] = $this->dollar;
			$this->template->load('default', 'harga', $data);
		}
		
	}


}