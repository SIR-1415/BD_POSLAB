<?php

function connectDB($host,$user,$pass,$db) {
	$conn = new mysqli($host,$user,$pass,$db);
	if ($conn->connect_errno) {
		return NULL;
	} else {
		return $conn;
	}
}

?>