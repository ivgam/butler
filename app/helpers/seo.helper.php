<?php

class SEO_Helper {
	
	public static function meta() {
		$brand = ' | '.COMPANY_NAME;
		$resource = Fw_Register::getRef('current_resource');
		$task = Fw_Register::getRef('current_task');
		$params = Fw_Filter::getArray('params');
		$oModel = new SEO_Model();
		$page = $oModel->getPage($resource, $task);
		if (!empty($page)) {
			return array(
				'title' => $page['title'].$brand,
				'description' => $page['description'],
				'author' => $page['author'],
				'robots' => $page['robots'],
				'canonical' => $page['canonical'],
			);
		}

		//SITEMAP
		if ($resource == 'static' && $task == 'map') {
			return array(
				'title' => 'Sitemap'.$brand,
				'description' => COMPANY_NAME.' sitemap page',
				'author' => AUTHOR.', '.AUTHOR_EMAIL,
				'robots' => 'NOINDEX, FOLLOW, NOARCHIVE',
				'canonical' => BASE_URL . '/map'
			);
		}
		
		//OTHER PAGES
		return array(
			'title' => 'Discover Incredible Experiences'.$brand,
			'description' => COMPANY_NAME.' static pages',
			'author' => AUTHOR.', '.AUTHOR_EMAIL,
			'robots' => 'NOINDEX, NOFOLLOW, NOARCHIVE',
			'canonical' => BASE_URL
		);
	}

}

?>
