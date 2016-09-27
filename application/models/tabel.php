<?php

class Tabel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}

	public function searching($kata)
	{
		$query = $this->db->query('select * FROM linkhadits WHERE 
			hadits LIKE "%'.$kata.'%" or
			link LIKE "%'.$kata.'%"
			')->result();
		/*$ket = 0;
		$data =  array();
		foreach ($query->result() as $value)
			{
			$data['link'] = $value->link;
			$data['desc'] = $value->desc;
			$ket = 1;
			}*/
		/*if ($ket==0) {
			$data['zero']="Tidak ada data";
		}*/
		return $query;
	}
}

?>