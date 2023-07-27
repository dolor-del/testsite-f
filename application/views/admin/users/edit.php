<a href="<?php if(isset($_GET['previous'])) { echo '/admin/'.$_GET['previous']; } else { echo '/admin/users'; } ?>"><input type="submit" value="Назад"></a><br><br>

<form action="" method="post">
	Логин: <input type="text" name="login" value="<?= $user['login'] ?>"><?= $errors['login'] ?? '' ?><br><br>
	Пароль: <?= $user['password'] ?><br><br>
	Новый пароль: <input type="password" name="pass"><?= $errors['pass'] ?? '' ?><br><br>
	Доступ:
	<label><input type="radio" name="access" <?php if ($user['access'] == 1) {echo 'checked';} else { echo ''; }?> value="1">Пользователь</label>
	<label><input type="radio" name="access" <?php if ($user['access'] == 5) {echo 'checked';} else { echo ''; }?> value="5">Администратор</label><br><br>
	Электронная почта: <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
	Фамилия: <input type="text" name="surname" value="<?= $user['surname'] ?>"><br><br>
	Дата регистрации: <?= $user['date_registration'] ?><br><br>
	Дата последней активности: <?= $user['date_last_act'] ?><br><br>
	<input type="submit" value="Сохранить" name="edit"><br><br>
	<input type="submit" value="Удалить" name="delete">
</form>