<section class="container">
	<h1>Reset Password</h1>

	<form action="actions/update-password.php" method="post">
		<!-- Agregamos como campos ocultos los valores del token y el email que recibimos como parámetros en el query string. -->
		<input type="hidden" name="token" value="<?= $_GET['token'];?>">
		<input type="hidden" name="email" value="<?= $_GET['email'];?>">
		<div>
			<label for="password">New Password</label>
			<input type="password" id="password" name="password" class="form-control">
		</div>
		<div>
			<label for="password_confirm">Confirm New Password</label>
			<input type="password" id="password_confirm" name="password_confirm" class="form-control">
		</div>
		<button type="submit" class="button">Send</button>
	</form>
</section>