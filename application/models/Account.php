<?php

namespace application\models;

use application\core\Model;

class Account extends Model {

	public function login() {
		if(!$this->checkErrorLogin()) {
			$res = $this->db->fetchOneRow("
			SELECT *
			FROM users
			WHERE login = '".$_POST['login']."' AND password = '".$_POST['pass']."'
			OR
			email = '".$_POST['login']."' AND password = '".$_POST['pass']."'
			LIMIT 1
			");

			if($res) {
				return $res;
			} else {
				$this->setErrorLogin();
				return false;
			}
		}

		return false;
	}

	public function register() {
		if(!$this->checkErrorCreateAccount() and !$this->checkMatchesInDbCreateAccount()) {
			$this->db->query("
				INSERT INTO users SET
				login    = '".$_POST['login']."',
				password = '".$_POST['pass']."',
				email    = '".$_POST['email']."',
				hash     = '".myHash($_POST['login'].$_POST['email'])."',
				date_registration = NOW()
				");

			return true;
		}

		return false;
	}

	public function editProfile($userSess) {
		if(isset($_POST['submit'])) {
			if($this->uploadImg(1, 100, 100)) {
				$this->db->query("
					UPDATE users SET
					age 		= '".$_POST['age']."',
					photo 	= '".$this->nameUploadImg."'
					WHERE id = ".(int)$userSess['id']."
				");
				$userSess['photo'] = $this->nameUploadImg;
				$userSess['age'] = $_POST['age'];
				return $userSess;
			} elseif (isset($_POST['age']) and !empty($_POST['age'])) {
				$this->db->query("
					UPDATE users SET
					age 		= '".$_POST['age']."'
					WHERE id = ".(int)$userSess['id']."
				");
				$userSess['age'] = $_POST['age'];
				return $userSess;
			} else {
				return false;
			}
		}

		return false;
	}

	public function logout() {
		setcookie('id', '' , time() - 3600*24*30*12, '/');
		setcookie('hash', '' , time() - 3600*24*30*12, '/');
		session_unset();
		session_destroy();

		header('Location: /');
		exit();
	}

	public function checkErrorLogin() {
		if(isset($_POST['login'], $_POST['pass'])) {

			if(empty($_POST['login'])) {
				$this->errors['login'] = 'Empty username!';
			}

			if(empty($_POST['pass'])) {
				$this->errors['pass'] = 'Empty password!';
			}

			if (count($this->errors))
				return true;

			return false;
		}

		return true;
	}

	public function setErrorLogin() {
		$this->errors['login'] = 'Неправильный логин или пароль!';
		$this->errors['pass'] = 'Неправильный логин или пароль!';
		return true;
	}

}