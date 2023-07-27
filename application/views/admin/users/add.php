<a href="/admin/users"><input type="submit" value="Назад"></a><br><br>
<form action="" method="post">
	Логин: <input type="text" name="login"> <span style="background-color: #ff333b"><?= $errors['login'] ?? '' ?></span><br><br>
	Пароль: <input type="text" name="pass"> <span style="background-color: #ff333b"><?= $errors['pass'] ?? '' ?></span><br><br>
	Доступ:
	<label><input type="radio" name="access" value="1">Пользователь</label>
	<label><input type="radio" name="access" value="5">Администратор</label><br><br>
	Электронная почта: <input type="email" name="email"> <span style="background-color: #ff333b"><?= $errors['email'] ?? '' ?></span><br><br>
	Фамилия: <input type="text" name="surname"><br><br>
	<input type="submit" value="Создать" name="create"><br><br>
</form>