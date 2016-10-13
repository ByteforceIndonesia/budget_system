<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {
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
		$data['title'] = "Notes";
		$data['notes'] = $this->db->get('notes')->result();
		

		$this->template->load('default', 'notes/list', $data);
	}

	public function add_notes(){
		if($this->input->post('add')){
			$content = nl2br($this->input->post('content'));
			$data_insert = array(
				'title' => $this->input->post('title'),
				'content' => $content,
				'created' => date('Y-m-d H:i:s')
				);

			$this->db->insert('notes',$data_insert);
			redirect('notes');
		}else{
			$data['title'] = "Tambah Notes";
		

			$this->template->load('default', 'notes/new', $data);
		}
	}

	public function delete($id = ''){
		
		
		
		$this->db->delete('notes',array('id' => $id));
		redirect('notes');
		
	}

	
}
