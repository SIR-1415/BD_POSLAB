<?php
require_once 'config.php';
require_once 'connectDB.php';
require_once 'sessiontimeout.php';


// se as varivaeis de formulario nao estiverem definidas
if (!isset($_POST['username']) || !isset($_POST['password'])) {
	header('location: login.php');
}

// ligar à BD
$liga = connectDB(HOSTDB, USERDB, PASSDB, DATADB);

if (!$liga) exit();
// verificar se existe username com password

// testo se dados de utilizador correspondem a user valido (par username / password)
$username = trim($_POST['username']);
$password = md5(trim($_POST['password']));
$validuser = false;

$queryuser = "SELECT username,pass from users WHERE (username='".$username."' AND pass='".$password."')";
$numusers= $liga->query($queryuser);
if ($numusers->num_rows == 1) {
	$validuser = true;
}

session_start();
if ($validuser) {
	$_SESSION['login']=$username;
	refreshtimeout();
	header("location:list.php");
} else {
	$_SESSION['error'] = "not a registered user";
	header("location:login.php");
}
session_write_close();

?>