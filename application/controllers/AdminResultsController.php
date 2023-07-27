<?php

namespace application\controllers;

use application\core\Controller;

class AdminResultsController extends Controller {

	public function mainAction() {
		$this->view->layout = 'admin';

		$result = $this->model->getAllResults();

		$resultsBadStudents = [];

		if ($result) {
			foreach ($result as $v) {
				foreach ($v as $key => $val) {
					if($key === 'score' and $val === '2') {
						$resultsBadStudents[] = $v;
					}
				}
			}
		}

		$vars = [
			'results' => $result,
			'resultsBadStudents' => $resultsBadStudents,
			'flag' => $this->model->flag,
			'info' => $this->model->info,
		];
		$this->view->render('Главная страница', $vars);
	}

}