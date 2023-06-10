<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<div class="card">
  <div class="card-content">
    <?php
    while ($user_data = mysqli_fetch_array($data['users'])) {
    ?>
      <form action="<?= BASEURL ?>/UsersController/edit/<?= $user_data['id'] ?>" method="post" enctype="multipart/form-data">
        <?php if (isset($error)) : ?>
          <div class="error" style="margin:5px 0;color: red"><?php echo $error; ?></div>
        <?php endif; ?>

        <label for="username">Username</label>
        <input type="text" name="username" value=<?= $user_data['username']; ?>>

        <label for="password">Password</label>
        <input type="password" name="password">

        <label for="foto">Foto</label>
        <img src="<?= BASEURL ?>/assets/foto/<?= $user_data['foto'] ?>" alt="<?= $user_data['foto'] ?>" id="preview-img" style="width: 100px;height:auto;display:block;margin: 15px 0;">
        <div id="preview"></div>
        <input type="file" name="foto" id="foto">

        <div style="display: flex;justify-content: end">
          <a class="btn" href="<?= BASEURL ?>" style="margin-right: 10px">Back</a>
          <button name="Submit" class="pixell-button">Button</button>
        </div>
      </form>
    <?php
    }
    ?>
  </div>
</div>

<script>
  function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function(event) {
        var imageInput = document.getElementById('preview-img');
        imageInput.setAttribute('src', event.target.result);
      };
      fileReader.readAsDataURL(fileInput.files[0]);
    }
  }

  var imageInput = document.getElementById('foto');
  imageInput.addEventListener('change', function() {
    imagePreview(this);
  });
</script>