<div class="container">
    <header>
        <nav id="navbar">
            <ul>
                <li><a href="<?= BASEURL ?>/UsersController/addView">Add New User</a><br /><br /></li>
                <li><a href="<?= BASEURL ?>/AuthController/logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div id="content">

        <table border="2" width="100%" class="table-green">
            <tr>
                <th>
                    <p class="text-black">Username</p>
                </th>
                <th>
                    <p class="text-black">Password</p>
                </th>
                <th>
                    <p class="text-black">Foto</p>
                </th>
                <th>
                    <p class="text-black">Action</p>
                </th>
            </tr>

            <?php
            while ($user_data = mysqli_fetch_array($data['users'])) {
            ?>
                <tr>
                    <td>
                        <p class="text-black"><?= $user_data['username'] ?></p>
                    </td>
                    <td>
                        <p class="text-black"><?= $user_data['password'] ?>
                    </td>
                    <td><img src="<?= BASEURL ?>/assets/foto/<?= $user_data['foto'] ?>" alt="<?= $user_data['foto'] ?>" width="100px"></td>
                    <td><a class="text-black" href="<?= BASEURL ?>/UsersController/detail/<?= $user_data['id'] ?>">Edit</a> <span class="text-dark-green" style="font-size: 5vh;text-align: center;vertical-align: middle;">|</span> <a class="text-black" href="<?= BASEURL ?>/UsersController/delete/<?= $user_data['id'] ?>">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </table>

        <nav id="navbar">
            <ul>
                <?php
                for ($i = 1; $i <= $data['totalPages']; $i++) {
                ?>
                    <li>
                        <a href="<?= BASEURL ?>/UsersController/index/<?= $i ?>" class="<?= $data['page'] == $i ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</div>