<?php

define("MYSQL_HOST", "mysql:$db;host=127.0.0.1");
define("MYSQL_USER", "www-data");
define("MYSQL_PASSWORD", "www-data");
define("DATABASE", "inventory");

/* Se define a continuación el nombre de todas las tablas */

define("TABLE_USER", user);

/* Se define a continuación las columnas de las tablas */

define("USER_NAME", username);
define("USER_PASSWORD", password);

class InventoryDao {
	protected $connect;
	public $error;

	/* Se crea un objeto de conexión a la base de datos en el constructor y se inicializaria el resto de datos */
	function __construct() {
		try {
			$connect = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
		} catch(PDOException $e) {
			$this->error = $e->getMessage();
			$this->connect = null;
		}
	}

	function __destruct() {

		if ($this->isConnected()) {
			$this->connect = null;
		}
	}

	function isConnected() {
		return ($this->connect == null);
	}

	function getConnect() {
		return $this->connect;
	}
}

?>