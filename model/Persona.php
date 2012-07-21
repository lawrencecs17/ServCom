<?php


/**
 * Description of Persona
 *
 * @author Lawrence
 */
require_once 'ConexionBD.php';
require_once 'ArrayList.php';

class Persona {
    
    private $idPersona;
    private $nombre;
    private $apellido;
    private $email;
    private $username;
    private $password;
    private $telefono;
    private $rol;
    private $fkFundacion;
    private $cedula;
    
    public function getIdPersona() {
        return $this->idPersona;
    }

    public function setIdPersona($idPersona) {
        $this->idPersona = $idPersona;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getFkFundacion() {
        return $this->fkFundacion;
    }

    public function setFkFundacion($fkFundacion) {
        $this->fkFundacion = $fkFundacion;
    }

    public function getCedula() {
        return $this->cedula;
    }

    public function setCedula($cedula) {
        $this->cedula = $cedula;
    }
    
    public function testConsulta()
    {
        $miBD = new ConexionBD();
        $miBD->setConexion($miBD->conectarBD($miBD));
        
        $query = "Select * from Persona";
        $resultado = mysql_query($query,$miBD->getConexion());
        
        while($fila = mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo "<td>Id: ".$fila['idPersona']."</td></br>";
            echo "<td>Nombre: ".$fila['nombre']."</td></br>";
            echo "<td>Apellido: ".$fila['apellido']."</td></br>";
            echo "<td>Cedula: ".$fila['cedula']."</td></br>";
            echo "<td>Telefono: ".$fila['telefono']."</td></br>";
            echo "<td>Email: ".$fila['email']."</td></br>";
            echo "<td>UserName: ".$fila['userName']."</td></br>";
            echo "<td>Password: ".$fila['password']."</td></br>";
            echo "<td>Rol: ".$fila['rol']."</td></br>";
            echo "<td>FkFundacion: ".$fila['fkFundacion']."</td></br>";
            echo "</tr></br>";
        }
        mysql_close();
    }
    
    public function findByUsernameAndPassword($username, $password)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$usuario = null;
    	
    	$query = "Select * from Persona Where userName = '$username' AND 
    	password ='$password'";
    	
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{    		
    		$usuario = new Persona();
	    	$usuario->setIdPersona($fila['idPersona']);
	    	$usuario->setNombre($fila['nombre']);
	    	$usuario->setApellido($fila['apellido']);
	    	$usuario->setCedula($fila['cedula']);
	    	$usuario->setTelefono($fila['telefono']);
	    	$usuario->setEmail($fila['email']);
	    	$usuario->setUsername($fila['userName']);
	    	$usuario->setPassword($fila['password']);
	    	$usuario->setRol($fila['rol']);    	
	    	$usuario->setFkFundacion($fila['fkFundacion']);	    	
    	}
    	mysql_close();
    	return $usuario;
    	    	
    }
    
    public function findByUsername($username)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$usuario = null;
    	 
    	$query = "Select * from Persona Where userName = '$username'";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$usuario = new Persona();
    		$usuario->setIdPersona($fila['idPersona']);
    		$usuario->setNombre($fila['nombre']);
    		$usuario->setApellido($fila['apellido']);
    		$usuario->setCedula($fila['cedula']);
    		$usuario->setTelefono($fila['telefono']);
    		$usuario->setEmail($fila['email']);
    		$usuario->setUsername($fila['userName']);
    		$usuario->setPassword($fila['password']);
    		$usuario->setRol($fila['rol']);
    		$usuario->setFkFundacion($fila['fkFundacion']);
    	}
    	mysql_close();
    	return $usuario;
    
    }
    
    public function findAll()
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$usuario = null;
    	$listUsuario = new ArrayList();
    
    	$query = "Select * from Persona";
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$usuario = new Persona();
    		$usuario->setIdPersona($fila['idPersona']);
    		$usuario->setNombre($fila['nombre']);
    		$usuario->setApellido($fila['apellido']);
    		$usuario->setCedula($fila['cedula']);
    		$usuario->setTelefono($fila['telefono']);
    		$usuario->setEmail($fila['email']);
    		$usuario->setUsername($fila['userName']);
    		$usuario->setPassword($fila['password']);
    		$usuario->setRol($fila['rol']);
    		$usuario->setFkFundacion($fila['fkFundacion']);
    		
    		$listUsuario->addItem($usuario);
    	}
    	mysql_close();
    	return $listUsuario;
    
    }
    
    public function findByEmail($email)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$usuario = null;
    	 
    	$query = "Select * from Persona Where email = '$email'";
    	 
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$usuario = new Persona();
    		$usuario->setIdPersona($fila['idPersona']);
    		$usuario->setNombre($fila['nombre']);
    		$usuario->setApellido($fila['apellido']);
    		$usuario->setCedula($fila['cedula']);
    		$usuario->setTelefono($fila['telefono']);
    		$usuario->setEmail($fila['email']);
    		$usuario->setUsername($fila['userName']);
    		$usuario->setPassword($fila['password']);
    		$usuario->setRol($fila['rol']);
    		$usuario->setFkFundacion($fila['fkFundacion']);
    	}
    	mysql_close();
    	return $usuario;
    
    }
    
    public function findByCedula($cedula)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$usuario = null;
    
    	$query = "Select * from Persona Where cedula = '$cedula'";
    
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$usuario = new Persona();
    		$usuario->setIdPersona($fila['idPersona']);
    		$usuario->setNombre($fila['nombre']);
    		$usuario->setApellido($fila['apellido']);
    		$usuario->setCedula($fila['cedula']);
    		$usuario->setTelefono($fila['telefono']);
    		$usuario->setEmail($fila['email']);
    		$usuario->setUsername($fila['userName']);
    		$usuario->setPassword($fila['password']);
    		$usuario->setRol($fila['rol']);
    		$usuario->setFkFundacion($fila['fkFundacion']);
    	}
    	mysql_close();
    	return $usuario;
    
    }
    
    public function findByID($id)
    {
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	$usuario = null;
    
    	$query = "Select * from Persona Where idPersona = '$id'";
    
    	$resultado = mysql_query($query,$miBD->getConexion());
    	$fila = mysql_fetch_array($resultado);
    	if($fila != null)
    	{
    		$usuario = new Persona();
    		$usuario->setIdPersona($fila['idPersona']);
    		$usuario->setNombre($fila['nombre']);
    		$usuario->setApellido($fila['apellido']);
    		$usuario->setCedula($fila['cedula']);
    		$usuario->setTelefono($fila['telefono']);
    		$usuario->setEmail($fila['email']);
    		$usuario->setUsername($fila['userName']);
    		$usuario->setPassword($fila['password']);
    		$usuario->setRol($fila['rol']);
    		$usuario->setFkFundacion($fila['fkFundacion']);
    	}
    	mysql_close();
    	return $usuario;
    
    }
    
    public function toString(Persona $fila)
    {    	
    	 $usuario= $usuario."</br>";
    	 $usuario= $usuario."Id: ".$fila->getIdPersona()."</br>";
    	 $usuario= $usuario."Nombre: ".$fila->getNombre()."</br>";
    	 $usuario= $usuario."Apellido: ".$fila->getApellido()."</br>";
    	 $usuario= $usuario."Cedula: ".$fila->getCedula()."</br>";
    	 $usuario= $usuario."Telefono: ".$fila->getTelefono()."</br>";
    	 $usuario= $usuario."Email: ".$fila->getEmail()."</br>";
    	 $usuario= $usuario."UserName: ".$fila->getUsername()."</br>";
    	 $usuario= $usuario."Password: ".$fila->getPassword()."</br>";
         $usuario= $usuario."Rol: ".$fila->getRol()."</br>";
    	 $usuario= $usuario."FkFundacion: ".$fila->getFkFundacion()."</br>";
    	 $usuario= $usuario."</br>";
    	 
    	 return $usuario;
    }
    
    public function registrar(Persona $usuario)
    {
    	$query = "INSERT INTO Persona ";
    	$query = $query." (nombre,apellido,cedula,telefono,email,username,
    	password,rol,fkFundacion) VALUES (";
    	$query = $query."'".$usuario->getNombre()."',";
    	$query = $query."'".$usuario->getApellido()."',";
    	$query = $query."'".$usuario->getCedula()."',";
    	$query = $query."'".$usuario->getTelefono()."',";
    	$query = $query."'".$usuario->getEmail()."',";
    	$query = $query."'".$usuario->getUsername()."',";
    	$query = $query."'".$usuario->getPassword()."',";
    	$query = $query.$usuario->getRol().",";
    	$query = $query.$usuario->getFkFundacion().")";
    	
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	
    	$resultado=mysql_query($query,$miBD->getConexion());    	
    	mysql_close();
    	return $resultado;
    }
    
    public function update(Persona $usuario)
    {
    	$query = "UPDATE Persona SET ";
    	$query = $query." nombre='".$usuario->getNombre()."',";
    	$query = $query." apellido='".$usuario->getApellido()."',";
    	$query = $query." cedula='".$usuario->getCedula()."',";
    	$query = $query." telefono='".$usuario->getTelefono()."',";
    	$query = $query." email='".$usuario->getEmail()."',";
    	$query = $query." username='".$usuario->getUsername()."' ";
    	$query = $query." WHERE idPersona= ".$usuario->getIdPersona();
    	 
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    	 
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }
    public function delete($cedula)
    {
    	$query = "UPDATE Persona SET ";
    	$query = $query." rol='-1' ";
    	$query = $query." WHERE cedula= ".$cedula;
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }
    
    public function activar($cedula)
    {
    	$query = "UPDATE Persona SET ";
    	$query = $query." rol='0' ";
    	$query = $query." WHERE cedula= ".$cedula;
    
    	$miBD = new ConexionBD();
    	$miBD->setConexion($miBD->conectarBD($miBD));
    
    	$resultado=mysql_query($query,$miBD->getConexion());
    	mysql_close();
    	return $resultado;
    }


    
}

?>
