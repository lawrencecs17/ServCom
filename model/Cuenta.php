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
    private $fkBanco;
    
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

}

?>
