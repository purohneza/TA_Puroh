<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('tabel');
	}

	
	public function index()
	{
		$this->load->view('welcome_message');
		
	}
	public function profil()
	{
		$this->load->view('profil');
		
	}
	public function pencarian()
	{
		$q = $this->input->post('query');
		$data['data_link'] = $this->tabel->searching($q);
		
		$this->load->view('hasil',$data);
	}
}
?>