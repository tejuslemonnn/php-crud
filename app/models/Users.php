<?php
class Users extends Controller
{
  private $table = 'users';
  private $db;
  private $userId;

  public function __construct()
  {
    $this->userId = $_SESSION['user_id'];
    $this->db = new Database;
  }

  public function getAllUsers($page, $perPage)
  {
    $offset = ($page - 1) * $perPage;
    $result = $this->db->query("SELECT * FROM users WHERE id != $this->userId ORDER BY create_time LIMIT $perPage OFFSET $offset");
    return $result;
  }

  public function countAllUsers()
  {
    $result = $this->db->query("SELECT * FROM users WHERE id != $this->userId");
    return $result->num_rows;
  }

  public function add($username, $password, $datetime, $fotoName = "")
  {
      return $this->db->query("INSERT INTO {$this->table}(username,password,foto,create_time) VALUES('$username','$password', '$fotoName', '$datetime')");
  }

  public function getById($id)
  {
    return $this->db->query("SELECT * FROM {$this->table} WHERE id=$id");
  }

  public function edit($id, $username, $password, $fotoName = "")
  {
    if ($fotoName != "") {
      $user = $this->db->query("SELECT * FROM {$this->table} WHERE id=$id");

      while ($user_data = mysqli_fetch_array($user)) {
        $foto = $user_data['foto'];
      }

      unlink("assets/foto/$foto");
      return $this->db->query("UPDATE {$this->table} SET username='$username', password='$password', foto='$fotoName' WHERE id=$id");
    } else {
      return $this->db->query("UPDATE {$this->table} SET username='$username', password='$password' WHERE id=$id");
    }
  }

  public function delete($id)
  {
    $user = $this->db->query("SELECT * FROM {$this->table} WHERE id=$id");
    while ($user_data = mysqli_fetch_array($user)) {
      $foto = $user_data['foto'];
    }

    if ($foto != "") {
      unlink("assets/foto/$foto");
    }

    $this->db->query("DELETE FROM {$this->table} WHERE id=$id");
  }
}
