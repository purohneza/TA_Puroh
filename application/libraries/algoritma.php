<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

Class Algoritma{
	
	protected $this;
	
	public function render($text, $pattern) {
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
}