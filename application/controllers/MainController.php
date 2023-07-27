<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		$result = false;
		if (isset($_SESSION['user'])) {
			$result = $this->model->getAllDisciplines();
			if ($result) {
				$flag = 1;
			} else {
				$flag = 2;
			}
		} else {
			$flag = 3;
		}
		$vars = [
			'disciplines' => $result,
			'flag' => $flag,
		];
		$this->view->render('Главная страница', $vars);
	}

}