<?php
class Login extends Controller
{
		public function index()
		{

				$this->view('login/index');
		}

		public function verify()
		{

				if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
						header('Location: /login');
						exit;
				}


				$username = trim($_POST['username'] ?? '');
				$password = trim($_POST['password'] ?? '');


				$userModel = $this->model('User');

				$user = $userModel->authenticate($username, $password);

				if ($user) {

						$_SESSION['auth']    = true;
						$_SESSION['user_id'] = $user['id'];
						$_SESSION['username']= $user['username'];

						header('Location: /notes');
						exit;
				} else {

						$_SESSION['error'] = 'Invalid username or password';
						header('Location: /login');
						exit;
				}
		}
}
