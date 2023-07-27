<div style="text-align: center">
	<form action= "" class="auth" method="post">
		Enter the login or email:*<br><input class="auth_text" type="text" name="login" value="<?= $_POST['login'] ?? ''?>"><br>
		<span style="color: #ff0000">
		<?= $errors['login'] ?? ''?>
		</span>
		<br><br>Enter the password:*<br><input class="auth_text" type="password" name="pass" value="<?= $_POST['pass'] ?? ''?>"><br>
		<span style="color: #ff0000">
		<?= $errors['pass'] ?? '' ?>
		</span><br>
		<p style="font-size: 10px; color: #ff0000">* Fields, obligatory for filling.</p>
		<br><br><input class="auth_button" type="submit" name="submitAuth" value = "Log In">
	</form>
	<br><br><a href="/account/register"><input class="auth_button" type="submit" name="submit-reg" value = "Create an account"></a>
</div>