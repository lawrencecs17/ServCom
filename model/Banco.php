<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banco
 *
 * @author Lawrence
 */
require_once 'ConexionBD.php';

class Banco {
    
    private $idBanco;
    private $nombre;
    private $direccion;
    private $telefono;
    private $status;
    private $fkFundacion;
    
    public function getStatus() {
    	return $this->status;
    }
    
    public function setStatus($status) {
    	$this->status = $status;
    }
    
    public function getIdBanco() {
        return $this->idBanco;
    }

    public function setIdBanco($idBanco) {
        $this->idBanco = $idBanco;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getFkFundacion() {
        return $this->fkFundacion;
    }

    public function setFkFundacion($fkFundacion) {
        $this->fkFundacion = $fkFundacion;
    }
    
    public function testConsulta()
    {
        $miBD = new ConexionBD();
        $miBD->setConexion($miBD->conectarBD($miBD));
        
        $query = "Select * from banco";
        $resultado = mysql_query($query,$miBD->getConexion());
        
        while($fila = mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo "<td>Id: ".$fila['idBanco']."</td></br>";
            echo "<td>Nombre: ".$fila['nombre']."</td></br>";
            echo "<td>Direccion: ".$fila['direccion']."</td></br>";
            echo "<td>Telefono: ".$fila['telefono']."</td></br>";
            echo "<td>FkFundacion: ".$fila['fkFundacion']."</td></br>";
            echo "</tr></br>";
        }
    }
    
    public function registrar(Banco $banco)
    {
    	$query = "INSERT INTO Banco ";
    	$query = $query." (nombre,telefono,direccion,status,fkFundacion) VALUES (";
    	$query = $query."'".$banco->getNombre()."',";
    	$query = $query."'".$banco->getTelefono()."',";
    	$query = $query."'".$banco->getDireccion()."',";
    	$query = $query.$banco->getStatus().",";
    	$query = $query.$banco->getFkFundacion().")";
    	 
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	 
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }
    
    public function findByName($name)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$banco = null;
    
    	$query = "Select * from Banco Where nombre = '$name'";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$banco = new Banco();
    		$banco->setIdBanco($fila['idBanco']);
    		$banco->setNombre($fila['nombre']);
    		$banco->setDireccion($fila['direccion']);
    		$banco->setTelefono($fila['telefono']);
    		$banco->setStatus($fila['telefono']);
    		$banco->setFkFundacion($fila['fkFundacion']);
    	}
    	mysql_close();
    	return $banco;
    
    }
    
    public function findById($id)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$banco = null;
    
    	$query = "Select * from Banco Where idBanco = $id";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$banco = new Banco();
    		$banco->setIdBanco($fila['idBanco']);
    		$banco->setNombre($fila['nombre']);
    		$banco->setDireccion($fila['direccion']);
    		$banco->setTelefono($fila['telefono']);
    		$banco->setStatus($fila['status']);
    		$banco->setFkFundacion($fila['fkFundacion']);
    	}
    	mysql_close();
    	return $banco;
    
    }
    
    public function delete($id)
    {
    	$query = "UPDATE Banco SET ";
    	$query = $query." status='-1' ";
    	$query = $query." WHERE idBanco= ".$id;
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }
    
    public function active($id)
    {
    	$query = "UPDATE Banco SET ";
    	$query = $query." status='1' ";
    	$query = $query." WHERE idBanco= ".$id;
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }


}

?>
