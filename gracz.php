<?php
session_start();
	unset($_SESSION['brak']);

	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == false))
	{
		header('Location: index.php'); 
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
	

</head>
<body>
<div id = "top">

<div id="uberMenu">
<?php
	$nick = @$_GET['nick'];
	if (!isset($nick))
	{
		echo "Niestety nie wybrałeś gracza ";
		echo '<a href="gra.php" class="przycisk">Twoje konto</a>';
		exit();
	}
	$nick = htmlentities($nick);
	require_once "connect.php";
	
	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno; //dodaje kod błedu connect_error opis" gdyby nie @ to cos
	}
	else 
	{
		$zapytanie = sprintf('SELECT * FROM uzytkownicy WHERE user = "%s" ',$nick);
		//potencjalna możliowść ataku, niegrożna ale możliwa
	
		
		if ($rezultat = $conn->query($zapytanie))
		{
			
			$wiersz = $rezultat->fetch_assoc();
			$ile = $rezultat->num_rows;
		
			if ($ile == 0)
			{
				echo "Niestety nie wybrałeś poprawnego gracza";
				echo '</br><a href="gra.php" class="przycisk">Twoje konto</a>';
				exit();	
			}
		}
	else
	{
		echo 'Zapytanie nie powiodło się';
		exit();
	}
			
		
}
	
		// gdy zapytanie się uda
		
		
		echo "<h1>Ten gracz nazywa się : <b style=".'"color:red;"'.">".$nick."</b></br> i nic ci do tego</h1>";
		echo '<div style="text-align:center;"><a class="przycisk"href="gra.php" >Twoje Konto</a></div>';
		
		
		$a =  $_SESSION['kwadrat']	+ $_SESSION['trojkat'] +  $_SESSION['sinus'];
		$b = $wiersz['sinus'] + $wiersz['kwadrat'] + $wiersz['trojkat'];
	
		echo "</br> Twoja siła bojowa to  $a  a jego </br> siła bojowa to $b, ";
		if ($a > $b) echo "nie wypada atakować słabszych :^(";
		elseif ($a < $b) echo "może chcesz go zaatakować :^)";
		elseif ($a == $b) echo  "nie wypada atakować słabszych ( ͡° ͜ʖ ͡°) ";
			


		echo '</br><a href="atak.php" class="przycisk">ATAKUJ!</a>';
		$_SESSION['gracz'] = $nick;

	
		
		

	
?>
</div>
</div>


<!-- &copy Bobi -->

</body>
</html>

