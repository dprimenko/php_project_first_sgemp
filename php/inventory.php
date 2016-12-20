<?php

include_once('app.php');

global $app;

$app = new App();
$app->redirect();

$app->head("Inicio de sesión", "Login");
$app->nav();
$app->footer();

echo '
	<p>Te has logueado correctamente</p> 
'

?>