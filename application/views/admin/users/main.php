<a href="/admin"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post" style="display:inline-block">
	<input type="text" placeholder="Search" name="search" value="<?= $_POST['search'] ?? '' ?>">
	<input type="submit" value="Поиск">
</form>

<?php if (isset($_POST['search']) && $_POST['search'] != '') : ?>
	<a href="/admin/users"><input type="submit" value="Назад"></a>
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

	<form action="" method="post">
		<table>
			<tr>
				<td><input type="checkbox" name="select_all"></td>
				<td>ID</td>
				<td>Login</td>
				<td>Email</td>
				<td>Age</td>
				<td>Active</td>
				<td>Access</td>
			</tr>
			<?php
				if ($users) :
					foreach ($users as $val) : ?>
			<tr>
				<td><input type="checkbox" name="ids[]" value="<?= (int)$val['id'] ?>"></td>
				<td><?= (int)$val['id'] ?></td>
				<td>
					<a href="/admin/users/edit?id=<?= (int)$val['id'] ?>"><?= $val['login'] ?></a>
				</td>
				<td><?= $val['email'] ?></td>

				<td><?= (int)$val['age'] ?></td>
				<td><?= (int)$val['active'] ?></td>
				<td><?= (int)$val['access'] ?></td>
				<td><a href="/admin/users?action=delete&id=<?= (int)$val['id'] ?>"">УДАЛИТЬ</a></td>
			</tr>
			<?php
					endforeach;
				endif; ?>
		</table>

		<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ">
	</form>

<br><a href="/admin/users/add"><input type="submit" name="add_user" value="ДОБАВИТЬ ПОЛЬЗОВАТЕЛЯ"></a>