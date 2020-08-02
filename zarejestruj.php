<?php
session_start();
	/*
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
	{
		header('Location: gra.php'); 
		exit();//natychmiastowe przejscie, wyjscie
		
	}
	
	*/
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Panel Rejestracyjny</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script src='https://www.google.com/recaptcha/api.js'></script>
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
		<div  id="login">
	<b>Zarejestruj się!</b>
	<form action="rejestracja.php" method="post">

		Login: </br>
		<input type="text" name="login" /> </br> </br>
		Email: </br>
		<input type="text" name="email" /> </br></br>
		Hasło: </br>
		<input type="password" name="haslo" /> </br></br>
		Ponów hasło: </br>
		<input type="password" name="hasloPonowione" /> </br></br>

		<label>
			<input type="checkbox" name="regulamin" /> Akceptuje regulamin
		</label>
		<div class="g-recaptcha" data-sitekey="6LeVIRQTAAAAALeBxJJsX2_9GBXANcIIVkcZGTkn"></div>


		<input class="przycisk" type="submit" value="Załóż konto " />
		
	</form>
	
	
	<form action="index.php">
	
	<input class="przycisk" type="submit" value="Mam już konto!">
	
	<?php
	if (isset($_SESSION['brak'])) echo $_SESSION['brak'];
	?>
	
	</div>
	<div id="test"><b>Don't stop.</b></br>ᕦ( ͡° ͜ʖ ͡°)ᕤ</div>
	</div>
	
	<div style="float:left;margin-top: 63px;" ><img src="sinus.png" alt=""></img>
	</div>
	
	
	
</div>
</div>
<!-- &copy Bobi -->

</body>
</html>

