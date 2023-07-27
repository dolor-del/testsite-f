<?php

namespace application\models;

use application\core\Model;

class Discipline extends Model {

	public $true;
	public $false;
	public $score;
	public $userId;

	public function getQuestions($userId) {
		$this->userId = $userId;

		$name = $this->getNameDiscipline();

		if ($res = $this->isCompleted($name)) {
			$this->flag = 'completed';
		} else {
			if (!($res = $this->getAllQuestions($name))) {
				$this->flag = 'void';
			}

			if(isset($_POST['finish'])) {
				for ($i = 1; $i <= count($res); $i++) {
					if(!isset($_POST['ans'.$i])) {
						$this->error = 'Вы ответили не на все вопросы!';
					}
				}

				if(!isset($this->error)) {

					$counter = 1;
					$this->true = 0;
					$this->false = 0;


					foreach($res as $val) {
						if($_POST['ans'.$counter] == $val['correct']) {
							$this->true++;
						} else {
							$this->false++;
						}
						$counter++;
					}

					$summ = $this->true + $this->false;
					$portion = ($this->false * 100)/$summ;

					if ($portion >= 0 && $portion <= 10) {
						$this->score = 5;
					} elseif($portion >= 11 && $portion <= 20) {
						$this->score = 4;
					} elseif($portion >= 21 && $portion <= 30) {
						$this->score = 3;
					} else {
						$this->score = 2;
					}

					$res = $this->db->row("
						INSERT INTO `results` SET
						`user_id`    = '".$this->userId."',
						`discipline`    = '".$name."',
						`count_true`    = ".(int)$this->true.",
						`count_false`    = ".(int)$this->false.",
						`score`    = ".(int)$this->score."
						");

					$this->flag = 'finish';
				}
			}
		}

		return $res;

	}

	public function getAllQuestions($name) {
		$res = $this->db->row("
			SELECT *
			FROM questions
			WHERE discipline = '".$name."'
			ORDER BY id
			");

		if (!count($res)) {
			return false;
		} else {
			return $res;
		}
	}

	public function getNameDiscipline() {
		$res = $this->db->fetchOneRow("
			SELECT name
			FROM disciplines
			WHERE id = '".$_GET['id']."'
			LIMIT 1
			");

		return $res['name'];
	}

	public function isCompleted($name) {
		$id = 100;
		$res = $this->db->row("
			SELECT count_true, count_false, score
			FROM results
			WHERE user_id = '".$this->userId."'
			AND discipline = '".$name."'
			LIMIT 1
			");

		return $res;
	}
}