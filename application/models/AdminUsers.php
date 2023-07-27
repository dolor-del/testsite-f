<?php

namespace application\models;

use application\core\Model;

class AdminUsers extends Model {

	public function getAllUsers() {

		if (isset($_POST['search']) and !empty($_POST['search'])) {
			$searchStr = trim($_POST['search']);
			$res = $this->search('users', '*', 'login', $searchStr);
			if (!$res) {
				$this->info = 'Нет пользователей с таким логином!';
				$this->flag = false;
				return $res;
			}
		} else {
			$res = $this->db->row("
				SELECT * FROM users
				ORDER BY id
			");
		}

		if(!$res) {
			$this->info = 'Список пользователей пуст';
			$this->flag = false;
			return false;
		}

		if(isset($_POST['del_marks'])) {
			if (isset($_POST['ids'])) {
				if ($this->delMarksTwoTables('users', 'results', 'id', 'user_id', $_POST['ids'])) {
					$this->info = 'Выбранные записи были удалены!';
					$res = $this->db->row("
						SELECT * FROM users
						ORDER BY id
					");
					$this->flag = true;
				}
			} else {
				$this->info = 'Вы не выбрали ни одной записи!';
				$this->flag = false;
			}
		}

		if(isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {
			if ($this->delItemTwoTables('users', 'results', 'id', 'user_id', $_GET['id'])) {
				$this->info = 'Запись была удалена!';
				$res = $this->db->row("
					SELECT * FROM users
					ORDER BY id
				");
				$this->flag = true;
			}
		}

		return $res;
	}

	public function addUser() {

		if (!$this->checkErrorCreateAccount() and !$this->checkMatchesInDbCreateAccount()) {
			if (isset($_POST['access'])) {
				$access = (int)$_POST['access'];
			} else {
				$access = 1;
			}
			$res = $this->db->query("
				INSERT INTO users SET
				login    = '".$_POST['login']."',
				password = '".$_POST['pass']."',
				email    = '".$_POST['email']."',
				hash     = '".myHash($_POST['login'].$_POST['email'])."',
				active     = 1,
				access     = $access,
				date_registration = NOW(),
				surname = '".$_POST['surname']."'
			");

			if ($res) {
				return true;
			}

			return false;
		}

		return false;
	}

	public function editUser() {
		$res = $this->db->fetchOneRow("
			SELECT * FROM `users`
			WHERE `id` = ".(int)$_GET['id']."
			LIMIT 1
		");

		if (!$res) {
			return false;
		}

		if(isset($_POST['delete'])) {
			if($this->delItemTwoTables('users', 'results', 'id', 'user_id', $_GET['id'])) {
				if(isset($_GET['previous'])) {
					header("Location: /admin/".$_GET['previous']);
					exit;
				} else {
					header("Location: /admin/users");
					exit;
				}
			}
		}

		if(!$this->checkErrorCreateAccount()) {
			$idUser = (int)$_GET['id'];
			$res = $this->db->query("
				UPDATE users SET
				login    = '".$_POST['login']."',
				password = '".$_POST['pass']."',
				email    = '".$_POST['email']."',
				hash     = '".myHash($_POST['login'].$_POST['email'])."',
				access     = '".$_POST['access']."',
				surname = '".$_POST['surname']."'
				WHERE id = $idUser
			");

			/*debug($res);*/

			if($res) {
				if(isset($_GET['previous'])) {
					header("Location: /admin/".$_GET['previous']);
				} else {
					header("Location: /admin/users");
				}
			}
			return false;
		}

		return $res;
	}
}