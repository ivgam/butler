<?php 
	class Fw_ClearDirectory{
		public static function clear($directory, $filter='all'){
			if(is_dir($directory) && $handler = opendir($directory)){
				while (false !== ($entry = readdir($handler))){
					if($entry != '.' && $entry != '..'){
						preg_match('/.*[.](.*)/', $entry, $matches);
						if($filter == 'all' || in_array($matches[1], $filter)){
							unlink($directory.DS.$entry);
						}
					}
				}
			}
		}
	}
?>