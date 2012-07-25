<?php

/**
 * Description of ConexionBD
 *
 * @author Lawrence Cermeño
 */
class ConexionBD {

	private $dbhost;
	private $dbusuario;
	private $dbpassword;
	private $db;
	private $conexion;

	function __construct() {
		$this->setDbhost("localhost");
		$this->setDb("julieta");
		$this->setDbpassword("1234");
		$this->setDbusuario("root");
		$this->setConexion(null);
	}

	public function getConexion() {
		return $this->conexion;
	}

	public function setConexion($conexion) {
		$this->conexion = $conexion;
	}


	public function getDbhost() {
		return $this->dbhost;
	}

	public function setDbhost($dbhost) {
		$this->dbhost = $dbhost;
	}

	public function getDbusuario() {
		return $this->dbusuario;
	}

	public function setDbusuario($dbusuario) {
		$this->dbusuario = $dbusuario;
	}

	public function getDbpassword() {
		return $this->dbpassword;
	}

	public function setDbpassword($dbpassword) {
		$this->dbpassword = $dbpassword;
	}

	public function getDb() {
		return $this->db;
	}

	public function setDb($db) {
		$this->db = $db;
	}

	public function conectarBD(ConexionBD $miBD) {
			
		$miBD->setConexion(mysql_connect($miBD->getDbhost(),$miBD->getDbusuario(),$miBD->getDbpassword()));

		if (!$miBD->getConexion())
		{
			echo "<h1>Falla en la conexion con la Base de Datos. Contactar al Administrador.</h1>";
		}
		else
		{
			mysql_select_db($miBD->getDb(),$miBD->getConexion()) or
			die (" <h1>Base de Datos no encontrada</h1>");
		}
		return $miBD->getConexion();

	}


}
?>