<?php
require_once 'no-cache-headers.php';
require_once 'sessiontimeout.php';

session_start();
if (!isset($_SESSION['login'])) {
	header('location:login.php');
}

if (checktimeout()) {
	refreshtimeout();
} else {
	$_SESSION['error'] = "expired session";
	header('location:logout.php');
}

require_once 'config.php';
require_once 'connectDB.php';




// ligar à BD
$liga = connectDB(HOSTDB, USERDB, PASSDB, DATADB);

if (!$liga) exit();

$myquery = "SELECT nome,apelido,phone from users";

//executo a query
$resultset = $liga->query($myquery);

//testo se houve erro
if ($liga->errno) {
	echo ("ERRO na Query : ". $connect->error);
	exit();
}

echo "<hr>";
//itero o resultado com objectos
while($row = $resultset->fetch_object()) {
	echo "<p>".$row->nome.' '.$row->apelido. ' '. $row->phone. "</p>";
}
echo "<hr>";

echo "<p><a href='list.php'>list1</p>";
echo "<p><a href='logout.php'>logout</p>";
	
?>