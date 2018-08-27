<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 include_once('./lib/core.php');

// get posted data
$request = json_decode(file_get_contents("php://input"));
$res = new response(900,"Comando Erroneo");
if($request->serial!='1234'){
	$res = new response(300,"Sin permiso");
	sendres($res);
	return;
}

$core = new core();
switch ($request->command) {
	case 'getClient':
	     $res->state=100;
	     $res->res = $core->getClient($request->payload);
		break;
	
	default:
		# code...
		break;
}
sendres($res);



function sendres($pres){
	echo json_encode($pres);
}



class response{
	var $state;
	var $res;
	__constructor($pstate,$pres){
		/*
		states : 
		100 ok
		200 Exception
		300 Security Error
		400 Controled Error
		900 comand Error

		*/
		$this->state=$pstate;
		$this->res=$pres;
	}
}



?>