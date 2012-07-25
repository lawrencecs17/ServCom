<?php


	session_start();
	
	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	require_once '../lib/Panel.php';
	
	//Constantes
	$LOCATION="gestionUsuarioV.php";
	
	$usuario 	= new Persona();
	$validacion = new Validacion();
	$correcto 	= true;
	$alert_text = "*Caracteres invalidos, no admitido acentos, ñ o simbolos  ";
	$alert_email= "*Email incorrecto";
	$alert_num  = "*No es un numero";
	$alert_pass = "*Las contraseñas no coinciden";
	$alert_repeat="*Ya existe en nuestra Base de Datos";
	
	$id 	     = $_SESSION["idPersona"];
	$cedula 	 = $_POST['cedula'];
	$nombre 	 = $_POST['nombre'];
	$apellido 	 = $_POST['apellido'];
	$email	 	 = $_POST['email'];
	$username	 = $_POST['username'];
	$telefono 	 = $_POST['telefono'];
	
	$pnlmain = new Panel("../view/index.html");
	
	//Se buscan los datos del usuario que ha iniciado sesion
	$user = new Persona();
	$user = $user->findByCedula($_SESSION["usuario"]);
	$pnlmain->add("username",$user->getUsername());
	
	$pnlcontent = new Panel("../view/modificarUsuario.html");
	
	//Validacion de los campos
	$usuario =$usuario->findById($id);
	if($validacion->numValido($cedula)==false)
	{
		$pnlcontent->add("alert_cedula", $alert_num);
		$correcto 	= false;
	}
	elseif ($usuario->findByCedula($cedula)==null)
	{
		$pnlcontent->add("cedula", $cedula);
	}
	else 
	{
		if($usuario->getCedula()!=$cedula)
		{
			$pnlcontent->add("alert_cedula", $alert_repeat);
			$pnlcontent->add("cedula", $cedula);
			$correcto 	= false;
		}
		else
		{
			$pnlcontent->add("cedula", $cedula);
		}
	}
	
	if($validacion->nombreValido($nombre)==false)
	{
		$pnlcontent->add("alert_nombre", $alert_text);
		$correcto 	= false;
	}
	else
	{
		$pnlcontent->add("nombre", $nombre);
	}
	if($validacion->nombreValido($apellido)==false)
	{
		$pnlcontent->add("alert_apellido", $alert_text);
		$correcto 	= false;
	}
	else
	{
		$pnlcontent->add("apellido", $apellido);
	}	
	if($validacion->emailValido($email)==false)
	{
		$pnlcontent->add("alert_email", $alert_email);
		$correcto 	= false;
	}
	elseif ($usuario->findByEmail($email)==null) 
	{
		$pnlcontent->add("email", $email);
	}
	else
	{
		if($usuario->getEmail()!=$email)
		{
			$pnlcontent->add("alert_email", $alert_repeat);
			$pnlcontent->add("email", $email);
			$correcto 	= false;
		}
		else 
		{
			$pnlcontent->add("email", $email);
		}
	}
	if($validacion->textValido($username)==false)
	{
		$pnlcontent->add("alert_username", $alert_text);
		$correcto 	= false;
	}
	elseif ($usuario->findByUsername($username)==null)  
	{
		$pnlcontent->add("username", $username);
	}
	else
	{
		if($usuario->getUsername()!=$username)
		{
			$pnlcontent->add("alert_username", $alert_repeat);
			$pnlcontent->add("username", $username);
			$correcto 	= false;
		}
		else
		{
			$pnlcontent->add("username", $username);
		}
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
		$usuario = new Persona();
		$usuario->setIdPersona($id);
		$usuario->setCedula($cedula);
		$usuario->setNombre($nombre);
		$usuario->setApellido($apellido);
		$usuario->setEmail($email);
		$usuario->setUsername($username);
		$usuario->setTelefono($telefono);
		
		$resultado = $usuario->update($usuario);	
		
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
			$pnlcontent->add("aviso", "Actualizacion Exitosa");
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