<?php
require_once 'Users.php';
$user = new User();
if (isset($_GET["id"])) {
  $user->active($_GET["id"]);
  exit();
}
echo "No tienes permisos para acceder";
