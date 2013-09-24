<?php

class Date_Helper {
	
	public function is($weekday_text, $date){
		return strtolower($weekday_text) == strtolower(date('l',strtotime($date)));
	}
	
	public function isMonday($date)		{ return is('monday'	, $date); }
	public function isTuesday($date)	{ return is('tuesday'	, $date); }
	public function isWednesday($date)	{ return is('wednesday'	, $date); }
	public function isThursday($date)	{ return is('thursday'	, $date); }
	public function isFriday($date)		{ return is('friday'	, $date); }
	public function isSaturday($date)	{ return is('saturday'	, $date); }
	public function isSunday($date)		{ return is('sunday'	, $date); }
	
	
}
?>
