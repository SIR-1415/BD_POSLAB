<html>
	<body>
	<form action = "<?php $_SERVER['PHP_SELF']?>" method="POST">
		<input type="text" name="username">
		<input type="pass" name="password">
		<input type="submit" />
	</form>
	</body>
</html>
<?php

$userdata = false;
$validuser = false;

// se foi enviada info no form
if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$userdata = true;
}

// dados de ligacao
$hostDB = 'localhost';
$userDB = 'webposlab';
$passDB = 'poslab';
$dataDB = 'POSLAB';

// estabelece ligacao
$connect = new mysqli($hostDB,$userDB,$passDB,$dataDB);

//testo se ha erro
if ($connect->connect_errno) {
	echo ("ERRO de LIGACAO : ". $connect->connect_error);
	exit();
} else {
	echo ("Estou Ligado!!!");
}

// testo se dados de utilizador correspondem a user valido (par username / password)
if ($userdata) {
	$queryuser = "SELECT username,pass from users WHERE (username='".$username."' AND pass='".$password."')";
//	echo $queryuser;
	$numusers= $connect->query($queryuser);
	if ($numusers->num_rows == 1) {
		$validuser = true;
	}
}

//defino a query
if ($validuser) {
	$myquery = "SELECT nome,apelido,phone from users";
} else {
	$myquery = "SELECT nome,apelido from users";
}
//executo a query
$resultset = $connect->query($myquery);

echo "numero de resultados =".$resultset->num_rows; 
//testo se houve erro
if ($connect->errno) {
	echo ("ERRO na Query : ". $connect->error);
	exit();
}

echo "<hr>";
//itero o resultado com objectos
while($row = $resultset->fetch_object()) {
	echo "<p>".$row->nome.' '.$row->apelido. ' ';
	if ($validuser) echo $row->phone;
	echo "</p>";
}

echo "<hr>";
// reaponto para o primeiro resultado
$resultset->data_seek(0);

//iterar o resultado com array associativos
while($row = $resultset->fetch_assoc()) {
	echo "<p>".$row['nome'].' '.$row['apelido']."</p>";
}

echo "<hr>";
// reaponto para o primeiro resultado
$resultset->data_seek(0);
//iterar o resultado com array enumerado
while($row = $resultset->fetch_array()) {
	echo "<p>".$row[0].' '.$row[1]."</p>";
}



?>