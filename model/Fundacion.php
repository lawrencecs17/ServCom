<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fundacion
 *
 * @author Lawrence
 */
 require_once 'ConexionBD.php';
 
class Fundacion {
    
    private $idFundacion;
    private $rif; 
    private $nombre;
    private $telefono;
    private $direccion;
    private $email;
    
    public function getRif() {
    	return $this->rif;
    }
    
    public function setRif($rif) {
    	$this->rif = $rif;
    }
    
    public function getIdFundacion() {
        return $this->idFundacion;
    }

    public function setIdFundacion($idFundacion) {
        $this->idFundacion = $idFundacion;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function testConsulta()
    {
        $miBD = new ConexionBD();
        $miBD->setConexion($miBD->conectarBD($miBD));
        
        $query = "Select * from fundacion";
        $resultado = mysql_query($query,$miBD->getConexion());
        
        while($fila = mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo "<td>Id: ".$fila['idFundacion']."</td></br>";
            echo "<td>Nombre: ".$fila['nombre']."</td></br>";
            echo "<td>Telefono: ".$fila['telefono']."</td></br>";
            echo "<td>Direccion: ".$fila['direccion']."</td></br>";
            echo "<td>Email: ".$fila['email']."</td></br>";
            echo "</tr></br>";
        }
    }
    
    public function findByRif($rif)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$fundacion = null;
    
    	$query = "Select * from Fundacion Where rif = '$rif'";
    
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$fundacion = new Fundacion();
    		$fundacion->setIdFundacion($fila['idFundacion']);
    		$fundacion->setNombre($fila['nombre']);;
    		$fundacion->setTelefono($fila['telefono']);
    		$fundacion->setEmail($fila['email']);
    		$fundacion->setRif($fila['rif']);
    		$fundacion->setDireccion($fila['direccion']);
    	}
    	mysql_close();
    	return $fundacion;
    
    }
    
    public function findById($id)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$fundacion = null;
    
    	$query = "Select * from Fundacion Where idFundacion = '$id'";
    
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$fundacion = new Fundacion();
    		$fundacion->setIdFundacion($fila['idFundacion']);
    		$fundacion->setNombre($fila['nombre']);;
    		$fundacion->setTelefono($fila['telefono']);
    		$fundacion->setEmail($fila['email']);
    		$fundacion->setRif($fila['rif']);
    		$fundacion->setDireccion($fila['direccion']);
    	}
    	mysql_close();
    	return $fundacion;
    
    }
    
    public function findByEmail($email)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$fundacion = null;
    
    	$query = "Select * from Fundacion Where email = '$email'";
    
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$fundacion = new Fundacion();
    		$fundacion->setIdFundacion($fila['idFundacion']);
    		$fundacion->setNombre($fila['nombre']);;
    		$fundacion->setTelefono($fila['telefono']);
    		$fundacion->setEmail($fila['email']);
    		$fundacion->setRif($fila['rif']);
    		$fundacion->setDireccion($fila['direccion']);
    	}
    	mysql_close();
    	return $fundacion;
    
    }
    
    public function registrar($fundacion)
    {   
    	$query = "INSERT INTO Fundacion (nombre,telefono,email,rif,direccion) VALUES (";
    	$query = $query." '".$fundacion->getNombre()."', ";
    	$query = $query." '".$fundacion->getTelefono()."', ";
    	$query = $query." '".$fundacion->getEmail()."', ";
    	$query = $query." '".$fundacion->getRif()."', ";
    	$query = $query." '".$fundacion->getDireccion()."' ";
    	$query = $query." )";
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	
    	$resultado=mysql_query($query,$miBD->getConexion());    	
    	mysql_close();
    	return $resultado;
    
    }
    
    public function update($fundacion)
    {
    	$query = "UPDATE Fundacion SET ";
    	$query = $query." nombre='".$fundacion->getNombre()."', ";
    	$query = $query." telefono='".$fundacion->getTelefono()."', ";
    	$query = $query." email='".$fundacion->getEmail()."', ";
    	$query = $query." rif='".$fundacion->getRif()."', ";
    	$query = $query." direccion='".$fundacion->getDireccion()."' ";
    	$query = $query." WHERE idFundacion= ".$fundacion->getIdFundacion();
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	echo $query;
    	return $resultado;
    }


}

?>
