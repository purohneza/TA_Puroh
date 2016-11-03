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

	public static function cosinusTokens(array $tokensA, array $tokensB) {
	    /*foreach ($tokenssA as $key => $value) {
	    	$tokensA = $value;
	    }*/
	    $dotProduct = $normA = $normB = 0;
	    $uniqueTokensA = $uniqueTokensB = array();
	    $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));
	    
	    foreach ($tokensA as $key => $token) {
	    	$uniqueTokensA[$token] = count($token);
	    }
	    foreach ($tokensB as $key => $token) {
	    	$uniqueTokensB[$token] = count($token);
	    }
	    //foreach ($tokensA as $token) $uniqueTokensA[$token] = $token;
	    //foreach ($tokensB as $token) $uniqueTokensB[$token] = $token;

	    foreach ($uniqueMergedTokens as $token) {
	        $x = isset($uniqueTokensA[$token]) ? count($token) : 0;
	        $y = isset($uniqueTokensB[$token]) ? count($token) : 0;
	       
	        $dotProduct += $x * $y;
	       	
	        $normA += $x;
	        $normB += $y;
	        
	    }/*
	    return ($normA * $normB) != 0
	        ? $dotProduct / sqrt($normA * $normB)
	        : 0;*/
	    $atas  = (($normA * $normB) !=0 ) ? $dotProduct:0;
	    $bawah = sqrt($normA) * sqrt($normB);
	    $total =  $atas / $bawah;
	    return $total;
	}
	
}