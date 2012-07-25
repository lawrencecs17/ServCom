<?php

require_once 'model/ConexionBD.php';
$miBD = new ConexionBD();
$miBD->setConexion($miBD->conectarBD($miBD));

echo $miBD->getDbhost();
echo $miBD->getDb();
echo $miBD->getDbpassword();
echo $miBD->getDbusuario();



?>