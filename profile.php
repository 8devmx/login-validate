<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>Profile</title>
</head>

<body class="bg-gray">
  <div>
    <div class="card">
      <div class="card-information">
        <img src="" alt="" id="avatar">
        <input type="file" id="changeAvatar">
        <h2 id="username">8devmx</h2>
        <h3 id="rol">Developer</h3>
      </div>
      <div class="card-actions">
        <button id="btnUpdate">Actualizar</button>
        <button id="logout">Cerrar sesión</button>
      </div>
    </div>
    <form action="#" id="updateProfile">
      <div>
        <label for="usernameInput">Username</label>
        <input type="text" id="usernameInput" name="usernameInput">
      </div>
      <div>
        <label for="rolInput">Rol</label>
        <select id="rolInput" name="rolInput">
          <?php
          require_once 'data/Users.php';
          $user = new User();
          $roles = $user->getRoles();
          foreach ($roles as $rol => $row) {
          ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div>
        <button id="updateData">Actualizar Datos</button>
      </div>
    </form>
  </div>
  <script src="js/profile.js"></script>
</body>

</html>