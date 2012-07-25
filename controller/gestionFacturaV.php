<?php

session_start();
//Se incluye una clase Panel, para el manejo dinamico de contenidos
require_once ("../lib/Panel.php");
require_once '../model/Persona.php';
require_once '../model/Factura.php';

// Constantes
$TITLE = "Gestion de Facturas";
$AGREGAR="registroUsuarioV.php";
$ELIMINAR="eliminarUsuarioV.php";
$CONSULTAR="#";
$EDITAR="modificarUsuarioV.php";
$ICON_UNLOCK="../image/icon_unlock";
$LINK_UNLOCK="activarUsuarioV.php";
$TITULO_DESBLOQUEAR="Desbloquear Factura";
$TITULO_AGREGAR="Registrar Factura";
$TITULO_ELIMINAR="Bloquear Factura";
$TITULO_EDITAR="Editar Factura";
$TITULO_CONSULTAR="Consultar Factura";

//Se asigna a esta variable el archivo plantilla del home
$pnlmain = new Panel("../view/index.html");

//Se buscan los datos del usuario que ha iniciado sesion

$usuario = new Persona();
$usuario = $usuario->findByCedula($_SESSION["usuario"]);

//Se procede la asignación
$pnlcontent = new Panel("../view/menuCrud.html");
$pnlcontent->add("title",$TITLE);
$pnlcontent->add("agregar",$AGREGAR);
$pnlcontent->add("eliminar",$ELIMINAR);
$pnlcontent->add("editar",$EDITAR);
$pnlcontent->add("consultar",$CONSULTAR);
$pnlcontent->add("iconUnlock",$ICON_UNLOCK);
$pnlcontent->add("tituloDesbloquear",$TITULO_DESBLOQUEAR);
$pnlcontent->add("linkUnlock",$LINK_UNLOCK);
$pnlcontent->add("tituloAgregar",$TITULO_AGREGAR);
$pnlcontent->add("tituloEliminar",$TITULO_ELIMINAR);
$pnlcontent->add("tituloConsultar",$TITULO_CONSULTAR);
$pnlcontent->add("tituloEditar",$TITULO_EDITAR);
$pnlmain->add("username",$usuario->getUsername());
$pnlmain->add("content", $pnlcontent);

//Se muestra la página
$pnlmain->show();
?>