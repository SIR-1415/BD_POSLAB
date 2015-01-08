<?php
session_start();
if (isset($_SESSION['login'])) {
	header('location:list.php');
}
?>
<html>
	<?php
	if (isset($_SESSION['error'])) {
	 echo "<h3>".$_SESSION['error']."</h3>";
	}
	?>
	<form action="checkuser.php" method="post">
		username : <input type="text" name="username" /><br />
		password : <input type="password" name="password" /><br />
		<input type="submit" />
		<input type="reset" />
	</form>
</html>