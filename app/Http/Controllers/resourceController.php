<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class resourceController extends Controller
{
	public function enkripsi($string)
	{
		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'sentul-apps';
	    $secret_iv = 'sentul-apps';
	 
	    // hash
	    $key = hash('sha256', $secret_key);
	     
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	 
	    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	    $output = base64_encode($output);
	 
	    return $output;
	}
	public function dekripsi($string)
	{
		 $output = false;
 
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'sentul-apps';
	    $secret_iv = 'sentul-apps';
	 
	    // hash
	    $key = hash('sha256', $secret_key);
	     
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	 
	    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	 
	    return $output;
	}
}
