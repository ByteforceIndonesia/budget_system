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
			$data_update = array(
				'emas_lm' => $this->input->post('emaslm'),
				'emas_24' => $this->input->post('emas24'),
				'dollar' => $this->input->post('dollar'),

				);

			$this->db->update('configuration',$data_update,array('id' => 1));
			$data_update['created'] = date('Y-m-d H:i:s');
			$this->db->insert('history',$data_update);

			redirect('main');
		}else{
			$data['title'] = 'Harga Hari Ini';
			$data['emaslm'] = $this->emaslm;
			$data['emas24'] = $this->emas24;
			$data['dollar'] = $this->dollar;
			$this->template->load('default', 'harga', $data);
		}
		
	}

	public function history(){
		$data['history'] = $this->db->get('history')->result();
		$this->template->load('default', 'history', $data);
	}


}