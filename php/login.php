<?php

include_once('app.php');

global $app;
$app = new App();

$app->head("Inicio de sesión", "Login");
$app->nav();

?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      User:<br>
      <input type="text" name="user"><br>
      Password:<br>
      <input type="password" name="password"><br><br>
      <input type="submit" value="Login"/>
</form> 
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST['user'];
  $password = $_POST['password'];

  if (empty($user)) {
    echo 'Debe introducir un usuario';
  } else if (empty($password)) {
    echo 'Debe introducir una contraseña';
  } else {
    //Conectar a la base de datos y comprobar si el usuario existe

    // 1.Crear conexión 
    if (is_null($app->getDao()->isConnected())) {
      $this->showErrorConnection();
    } else {
      
    }

    // Guardar sesión
    $app->init_session($user);
    echo '<script language="javascript">window.location.href="inventory.php"</script>';
    // Redireccionar a otra página
  }
}
$app->footer();
?>