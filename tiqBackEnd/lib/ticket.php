<?php

class ticket{
	var $IdTicket;
	var $TicketDate;
	var $AttendedBy;
	var $TicketState;
	var $TicketNotes;
	var $Hidden;
	var $Client;
	var $Subject;
	var $Sender;
	function __construct(){
		$this->IdTicket=0;
		$this->TicketDate = Date('Y-m-d');
		$this->AttendedBy = new user();
		$this->TicketState = 0;
		$this->TicketNotes = "";
		$this->Hidden="";
		$this->Client = new client();
		$this->Subject = "";
		$this->Sender="";

	}
	function load(){
		$ac = new tiqmysql();
		$sql="select idTicket
			,ticketDate
			,attendedBy
			,ticketState
			,ticketNotes
			,hidden
			,idClient
			,subject
			from tqTicket where idTicket=".$this->IdTicket."
			";
		$res = $ac->query($sql);
		if($ac->lines($res)==0)
			return false;
		else
		{
			$re = $ac->getArray($res);
			$this->TicketDate = $re[0]["ticketDate"];
			$this->AttendedBy->IdUser = $re[0]["attendedBy"];
			$this->TicketState = $re[0]["ticketState"];
			$this->TicketNotes = $re[0]["ticketNotes"];
			$this->Hidden=$re[0]["hidden"];
			$this->Client->IdClient = $re[0]["idClient"];
			$this->Subject = $re[0]["subject"];
			$this->Sender= $re[0]["sender"];
			return true;
		}

	}
	function save(){
		$ac = new tiqmysql();
		return $this->saveTran($ac);
	}
	function saveTran($pac){
		$sql="";
		echo "inicia saver ";
		if($this->IdTicket==0){
			$sql="insert into tqTicket (
			ticketDate
			,attendedBy
			,ticketState
			,ticketNotes
			,hidden
			,idClient
			,subject
			,sender
			) values (
		    now()
		    ,".$this->AttendedBy->idUser."
		    ,".$this->TicketState."
		    ,'". $pac->sanitize($this->TicketNotes)."'
		    ,".$this->hidden."
		    ,".$this->Client->idClient."
		    ,'".$pac->sanitize($this->Subject)."'
		    ,'".$pac->sanitize($this->Sender)."'
			)";
			echo $sql;
		}
		else
		{
			$sql="update tqTicket set 
			    attendedBy=".$this->AttendedBy->IdUser."
			    ,ticketstate=".$this->TicketState."
			    ,ticketNotes='".$pac->sanitize($this->TicketNotes)."'
			    ,hidden=".$this->Hidden."
			    ,idClient=".$this->Client->idClient."
			    ,subject='".$pac->sanitize($this->Subject)."'
			    ,sender='".$pac->sanitize($this->Sender->IdUser)."'
			     where idTicket=".$this->IdTicket."
			    ";
			    echo $sql;
		}
		$pac->query($sql);
		if($this->IdTicket==0){
			$this->IdTicket= $pac->lastId("tqTicket");
		}

		return $this->idTicket;
	}

}


?>