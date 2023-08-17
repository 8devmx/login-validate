<?php
class User
{
  private $con;

  public function __construct()
  {
    $db = "spending_tracker";
    $host = "localhost";
    $user = "root";
    $password = "";
    try {
      $this->con = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    } catch (PDOException $e) {
      echo "Hubo un error: " . $e->getMessage();
    }
  }
  public function login()
  {
    $query = $this->con->prepare("SELECT u.id as id, u.nombre as username, r.nombre as rol, u.correo as email, u.avatar as avatar, u.rol_id FROM usuarios u LEFT JOIN roles r ON u.rol_id = r.id WHERE u.correo = :username AND u.password = :pass");
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $query->execute(["username" => $username, ":pass" => $pass]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($result);
  }
  public function getRoles()
  {
    $query = $this->con->prepare("SELECT * FROM roles");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  public function updateProfile()
  {
    $query = $this->con->prepare("UPDATE usuarios set nombre = :nombre, rol_id = :rol_id WHERE id = :id");
    $nombre = $_POST['usernameInput'];
    $rol = $_POST['rolInput'];
    $id = $_POST['id'];
    $array = ["status" => "error", "text" => "No se actualizó correctamente"];
    if ($query->execute([":nombre" => $nombre, ":rol_id" => $rol, ":id" => $id])) {
      $array = ["status" => "success", "text" => "Se actualizó satisfactoriamente"];
    }
    echo json_encode($array);
  }
  public function setAvatar()
  {
    $upload_dir = "../public/";
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = $upload_dir . $_FILES["file"]["name"];
    $response = ["status" => "error", "text" => "No se cargó correctamente"];
    if (move_uploaded_file($tmp_name, $name)) {
      $response = ["status" => "success", "text" => "Se cargó correctamente", "file" => $_FILES["file"]["name"]];
    }
    echo json_encode($response);
  }
}


if (isset($_POST) && isset($_POST['function'])) {
  $user = new User();
  switch ($_POST['function']) {
    case 'login':
      $user->login();
      break;
    case 'updateProfile':
      $user->updateProfile();
      break;
    case 'setAvatar':
      $user->setAvatar();
      break;
  }
}
