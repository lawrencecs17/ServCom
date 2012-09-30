<?php

require_once '../model/Banco.php';
require_once '../model/Persona.php';
require_once '../model/Validacion.php';
require_once '../lib/Panel.php';

//CONSTANTES
$FK_FUNDACION="1";
$STATUS="1";
$LOCATION="gestionBancoV.php";

$banco 	= new Banco();
$validacion = new Validacion();
$correcto 	= true;
$alert_text = "*Caracteres invalidos, no admitido acentos, ñ o simbolos  ";
$alert_email= "*Email incorrecto";
$alert_num  = "*No es un numero";
$alert_repeat="*Ya existe en nuestra Base de Datos";

$nombre 	 = $_POST['nombre'];
$telefono 	 = $_POST['telefono'];
$direccion	 = $_POST['direccion'];

$pnlmain = new Panel("../view/index.html");

//Se buscan los datos del usuario que ha iniciado sesion
session_start();
$user = new Persona();
$user = $user->findByCedula($_SESSION["usuario"]);
$pnlmain->add("username",$user->getUsername());

$pnlcontent = new Panel("../view/registroBanco.html");

//Validacion de los campos

if($validacion->textValido($direccion)==false)
{
	$pnlcontent->add("alert_direccion", $alert_text);
}
else
{
	$pnlcontent->add("direccion", $direccion);
}


if($validacion->nombreValido($nombre)==false)
{
	$pnlcontent->add("alert_nombre", $alert_text);
	$correcto 	= false;
}
elseif ($banco->findByName($nombre)==null)
{
	$pnlcontent->add("nombre", $nombre);
}
else
{
	$pnlcontent->add("alert_nombre", $alert_repeat);
	$pnlcontent->add("nombre", $nombre);
	$correcto 	= false;
}


if($validacion->numValido($telefono)==false)
{
	$pnlcontent->add("alert_telefono", $alert_num);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("telefono", $telefono);
}



if($correcto)
{
	$banco->setNombre($nombre);;
	$banco->setTelefono($telefono);
	$banco->setDireccion($direccion);
	$banco->setStatus($STATUS);
	$banco->setFkFundacion($FK_FUNDACION);

	$resultado = $banco->registrar($banco);

	if($resultado==false)
	{
		
		$pnlcontent = new Panel("../view/error.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("aviso", "Ha ocurrido un error en el servidor intente luego.");
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
	else
	{
		$pnlcontent = new Panel("../view/aviso.html");
		$pnlcontent->add("location",$LOCATION);
		$pnlcontent->add("aviso", "Registro Exitoso");
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
}
else
{
	$pnlcontent->add("location",$LOCATION);
	$pnlmain->add("content", $pnlcontent);
	$pnlmain->show();
}

?>