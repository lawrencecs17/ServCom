<?php

	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	require_once '../lib/Panel.php';	
	
	$usuario 	= new Persona();
	$validacion = new Validacion();
	$correcto 	= true;
	$alert_text = "*Caracteres invalidos, no admitido acentos, ñ o simbolos  ";
	$alert_email= "*Email incorrecto";
	$alert_num  = "*No es un numero";
	$alert_pass = "*Las contraseñas no coinciden";
	$alert_repeat="*Ya existe en nuestra Base de Datos"; 	
	
	$cedula 	 = $_POST['cedula'];
	$nombre 	 = $_POST['nombre'];
	$apellido 	 = $_POST['apellido'];
	$email	 	 = $_POST['email'];
	$username	 = $_POST['username'];
	$telefono 	 = $_POST['telefono'];
	$password 	 = $_POST['password'];
	$password2	 = $_POST['password2'];
	$fkFundacion = 1;
	$rol		 = 0;
	
	$pnlmain = new Panel("../view/index.html");
	$pnlcontent = new Panel("../view/registroUsuario.html");
	
	//Validacion de los campos
	
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
		$pnlcontent->add("alert_cedula", $alert_repeat);
		$pnlcontent->add("cedula", $cedula);
		$correcto 	= false;
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
		$pnlcontent->add("alert_email", $alert_repeat);
		$pnlcontent->add("email", $email);
		$correcto 	= false;
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
		$pnlcontent->add("alert_username", $alert_repeat);
		$pnlcontent->add("username", $username);
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
	if($validacion->textValido($password)==false)
	{
		$pnlcontent->add("alert_password", $alert_text);
		$correcto 	= false;
	}
	if($password!=$password2)
	{
		$pnlcontent->add("alert_password", $alert_pass);
		$pnlcontent->add("alert_password2", $alert_pass);
		$correcto 	= false;
	}
	
	

	if($correcto)
	{	
		$usuario->setCedula($cedula);
		$usuario->setNombre($nombre);
		$usuario->setApellido($apellido);
		$usuario->setEmail($email);
		$usuario->setUsername($username);
		$usuario->setTelefono($telefono);
		$usuario->setPassword($password);
		$usuario->setRol($rol);
		$usuario->setFkFundacion($fkFundacion);
		
		$resultado = $usuario->registrar($usuario);	
		
		if($resultado==false)
		{
			echo $resultado;
			$pnlcontent = new Panel("../view/error.html");
			$pnlcontent->add("aviso", "Ha ocurrido un error en el servidor intente luego.");
			$pnlmain->add("content", $pnlcontent);
			$pnlmain->show();
		}
		else
		{
			$pnlcontent = new Panel("../view/aviso.html");
			$pnlcontent->add("aviso", "Registro Exitoso");
			$pnlmain->add("content", $pnlcontent);
			$pnlmain->show();
		}
	}
	else
	{		
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
	
?>