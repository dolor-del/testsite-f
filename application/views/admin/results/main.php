<a href="/admin"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post" style="display:inline-block">
	<input type="text" name="search" value="<?= $_POST['search'] ?? '' ?>">
	<input type="submit" value="Поиск">
</form>

<?php if (isset($_POST['search']) && $_POST['search'] != '') : ?>
	<a href="/admin/results"><input type="submit" value="Назад"></a>
<?php endif; ?><br><br>

<?php if (isset($info)) : ?>
	<div style="<?php
	if (isset($flag)) :
		if ($flag) :
			echo 'background-color: #57ff53;';
		else :
			echo 'background-color: #ff333b;';
		endif;
	endif; ?> height: 30px; padding-top: 5px; text-align: center ">
		<span><?= $info ?></span>
	</div><br>
<?php endif; ?>

	<h1>Все студенты</h1>
	<form action="" method="post">
		<table>
			<tr>
				<td><input type="checkbox" name="select_all"></td>
				<td>id</td>
				<td>Логин</td>
				<td>ФИО</td>
				<td>Дисциплина</td>
				<td>Правильные</td>
				<td>Не правильные</td>
				<td>Итогова оценка</td>
				<td>Действие</td>
			</tr>
			<?php
				if ($results) :
					foreach ($results as $val) : ?>
			<tr>
				<td><input type="checkbox" name="ids[]" value="<?= (int)$val['id'] ?>"></td>
				<td><?= (int)$val['id'] ?></td>
				<td>
					<a href="/admin/users/edit?id=<?= (int)$val['user_id'] ?>&previous=results"><?= $val['login'] ?></a>
				</td>
				<td style="font-weight:bold"><?= $val['surname'] ?></td>
				<td><?= $val['discipline'] ?></td>
				<td><?= $val['count_true'] ?></td>
				<td><?= $val['count_false'] ?></td>
				<td><?= $val['score'] ?></td>
				<td><a href="/admin/results?action=delete&id=<?= (int)$val['id'] ?>">УДАЛИТЬ</a></td>

			</tr>
			<?php
					endforeach;
				endif; ?>
		</table>
		<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ">
	</form>

	<h1>Двоечники</h1>
	<form action="" method="post">
		<table>
			<tr>
				<td><input type="checkbox" name="select_all"></td>
				<td>id</td>
				<td>Логин</td>
				<td>ФИО</td>
				<td>Дисциплина</td>
				<td>Правильные</td>
				<td>Не правильные</td>
				<td>Итогова оценка</td>
			</tr>
			<?php
			if ($resultsBadStudents) :
				foreach ($resultsBadStudents as $val) : ?>
				<tr>
					<td><input type="checkbox" name="ids[]" value="<?= (int)$val['id'];?>"></td>
					<td><?= (int)$val['id'] ?></td>
					<td>
						<a href="/admin/users/edit?id=<?= (int)$val['user_id'] ?>&previous=results"><?= $val['login'] ?></a>
					</td>
					<td style="font-weight:bold"><?= $val['surname'] ?></td>
					<td><?= $val['discipline'] ?></td>
					<td><?= $val['count_true'] ?></td>
					<td><?= $val['count_false'] ?></td>
					<td><?= $val['score'] ?></td>

				</tr>
			<?php
				endforeach;
			endif; ?>
		</table>
	</form>