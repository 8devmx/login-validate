<?php
$db = "spending_tracker";
$host = "localhost";
$user = "root";
$password = "";

try {
  $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  $username = $_POST["username"];
  $pass = $_POST["pass"];

  $query = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :username AND password = :pass");
  $query->execute(["username" => $username, ":pass" => $pass]);
  $result = $query->fetch(PDO::FETCH_ASSOC);
  echo json_encode($result);
} catch (PDOException $e) {
  echo "Hubo un error: " . $e->getMessage();
}
