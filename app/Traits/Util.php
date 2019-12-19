<?php

namespace App\Traits;

class Util {

    static function generateRandomString($length)
  	{
  		$alphabet = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  		$id = array();
  		$alphaLength = strlen($alphabet) - 1;
  		for ($i = 0; $i < $length; $i++) {
  			$p = mt_rand(0, $alphaLength);
  			$id[] = $alphabet[$p];
  		}
  		return implode($id);
  	 }

    static function generateOrderNumber(){
		return "TR-" . date('Y', time()) . date('m', time()) . date('d', time()) . "-" . ucwords(self::generateRandomString(8));
    }

    static $rideTypes = ['1' => 'Transport', '2' => 'Livraison'];
 }
