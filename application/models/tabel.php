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
		$query = $this->db->query('select link FROM linkhadits WHERE hadits LIKE "%'.$kata.'%"');
		$ket = 0;
		foreach ($query->result() as $value)
			{
			$data[] = $value->link;
			$ket = 1;
			}
		if ($ket==0) {
			$data="salah";
		}
		return $data;
	}
}

?>