<?php

namespace application\models;

use application\core\Model;

class AdminResults extends Model
{

    public function getAllResults()
    {

        if (isset($_POST['search']) and !empty($_POST['search'])) {
            $res = $this->searchTwoTable($_POST['search']);
            if ($res) {
                return $res;
            }
        } else {
            $res = $this->db->row("
				SELECT *
				FROM results AS r, users AS u
				WHERE r.user_id = u.id
				ORDER BY r.id
			");
        }

        if (!$res) {
            $this->info = 'Список результатов пуст';
            $this->flag = false;

            return false;
        }

        if (isset($_GET['action'], $_GET['id']) && $_GET['action'] == 'delete') {
            if ($this->delItem('results', $_GET['id'])) {
                $this->info = 'Запись была удалена!';
                $res = $this->db->row("
					SELECT * FROM results
					ORDER BY id
				");
                $this->flag = true;
            }
        }

        if (isset($_POST['del_marks'])) {
            if (isset($_POST['ids'])) {
                if ($this->delMarks('results', $_POST['ids'])) {
                    $this->info = 'Выбранные записи были удалены!';
                    $res = $this->db->row("
						SELECT * FROM results
						ORDER BY id
					");
                    $this->flag = true;
                }
            } else {
                $this->info = 'Вы не выбрали ни одной записи!';
                $this->flag = false;
            }
        }

        return $res;
    }
}