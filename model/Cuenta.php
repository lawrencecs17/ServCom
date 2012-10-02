<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cuenta
 *
 * @author Lawrence
 */
require_once 'ConexionBD.php';

class Cuenta {
    
    private $idCuenta;
    private $codigoCliente;
    private $titular;
    private $tipo;
    private $status;
    private $fkBanco;
    private $banco;
    
    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

        
    public function getIdCuenta() {
        return $this->idCuenta;
    }

    public function setIdCuenta($idCuenta) {
        $this->idCuenta = $idCuenta;
    }

    public function getCodigoCliente() {
        return $this->codigoCliente;
    }

    public function setCodigoCliente($codigoCliente) {
        $this->codigoCliente = $codigoCliente;
    }

    public function getTitular() {
        return $this->titular;
    }

    public function setTitular($titular) {
        $this->titular = $titular;
    }

    public function getFkBanco() {
        return $this->fkBanco;
    }

    public function setFkBanco($fkBanco) {
        $this->fkBanco = $fkBanco;
    }
    
    public function testConsulta()
    {
        $miBD = new ConexionBD();
        $miBD->setConexion($miBD->conectarBD($miBD));
        
        $query = "Select * from cuenta";
        $resultado = mysql_query($query,$miBD->getConexion());
        
        while($fila = mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo "<td>Id: ".$fila['idCuenta']."</td></br>";
            echo "<td>Nombre: ".$fila['codigoCliente']."</td></br>";
            echo "<td>Direccion: ".$fila['titular']."</td></br>";
            echo "<td>Tipo de Cuenta: ".$fila['tipo']."</td></br>";
            echo "<td>FkBanco: ".$fila['fkBanco']."</td></br>";
            echo "</tr></br>";
        }
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function findByNoCuenta($noCuenta)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$cuenta = null;
    
    	$query = "Select * from Cuenta Where codigoCliente = '$noCuenta'";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$cuenta = new Cuenta();
    		$cuenta->setIdCuenta($fila['idCuenta']);
    		$cuenta->setCodigoCliente($fila['codigoCliente']);
    		$cuenta->setTitular($fila['titular']);
    		$cuenta->setStatus($fila['status']);
    		$cuenta->setFkBanco($fila['fkBanco']);
    		
    	}
    	mysql_close();
    	return $cuenta;
    
    }
    
    public function findByNoCuentaAndBanco($noCuenta, $fkBanco)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$cuenta = null;
    
    	$query = "Select * from Cuenta Where codigoCliente = '$noCuenta' AND fkBanco='$fkBanco'";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$cuenta = new Cuenta();
    		$cuenta->setIdCuenta($fila['idCuenta']);
    		$cuenta->setCodigoCliente($fila['codigoCliente']);
    		$cuenta->setTitular($fila['titular']);
    		$cuenta->setStatus($fila['status']);
    		$cuenta->setFkBanco($fila['fkBanco']);
    
    	}
    	mysql_close();
    	return $cuenta;
    
    }
    
    public function findById($id)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$cuenta = null;
    
    	$query = "Select c.*,b.nombre as nombreBanco from Cuenta c, Banco b Where idCuenta = $id AND c.fkBanco = b.idBanco ";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$cuenta = new Cuenta();
    		$cuenta->setIdCuenta($fila['idCuenta']);
    		$cuenta->setCodigoCliente($fila['codigoCliente']);
    		$cuenta->setTitular($fila['titular']);
    		$cuenta->setStatus($fila['status']);
    		$cuenta->setFkBanco($fila['fkBanco']);
    		$cuenta->setBanco($fila['nombreBanco']);
    
    	}
    	echo $query;
    	mysql_close();
    	return $cuenta;
    
    }
    
    
    
    public function registrar(Cuenta $cuenta)
    {
    	$query = "INSERT INTO Cuenta ";
    	$query = $query." (codigoCliente,titular,status,fkBanco) VALUES (";
    	$query = $query."'".$cuenta->getCodigoCliente()."',";
    	$query = $query."'".$cuenta->getTitular()."',";
    	$query = $query."'".$cuenta->getStatus()."',";
    	$query = $query.$cuenta->getFkBanco().")";
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }
    
    public function active($id)
    {
    	$query = "UPDATE Cuenta SET ";
    	$query = $query." status='1' ";
    	$query = $query." WHERE idCuenta= ".$id;
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }
    
    public function delete($id)
    {
    	$query = "UPDATE Cuenta SET ";
    	$query = $query." status='-1' ";
    	$query = $query." WHERE idCuenta= ".$id;
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }

    public function getBanco()
    {
        return $this->banco;
    }

    public function setBanco($banco)
    {
        $this->banco = $banco;
    }
}

?>
