<?php


//Se incluye una clase Panel, para el manejo dinamico de contenidos
require_once ("../lib/Panel.php");
require_once '../model/Persona.php';
require_once '../model/Banco.php';
require_once '../model/ArrayList.php';
require_once '../model/ConexionBD.php';

// CONSTANTES

$ACTION="eliminarBanco.php";
$TITULO="Bloquear Banco";
$TITULO_COMBO_BOX="Seleccione Banco";
$LOCATION="gestionBancoV.php";

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
//Se listan todos los bancos ACTIVOS
$query = "Select * from Banco WHERE status <> -1 ORDER BY nombre ASC";
$resultado = mysql_query($query,$miBD->getConexion());
while($fila = mysql_fetch_array($resultado))
{
	$banco = new Banco();
	$banco->setIdBanco($fila['idBanco']);
	$banco->setNombre($fila['nombre']);
	$banco->setDireccion($fila['direccion']);
	$banco->setTelefono($fila['telefono']);
	$banco->setFkFundacion($fila['fkFundacion']);

	$comboBox =$comboBox."<OPTION VALUE=".$banco->getIdBanco().">".$banco->getNombre()."</OPTION> ";

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