<?php
/**
* Description of Banco
*
* @author Lawrence
*/
require_once 'ConexionBD.php';

class Egreso {

	private $idEgreso;
	private $nombre;
	private $descripcion;
	private $status;
	private $fkTipo;
	private $fecha;
	private $fkPersona;
	private $tipo;
	private $persona;



	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	public function getDescripcion()
	{
	    return $this->descripcion;
	}

	public function setDescripcion($descripcion)
	{
	    $this->descripcion = $descripcion;
	}

	public function getStatus()
	{
	    return $this->status;
	}

	public function setStatus($status)
	{
	    $this->status = $status;
	}

	public function getFkTipo()
	{
	    return $this->fkTipo;
	}

	public function setFkTipo($fkTipo)
	{
	    $this->fkTipo = $fkTipo;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getFkPersona()
	{
	    return $this->fkPersona;
	}

	public function setFkPersona($fkPersona)
	{
	    $this->fkPersona = $fkPersona;
	}
	
	public function save(Egreso $egreso)
	{
		$query = "INSERT INTO Egreso ";
		$query = $query." (nombre,descripcion,status,fecha,tipo,fkPersona) VALUES (";
		$query = $query."'".$egreso->getNombre()."', ";
		$query = $query."'".$egreso->getDescripcion()."', ";
		$query = $query.$egreso->getStatus().", ";
		$query = $query."'".$egreso->getFecha()."', ";
		$query = $query.$egreso->getFkTipo().", ";	
		$query = $query.$egreso->getFkPersona().")";
		
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
	
		$resultado=mysql_query($query,$miBD->getConexion());
		mysql_close();
		return $resultado;
	}

	public function getIdEgreso()
	{
	    return $this->idEgreso;
	}

	public function setIdEgreso($idEgreso)
	{
	    $this->idEgreso = $idEgreso;
	}

	public function getTipo()
	{
	    return $this->tipo;
	}

	public function setTipo($tipo)
	{
	    $this->tipo = $tipo;
	}

	public function getPersona()
	{
	    return $this->persona;
	}

	public function setPersona($persona)
	{
	    $this->persona = $persona;
	}
	
	public function findById($id)
	{
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
		$cuenta = null;
	
		$query = "Select e.*, p.nombre as nombPer, p.apellido as apePer, t.nombre as nomTip from Egreso e, Persona p, Tipo t WHERE e.idEgreso = $id AND e.fkPersona = p.idPersona AND e.tipo = t.idTipo  ORDER BY nombre ASC";
		$resultado = mysql_query($query,$miBD->getConexion());
		$fila = mysql_fetch_array($resultado);
		if($fila != null)
		{
			$egreso = new Egreso();
			$egreso->setIdEgreso($fila['idEgreso']);
			$egreso->setNombre($fila['nombre']);
			$egreso->setDescripcion($fila['descripcion']);
			$egreso->setFecha($fila['fecha']);
			$egreso->setFkPersona($fila['fkPersona']);
			$egreso->setStatus($fila['status']);
			$egreso->setFkTipo($fila['tipo']);
			$egreso->setPersona($fila['nombPer']." ".$fila['apePer']);
			$egreso->setTipo($fila['nomTip']);
	
		}
		mysql_close();
		return $egreso;
	
	}
	
	public function delete($id)
	{
		$query = "UPDATE Egreso SET ";
		$query = $query." status='-1' ";
		$query = $query." WHERE idEgreso= ".$id;
	
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
	
		$resultado=mysql_query($query,$miBD->getConexion());
		mysql_close();
		return $resultado;
	}
	
	public function active($id)
	{
		$query = "UPDATE Egreso SET ";
		$query = $query." status='1' ";
		$query = $query." WHERE idEgreso= ".$id;
	
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
	
		$resultado=mysql_query($query,$miBD->getConexion());
		mysql_close();
		return $resultado;
	}
	
	public function update(Egreso $egreso)
	{
		$query = "UPDATE Egreso SET ";
		$query = $query." nombre='".$egreso->getNombre()."', ";
		$query = $query." descripcion='".$egreso->getDescripcion()."', ";
		$query = $query." fecha='".$egreso->getFecha()."', ";
		$query = $query." tipo=".$egreso->getFkTipo()." ";
		$query = $query." WHERE idEgreso= ".$egreso->getIdEgreso();
	echo $query;
		$miBD = new ConexionBD();
		$miBD->setConexion($miBD->conectarBD($miBD));
	
		$resultado=mysql_query($query,$miBD->getConexion());
		mysql_close();
		return $resultado;
	}
}