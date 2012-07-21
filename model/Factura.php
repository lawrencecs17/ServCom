<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Factura
 *
 * @author Lawrence
 */
require_once 'ConexionBD.php';

class Factura {
    
    private $idFactura;
    private $noFactura;
    private $noControl;
    private $rif;
    private $emisor;
    private $fechaEmision;
    private $comprador;
    private $descripcion;
    private $estatus;
    private $totalFactura;
    private $ajuste;
    private $baseImponible;
    private $iva;
    private $cantidad;
    private $monto;
    private $precionUnitario;
    private $fkEgreso;
    private $fkPersona;
    
    public function getRif() {
        return $this->rif;
    }

    public function setRif($rif) {
        $this->rif = $rif;
    }

        
    public function getMonto() {
        return $this->monto;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

        
    public function getIdFactura() {
        return $this->idFactura;
    }

    public function setIdFactura($idFactura) {
        $this->idFactura = $idFactura;
    }

    public function getNoFactura() {
        return $this->noFactura;
    }

    public function setNoFactura($noFactura) {
        $this->noFactura = $noFactura;
    }

    public function getNoControl() {
        return $this->noControl;
    }

    public function setNoControl($noControl) {
        $this->noControl = $noControl;
    }

    public function getEmisor() {
        return $this->emisor;
    }

    public function setEmisor($emisor) {
        $this->emisor = $emisor;
    }

    public function getFechaEmision() {
        return $this->fechaEmision;
    }

    public function setFechaEmision($fechaEmision) {
        $this->fechaEmision = $fechaEmision;
    }

    public function getComprador() {
        return $this->comprador;
    }

    public function setComprador($comprador) {
        $this->comprador = $comprador;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getEstatus() {
        return $this->estatus;
    }

    public function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    public function getTotalFactura() {
        return $this->totalFactura;
    }

    public function setTotalFactura($totalFactura) {
        $this->totalFactura = $totalFactura;
    }

    public function getAjuste() {
        return $this->ajuste;
    }

    public function setAjuste($ajuste) {
        $this->ajuste = $ajuste;
    }

    public function getBaseImponible() {
        return $this->baseImponible;
    }

    public function setBaseImponible($baseImponible) {
        $this->baseImponible = $baseImponible;
    }

    public function getIva() {
        return $this->iva;
    }

    public function setIva($iva) {
        $this->iva = $iva;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getPrecionUnitario() {
        return $this->precionUnitario;
    }

    public function setPrecionUnitario($precionUnitario) {
        $this->precionUnitario = $precionUnitario;
    }

    public function getFkEgreso() {
        return $this->fkEgreso;
    }

    public function setFkEgreso($fkEgreso) {
        $this->fkEgreso = $fkEgreso;
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
        
        $query = "Select * from factura";
        $resultado = mysql_query($query,$miBD->getConexion());
        
        while($fila = mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo "<td>Id: ".$fila['idFactura']."</td></br>";
            echo "<td>noFactura: ".$fila['noFactura']."</td></br>";
            echo "<td>noControl: ".$fila['noControl']."</td></br>";
            echo "<td>Emisor: ".$fila['emisor']."</td></br>";
            echo "<td>fechaEmision: ".$fila['fechaEmision']."</td></br>";
            echo "<td>comprador: ".$fila['comprador']."</td></br>";
            echo "<td>descripcion: ".$fila['descripcion']."</td></br>";
            echo "<td>estatus: ".$fila['estatus']."</td></br>";
            echo "<td>totalFactura: ".$fila['totalFactura']."</td></br>";
            echo "<td>ajuste: ".$fila['ajuste']."</td></br>";
            echo "<td>baseImponible: ".$fila['baseImponible']."</td></br>";
            echo "<td>Iva: ".$fila['iva']."</td></br>"; 
            echo "<td>Cantidad: ".$fila['cantidad']."</td></br>";
            echo "<td>PrecioUnitario: ".$fila['iva']."</td></br>";
            echo "<td>Rif: ".$fila['rif']."</td></br>";
            echo "<td>fkPersona: ".$fila['fkPersona']."</td></br>";
            echo "<td>fkEgreso: ".$fila['fkEgreso']."</td></br>";
            echo "</tr></br>";
        }
    }


    
}

?>
