<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<div class="card">
  <div class="card-content">
    <form action="<?= BASEURL ?>/UsersController/add" method="post" enctype="multipart/form-data">
      <?php if (isset($error)) : ?>
        <div class="error" style="margin:5px 0;color: red"><?php echo $error; ?></div>
      <?php endif; ?>

      <label for="username">Username</label>
      <input type="text" name="username" id="username" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <label for="foto">Foto</label>
      <div id="preview"></div>
      <input type="file" name="foto" id="foto">

      <div style="display: flex;justify-content: end">
        <a class="btn" href="<?= BASEURL; ?>" style="margin-right: 10px">Back</a>
        <button name="Submit" class="pixell-button">Button</button>
      </div>
    </form>
  </div>
</div>

<script>
  function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function(event) {
        var previewImage = document.createElement('img');
        previewImage.src = event.target.result;
        previewImage.style.width = '100px';
        previewImage.style.height = 'auto';

        var previewElement = document.getElementById('preview');
        previewElement.innerHTML = '';
        previewElement.appendChild(previewImage);
      };
      fileReader.readAsDataURL(fileInput.files[0]);
    }
  }

  var imageInput = document.getElementById('foto');
  imageInput.addEventListener('change', function() {
    imagePreview(this);
  });
</script>