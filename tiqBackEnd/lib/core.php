<?php
include_once('client.php');
include_once('mysql.php');
include_once('ticket.php');
include_once('email.php');
include_once('user.php');
include_once('emailReader.php');


class core{
	function getClient($pIdClient){
		$cli = new client();
		$cli->IdClient=$pIdClient;
		if($cli->load())
		{
			$json='{
				 "IdClient":'.$cli->IdClient.'
				,"ClientName":"'.$cli->ClientName.'"
				,"UrlWebService":"'.$cli->UrlWebService.'"
				,"PasswordWS":"'.$cli->PasswordWS.'"
				,"Email":"'.$cli->Email.'"
				,"EmailPassword":"'.$cli->EmailPassword.'"
				,"EmailUser":"'.$cli->EmailUser.'"
				,"EmailSmtp":"'.$cli->EmailSmtp.'"
				,"EmailIMAP":"'.$cli->EmailIMAP.'"
				,"EmailIdentity":"'.$cli->EmailIdentity.'"
			}';
			return $json;
		}
		else
		{
			return "";
		}


	}
	function updateTicket($pjsonTicket){
		$tran = new $transforms();
		$nTk = $tran->jsonToTicket($pjsonTicket);
		return $nTk->save();
	}
	function getTicketById($pId){
		$tik = new ticket();
		$tik->IdTicket=$pId;
		if(!$tik->load())
			return "";
		$tran = new $transforms();
		return $tran->ticketToJson($tik);
	}
	function checkEmail(){
		$reader = new Email_reader();
		$reader->inbox();
	}
	
}

?>