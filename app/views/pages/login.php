<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<meta name="vieport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/app/assets/css/registr_style.css">
</head>

<body>
	<div id="content">
		<div class="container-fluid table-block">
			<div class="row table-cell-block" class="col-sm-6">
				<div class="account-wall">
					<h1 class="text-center login-title">Вход</h1>
					<form method="post" class="form-signin" id="form-signin" name="form-signin">
						<input type="hidden" name="action" value="login">
						<?php if (!empty($pageData['errorlogin'])) : ?>
							<p><?php echo $pageData['errorlogin']; ?></p>
						<?php endif; ?>
						<input type="text" name="email" class="form-control" id="email" placeholder="Email" required autofocus>
						<input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
						<input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход" />
					</form>
				</div>
				<!-- /.account-wall -->
			</div>
			<!-- /.row table-cell-block -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#content -->
</body>

</html>