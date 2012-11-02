<?php
class Fw_Rest_Controller extends Fw_Controller{
	public function __construct() {
		$this->layout = 'blank';	
	}	
	public function router(){
		header('Access-Control-Allow-Origin: *');

		function export($result){
			$route = strstr($_SERVER['REQUEST_URI'], 'api');
			switch(strstr($route, '.')){
				case '.xml':
					var_dump($result);				
					break;
				case '.json':
				default:
					echo json_encode($result);
					break;
			}
		}
		function gets(){
			spl_autoload_register('__autoload');
			$model = new Rest_Model();
			$result = $model->rest_gets();
			export($result);
		}		
		function get($id){			
			spl_autoload_register('__autoload');
			$model = new Rest_Model();
			$result = $model->rest_get($id);
			export($result);
		}
		function search($query){				
			spl_autoload_register('__autoload');		
			$model = new Rest_Model();
			$result = $model->rest_search($query);
			export($result);
		}
		function add(){			
			spl_autoload_register('__autoload');
			$model = new Rest_Model();
			$result = $model->rest_add();
			export($result);
		}
		function update($id){			
			spl_autoload_register('__autoload');
			$model = new Rest_Model();
			$result = $model->rest_update($id);
			export($result);
		}
		function delete($id){			
			spl_autoload_register('__autoload');
			$model = new Rest_Model();
			$result = $model->rest_delete($id);
			export($result);
		}

		require LIBS_PATH.DS.'Slim'.DS.'Slim.php';		
		$route = strstr($_SERVER['REQUEST_URI'], 'api');
		list($api,$table) = explode('/', $route);	
		Fw_Register::setRef('table', $table);
		$app = new Slim();		
		$app->get 	('/'.$table					, 'gets'	);
		$app->get 	('/'.$table.'/:id'			, 'get'		);
		$app->get 	('/'.$table.'/search/:query', 'search'	);
		$app->post 	('/'.$table					, 'add'		);
		$app->put 	('/'.$table.'/:id'			, 'update'	);
		$app->delete('/'.$table					, 'delete'	);		
		$app->run();		
	}
}
?>