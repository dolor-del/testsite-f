<?php

namespace application\controllers;

use application\core\Controller;

class DisciplineController extends Controller {

	public function showAction() {
		$result = $this->model->getQuestions($_SESSION['user']['id']);

		$flag = $this->model->flag;
		$error = $this->model->error;
		$true = $this->model->true;
		$false = $this->model->false;
		$score = $this->model->score;

		$vars = [
			'disciplines' => $result,
			'flag' => $flag,
			'error' => $error,
			'true' => $true,
			'false' => $false,
			'score' => $score,
		];

		$this->view->render($this->model->getNameDiscipline(), $vars);
	}

}