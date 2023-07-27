<?php

namespace application\controllers;

use application\core\Controller;

class AdminWorksController extends Controller {

	public function mainAction() {
		$this->view->layout = 'admin';

		$result = $this->model->getAllDisciplinesName();

		$vars = [
			'disciplines' => $result,
		];

		$this->view->render('Главная страница', $vars);
	}

	public function editAction() {
		$this->view->layout = 'admin';
		$vars = [];
		$this->view->render('Изменение названия дисциплины', $vars);
	}

	public function addDisciplineAction() {
		$this->view->layout = 'admin';

		if(isset($_POST['add'])) {
			$result = $this->model->addNewDiscipline();
			if ($result) {
				header('Location: /admin/works');
			}
		}

		$vars = [
			'error' => $this->model->error,
		];
		$this->view->render('Добавление дисциплины', $vars);

	}

	public function addWorkAction() {
		$this->view->layout = 'admin';
		$vars = [];
		$this->view->render('Добавление работы', $vars);
	}

}