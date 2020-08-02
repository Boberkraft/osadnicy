<?php
	session_start();

	if (!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany'] == FALSE))
	{
		header('Location: index.php');
		exit();
	}
	unset($_SESSION['dodanabudowla']);

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Podsumowanie zamówienia</title>
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	
	<style>
	td
	{
		text-align:center;
		color:#000000;
	}	
	td:nth-of-type(4n+0)
	{
		color:#fff5ff;
	}
	input
	{
	  margin: 0;
	  padding: 0;
	  border: none;

	  background-color: transparent;
	 
	}
	.p
	{
		margin-top:0px;
		
	}
	</style>


</head>
<body>
<div id = "top">

<div id="uberMenu">

<?php
	
	require_once "connect.php";
	
	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno; //dodaje kod błedu connect_error opis" gdyby nie @ to cos
	}
	else 
	{
		if ($rezultat = $conn->query("SELECT * FROM uzytkownicy ORDER BY kwadrat ASC"))
		{
			
			
		}
		else{
			echo "Zapytanie do bazy się nie udało!";
			exit();
		}
		$ile = $rezultat->num_rows;
	
	
		$nr = 1;
		echo '<div id="logo"><b>Ranking graczy</b></div></br>';
		//	echo '<div style="width: 400px;height: 350px; overflow:scroll;">'; //POCZĄTEK SCROOBROOMU
		echo '<table class = "p"align="center" border="1" bordercolor="#d5d5d5" cellpadding="4" cellspacing="0"><tr>'; //góra tabelki
		
		echo 
	'<td width="20" align="center" bgcolor="e5e5e5">nr</td><td>Punkty</td><td>Wojsko</td><td > Nick</td></tr><tr>'."\n<!-Wygenerowana treść-->\n";
		

		$ranking = array(
		array("punkty"=>0,"content"=>"")
		);
		while($wiersz = $rezultat->fetch_array())
		{
			//ErrorDocument 404  http://localhost/404.php
			
			$punkty = $wiersz['drewno'] + $wiersz['kamien'] + $wiersz['zboze'];
			$wojsko =  $wiersz['trojkat'] + $wiersz['kwadrat'] + $wiersz['sinus'];
			//<form action='szukaj.php' method='get'><input value="%s" name="user"><input type="submit" value="GO"/></form>
			$napiskoniec = sprintf('<td>%s</td><td>%s</td><td style="text-align:left;"><form action="gracz.php" method="get"><input type="submit" name="nick" value="%s"/></form></td></tr>'."\n".'<tr>', $punkty,$wojsko,$wiersz['user'],$wiersz['user']);
		$napis = '<td width="20" align="center" bgcolor="e5e5e5">%s</td>'.$napiskoniec;
			array_push($ranking,array("punkty"=>$punkty,"content"=>$napis));
			$nr++;

		}
	}
	
	function my_sort($a,$b) 
	{
	
	    return $b['punkty'] - $a['punkty']; //what the fuck !? chyba sprawdza która liczba jest wieksza, przyjrzeć się działaniu usort()!
	}
	//return ($a > $b) ? -1 : 1;
	//If $a is greater than $b return -1, else return 1. 
		
	//////////////sortuje beze////////
	usort($ranking,"my_sort");    //
	///////////////////////////////////
	
	$pomoc=1;
	foreach($ranking as $result)
	{
			$result['content'] = sprintf($result['content'],$pomoc++); 
			echo $result['content']; //echo całabaza techbaza heheszki
		
	}
	//print_r($ranking);
	
	echo "</tr>\n<!- koniec wygenerowanej treści -->\n</table>";
	
	
$conn->close();
?>
<!--</div>-->
<p align="center">
<a class="przycisk" style="margin-left:5px;"href="index.php">Twoje konto</a></br></br>
&lt;-- To naprawdę powinno być zrobione obiektowo :^) --&gt;</br>
 &copy Bobi
</p>
</div>

</div>
</body>
</html>

