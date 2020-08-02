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

	$a = $_SESSION['kwadrat'];
	$b = $_SESSION['trojkat'];
	$c = $_SESSION['sinus'];
echo<<<END
	
	<form action="kupowanie.php" method="post">
		<b>Co chcesz ulepszyć?</b>: </br>
		</br>(300 A | 200 P | 150  HZ) </br><input type="text" style="width:40px;" name="kwadrat" value=""/> Sygnał kwadratowy . Masz $a </br>
		</br> (200 A | 300 P | 150  HZ)</br> <input type="text" style="width:40px;" name="trojkat" value=""/> Sygnał trójkątny. Masz $b </br>
		 </br><s>(100 A | 100 P | 200  HZ)</br><input type="text" style="width:40px;" name="sinus" value=""/> Sygnał sinusoidalny . Masz  $c</s></br>
		<input class="przycisk" type="submit"value="Kup"/>

	</form>
	</br>
END;
	if (isset($_SESSION['kupione']))
		echo $_SESSION['kupione'];
	?>
	</br> Kwadrat atakuje i zabiera surowce a trójąt broni! SINUS JEST BEZUŻYTECZNY
	</br> </br> </br> <a class = "przycisk"href="index.php"> Twoje konto</a> </br>
	
</div>
</div>



<!-- &copy Bobi -->

</body>
</html>

