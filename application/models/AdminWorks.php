<?php

namespace application\models;

use application\core\Model;

class AdminWorks extends Model {

	public function getAllDisciplinesName() {

		$res = $this->model->getAllDisciplines();

		if (isset($_GET['action']) && $_GET['action'] == 'delete') {

			$this->db->query("
				DELETE
				FROM disciplines
				WHERE id = ".(int)$_GET['id']."
			");
			q("DROP TABLE `".$_GET['discipline']."`");
			$_SESSION['info'] = 'Предмет был удален!';
			$_SESSION['flag'] = true;
			header("Location: /admin/works");
			exit;
		}

		$res = q("SELECT * FROM `disciplines`
					ORDER BY `id`");

		if(!mysqli_num_rows($res)) {
			$no_disciplines = 'Список предметов пуст';
		}

		if(isset($_POST['del_marks']) && isset($_POST['ids'])) {

			foreach($_POST['ids'] as $k => $v) {
				$k = (int)$v;
			}

			$ids = implode(',', $_POST['ids']);

			q("
	DELETE FROM `disciplines`
	WHERE `id` IN (".$ids.")
	");

			$_SESSION['info'] = 'Выбранные предметы были удалены!';
			$_SESSION['flag'] = true;
			header('Location: /admin/works');
			exit();
		} elseif (isset($_POST['del_marks']) && !isset($_POST['ids'])) {
			$_SESSION['info'] = 'Вы не выбрали ни одного предмета!';
			$_SESSION['flag'] = false;
		}

	}

	public function addNewDiscipline() {

			$nameDiscipline = trim($_POST['discipline']);
			if(empty($nameDiscipline) or $nameDiscipline === '') {
				$this->error = 'Запишите название!';
				$this->flag = false;
				return false;
			}

			$this->db->query("
				INSERT INTO disciplines SET
				name    		= '".$nameDiscipline."'
			");

			$this->info = 'Предмет был добавлен!';
			$this->flag = true;
			return true;
	}
}