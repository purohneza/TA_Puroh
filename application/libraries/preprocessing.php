<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Created By Muhamad Jafar Sidik
 * 081322091912 
 */

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
        $data = $this->case_folding();        
        foreach ($data as $key => $values) {
            $case[] = explode(" ", $values);
        }

        foreach ($case as $key => $value) {
            $response[] =  $value;   
        }
        return $response;        
    }

    public function filtering(){
        /*menghilangkan array yang sama*/
        $data = $this->tokenizing();
        foreach ($data as $key => $value) {
            
            $index_array = $this->array_empty_remover($value);

            $uniq =  array_unique($index_array);
            
            $filtering[]  = array_merge($uniq);

        }
        
        return $filtering;

    }
    public function array_empty_remover($array, $remove_null_number = true) {
        $new_array = array();
        $null_exceptions = array();
        foreach ($array as $key => $value) {
            $value = trim($value);
            if($remove_null_number) {
                $null_exceptions[] = '0';
            }
            if(!in_array($value, $null_exceptions) && $value != "") {
                $new_array[] = $value;
            }
        }
        return $new_array;
    }
    public function stemming($word){

    	/*$stem = PorterStemmer::Stem($word);
    	return $stem;*/
    }
}