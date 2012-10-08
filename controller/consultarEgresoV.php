<?php


//Se incluye una clase Panel, para el manejo dinamico de contenidos
require_once ("../lib/Panel.php");
require_once '../model/Persona.php';
require_once '../model/Egreso.php';
require_once '../model/ArrayList.php';
require_once '../model/ConexionBD.php';

// CONSTANTES

$ACTION="consultarEgreso.php";
$TITULO="Consultar Egreso";
$TITULO_COMBO_BOX="Seleccione Egreso";
$LOCATION="gestionEgresoV.php";

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
$query = "Select e.*, p.nombre as nombPer, p.apellido as apePer, t.nombre as nomTip from Egreso e, Persona p, Tipo t WHERE  e.fkPersona = p.idPersona AND e.tipo = t.idTipo  ORDER BY nombre ASC";
$resultado = mysql_query($query,$miBD->getConexion());
while($fila = mysql_fetch_array($resultado))
{
	$egreso = new Egreso();
	$egreso->setIdEgreso($fila['idEgreso']);
	$egreso->setNombre($fila['nombre']);
	$egreso->setDescripcion($fila['descripcion']);
	$egreso->setFecha($fila['fecha']);
	$egreso->setFkPersona($fila['fkPersona']);
	$egreso->setStatus($fila['status']);
	$egreso->setFkTipo($fila['fkTipo']);
	$egreso->setPersona($fila['nombPer']." ".$fila['apePer']);
	$egreso->setTipo($fila['nomTip']);
	
	$comboBox =$comboBox."<OPTION VALUE=".$egreso->getIdEgreso().">".$egreso->getNombre()."</OPTION> ";

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