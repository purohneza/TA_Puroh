<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'stem.php';

class Preprocessing {

	protected $this;

	public function render(){

	}
	public function pemecah_kalimat($text){        

        $pecah      = explode(".",$text);
        return $pecah;

    }
	public function casefolding($text){

        $looping_data = $this->pemecah_kalimat($text);
        foreach ($looping_data as $key => $value) {
            $input = preg_replace('@[?:;,+=!~#()0-9]+@', " ", strtolower($value));//("@[^\d:,]+@i"," ",strtolower($value));
            $data[] = $input;
        }
        return $data;
    }
	
	public function tokenizing($text){
        $data = $this->casefolding($text);        
        foreach ($data as $key => $values) {
            $case[] = explode(" ", $values);
        }

        foreach ($case as $key => $value) {
            $response[] =  $value;   
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