<?php
require_once "connection.php";
$compId = $_REQUEST['pushid'];
$query = $dbconnect->query("UPDATE `task` SET `status`= 1 WHERE `id`='$compId'");
?>