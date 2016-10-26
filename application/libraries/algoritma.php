<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require 'PorterStemmer.php';

Class Algoritma{
	
	protected $this;
	
	protected $CI;
	
	private $terms = array();
	private $kalimat = array();
	
	public function __construct()
    {
		// Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    }
	public function render($text, $pattern) {

		$pattern_text = ltrim($pattern);
	    $patlen = strlen($pattern);
	    $textlen = strlen($text);
	    $table = $this->makeCharTable($pattern);
	    for ($i=$patlen-1; $i < $textlen;) { 
	        $t = $i;
	        for ($j=$patlen-1; $pattern[$j]==$text[$i]; $j--,$i--) { 
	            if($j == 0) return 1; //Cocok;
	        }
	        $i = $t;
	        if(array_key_exists($text[$i], $table))
	            $i = $i + max($table[$text[$i]], 1);
	        else
	            $i += $patlen;
	    }
	    return 0; //Tidak Cocok
	}
	function makeCharTable($string) {
	    $len = strlen($string);
	    $table = array();
	    for ($i=0; $i < $len; $i++) { 
	        $table[$string[$i]] = $len - $i - 1; 
	    }
	    return $table;
	}

	public function tfidf($text){
		
		$pecahanKalimat = explode(". ", $text);
    	$tokens 		= array();
    	$arr_kalimat 	= array();
    	$termsd			= array();
    	$terms			= array();
    	foreach ($pecahanKalimat as $keyKal => $kalimat) {

      		/* 2. case folding */
      		$kal = preg_replace('@[?:;.,+=!~#()0-9]+@', " ", strtolower($kalimat));
      		array_push($arr_kalimat, $kal);
      		//echo '<br><strong>S' . ($keyKal+1) . '</strong>: ' . $kal;

      		/* 3. tokenizing */
		      $tokenPart = explode(" ", trim($kal));
		      $tokens = array();
		      foreach ($tokenPart as $part) {
		        if (!in_array(trim($part), $tokens)) {
		          array_push($tokens, $part);
		        }
		      }
		}

	    $this->kalimat = $arr_kalimat;
	    //echo 'Kalimat <pre>'; print_r($this->kalimat); echo '</pre>';
		foreach ($this->kalimat as $key => $kalimat) {
	     	//echo 'kalimat ('.($key+1).') = ' . $kalimat . '</br>';
	    	$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
			$stemmer  = $stemmerFactory->createStemmer();
			$output   = $stemmer->stem($kalimat);

	    	$term = explode(" ", $output);
	    	foreach ($term as $keyTerm => $termValue) {
	    		
	     		$term = preg_replace('@[?:;.,+=!~#()0-9]+@', "", strtolower($termValue));
	     		$termsd[$termValue] = $termValue;
	    		
	    		$arr = array_unique($termsd);
	    		$kata_tak_penting = $this->CI->db->query("select * from tb_stoplist")->result();
	    		foreach ($kata_tak_penting as $key => $value) {
	    			unset($arr[$value->Kata]);	    			
	    		}
	    		asort($arr);
	    		$this->terms = $arr;
	    	}
	    }
	    echo "<pre/>";
	    print_r($this->terms);
	    echo "Tabel TF";
	    echo "<table border='1'><thead><tr><th>Terms </th>";
		
		foreach ($this->kalimat as $key => $value_k) {
	    	echo "<th>D".($key+1)."(Dokumen)</th>";
	    }

	    echo "</tr><thead><tbody>";
	    foreach ($this->terms as $key => $value_terms) {
	    	echo "<tr>";

	    	echo "<td>".($value_terms)."</td>";
	    	foreach ($this->kalimat as $key => $kalimat_loops) {
	    		$count =  strpos($kalimat_loops,$value_terms);
	    		echo $value_terms."-";
	    		
	    		if($count <= 0){
	    			$sum = 0;
	    		}else{
	    			$sum = $count;

	    		}
	    		echo "<td>".$kalimat_loops."<br/>".$sum."</td>";
	    	}

	    	echo "</tr>";
	    }
	    echo "<tbody></table>";
/*$idf = array();

    foreach ($this->terms as $term) {

      $D = 0;
      $dfi = 0;
      foreach ($this->kalimat as $kalKey => $kalimats) {
        $this->tf[$kalKey][$term] = 0;

        $found = false;
        $string = explode(" ", $kalimats);
        foreach ($string as $str) {
          if (strcmp($str, $term) == 0) {
            $this->tf[$kalKey][$term]++;
            $dfi++;
            $found = true;
          }
        }

        //if ($found) {
          $D++;
        //}

      }

      //echo '<br>dfi = ' . $dfi;
      //echo '<br>D = ' . $D;
      $idf[$term] = 0;
      if ($dfi > 0) {
        $idf[$term] = log10($D / $dfi);
      }
      //echo '<br>IDF ('.$term.') = log('.$D.' / '.$dfi.') = ' . $idf[$term];

    }
    echo "<br/>-------------------------<br/>";
    print_r($idf);*/
    	//return true;
	}
	public static function cosinusTokens(array $tokensA, array $tokensB) {
	    /*foreach ($tokenssA as $key => $value) {
	    	$tokensA = $value;
	    }*/
	    $dotProduct = $normA = $normB = 0;
	    $uniqueTokensA = $uniqueTokensB = array();
	    $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));

	    foreach ($tokensA as $token) $uniqueTokensA[$token] = 0;
	    foreach ($tokensB as $token) $uniqueTokensB[$token] = 0;

	    foreach ($uniqueMergedTokens as $token) {
	        $x = isset($uniqueTokensA[$token]) ? 1 : 0;
	        $y = isset($uniqueTokensB[$token]) ? 1 : 0;
	        $dotProduct += $x * $y;
	        $normA += $x;
	        $normB += $y;
	    }

	    return ($normA * $normB) != 0
	        ? $dotProduct / sqrt($normA * $normB)
	        : 0;
	}
	
}