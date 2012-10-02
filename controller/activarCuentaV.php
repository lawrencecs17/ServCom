<?php


//Se incluye una clase Panel, para el manejo dinamico de contenidos
require_once ("../lib/Panel.php");
require_once '../model/Persona.php';
require_once '../model/Cuenta.php';
require_once '../model/Banco.php';
require_once '../model/ArrayList.php';
require_once '../model/ConexionBD.php';

// CONSTANTES

$ACTION="activarCuenta.php";
$TITULO="Activar Cuenta";
$TITULO_COMBO_BOX="Seleccione Cuenta";
$LOCATION="gestionCuentaV.php";

//Se asigna a esta variable el archivo plantilla del home
$pnlmain = new Panel("../view/index.html");

//Se buscan los datos del usuario que ha iniciado sesion
session_start();
$user = new Persona();
$user = $user->findByCedula($_SESSION["usuario"]);
$pnlmain->add("username",$user->getUsername());

//Se procede la asignación
$pnlcontent = new Panel("../view/busquedaUsuario.html");

/****************************/
$miBD = new ConexionBD();
$miBD->setConexion($miBD->conectarBD($miBD));
$banco = null;
$comboBox="";
//Se listan todos los bancos INACTIVOS
$query = "Select *, b.nombre as nombreBanco from Cuenta c, Banco b WHERE c.status = -1 AND c.fkBanco = b.idBanco ";
$resultado = mysql_query($query,$miBD->getConexion());
while($fila = mysql_fetch_array($resultado))
{
	$cuenta = new Cuenta();
	$cuenta->setIdCuenta($fila['idCuenta']);
	$cuenta->setCodigoCliente($fila['codigoCliente']);
	$cuenta->setTitular($fila['titular']);
	$cuenta->setFkBanco($fila['fkBanco']);
	$cuenta->setBanco($fila['nombreBanco']);

	$comboBox =$comboBox."<OPTION VALUE=".$cuenta->getIdCuenta().">".$cuenta->getCodigoCliente()." - ".$cuenta->getBanco()."</OPTION> ";

}
mysql_close();

/****************************/
$pnlcontent->add("action",$ACTION);
$pnlcontent->add("titulo",$TITULO);
$pnlcontent->add("tituloComboBox",$TITULO_COMBO_BOX);
$pnlcontent->add("location",$LOCATION);
$pnlcontent->add("listUsuario",$comboBox);
$pnlmain->add("content",$pnlcontent);
$pnlmain->show();
?>