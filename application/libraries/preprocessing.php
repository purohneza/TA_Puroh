<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'PorterStemmer.php';

class Preprocessing {

	protected $this;

	public function render(){

	}
	public function pemecah_kalimat($text){        

        $pecah      = explode(".",$text);
        return $pecah;

    }
	public function casefolding($text){
        $input = preg_replace('@[?:;,+=|!~#()0-9]+@', "", strtolower($text));//("@[^\d:,]+@i"," ",strtolower($value));
        return $input;
    }
	
	public function tokenizing($text){
        
        $pecah = explode('.', $text);

        foreach ($pecah as $key => $values) {
            $response[] =  $values;      
        }
        return $response;        
    }

    public function filtering($kalimat){
        /*menghilangkan array yang sama*/
        $data = $this->tokenizing($kalimat);
        foreach ($data as $key => $value) {
            
            $index_array = $this->array_empty_remover($value);

            //$uniq =  array_unique($index_array);
            
            $filtering[]  = $$index_array; //array_merge($uniq);

        }
        
        return $filtering;

    }
    public function stopword($array_kalimat,$array_stopword){

        return str_ireplace($array_stopword, "", $array_kalimat);
    }

    public function array_empty_remover($array, $remove_null_number = true) {
        $array_remove =  array(
            "yang",
            "dan",

        );
    }
    public function stemming($word){

    	/*$stem = PorterStemmer::Stem($word);
    	return $stem;*/
    }
}