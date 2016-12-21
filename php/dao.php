<?php

define('MYSQL_DSN', 'mysql:dbname=inventory;host=127.0.0.1');
define('MYSQL_USER', 'www-data');
define('MYSQL_PASSWORD', 'www-data');
define('DATABASE', 'inventory');

/* Se define a continuación el nombre de todas las tablas */

define('TABLE_USER', 'User');

/* Se define a continuación las columnas de las tablas */

define('USER_NAME', 'username');
define('USER_PASSWORD', 'password');

class InventoryDao {
	protected $connect;
	public $error;

	/* Se crea un objeto de conexión a la base de datos en el constructor y se inicializaria el resto de datos */
	function __construct() {
		try {
			$this->connect = new PDO(MYSQL_DSN, MYSQL_USER, MYSQL_PASSWORD);
		} catch(PDOException $e) {
			$this->error = $e->getMessage();
			$this->connect = false;
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

	function checkUser($username, $password) {

		$result = false;

		$sql = "SELECT * FROM ".TABLE_USER." WHERE ".USER_NAME." = '".$username."' AND ".USER_PASSWORD." = sha1('".$password."');";

		$statement = $this->connect->query($sql);
		$aResult = $statement->fetch(PDO::FETCH_ASSOC);

		if (count($aResult) > 0) {
			$result = true;
		}
		$statement = null;
		return $result;
	}
}

?>