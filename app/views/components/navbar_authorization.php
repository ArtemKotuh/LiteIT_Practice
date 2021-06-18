

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a href="/" class="navbar-brand">YouTube<b>Video</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav">
			<div class="container-fluid table-block">
				<!-- <h1 class="header-text">Сайт с погодой</h1> -->
				<div class="menu">
					<form method="post" class="form-menu">
						<button class="btn btn-primary" type="submit" name="action" value="featured">Избранные</button>
					</form>
				</div>
				<!-- /.menu -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<form class="navbar-form form-inline">
			<div class="input-group search-box">
				<input type="text" id="search" name="search" class="form-control" placeholder="Search here...">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="material-icons">&#xE8B6;</i>
					</span>
				</div>
			</div>
		</form>
		<div class="navbar-nav ml-auto action-buttons">
			<form method="post" class="form-menu">
				<button class="btn btn-primary" type="submit" name="action" value="logout" id="logout_id">Выйти с аккаунта</button>
				<div class="mess"></div>
			</form>
		</div>
	</div>
</nav>