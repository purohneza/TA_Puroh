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

			SELECT 
				qs.id as id,
				su.uri as uri,
				su.id as idx
				FROM query_search qs
				join source_uri su on su.id_query_search = qs.id
				WHERE (qs.code LIKE '%".$kata."%' OR qs.name LIKE '%".$kata."%' OR qs.tags LIKE '%".$kata."%' )

			")->result();
		return $query;
	}
}

?>