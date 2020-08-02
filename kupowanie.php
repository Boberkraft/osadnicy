<?php

	session_start();
	
/*
	if (!isset($_POST['login']) || (!isset($_POST['haslo']) || (!isset($_POST['email']))))
	{
		header('Location: index.php');
		exit();
		
	}
*/
	require_once "connect.php";
	
	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno; //dodaje kod błedu connect_error opis" gdyby nie @ to cos
	}
	else 
	{
	
		$kwadrat = $_POST['kwadrat'];
		$trojkat = $_POST['trojkat'];
		$sinus = $_POST['sinus'];
		//gdy coś nie jest intem zapisz tam 0;
		
		
		if (!$kwadrat && !$trojkat && !$sinus )
		{
			header('Location: menuKupowania.php');
			$_SESSION['kupione'] = '<b style="color:red;">Wpisz wartości!</b>';
			exit();
		}	
		if ($kwadrat == 0) $kwadrat = 0;
		if ($trojkat == 0) $trojkat = 0;
		if ($sinus == 0) $sinus = 0;
		
		if (!is_int($kwadrat) ) $_SESSION['kupione'] = '<b style="color:red;">Wpisz liczbę! 1</b>';
		if (!is_int($trojkat) ) $_SESSION['kupione'] = '<b style="color:red;">Wpisz liczbę! 2</b>';
		if (!is_int($sinus) ) $_SESSION['kupione'] = '<b style="color:red;">Wpisz liczbę! 4</b>';
		echo $kwadrat, ' | ',$trojkat,' | ',$sinus;
		
		//if (((!is_int($kwadrat) && $kwadrat != null)) || (!is_int($trojkat) && $trojkat != null) || (!is_int($sinus) && $sinus != null))
	//	{
		//	$_SESSION['kupione'] = '<b style="color:red;">Wpisz liczbę!</b>';
	//	header('Location: menuKupowania.php');
			
		
		$kosztAmplitudy = $kwadrat * 300 + $trojkat * 200 + $sinus * 150;
		$kosztFazy = $kwadrat * 200 + $trojkat * 300 + $sinus * 150;
		$kosztHz = $kwadrat * 100 + $trojkat * 100 + $sinus * 200;
		
		
		//DODAĆ TWOJ HAJS
		//$pokaSurki = sprintf("SELECT drewno, kamien, zboze FROM uzytkownicy WHERE idgracza = %s",$_SESSION['id']);
		$id = $_SESSION['id'];
		
		if ($rezultatHajs = $conn->query("SELECT drewno, kamien, zboze FROM uzytkownicy WHERE id = $id"))
	;
		
		else
		{
			echo "Wystąpił 0 błąd ulepszenia, zapytanie o surowce się nie udało !!!11one. </br> <b>Wyjebać PHP i zatrzymać GENERATOR!!</b>";
			exit();
		}
		$row = $rezultatHajs->fetch_assoc();
		$twojaAmplituda = $row['drewno'];
		$twojaFaza = $row['kamien'];
		$twojaHz = $row['zboze'];
		
		if (($kosztAmplitudy <= $twojaAmplituda)&&($kosztFazy <= $twojaFaza)&&($kosztHz <= $twojaHz))
		{
			//wszystko się zgadza mam surki
			$twojaAmplituda -= $kosztAmplitudy;
			$twojaFaza -= $kosztFazy;
			$twojaHz -= $kosztHz;
			
			
			$dodajWojo = sprintf("UPDATE uzytkownicy SET kwadrat = kwadrat + %s,	trojkat = trojkat + %s, sinus = sinus + %s WHERE id = %s",
			$kwadrat,$trojkat,$sinus,$_SESSION['id']);
			
			$zmniejszHajs = sprintf("UPDATE uzytkownicy SET drewno = %s,kamien =  %s, zboze = %s WHERE id = %s",
			$twojaAmplituda,$twojaFaza,$twojaHz,$_SESSION['id']);
			
			if (mysqli_query($conn, $dodajWojo))
			{
				if (mysqli_query($conn, $zmniejszHajs))
				{
				$_SESSION['kupione'] = "Kupiłeś : ". $kwadrat." kwadratów, ".$trojkat." trójkątów i ".$sinus." sinusoid!</br> Kosztowało cię to ".$kosztAmplitudy." Amplitud, ".$kosztFazy." punktów sygnałowych i ".$kosztHz." częstotliwości! ";
				$_SESSION['kwadrat'] += $kwadrat;
				$_SESSION['trojkat'] += $trojkat;
				$_SESSION['sinus'] += $sinus;
				$_SESSION['drewno'] -= $kosztAmplitudy;
				$_SESSION['kamien'] -= $kosztFazy;
				$_SESSION['zboze'] -=$kosztHz;
				}
				else
				{
					echo "Wystąpił 2 błąd ulepszenia, zapytanie o odjęcie surowców się nie udało !!!11one. </br><b>Wyjebać PHP i zatrzymać GENERATOR!!</b>";
					exit();
				}
			}
			else
			{
				echo "Wystąpił 1 błąd ulepszenia, zapytanie o dodanie wojska się nie udało !!!11one. </br> <b>Wyjebać PHP i zatrzymać GENERATOR!!</b>";
				echo mysqli_error($conn);
				exit();
			}
		
		}
		else //nie masz skurki
		{
			$_SESSION['kupione'] = '<span style="color:red;">Za mało surowców!</span>'; //gdy masz mało skurki
		}
	}
			
		
	header('Location: menuKupowania.php');
	$conn->close();
	
	
	
?>