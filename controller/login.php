<?php

	require_once '../model/Persona.php';
	require_once '../model/Validacion.php';
	require_once '../lib/Panel.php';
	
	session_start();

	$isOk=true;
	$alert_login="Ha introducido a caracteres no permitidos en su login";	
	$alert_password="Ha introducido a caracteres no permitidos en su password";
	$alert_autenticate = "Login o Password incorrectos";
	
	$pnlcontent = new Panel("../view/login.html");
	
	//Se reciben el nombre de usuario y password
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//Se instacion un objeto de validacion, para verificar
	//los campos ingresados
	
	$validacion = new Validacion();
	
	//Se proceder a realizar la validacion
	
	//Se valida el usuario
	
	if($validacion->textUsernameValido($username)==false)
	{
		$isOk=false;
		$pnlcontent->add("alert", $alert_login);
	}	
	
	//Se valida el password
	if($validacion->textValido($password)==false)
	{
		$isOk=false;
		$pnlcontent->add("alert", $alert_password);
	}
	
	//Si los datos son permitidos, se verifica en la BD el usuario
	
	if($isOk==true)
	{
		$usuario = new Persona();
		$usuario = $usuario->findByUsernameAndPassword($username, $password);
		
		//Si el usuario es encontrado, se almacena en una variable de sesion
		
		if($usuario)
		{
			$_SESSION["usuario"]=$usuario->getCedula();
			echo "<script type='text/javascript'>window.location='modificarUsuarioV.php';</script>";			
		}
		else //El usuario o la contraseña son incorrectos. 
		{
			$isOk = false;
			$pnlcontent->add("alert", $alert_autenticate);
		}
	}
	
	if($isOk==false)
	{
		$pnlmain = new Panel("../view/index2.html");
		$pnlmain->add("content", $pnlcontent);
		$pnlmain->show();
	}
	

?>