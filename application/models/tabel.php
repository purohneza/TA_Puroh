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
		$query = $this->db->query("
			SELECT *
				FROM query_search
				WHERE (code LIKE '%".$kata."%' OR name LIKE '%".$kata."%' OR tags LIKE '%".$kata."%' OR source_uri LIKE '%".$kata."%')
			")->result();
		return $query;
	}
}

?>