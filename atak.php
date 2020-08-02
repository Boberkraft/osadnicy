<?php
session_start();
	unset($_SESSION['brak']);

	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == false))
	{
		header('Location: index.php'); 
		exit();//natychmiastowe przejscie, wyjscie
		
	}
	
	function wynikWalki($atakujacy,$broniacy)
	{
		$wynikWalki = abs($atakujacy - $broniacy);
		if ($atakujacy > $broniacy)
		{
			//atakujacy przegrywa
			return array(0, $wynikWalki);
		}
		else if ($atakujacy < $broniacy)
		{
			 return array($wynikWalki, 0);
		}
		else if ($atakujacy == $broniacy)
		{
			 return array(0, 0);
		}
		else 
		{
			echo 'Błąd wynikWalki, zgłoś!';
			exit();
		}
	 //można dopisać 2 wyrazy sprawdzić tam wyżej
		
	}
	function zabraneSurki($resors, $ile)
	{
		if ($resors >= $ile) return $ile;
		if ($resors < $ile) return $resors;

	}
	
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Gra</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<style>
	table
	{
	border: 2px solid #fafafa;	
		
	}
	td
	{
		border: 2px solid #fafafa;	
		text-align:center;
		color:#ffffff;
	}	
	td:nth-of-type(3n+1)
	{
		color:#000000;
	}
	</style>

</head>
<body>
<div id = "top">

<div id="uberMenu">
<?php
	$nick = $_SESSION['gracz']; //przeciwnik
	$id = $_SESSION['id'];
	if (!isset($nick))
	{
		echo "Niestety nie wybrałeś gracza ";
		echo '<a href="gra.php" class="przycisk">Twoje konto</a>';
		exit();
	}
	require_once "connect.php";
	
	
	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno != 0)
	{
		echo 'Error: '.$conn->connect_errno; //dodaje kod błedu connect_error opis" gdyby nie @ to cos
		exit();
	}

		$zapytanie = sprintf('SELECT * FROM uzytkownicy WHERE user = "%s" ',$nick);
		$zapytanie2 = sprintf('SELECT * FROM uzytkownicy WHERE id = "%s" ',$id);
		//potencjalna możliowść ataku, niegrożna ale możliwa
		
	
		
		if ($rezultat = $conn->query($zapytanie))
		{
			
			$wiersz = $rezultat->fetch_assoc();
			$ile = $rezultat->num_rows;
			
			if ($rezultat2 = $conn->query($zapytanie2))
			{
			$wiersz2 = $rezultat2->fetch_assoc();
			$ile2 = $rezultat2->num_rows;
			}
			else
			{
			echo 'Zapytanie nie powiodło się 2';
			exit();
			}
		
			if ($ile == 0 || $ile2 == 0)
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
			// gdy zapytanie się uda
			// moc jednostek
			
		//define(atakkwadrat, 3.2);
		//define(ataktrojkat, 2.3);
		//define(ataksinus, 3);
		
		// kwadrat broni surowcór, trojkat zabiera surowce, sinus robi to i to
						
		//gracza
		$twojNick = $wiersz2['user'];
		$twojK = $wiersz2['kwadrat'];
		$twojT = $wiersz2['trojkat'];
		$twojS= $wiersz2['sinus'];
		$twojA= $wiersz2['drewno'];
		
			//moc ataku gracza 
			//$mocGracza = $twojT + 0.5 * $twojS;
		
		//wroga
		$idWroga = $wiersz['id'];
		$K = $wiersz['kwadrat'];
		$T = $wiersz['trojkat'];
		$S = $wiersz['sinus'];
		
		$Ka = $wiersz['kamien'];
		$D= $wiersz['drewno'];
		$Z= $wiersz['zboze'];
		
			//moc ataku wroga
			//$mocWroga = $K + 0.5 * $S;
	
			$wynik = wynikWalki($twojK,$T*2); 
			
			
			$wynikWroga = $wynik['0'];
			$wynikGracza = $wynik['1'];
			
			
			
			
			//kradzież surki
			if ($wynikGracza != 0)
			{
				$zabierasz = $wynikGracza * 100;
				
				$resztakwadratów = round ($wynikGracza * 0.95);
				$strataKwadratów =$wynikGracza - $resztakwadratów;
				
				$zabieranaK = zabraneSurki($K, $zabierasz);
				$zabieranaD = zabraneSurki($D, $zabierasz);
				$zabieranaZ = zabraneSurki($Z, $zabierasz);
				
				//Aktualizowanie sesji
				$_SESSION['drewno'] += $zabieranaD;
				$_SESSION['kamien'] += $zabieranaK;
				$_SESSION['zboze'] += $zabieranaZ;
				$_SESSION['kwadrat'] = $resztakwadratów;
				
				//$test = "UPDATE uzytkownicy SET drewno = drewno + 1 ";
				
				$aktualizujSurowceAtakujacego = sprintf('UPDATE uzytkownicy SET drewno = drewno + %s, kamien = kamien + %s, zboze = zboze + %s WHERE id= %s'
				,$zabieranaD,$zabieranaK,$zabieranaZ,$id);

				$aktualizujSurowceObroncy = sprintf('UPDATE uzytkownicy SET drewno = drewno - %s, kamien = kamien - %s, zboze = zboze - %s WHERE id= %s'
				,$zabieranaD,$zabieranaK,$zabieranaZ,$idWroga);
				
				$aktualizujWojskaObroncy = sprintf('UPDATE uzytkownicy SET trojkat = 0 WHERE id= %s'
				,$idWroga);
				
				$aktualizujWojskaAtakujacego = sprintf('UPDATE uzytkownicy SET kwadrat = %s WHERE id= %s'
				,$resztakwadratów,$id);
						
				if (mysqli_query($conn,$aktualizujSurowceAtakujacego)) 
				;
				else
				{
					echo '</br></br> Bład 1:'.mysqli_error($conn) ;
				}
				if (mysqli_query($conn,$aktualizujSurowceObroncy))
			;
				else
				{	
					echo '</br></br> Bład 2:'.mysqli_error($conn) ;
				}
					if (mysqli_query($conn,$aktualizujWojskaObroncy))
			;
				else
				{	
					echo '</br></br> Bład 3:'.mysqli_error($conn) ;
				}
					if (mysqli_query($conn,$aktualizujWojskaAtakujacego))
			;
				else
				{	
					echo '</br></br> Bład 4 :'.mysqli_error($conn) ;
				}
				
				
			}
			else 
			{
				echo 'Niestety przegrałeś! :^(';
			}
		
		
echo<<<END
</br>
	Zyskałeś :
</br>	$zabieranaD Drewna
</br>	$zabieranaK Kamienia
</br>	$zabieranaZ Zboża
</br>
	Straciłeś $strataKwadratów kwadrat!


		<table>
		<tr>
			<td>XXX</td><td>Ty</td><td>Wróg</td>
		</tr>
		<tr>
			<td>Nick</td><td>$twojNick</td><td>$nick</td>
		</tr>
		<tr>
			<td>Kwadraty</td><td>$twojK</td><td>$K</td>
		</tr>
		<tr>
			<td><s>Sinusy</s></td><td><s>$twojS</s></td><td><s>$S</s></td>
		</tr>
		<tr>
			<td>Trojkaty</td><td>$twojT</td><td>$T</td>
		</tr>
		<tr>
			<td>Pozostało</td><td >$resztakwadratów kwadratów</td><td>$wynikWroga trójkątów</td>
		</tr>
	
		</table>
		</br></br><a href="gra.php" class="przycisk">Twoje konto</a>          <a href="ranking.php" class="przycisk">Ranking</a>
END;
		

		
		//$a =  $_SESSION['kwadrat']	+ $_SESSION['trojkat'] +  $_SESSION['sinus'];
		//$b = $wiersz['sinus'] + $wiersz['kwadrat'] + $wiersz['trojkat'];
	/*
		$motto = "życie"
		$motto2 = "szczęście"
		
		if (!$motto == $motto2)
		{
			echo 'Życie jest kłamstwem.';
		}
	*/
	
?>
</div>
</div>

	





<!-- &copy Bobi -->

</body>
</html>

