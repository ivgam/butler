<?php
class Fw_Statement extends PDOStatement{
	public function execute($bound_input_parameters = null) {
		if (DEBUG_MODE){
			$ts_start = microtime();
		}
		parent::execute($bound_input_parameters);
		if (DEBUG_MODE){
			$trace = debug_backtrace();			
			$ts_end = microtime();
			$ts = $ts_end - $ts_start;
			$error_info = $this->errorInfo();
			$debug = <<<DEBUG
 Called on: {$trace[1]['file']}
		  Line: {$trace[1]['line']}
		  Time: $ts seg
  Num Rows: {$this->rowCount()}
Error Code: {$error_info[0]}
Error Info: {$error_info[2]}
DEBUG;
			Fw_Register::addInRef('query_log', array(
				'sql'=>$this->queryString,				
				'debug'=>array(
					'file'=>$trace[1]['file'],
					'line'=>$trace[1]['line'],
					'time'=>$ts.'seg',
					'rows'=>$this->rowCount(),
					'error_code'=>$error_info[0],
					'error_info'=>$error_info[2]					
				)
			));
		}
		if (LOG_QUERYS){
			$handle = fopen(LOGS_PATH.DS.'query_log_'.date('Y_m_d_H').'.log', 'a');
			$time = date('Y-m-d H:i:s');
			fwrite($handle, "\n######## $time #########\n\n");
			fwrite($handle, $this->queryString."\n".(isset($debug)?"\n$debug\n":"\n"));			
			fclose($handle);
		}
	}
}
?>