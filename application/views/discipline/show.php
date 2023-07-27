<?php if(isset($error)) : ?>

	<span style="color:#8b0202"><?= $error ?></span><br><br>

<?php endif; ?>

<?php

if (isset($flag)) :
	switch ($flag) :

		case 'completed': ?>

		<span>Вы уже проходили данный тест! Ваши результаты: </span><br><br>
		<p>
			Кол-во верных ответов: <?= $disciplines[0]['count_true'] ?> <br><br>
			Кол-во не верных ответов: <?= $disciplines[0]['count_false'] ?> <br><br>
			Ваша оценка :<?= $disciplines[0]['score']; ?>
		</p>

		<?php break;

		case 'finish': ?>

		<span>Тест завершен! Ваши результаты: </span><br><br>
		<p>
			Кол-во верных ответов: <?= $true ?> <br><br>
			Кол-во не верных ответов: <?= $false ?> <br><br>
			Ваша оценка :<?= $score ?>
		</p>

		<?php break;

		case 'void': ?>

		<p>Этот тест пуст! Дождитесь, когда здесь появятся вопросы.</p>

		<?php break;

		default: ?>

		<form action="" method="post">

			<?php
			$counter = 1;

			foreach ($disciplines as $val) {

				echo $counter.'.'; ?>
				<span style="font-weight:bold"><?= $val['question']; ?></span><br><br>

				<span style="margin-left:20px">1)</span><label style="margin-left:10px"><input type="radio" name="<?= 'ans'.$counter ?>" value="1"><?= $val['answer1']; ?></label><br><br>
				<span style="margin-left:20px">2)</span><label style="margin-left:10px"><input type="radio" name="<?= 'ans'.$counter ?>" value="2"><?= $val['answer2']; ?></label><br><br>
				<span style="margin-left:20px">3)</span><label style="margin-left:10px"><input type="radio" name="<?= 'ans'.$counter ?>" value="3"><?= $val['answer3']; ?></label><br><br>
				<span style="margin-left:20px">4)</span><label style="margin-left:10px"><input type="radio" name="<?= 'ans'.$counter ?>" value="4"><?= $val['answer4']; ?></label><br><br>
				<span style="margin-left:20px">5)</span><label style="margin-left:10px"><input type="radio" name="<?= 'ans'.$counter ?>" value="5"><?= $val['answer5']; ?></label><br><br>
				<br><br>
				<?php
				$counter++;
			}
			?>

			<br><input type="submit" name="finish" value="Закончить">
		</form>
<?php
	endswitch;
endif;
?>