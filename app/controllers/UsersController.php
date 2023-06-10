<?php

class UsersController extends Controller
{
    public function index($page = 1, $perPage = 5)
    {
        $data['title'] = 'Home';
        $data['users'] = $this->model('Users')->getAllUsers($page, $perPage);
        $totalUsers = $this->model('Users')->countAllUsers();
        $data['totalPages'] = ceil($totalUsers / $perPage);
        $data['page'] = $page;

        $this->view('partials/header', $data);
        $this->view('users/index', $data);
        $this->view('partials/footer');
    }

    public function addView()
    {
        $data['title'] = "Add User";
        
        $this->view('partials/header', $data);
        $this->view('users/add');
        $this->view('partials/footer');
    }

    public function add()
    {
        try {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $datetime = date("Y-m-d H:i:s");


            // upload file
            $extensionValid = array('png', 'jpg', 'jpeg');
            $fotoName = $username . '-' . $_FILES['foto']['name'];
            $x = explode('.', $fotoName);
            $extension = strtolower(end($x));
            $size = $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];

            if ($_FILES['foto']['name'] === "") {
                $result = $this->model('Users')->add($username, $password, $datetime);

                header("Location: " . BASEURL);
            } else if (in_array($extension, $extensionValid) === true) {
                if ($size < 1044070) {

                    // if folder not exist, create folder
                    if (!file_exists('./assets/foto')) {
                        mkdir('./assets/foto', 0777, true);

                        move_uploaded_file($file_tmp, './assets/foto/' . $fotoName);
                    } else {
                        move_uploaded_file($file_tmp, './assets/foto/' . $fotoName);
                    }


                    $result = $this->model('Users')->add($username, $password, $datetime, $fotoName);

                    if ($result) {
                        header("Location: " . BASEURL);
                    } else {
                        $error =  'Failed Upload File';
                    }
                } else {
                    $error = 'Size file Should be less than 1 MB';
                }
            } else {
                $error = 'Only JPG and PNG file are allowed';
            }
        } catch (mysqli_sql_exception $ex) {
            if ($ex->getCode() === 1062) {
                $error = "Username already exists. Please choose a different username. <a href='users.php'>View Users</a>";
                echo "<script>var errorMessage = " . json_encode($error) . ";</script>";
                die($error);
            } else {
                echo 'Error: ' . $ex->getMessage();
            }
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Detail User';
        $data['users'] = $this->model('Users')->getById($id);
        $this->view('partials/header', $data);
        $this->view('users/edit', $data);
        $this->view('partials/footer');
    }

    public function edit($id)
    {
        try {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // upload file
            $extensionValid = array('png', 'jpg', 'jpeg');
            $fotoName = $username . '-' . $_FILES['foto']['name'];
            $x = explode('.', $fotoName);
            $extension = strtolower(end($x));
            $size = $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];

            if ($_FILES['foto']['name'] === "") {
                $result = $this->model('Users')->edit($id, $username, $password);

                header("Location: " . BASEURL);
            } else if (in_array($extension, $extensionValid) === true) {
                if ($size < 1044070) {

                    // if folder not exist, create folder
                    if (!file_exists('./assets/foto')) {
                        mkdir('./assets/foto', 0777, true);

                        move_uploaded_file($file_tmp, './assets/foto/' . $fotoName);
                    } else {
                        move_uploaded_file($file_tmp, './assets/foto/' . $fotoName);
                    }

                    $result = $this->model('Users')->edit($id, $username, $password, $fotoName);

                    if ($result) {
                        header("Location: " . BASEURL);
                    } else {
                        $error =  'Failed Upload File';
                    }
                } else {
                    $error = 'Size file Should be less than 1 MB';
                }
            } else {
                $error = 'Only JPG and PNG file are allowed';
            }
        } catch (mysqli_sql_exception $ex) {
            if ($ex->getCode() === 1062) {
                $error = "Username already exists. Please choose a different username. <a href='users.php'>View Users</a>";
                echo "<script>var errorMessage = " . json_encode($error) . ";</script>";
                die($error);
            } else {
                echo 'Error: ' . $ex->getMessage();
            }
        }
    }

    public function delete($id)
    {
        $this->model('Users')->delete($id);

        header("Location: " . BASEURL);
    }
}
