<?php
/**
* Description of Banco
*
* @author Lawrence
*/
require_once 'ConexionBD.php';

class Tipo {

	private $idTipo;
	private $nombre;

	public function getIdTipo()
	{
	    return $this->idTipo;
	}

	public function setIdTipo($idTipo)
	{
	    $this->idTipo = $idTipo;
	}

	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
}