<?php
	$tr_answers = json_decode(file_get_contents($_GET['testfile']), true)['answers'];
	$primary_message = 'Ваш результат:';
	$total_count = 0;
	$passed_count = 0;

		if (isset($_POST)) {
			foreach ($_POST as $us_key => $us_value) {
			$total_count++;
			if ($us_value == $tr_answers[$us_key]) {
				$passed_count++;
			}
		}
			
		$user_answers = $_POST;

		$passed_count = $passed_count . ' / ';

		if ($total_count == 0) {$total_count = .1;}

		if (($passed_count/$total_count)*100 < 45) {
			$primary_message = '';
			$secondary_message = '<h3 class="text-danger">Тест не пройден</h3>';
			$passed_count = '';
			$total_count = '';}
		elseif (($passed_count/$total_count)*100 < 75) {
			$secondary_message = '<h3 class="text-warning">Удовлетворительно</h3>';}
		elseif (($passed_count/$total_count)*100 < 90) {
			$secondary_message = '<h3 class="text-success">Хорошо</h3>';}
		elseif (($passed_count/$total_count)*100 > 90) {
			$secondary_message = '<h3 class="text-success">Отлично!</h3>';}

		if (count($tr_answers) > count($user_answers)) {
			$primary_message = '';
			$secondary_message = '<h3 class="text-danger">Ответьте на все вопросы!</h3>';
			$passed_count = '';
			$total_count = '';}
	} else {
		$primary_message = '';
		$secondary_message = '<h3 class="text-danger">Ответьте на все вопросы!</h3>';
		$passed_count = '';
		$total_count = '';
	}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>JSON TEST form</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-color: #d5deed">
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">JSON TEST form</a>
			</div>
			<div class="navbar-collapse navbar-top collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="admin.php">ЗАГРУЗИТЬ ТЕСТ</a></li>
					<li><a href="list.php">СПИСОК ТЕСТОВ</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div style="text-align: center;" class="container">
		<h2><?=$_GET['testname']?></h2><br><br>
		<h3><?=$primary_message?></h3>
		<?=$secondary_message?>
		<h3><?php echo $passed_count . $total_count; ?></h3><br><br>
		<?php echo '<a href="test.php?testfile=' . $_GET['testfile'] . '" class="bg-warning">Вернуться к тесту</a>'?><br>
		<a href="list.php" class="bg-success">Вернуться к списку тестов</a><br>
		<a href="admin.php" class="bg-info">Загрузить файл теста</a>
	</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
