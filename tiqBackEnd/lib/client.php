<?php
  class Client{
  	var $IdClient;
  	var $ClientName;
  	var $UrlWebService;
  	var $PasswordWS;
  	var $Email;
  	var $EmailPassword;
  	var $EmailUser;
  	var $EmailSmtp;
  	var $EmailIMAP;
  	var $EmailIdentity;
  	function __construct() {
  		$this->IdClient=0;
  		$this->ClientName='';
  		$this->UrlWebService='';
  		$this->PasswordWS='';
  		$this->Email='';
  		$this->EmailPassword='';
  		$this->EmailUser='';
  		$this->EmailSmtp='';
  		$this->EmailIMAP='';
  		$this->EmailIdentity='';
  	}
  	function load(){
  		$sql="select * from tqClient where idClient=".$this->IdClient;
  		$ac = new tiqmysql();
  		$res = $ac->query($sql);
  		if($ac->lines($res)>0){
  			$ares = $ac->getArray($res);
  			$this->ClientName=$ares["clientName"];
  			$this->UrlWebService=$ares["urlWebService"];
  			$this->PasswordWS=$ares["passwordWS"];
  			$this->Email=$ares["email"];
  			$this->EmailPassword=$ares["emailPassword"];
  			$this->EmailUser=$ares["emailUser"];
  			$this->EmailSmtp=$ares["emailSmtp"];
  			$this->EmailIMAP=$ares["emailIMAP"];
  			$this->EmailIdentity=$ares["EmailIdentity"];
  			return true;

  		}
  		return false;


  	}
  }

?>