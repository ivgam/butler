<?php

class Image_Helper {

	public static function get($url, $type){
		return BASE_URL.str_replace('.jpg', '_'.$type.'.jpg', $url);
	}
	
	public static function background($url)			{return self::get($url, __FUNCTION__);}
	public static function city_thumb($url)			{return self::get($url, __FUNCTION__);}
	public static function product_slider($url)		{return self::get($url, __FUNCTION__);}
	public static function product_grid($url)		{return self::get($url, __FUNCTION__);}
	public static function category_slider($url)	{return self::get($url, __FUNCTION__);}
	public static function category_grid($url)		{return self::get($url, __FUNCTION__);}

	public static function getImages($resource_type, $id, $grouped = true) {
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = <<<SQL
SELECT id, url, main
	FROM {$resource_type}_image
	WHERE id_{$resource_type} = :id
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		if($grouped){
			return $statement->fetchAll(PDO::FETCH_GROUP);
		}
		return $statement->fetchAll();
	}
	
	public static function getMainImage($resource, $id, $type){
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = <<<SQL
SELECT url
	FROM {$resource}_image
	WHERE id_{$resource} = :id
	AND main = 1
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		$url = $statement->fetchColumn();
		return self::get($url, $type);
	}

	public static function setImages($resource_type, $id, $images) {
		//DELETES
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = "DELETE FROM {$resource_type}_image WHERE id_{$resource_type} = :id";
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		//INSERTS
		$sSQL = <<<SQL
INSERT INTO {$resource_type}_image
(id_{$resource_type}, url, main, ts_creation, ts_update)
VALUES
(:id, :url, :selected, NOW(), NOW())
SQL;
		$statement = $oDb->prepare($sSQL);

		if (!is_dir(IMG_PATH . DS . $resource_type)) {
			mkdir(IMG_PATH . DS . $resource_type);
		}
		if (!is_dir(IMG_PATH . DS . $resource_type . DS . $id)) {
			mkdir(IMG_PATH . DS . $resource_type . DS . $id);
		}

		foreach ($images as $k => $image) {
			if (preg_match('/\/tmp\/limbo\/(.*)\/(.*)/', $image['url'], $matches)) {
				$old_path = UPLOAD_PATH . DS . 'limbo' . DS . $matches[1] . DS . $matches[2];
				$new_path = IMG_PATH . DS . $resource_type . DS . $id . DS . $matches[2];
				rename($old_path, $new_path);
				$sizes = Fw_Register::getRef('sizes');
				foreach ($sizes as $name => $dimensions) {
					rename(str_replace('.jpg', '_' . $name . '.jpg', $old_path), str_replace('.jpg', '_' . $name . '.jpg', $new_path));
				}
				$image['url'] = IMG_URI . "{$resource_type}/$id/$matches[2]";
			}
			$statement->bindParam(':id', $id, PDO::PARAM_INT);
			$statement->bindParam(':url', $image['url'], PDO::PARAM_INT);
			$selected = ($image['selected'] == 'true');
			$statement->bindParam(':selected', $selected, PDO::PARAM_BOOL);
			$statement->execute();
		}
		if (isset($matches[1])) {
			Fw_ClearDirectory::clear(UPLOAD_PATH . DS . 'limbo' . DS . $matches[1]);
			rmdir(UPLOAD_PATH . DS . 'limbo' . DS . $matches[1]);
		}
	}

}

?>