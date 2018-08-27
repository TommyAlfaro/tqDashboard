<?php
  include_once('../tiqBackEnd/lib/core.php');
  $core = new core();
  $res= $core->getClient(1);
  echo var_dump($res);

?>