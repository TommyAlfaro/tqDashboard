<?php

class transforms(){
	function JsonToTicket($pjsonTicket){
		$nTk = new ticket();
		$pTk = json_decode($pjsonTicket);
		$nTk->IdTicket = $pTk->IdTicket;
		$nTk->AttendedBy->IdUser = $pTk->AttendedBy;
		$nTk->Hidden =$pTk->Hidden;
		$nTk->Client->IdClient= $pTk->Client;
		$nTk->Subject = $pTk->Subject;
		$nTk->Sender = $pTk->Sender;
		return $nTk;
	}
	function TicketToJson($pTicket){
		$ljson = '{
			"IdTicket":'.$this->IdTicket.'
			,"AttendedBy":'.$this->AttendedBy->IdUser.'
			,"AttendedByName":'.$this->AttendedBy->Name.'
			,"Hidden":'.$this->Hidden.'
			,"Client":"'.$this->Client->IdClient.'"
			,"ClientName":"'.$this->Client->ClientName.'"
			,"Subject":"'.$this->Subject.'"
			,"Sender":"'.$this->Sender.'"
		}';
		return $ljson;

	}

}

?>