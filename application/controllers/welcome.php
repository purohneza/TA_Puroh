<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//use PHPHtmlParser\Dom;

class Welcome extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('tabel');
		$this->load->library('Algoritma');
		$this->load->library('Preprocessing');
		$this->load->library('simple_html_dom');
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
		
		if(empty($q)){
			echo "Text Tidak Boleh Kosong";
			exit();
		}

		$explode = explode(" ",$q);
		$pettern 	= end($explode);
		$render = $this->algoritma->render($q,$pettern);
		$data = $this->tabel->searching($pettern);

		if($render == 0){
			echo "Algoritma Bayermore tidak menemukan text yang cocok";
			exit();
		}

		if(empty($data)){
				echo "Tidak ada data";
				exit();
			}
		echo "<table class='table'>
			<tr>
				<td>No</td>
				<td>Source</td>
				
				<td>Detail</td>
			</tr>
			";
			$no =  1;
			
			//print_r($data['desc']);
		foreach ($data as $key => $value) {
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".htmlspecialchars($value->source_uri)."</td>";
			//echo "<td>".htmlspecialchars($value->desc)."</td>";
			
			echo "<td><a id='detail' onclick='details(this);' data-id_query_search='".$value->id."' data-query='".$q."' data-link='".$value->source_uri."' href='#'>Detail</a></td>";
			echo "</tr>";
			$no++;
		}
		echo "</table>";
	}

	public function details(){
		$details 	= $this->input->post('details');
		$link 		= $this->input->post('link');
		$id_query_search 		= $this->input->post('id_query_search');
		
		/*scrapping Dimulai*/		
		$data 	= $this->__curl($link);
		$ret = $data->find('div.post-single-content'); 
		foreach ($ret as $key => $value) {
			$text = $value->plaintext;
		}

		$casefolding =  $this->preprocessing->casefolding($text);
		/*$tokenizing  =  $this->preprocessing->tokenizing($casefolding);
		$show = array_filter($tokenizing);*/
		$explode_kiri = explode(" ", $casefolding);

		echo "<div class='row'>
          <div class='col-md-6'>
          <h3>Hasil Scrapping</h3>
          <hr/><p class='text-justify'>".$value."</p>
          </div>
		<div class='col-md-6'>
          <h3>Hasil Kemiripan</h3>
          <table class='table'>
			<tr>
				<th>No</th>
				<th>Data</th>
				<th>Nilai</th>
			</tr>";
			
			/*Query Ke database terus simpen di array yang nanti nya aka di looping untuk ditampilkan disebelah kanan*/
			$query = $this->db->query("select * from resource_hadist where id_query_search='".$id_query_search."'");
			$rows = $query->result();
		
		if(!empty($rows)){
			$noo = 1;
			foreach ($rows as $key => $values) {
			$explode_kanan = explode(" ", $values->indonesian_source);
			
			similar_text($value, $values->indonesian_source, $percent);
				echo "<tr>
					<td>".$noo."</td>
					<td>".$values->indonesian_source."</td>
					
					<td>".algoritma::cosinusTokens($explode_kiri,$explode_kanan)."</td>
				</tr>";
				$noo++;
			}
		}
		echo "</table>
		</div>";
		echo "</div>";
	}

	private function __curl($uri) {

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_HEADER, false);
	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($curl, CURLOPT_URL, $uri);
	    curl_setopt($curl, CURLOPT_REFERER, $uri);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
	    $str = curl_exec($curl);
	    curl_close($curl);

	    // Create a DOM object
	    $dom = new simple_html_dom();
	    // Load HTML from a string
	    $dom->load($str);

	    return $dom;
	}
	public function test_rumus(){
		$vektor_a =  array(
			'pasukan',
			'pengibar',
			'bendera',
			'pusaka'
			);
		$vektor_b =  array(
			'paskibraka',
			'adalah',
			'singkatan',
			'dari',
			'pasukan',
			'pengibar',
			'bendera',
			'pusaka'			
			);
		echo algoritma::cosinusTokens($vektor_a,$vektor_b);
	}
}
?>