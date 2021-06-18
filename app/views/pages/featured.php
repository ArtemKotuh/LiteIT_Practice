<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Подключаем стили и скрипты -->
	<?php include 'app/views/components/style_script.php'; ?>

</head>

<body>
	<!-- Подключаем файл с верстки авторизированого пользователя -->
	<?php include 'app/views/components/navbar_authorization.php' ?>
	<h1><?php echo "Избранные видео пользователя \"" . $pageData['current_user'] . "\"" ?> </h1>
	<?php
	// Подключаем файл с верстки для вывода получаенных данных с базы 
	include 'app/views/components/content_db.php'
	?>
</body>

</html>