<div style="text-align: center">
	<form action="" method="post" enctype="multipart/form-data">
		Фото: <br><br><img src="<?= $photo ?? '' ?>" alt="photo"><br><br>
		<input type="file" name="file" accept="image/*"><br><br>
		Возраст: <input type="text" name="age" value="<?= $age ?? '' ?>"><br><br>
		<input  name="submit" class="auth_button" type="submit" value="Save the changes">
	</form>
</div>