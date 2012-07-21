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
    private $fkFundacion;
    
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


}

?>
