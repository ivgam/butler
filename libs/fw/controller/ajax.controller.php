<?php

class Fw_Ajax_Controller extends Fw_Controller {

	public function __construct() {
		$this->layout = 'blank';
	}

	public function login() {
		if (isset($_COOKIE['customer'])) {
			list($md5_email, $pwd) = explode('&&&&', $_COOKIE['customer']);
			$oModel = new Customer_Model();
			$oCustomer = $oModel->getCustomer($md5_email, $pwd);
			if (!empty($oCustomer)) {
				Fw_Module::getModule('user-logged', array('customer' => $oCustomer));
			}
		}
		exit();
	}

	public function upload() {
		require_once(LIBS_PATH . DS . 'SimpleImage' . DS . 'simpleImage.php');
		$folder = md5(time() . rand(0, 10000));
		mkdir(UPLOAD_PATH . DS . 'limbo' . DS . $folder);
		$uploaded = array('folder' => $folder, 'files' => array());
		$sizes = Fw_Register::getRef('sizes');
		foreach ($_FILES["attachments"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$seed = 0;
				$name = $_FILES["attachments"]["name"][$key];
				if (is_file(UPLOAD_PATH . DS . 'limbo' . DS . $folder . DS . $name)) {
					$aParts = explode('.', $name);
					$aOriginal = $aParts;
					do {
						$pos = max(array(0, count($aParts) - 2));
						$aParts[$pos] = $aOriginal[$pos] . '_' . ++$seed;
						$name = implode('.', $aParts);
					} while (is_file(UPLOAD_PATH . DS . 'limbo' . DS . $folder . DS . $name));
				}
				$new_location = UPLOAD_PATH . DS . 'limbo' . DS . $folder . DS . $name;
				$url = UPLOAD_URI . '/limbo/' . $folder . '/' . $name;
				move_uploaded_file($_FILES["attachments"]["tmp_name"][$key], $new_location);
				$image = new SimpleImage();
				$image->load($new_location);
				$ratio = $image->getWidth() / $image->getHeight();
				//if ($image->getWidth() >= xxx && $image->getHeight() >= yyy && $ratio > 1.6 && $ratio < 2) {
				$resized = array();
				foreach($sizes as $name => $dimensions){
					$image->resize($dimensions[0], $dimensions[1]);
					$image->save(str_replace('.jpg', '_'.$name.'.jpg', $new_location));
					$resized[$name] = array(
						'location'	=> str_replace('.jpg', '_'.$name.'.jpg', $new_location),
						'url'		=> str_replace('.jpg', '_'.$name.'.jpg', $url),
						'name'		=> str_replace('.jpg', '_'.$name.'.jpg', $name),
						'size'		=> getimagesize(str_replace('.jpg', '_'.$name.'.jpg', $new_location)),
					);
				}
				$uploaded['files'][] = array(
					'location' => $new_location,
					'url' => $url,
					'name' => $name,
					'size' => getimagesize($new_location),
					'resized' => $resized
				);
				//}
			}
		}
		echo json_encode($uploaded);
		exit();
	}

	public function setImages(){
		$resource = Fw_Filter::getVar('resource', 'default', 'post');
		$id = Fw_Filter::getVar('id', 'default', 'post');
		$images = Fw_Filter::getVar('images', 'default', 'post');
		Image_Helper::setImages($resource, $id, $images);
		Fw_Register::addMessage(ucfirst($resource).'#'.$id.' images updated successfully');
		echo json_encode(array());
		exit();
	}
	
}

?>