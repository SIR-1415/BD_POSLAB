<?php
require_once 'config.php';
require_once 'connectDB.php';

$liga = connectDB(HOSTDB, USERDB, PASSDB, DATADB);

if (!$liga) exit();

echo ("ok");

?>