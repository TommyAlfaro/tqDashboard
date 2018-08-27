<?php

class mimysql{
 var $basedatos;
 var $con;
 var $tranabierta;

 function open()
 {
  $this->con = new mysqli("localhost", "root", "tomk57",  $this->basedatos);
  if ($this->con->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

}

function close(){
	if($this->con!=null){
   $this->con->close();
   $this->con=null;
 }
} 

function query($tira)
{
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
 date_default_timezone_set('America/Costa_Rica');
 if($this->con==null){
  $this->open();
  $conabierta=false;  
}
else{
  $conabierta=true;
}
$resultado = $this->con->query($tira);
if($this->con->errno){
 die( $this->debugDB());
}
if(!$conabierta)
  $this->close($conabierta);  
return $resultado ;
}

function lines($resulquery1)
{
 $resu1 = mysqli_num_rows($resulquery1);
 return $resu1;
}

function lastId(){
	if($this->con==null){
		$this->open();
		$conabierta=false;  
	}else
  $conabierta=true;
  $resid= $this->con->insert_id;
  if(!$conabierta)
    $this->close($conabierta);  
  return $resid;
}

function openTran() {
	if($this->con==null){
		$this->open();
		$conabierta=false;  
	}else
  $conabierta=true;

  $this->query("BEGIN");
  return true;
}
function closeTran() {
	$this->query("COMMIT");
	$this->close();
	return true;
}
function rollbackTran() {
	$this->query("ROLLBACK");
	$this->close();
	return true;

}
function firstValueFromResult($result){

  $row = $result->fetch_array();
  return $row[0];
}

function firstValue($xsql){
  $result=$this->query($xsql);
  $row =  $result->fetch_array(MYSQLI_NUM);
  return $row[0];
}


function debugDB(){
  $errores = array(
    1062 => array(
     "/Duplicate entry ('.*') for key [0-9]/",
     'El valor \\1 esta siendo utilizado por otro registro '
   ),
    1216 => array(
     "/Cannot add or update a child row: a foreign key constraint fails/",
     "No se pudo agregar/actualizar hay datos que referencian a otras tablas y no existen"
   ),
    1217 => array(
     "/Cannot delete or update a parent row: a foreign key constraint fails/",
     "No se puede borrar/actualzar este registro porque esta relacionado con otros conceptos"
   ),
    1451 => array(
     "/Cannot delete or update a parent row: a foreign key constraint fails/",
     "No se puede borrar/actualzar este registro porque esta relacionado con otros conceptos"
   )
  );
  $numer=$this->con->errno;     
  echo var_dump($this->con->error);
  if(array_key_exists ($numer,$errores))
   $texto =$errores[$numer][1];
 else
   $texto = $this->con->error." numerror -> ".$numer;
      //echo "Error al cargar en la base de datos<br/>".$texto."<br/>";
 return $texto;
}

function getArray($resultquery){
 return mysqli_fetch_array($resultquery);
}

function sanitize($cad){
  return mysqli_real_escape_string($cad);

}

}

class tiqmysql extends mimysql{
	function tiqmysql() {
		$this->basedatos="tiqdashboard";

	}
}


?>
