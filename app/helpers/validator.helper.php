<?php

class Validator_Helper {

	public static function length($value, $min, $max) {
		return strlen($value) >= $min && strlen($value) <= $max;
	}

	public static function isEmail($value) {
		if (preg_match('/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,4})+$/', $value)) {
			list($user, $domain) = explode('@', $value);
			return checkdnsrr($domain, 'MX');
		}
		return false;
	}

	public static function required($value) {
		return strlen(trim($value)) > 0;
	}

	public static function isInt($value) {
		return ((int) $value == $value);
	}

	public static function isFloat($value) {
		return ((float) $value == $value);
	}

	public static function isGeoposition($value) {
		//TO DO;
		return true;
	}

	public static function isHour($value) {
		if (preg_match('/^([0-9]{1,2}):([0-9]{2})$/', $value, $matches)) {
			return !((int) $matches[1] > 23 || (int) $matches[2] > 59);
			//return $matches[0] > 0 && $matches <= 23 && $matches[1] > 0 && $matches[1] <= 59;
		}
		return false;
	}

	public static function isDate($value) {
		if (preg_match('/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/', $value, $matches)) {
			$daysInMonth = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
			if ((!($matches[1] % 4) && $matches[1] % 100) || !($matches[1] % 400)) {
				$daysInMonth[1] = 29;
			}
			return
					!(
					(int) $matches[1] < 2010 ||
					(int) $matches[1] > 3050 ||
					(int) $matches[2] > 12 ||
					(int) $matches[3] > $daysInMonth[(int) $matches[2]]
					);
		}
		return false;
	}

	public static function iniDateGreatherThanEndDate($start_date, $end_date) {
		if (
				preg_match('/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/', $start_date)
				&& preg_match('/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/', $end_date)
		) {
			return strtotime($start_date) <= strtotime($end_date);
		}
		return false;
	}
	
	public static function iniTimeGreatherThanEndTime($start_time, $end_time) {
		if (
				preg_match('/^([0-9]{1,2}):([0-9]{2})$/', $start_time)
				&& preg_match('/^([0-9]{1,2}):([0-9]{2})$/', $end_time)
		) {
			return strtotime('2012-01-01 '.$start_time.':00') <= strtotime('2012-01-01 '.$end_time.':00');
		}
		return false;
	}

}

?>
