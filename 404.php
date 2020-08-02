
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Gra</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<style>
	s
	{
		color:red;
	}
	</style>

</head>
<body>

<div style="margin-left: auto;margin-right: auto;width:500px;text-align:center;">
<h1  ><b style="color:black;font-weight: 900;">Bład 404</b> </br>Nie znaleziono strony</h1>
<a class="przycisk"href="index.php"/>Strona główna</a>
</br>
</br>
</br>
</br>
<h3 style="text-align:left" ><b  style="color:black;font-weight: 900;text-align:center;" >Jeszcze muszę zrobić:</b> </br>
</br>{
</br>- <s>indywidualna strona każdego gracza, dać tam POST by było id w nazwie</s>
</br>- weryfikacja czy dany nick już istnieje
</br>- zmienić systemu budowy i puktów
</br>-<s> możliwośc atakowania</s>
</br>-<s> klikania na gracza w rankingu</s>
</br>- edycja swojego profilu
</br>- surki się odnawiają za każdym razem gdy odświeżysz (js lub php)
</br>- dodać zastosowanie sinusów
</br>- info strona wyjaśniająca zadasady?
</br>- <s>by ataki aktualizowały sesję</s>
</br>- <s>coś ten lennyFace jest odporny na ataki </s>
</br>- ładnie wyglądające ruszająca się sinusoida!
</br>- Segregacja śmiecowych nicków
</br>- 
</br>}
</h3>
</div>
</br>
</br>
<?php

	function my_sort($a,$b)
	{
	
	    return $a['liczba'] - $b['liczba']; //what the fuck !?
	}

	$a=array(
	array("imie"=>"Bobi ma ","liczba"=>"20","syf"=>" lat"),
	array("imie"=>"Doba ma ","liczba"=>"6","syf"=>" miesięcy"),
	array("imie"=>"Adad ma ","liczba"=>"7","syf"=>" dni")
	);
	usort($a,"my_sort");

	$arrlength=count($a);
	for($x=0;$x<$arrlength;$x++)
		{
			
		 /*
		echo $a[$x]['imie'];
		echo $a[$x]['liczba'];
		echo $a[$x]['syf'];
		echo "</br>";
		*/
			
	   }
	 /*
	 OUT
	 
	Doba ma 6 miesięcy
	Adad ma 7 dni
	Bobi ma 20 lat
	
	 */

	?>

</body>
</html>

