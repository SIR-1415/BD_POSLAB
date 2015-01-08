<?php
require_once 'config.php';

function refreshtimeout() {
	$_SESSION['timeout'] = time() + TIMEOUT;
}

function checktimeout() {
	$ctime = time();
	$stime = $_SESSION['timeout'];
	if ($ctime > $stime) return false;
	else return true;
}
?>