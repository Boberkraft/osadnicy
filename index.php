<?php
session_start();
	unset($_SESSION['brak']);

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
	{
		header('Location: gra.php'); 
		exit();//natychmiastowe przejscie, wyjscie
		
	}
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Gra</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<?php
	require_once 'header.php';
	?>
	
	<style>
		input
	{
	  width:150px;
	}
	#top
	{
		padding-top:0px;
		padding-bottom:40px;
		
		
	}
	</style>


</head>
<body>
<div id = "top">
<div id="container">
	<div style="float:left;margin-top: 100px;" ><img src="linder.png" alt=""></img></div>
	<div style="float:left;"id="content">
		
		<div id="logo"><b>BOBKOGRA</b></div>
		
		<div id="login">
		<b>Zaloguj się!</b>
		<form action="zaloguj.php" method="post">
		Login: </br>
		<input type="text" name="login" /> </br> </br>
		Hasło: </br>
		<input type="password" name="haslo" /> </br></br>
		<input class="przycisk"  type="submit" value="Zaloguj się" />

	</form>
	<form action="zarejestruj.php">
	<input class="przycisk" type="submit" value="Zarejestruj się">
	</form>
	<?php
	if (isset($_SESSION['blad']))
		echo $_SESSION['blad'];
	?>
	</br></br></br></br>
	

		</div>
		<div id="test"><b>Don't stop.</b></br>  ( ͡° ͜ʖ ͡°)</div>
	</div>
	<div style="float:left;margin-top: 63px;" ><img src="sinus.png" alt=""></img></div>
	</div>
</div>


<!-- &copy Bobi -->

</body>
</html>

