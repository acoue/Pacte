<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class SecuriteComponent extends Component
{
	
	public function getCodeCaptcha()
	{
     	$length = 6;    		
     	$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		return $password;
	}
	
	public function getPassword()
	{
		$length = 8;
		$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		return $password;
	}
	
	public function getToken()
	{
		$length = 32;
		$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		return $password;
	}
}
