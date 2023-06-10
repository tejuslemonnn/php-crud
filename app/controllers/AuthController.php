<?php
class AuthController extends Controller
{
  public function index()
  {
    if (!isset($_SESSION['user_id'])) {
      header("Location: " . BASEURL . "/AuthController/loginPage");
    } else {
      header("Location: " . BASEURL . "/UsersController/");
    }
  }

  public function loginPage()
  {
    $data['title'] = 'Login';
    $this->view('partials/header', $data);
    $this->view('auth/login');
    $this->view('partials/footer');
  }

  public function login()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $this->model('AuthModel')->login($username, $password);
  }

  public function logout()
  {
    session_destroy();

    header("Location: " . BASEURL);
  }
}
