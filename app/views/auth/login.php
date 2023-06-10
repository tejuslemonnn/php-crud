<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<div class="container">
    <div class="card">
        <div class="card-content">
                <h3 style="font-size: 2rem;">Login</h3>
            <form method="POST" action="<?= BASEURL; ?>/AuthController/login">
                <?php if (isset($error)): ?>
                    <div class="error" style="margin:5px 0;color: red"><?= $error; ?></div>
                <?php endif; ?>

                <div class="input-group">
                    <input class="form-input" type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <input class="form-input" type="password" placeholder="Password" name="password"
                           required>
                </div>
                <div class="input-group">
                    <button name="submit" class="pixell-button" style="width: 100%">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>