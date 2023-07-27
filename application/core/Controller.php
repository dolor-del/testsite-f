<?php

namespace application\core;

use application\core\View;

abstract class Controller {

    public $route;
    public $view;

    /**
     * @var Model
     *
     */
    public $model;
    public $acl;

	public function __construct($route) {
		$this->route = $route;

		if (!$this->checkAcl()) {
			View::errorCode(403);
		}

		$this->view = new View($route);

		if (!$this->model = $this->loadModel($route['controller'])) {
			View::errorCode(404);
		}
	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
		return false;
	}

	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		} elseif (!isset($_SESSION['user']) and $this->isAcl('guest')) {
			return true;
		} elseif (isset($_SESSION['user']) and $_SESSION['user']['access'] == 1 and $this->isAcl('user')) {
			return true;
		} elseif (isset($_SESSION['user']) and $_SESSION['user']['access'] == 5 and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}

}