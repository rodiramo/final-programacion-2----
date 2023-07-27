<section class="container">
	<h1 class="mb-1">Request a new password</h1>

	<p class="mb-1">Input your email and you will receive instructions on how to restablish your password.</p>

	<form action="actions/send-request-email.php" method="post">
		<div>
			<label for="email">Email</label>
			<input type="email" id="email" name="email" class="form-control">
		</div>
		<button type="submit" class="button">Send Email</button>
	</form>
</section>