<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
		<title>Login</title>
		<style>
				body { background: #f4f4f4; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
				.login-container { background: white; padding: 30px 40px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
				h1 { margin-bottom: 20px; font-size: 22px; text-align: center; }
				label { display: block; margin-top: 10px; font-weight: bold; }
				input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
				input[type="submit"] { margin-top: 20px; width: 100%; padding: 10px; background-color: #4CAF50; border: none; color: white; font-weight: bold; border-radius: 4px; cursor: pointer; }
				input[type="submit"]:hover { background-color: #45a049; }
				.error { color: red; font-weight: bold; margin-bottom: 10px; text-align: center; }
		</style>
</head>
<body>
		<div class="login-container">
				<h1>Login Form</h1>

				<?php if (isset($_SESSION['login_error'])): ?>
						<div class="error"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
				<?php endif; ?>

				<form action="/login/verify" method="post">
						<label for="username">Username:</label>
						<input type="text" id="username" name="username" required>

						<label for="password">Password:</label>
						<input type="password" id="password" name="password" required>

						<input type="submit" value="Submit">
				</form>

				<p style="text-align:center;margin-top:10px;">
						<a href="/signup">Create an account</a>
				</p>
		</div>
</body>
</html>
