<?php

namespace application\core;

use application\lib\Db;

abstract class Model {

	public $db;

	public $info;
	public $flag;
	public $error;
	public $errors = [];

	//ЗАГРУЗКА ИЗОБРАЖЕНИЙ
	public $infoUploadError;
	public $nameUploadImg;

	public function __construct() {
		$this->db = new Db;
	}

	public function getAllDisciplines() {
		if (isset($_POST['search'])) {
			$res = $this->search('disciplines','id, name', 'name', $_POST['search']);
			return $res;
		}
		$res = $this->db->row('
			SELECT id, name
			FROM disciplines
			ORDER BY id
		');
		return $res;
	}

	//УДАЛИТЬ ОТМЕЧЕННЫЕ ЗАПИСИ
	public function delMarks($tableName, $idsDel) {
		foreach($idsDel as $k => $v) {
			$k = (int)$v;
		}

		$ids = implode(',', $idsDel);

		$this->db->query("
			DELETE
			FROM $tableName
			WHERE id IN (".$ids.")
		");

		return true;
	}

	public function delMarksTwoTables($tableName1, $tableName2, $column1, $column2, $idsDel) {
		foreach($idsDel as $k => $v) {
			$k = (int)$v;
		}

		$ids = implode(',', $idsDel);

		$this->db->query("
			DELETE
			FROM $tableName1
			WHERE $column1 IN (".$ids.")
		");

		$this->db->query("
			DELETE
			FROM $tableName2
			WHERE $column2 IN (".$ids.")
		");

		return true;
	}

	//УДАЛИТЬ ЗАПИСЬ
	public function delItem($tableName, $id) {
		$this->db->query("
			DELETE
			FROM $tableName
			WHERE id = ".(int)$id."
		");

		return true;
	}

	public function delItemTwoTables($tableName1, $tableName2, $column1, $column2, $id) {
		$this->db->query("
			DELETE
			FROM $tableName1
			WHERE $column1 = ".(int)$id."
		");

		$this->db->query("
			DELETE
			FROM $tableName2
			WHERE $column2 = ".(int)$id."
		");

		return true;
	}

	//СТРОКА ПОИСКА
	public function search($tableName, $columns, $crit, $strSearch) {
		if ($strSearch != '') {
			return $this->db->row("
				SELECT $columns
				FROM $tableName
				WHERE $crit LIKE '%".$strSearch."%'
				ORDER BY $crit
			");
		}

		return false;
	}

	public function searchTwoTable($strSearch) {
		if ($strSearch != '') {
			return $this->db->row("
				SELECT *
				FROM results AS r, users AS u
				WHERE r.user_id = u.id
				AND login LIKE '%".$strSearch."%'
				ORDER BY login
			");
		}

		return false;
	}

	//ОТЛАВЛИВАЕМ ОШИБКИ ПРИ СОЗДАНИИ АККАУНТА
	public function checkErrorCreateAccount() {
		if(isset($_POST['login'], $_POST['pass'], $_POST['email'])) {

			if(empty($_POST['login'])) {
				$this->errors['login'] = 'Empty or invalid username!';
			} elseif(mb_strlen($_POST['login']) < 2) {
				$this->errors['login'] = 'Username is too short!';
			} elseif(mb_strlen($_POST['login']) > 16) {
				$this->errors['login'] = 'Username is too long!';
			}

			if(mb_strlen($_POST['pass']) < 4) {
				$this->errors['pass'] = 'The password must contain at least 4 characters!';
			}

			if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$this->errors['email'] = 'Invalid email value!';
			}

			if(count($this->errors)) {
				return true;
			}

			return false;
		}

		return true;
	}

	//ПОИСК СОВПАДЕНИЙ В БАЗЕ ПРИ СОЗДАНИИ АККАУНТА
	public function checkMatchesInDbCreateAccount() {
		$res = $this->db->fetchOneRow("
			SELECT id
			FROM users
			WHERE login = '".$_POST['login']."'
			LIMIT 1
		");

		if ($res) {
			$this->errors['login'] = 'Такой логин уже существует!';
		}

		$res = $this->db->fetchOneRow("
			SELECT id
			FROM users
			WHERE email = '".$_POST['email']."'
			LIMIT 1
		");

		if ($res) {
			$this->errors['email'] = 'Такой email уже существует!';
		}

		if (count($this->errors)) {
			return true;
		}

		return false;
	}

    /**
     *
     *
     * @param bool $resize
     * @param int $w
     * @param int $h
     * @return bool
     */
	public function uploadImg($resize = false, $w = 0, $h = 0): bool
    {
		$array1 = ['image/gif', 'image/jpeg', 'image/png'];
		$array2 = ['jpg', 'jpeg', 'gif', 'png'];

		if ($_FILES['file']['error'] == 0) {
			if ($_FILES['file']['size'] > 52428800) {
				$this->infoUploadError = 'Размер изображения не должен превышать 50Мб.';
			} else {
				preg_match('#\.([a-z]+)$#iu', $_FILES['file']['name'], $matches);
				if (isset($matches[1])) {
					$end = mb_strtolower($matches[1]);

					$temp = getimagesize($_FILES['file']['tmp_name']);
					$this->nameUploadImg = '/public/uploaded/'.date('Ymd-His').'img'.rand(10000, 99999).'.'.$end;

					if (!in_array($end, $array2)) {
						$this->infoUploadError = 'Расширение изображения не подходит.';
					} elseif(!in_array($temp['mime'], $array1)) {
						$this->infoUploadError = 'Тип файла не подходит (можно загружать только изображения).';
					} elseif(!move_uploaded_file($_FILES['file']['tmp_name'], '.'.$this->nameUploadImg)) {
						$this->infoUploadError = 'Ошибка! Изображение не загружено.';
					} else {

						if ($resize == true) {

							$r = $temp[0] / $temp[1];

							if($w / $h > $r) {
								$newwidth = $h * $r;
								$newheight = $h;
							} else {
								$newheight = $w / $r;
								$newwidth = $w;
							}

							if ($temp['mime'] == 'image/jpeg') {
								$src = imagecreatefromjpeg('.'.$this->nameUploadImg);
							} elseif($temp['mime'] == 'image/png') {
								$src = imagecreatefrompng('.'.$this->nameUploadImg);
							} elseif($temp['mime'] == 'image/gif') {
								$src = imagecreatefromgif('.'.$this->nameUploadImg);
							}

							$tmp = imagecreatetruecolor($newwidth, $newheight);
							imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $temp[0], $temp[1]);
							imagejpeg($tmp, '.'.$this->nameUploadImg, 100);
							imagedestroy($tmp);
						}
					}
				} else {
					$this->infoUploadError = 'Данный файл не является изображением. Принимаемые типы файлов: jpg, png, gif.';
				}
			}
		}

		if (isset($this->nameUploadImg) and !isset($info_error)) {
			return true;
		}

		return false;
	}
}