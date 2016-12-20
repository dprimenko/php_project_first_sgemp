<?php

include('dao.php');

session_start();

/*
Este fichero va a contener funciones que se utilizarán
en otros ficheros php.
*/

class App {

	protected $dao;

	function __construct() {
		$this->dao = InventoryDao();
	}

	function getDao() {
		return $this->dao;
	}

	function head($titulo="", $h1="", $h2=null) {
		echo "
        <!DOCTYPE html>
        <html lang=\"es\">
        <head>
              <meta charset=\"utf-8\"/>
              <title>$titulo</title>
              <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\" />
        </head>
        <body>

        <!-- Cabecera -->
        <header>
            <h1>$h1</h1>
            <h2>$h2</h2>
        </header>
        ";
    }
    function nav() {
        echo '
        <!-- Navegacion -->
        <nav>
            <ul>';
        if ($this->isLogged()) {
        	echo '<li><a href="logout.php">Logout</a></li>';  
        }          
        echo '
        	</ul>
        </nav>
        <div id=\"content\">
        ';
    }
	function footer() {
		echo '
		</div>
			<!-- Pie de pagina -->
			<footer>
				<p>Pagina realizada por: David Primenko</p>
			</footer>
		</body>
        </html>';
	}

	function redirect() {
		if (!$this->isLogged()) {
			header("Location: login.php");
		}
	}

	/*
    Función que comprueba si el usuario ha iniciado sesión
	*/

    function isLogged() {

		$result = false;

		if(isset($_SESSION['user'])) {
			$result = true;
		}

		return $result;
	}

	function login($user, $password) {

		$result = false;

		if(isset($_SESSION['user']) && isset($_SESSION['passw'])) {
			$result = true;
		}

		return $result;
	}

	function init_session($user) {
		if (!isset($_SESSION['user'])) {
			$_SESSION['user'] = $user;
		}
	}

	function destroy_session() {
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
			
			session_destroy();
			header("Location: ../index.php");
		}
	}

	function showErrorConnection() {
		$this->head();
		echo "<p>".$this->getDao()->error."</p>";
		$this->footer();
	}
}
?>