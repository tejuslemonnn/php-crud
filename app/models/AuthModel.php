<?php
class AuthModel extends Controller
{
  private $table = 'users';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function login($username, $password)
  {
    $query = "SELECT * FROM {$this->table} WHERE username='$username'";
    $result = $this->db->query($query);
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $result->num_rows > 0 ? $row["password"] : null;

    if ($result->num_rows > 0 && password_verify($password, $hashedPassword)) {
      $_SESSION['user_id'] = $row['id'];

      header("Location: " . BASEURL . "/UsersController/");
    } else {
      $error = "Username Or Password Wrong!";
    }
  }
}
