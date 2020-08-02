<?php
session_start();
	unset($_SESSION['brak']);

	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == FALSE))
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
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" type="text/css"/>

</head>
<body>
<div id = "top">

<div id="uberMenu">
	<?php
	$a = $_SESSION['lvlkamienia'];
	$b = $_SESSION['lvlzboza'];
	$c = $_SESSION['lvldrewna'];
	
	
echo<<<END
	<form action="upgrade.php" method="post">
		<b>Co chcesz ulepszyć?</b>: </br>
		<input type="radio" name="budowla" value="kamien"/>  Fazę początkową  $a lvl</br>
	
		<input type="radio" name="budowla" value="drewno"/> Amplitudę $c lvl</br>
			<input type="radio" name="budowla" value="zboze"/> Częstotliwość  $b lvl</br>
		<input type="submit"value="Kup"/>

	</form>
	</br>
END;
	if (isset($_SESSION['dodanabudowla']))
		echo $_SESSION['dodanabudowla'];
	?>
	</br> </br> </br> <a class = "przycisk" href="index.php"> Twoje konto</a>
	

</div></div>


<!-- &copy Bobi -->

</body>
</html>

