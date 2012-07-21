<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cheque
 *
 * @author Lawrence
 */
require_once 'ConexionBD.php';
class Cheque {
    
    private $idCheque;
    private $monto;
    private $beneficiario;
    private $fechaEmision;
    private $fkCuenta;
    private $fkPersona;
    
    public function getIdCheque() {
        return $this->idCheque;
    }

    public function setIdCheque($idCheque) {
        $this->idCheque = $idCheque;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function getBeneficiario() {
        return $this->beneficiario;
    }

    public function setBeneficiario($beneficiario) {
        $this->beneficiario = $beneficiario;
    }

    public function getFechaEmision() {
        return $this->fechaEmision;
    }

    public function setFechaEmision($fechaEmision) {
        $this->fechaEmision = $fechaEmision;
    }

    public function getFkCuenta() {
        return $this->fkCuenta;
    }

    public function setFkCuenta($fkCuenta) {
        $this->fkCuenta = $fkCuenta;
    }

    public function getFkPersona() {
        return $this->fkPersona;
    }

    public function setFkPersona($fkPersona) {
        $this->fkPersona = $fkPersona;
    }
    
    public function testConsulta()
    {
        $miBD = new ConexionBD();
        $miBD->setConexion($miBD->conectarBD($miBD));
        
        $query = "Select * from cheque";
        $resultado = mysql_query($query,$miBD->getConexion());
        
        while($fila = mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo "<td>Id: ".$fila['idCheque']."</td></br>";
            echo "<td>Monto: ".$fila['monto']."</td></br>";
            echo "<td>Beneficiario: ".$fila['beneficiario']."</td></br>";
            echo "<td>FkPersona: ".$fila['fkPersona']."</td></br>";
            echo "<td>FkCuenta: ".$fila['fkCuenta']."</td></br>";
            echo "</tr></br>";
        }
    }


}

?>
