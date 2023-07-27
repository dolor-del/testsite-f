<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller {

	public function loginAction() {
		$userSess = $this->model->login();
		$errors = $this->model->errors;

		if ($userSess) {
			$_SESSION['user'] = $userSess;
			header('Location: /');
			exit();
		}

		$vars = [
			'errors' => $errors,
		];

		$this->view->render('Вход', $vars);
	}

	public function registerAction() {
		$res = $this->model->register();
		$errors = $this->model->errors;

		if ($res) {
			header('Location: /account/login');
			exit();
		}

		$vars = [
			'errors' => $errors,
		];

		$this->view->render('Регистрация', $vars);
	}

	public function editAction() {
		$userSess = $this->model->editProfile($_SESSION['user']);

		if ($userSess) {
			if ($userSess['photo']) {
				$_SESSION['user']['photo'] = $userSess['photo'];
			}
			$_SESSION['user']['age'] = $userSess['age'];
		}
		$vars = [
			'photo' => $_SESSION['user']['photo'],
			'age' => $_SESSION['user']['age'],
		];

		$this->view->render('Изменение профиля', $vars);
	}

	public function logoutAction() {
		$this->model->logout();
	}

}