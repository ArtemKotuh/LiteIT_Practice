<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $pageData['title']; ?></title>
	<!-- Подключаем стили и скрипты -->
	<?php include 'app/views/components/style_script.php'; ?>
</head>

<body>

	<?php
	//Подключаем необходимый navbar в зависимости от того, авторизирован ли пользователь
	$_SESSION['authorization'] == 'yes' ? include 'app/views/components/navbar_authorization.php' : include 'app/views/components/navbar_default.php';
	
	?>
	<h1><?php echo "Результаты поиска видео по фразе \"" . $pageData['search_word'] . "\"" ?> </h1>
	<?php
	//Подключаем вывод content в зависимости от того,  будем ли мы работа с API или с базой данных
	$_SESSION['YouTubeAPI'] = 'no' ? include 'app/views/components/content_db.php' : include 'app/views/components/content_youtubeapi.php';
	?>
</body>

</html>