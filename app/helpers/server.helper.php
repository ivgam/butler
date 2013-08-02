<?php

class Server_Helper {

	public static function get_server_load() {
		if (stristr(PHP_OS, 'win')) {
			$wmi = new COM("Winmgmts://");
			$server = $wmi->execquery("SELECT LoadPercentage FROM Win32_Processor");
			$cpu_num = 0;
			$load_total = 0;
			foreach ($server as $cpu) {
				$cpu_num++;
				$load_total += $cpu->loadpercentage;
			}
			$load = round($load_total / $cpu_num);
		} else {
			$sys_load = sys_getloadavg();
			$load = $sys_load[0];
		}
		return (int) $load;
	}

	public static function getDatabaseVariable($name, $aStatus) {
		foreach ($aStatus as $k => $v) {
			if ($v['Variable_name'] == $name) {
				return $v['Value'];
			}
		}
	}

	public static function uptimeFormat($seconds) {
		$to_return = '';
		$rest = $seconds;

		$Y = floor($rest / (365 * 24 * 3600));
		$rest = (int) ($rest - ($Y * 365 * 24 * 3600));
		if ($Y > 0) {
			$to_return .= "{$Y}Y";
		}

		$M = floor($rest / (12 * 30 * 3600));
		$rest = (int) ($rest - ($M * 12 * 30 * 3600));
		if ($M > 0) {
			$to_return .= "{$M}M";
		}

		$d = floor($rest / (24 * 3600));
		$rest = (int) ($rest - ($d * 24 * 3600));
		if ($d > 0) {
			$to_return .= "{$d}d";
		}

		$h = floor($rest / 3600);
		$rest = (int) ($rest - ($h * 3600));
		if ($h > 0) {
			$to_return .= "{$h}h";
		}

		$m = floor($rest / 60);
		$rest = (int) ($rest - ($m * 60));
		if ($m > 0) {
			$to_return .= "{$m}m";
		}

		$s = (int) $rest;
		$to_return .= "{$s}s";
		return $to_return;
	}

}

?>
