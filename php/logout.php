<?php

include_once "app.php";

global $app;

$app = new App();

$app->destroy_session();
?>