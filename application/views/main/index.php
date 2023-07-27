<?php if($flag === 1) : ?>
	<div class="navigation-flex">
		<div class="flex-in-flex-1-center">
			<div>
				<?php foreach ($disciplines as $val): ?>
					<a href="/discipline?id=<?= $val['id'] ?>">
						<div  style="text-align:center">
							<span class="text_top"><?= $val['name'] ?></span><br>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php elseif ($flag === 2) : ?>
	<div class="navigation-flex" style="font-size: 25px;"> Список тестов пуст.</div>
<?php elseif ($flag === 3) : ?>
	<div class="navigation-flex" style="font-size: 25px;"> Тесты видны только зарегистрированным пользователям. Пожалуйста, зарегистрируйтесь или авторизуйтесь на сайте.</div>
<?php endif; ?>


