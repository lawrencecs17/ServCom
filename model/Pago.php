<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pago
 *
 * @author Lawrence
 */
require_once 'ConexionBD.php';

class Pago {
    
    private $fkCheque;
    private $fkFactura;
    private $tipo;
    
    public function getFkCheque() {
        return $this->fkCheque;
    }

    public function setFkCheque($fkCheque) {
        $this->fkCheque = $fkCheque;
    }

    public function getFkFactura() {
        return $this->fkFactura;
    }

    public function setFkFactura($fkFactura) {
        $this->fkFactura = $fkFactura;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
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
