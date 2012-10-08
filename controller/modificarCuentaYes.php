<?php

require_once '../model/Banco.php';
require_once '../model/Cuenta.php';
require_once '../model/Persona.php';
require_once '../model/Validacion.php';
require_once '../lib/Panel.php';

//CONSTANTES
$STATUS="1";
$LOCATION="gestionCuentaV.php";

$cuenta	= new Cuenta();
$validacion = new Validacion();
$correcto 	= true;
$alert_text = "*Caracteres invalidos, no admitido acentos, ñ o simbolos  ";
$alert_email= "*Email incorrecto";
$alert_num  = "*No es un numero";
$alert_repeat="*Ya existe en nuestra Base de Datos";
$alert_null="*Debe seleccionar una opcion valida";

$noCuenta	 = $_POST['noCuenta'];
$titular 	 = $_POST['titular'];
$fkBanco	 = $_POST['banco'];
$listBancos	 = $_POST['bancos'];

$pnlmain = new Panel("../view/index.html");

//Se buscan los datos del usuario que ha iniciado sesion
session_start();
$user = new Persona();
$user = $user->findByCedula($_SESSION["usuario"]);
$pnlmain->add("username",$user->getUsername());

$pnlcontent = new Panel("../view/registrarCuenta.html");

//Validacion de los campos

if($validacion->textValido($noCuenta)==false)
{
	$pnlcontent->add("alert_noCuenta", $alert_text);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("noCuenta", $noCuenta);
}


if($validacion->nombreValido($titular)==false)
{
	$pnlcontent->add("alert_titular", $alert_text);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("titular", $titular);
}

if($fkBanco == 0)
{
	$pnlcontent->add("alert_banco", $alert_null);
	$pnlcontent->add("list", $listBancos);
	$correcto 	= false;
}
else
{
	$pnlcontent->add("list", $listBancos);
}



if($correcto)
{
	$cuenta = $cuenta->findById( $_POST["id"]);
	$cuenta->setCodigoCliente($noCuenta);
	$cuenta->setFkBanco($fkBanco);
	$cuenta->setTitular($titular);

	$resultado = $cuenta->update($cuenta);

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
		$pnlcontent->add("aviso", "Actualizacion Exitosa");
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