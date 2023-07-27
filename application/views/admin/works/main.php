<a href="/admin"><input type="submit" value="Назад"></a><br><br>

<?php if (isset($info)) { ?>
	<div style="<?php
	if (isset($flag)) {
		if ($flag) {
			echo 'background-color: #57ff53;';
		} else {
			echo 'background-color: #ff333b;';
		}
	} ?> height: 30px; padding-top: 5px; text-align: center ">
		<span><?php echo $info; ?></span>
	</div><br>
<?php } ?>

	<form action="" method="post">
		<table>
			<tr>
				<td><input type="checkbox" name="select_all"></td>
				<td>id</td>
				<td>Название</td>
				<td>Действие</td>
			</tr>
			<?php
			if ($disciplines) :
				foreach ($disciplines as $val) : ?>
					<tr>
						<td><input type="checkbox" name="ids[]" value="<?= (int)$val['id'] ?>"></td>
						<td><?= $val['id'] ?></td>
						<td><a href="/admin/works/edit?id=<?= $val['id'] ?>"><?= $val['name'] ?></a><br><br></td>
						<td><a href="/admin/works?action=delete&id=<?= (int)$val['id'] ?>">УДАЛИТЬ</a></td>
					</tr>

			<?php
				endforeach;
			endif; ?>
		</table>
		<br><input type="submit" name="del_marks" value="УДАЛИТЬ ОТМЕЧЕННЫЕ">
	</form>

<br><a href="/admin/works/add/discipline"><input type="submit" name="add_user" value="ДОБАВИТЬ КОНТРОЛЬНУЮ"></a>