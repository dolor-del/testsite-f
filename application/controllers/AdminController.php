<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

	public function indexAction() {
		$this->view->layout = 'admin';
		$vars = [];
		$this->view->render('Панель администратора', $vars);
	}

}