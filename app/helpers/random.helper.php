<?php

class Random_Helper {

	public static function getPassword() {
		$base = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$special = "!@#$%&/()=?,;.:-_";
		$pwd = substr($special, rand(0, 19), 1);
		for ($i = 0; $i < 5; $i++) {
			$pwd .= substr($base, rand(0, 62), 1);
		}
		$pwd .= substr($special, rand(0, 19), 1);
		for ($i = 0; $i < 5; $i++) {
			$pwd .= substr($base, rand(0, 62), 1);
		}
		return $pwd;
	}

	public static function getSeed() {
		$base = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$seed = "";
		for ($i = 0; $i < 25; $i++) {
			$seed .= substr($base, rand(0, 62), 1);
		}
		return $seed;
	}

}

?>