<?php

require_once '../model/Egreso.php';
require_once '../model/Persona.php';
require_once '../model/Validacion.php';
require_once '../lib/Panel.php';

//CONSTANTES
$STATUS="1";
$LOCATION="gestionEgresoV.php";

$validacion = new Validacion();
$correcto 	= true;
$alert_text = "*Caracteres invalidos, no admitido acentos, ñ o simbolos  ";
$alert_email= "*Email incorrecto";
$alert_num  = "*No es un numero";
$alert_repeat="*Ya existe en nuestra Base de Datos";
$alert_null="*Debe seleccionar una opcion valida";
$TITULO = "Registro de Egreso";

$nombre 	 	= $_POST['nombre'];
$descripcion 	= $_POST['descripcion'];
$fkTipo 		= $_POST['tipo'];
$list			= $_POST['list'];
$fecha			= $_POST['fecha'];

$pnlmain = new Panel("../view/index.html");

//Se buscan los datos del usuario que ha iniciado sesion
session_start();
$user = new Persona();
$user = $user->findByCedula($_SESSION["usuario"]);
$pnlmain->add("username",$user->getUsername());

$pnlcontent = new Panel("../view/registrarEgreso.html");
$pnlcontent->add("titulo",$TITULO);

//Validacion de los campos


if($validacion->nombreValido($nombre)==false)
{
	$pnlcontent->add("alert_nombre", $alert_text);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("nombre", $nombre);
}


if($validacion->textValido($descripcion)==false)
{
	$pnlcontent->add("alert_descripcion", $alert_text);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("descripcion", $descripcion);
}
if($fkTipo == 0)
{
	$pnlcontent->add("alert_tipo", $alert_null);
	$pnlcontent->add("list", $list);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("list", $list);
}

if($validacion->textValido($fecha)==false)
{
	$pnlcontent->add("alert_fecha", $alert_text);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("fecha", $fecha);
}

if($correcto)
{
	$egreso = new Egreso();
	$egreso->setIdEgreso($_POST['id']);
	$egreso->setNombre($nombre);
	$egreso->setDescripcion($descripcion);
	$egreso->setFecha($fecha);
	$egreso->setFkPersona($user->getIdPersona());
	$egreso->setStatus($STATUS);
	$egreso->setFkTipo($fkTipo);
	$resultado = $egreso->update($egreso);

	if($resultado==false)
	{
		
		$pnlcontent = new Panel("../view/error.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("aviso", "Ha ocurrido un error en el servidor intente luego.");
		$pnlmain->add("content", $pnlcontent);		
	}
	else
	{
		$pnlcontent = new Panel("../view/aviso.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("aviso", "Registro Exitoso");
		$pnlmain->add("content", $pnlcontent);		
	}
}
else
{
	$pnlcontent->add("location",$LOCATION);
	$pnlmain->add("content", $pnlcontent);
}
$pnlmain->show();

?>