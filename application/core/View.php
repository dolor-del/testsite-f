<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['url'];
	}

	public function render($title, $vars = []) {
		extract($vars);
		$created = $this->yearCreated();

		$path = 'application/views/'.$this->path.'.php';

		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/'.$this->layout.'.php';
		}
	}

	//ГОД СОЗДАНИЯ САЙТА - ТЕКУЩИЙ ГОД
	public function yearCreated() {
		$config = require 'application/config/created.php';
		if ($config == date('Y'))
			return $created = $config;
		else
			return $created = $config.' - '.date('Y');
	}

	public function redirect($url) {
		header('location: '.$url);
		exit;
	}

	public static function errorCode($code) {
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit;
	}

	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

}	