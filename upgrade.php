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
	
		$budowla = $_POST['budowla'];
		
		if (!$budowla )
		{
			header('Location: menuUlepszania.php');
			$_SESSION['dodanabudowla'] = '<p style="color:red;">Zaznacz budowlę!</p>';
			exit();
		}	
		
		
		
		$tak = false;
		switch ($budowla)
		{
			case "kamien":
				if($_SESSION['kamien'] >= 100)
				{
					$_SESSION['lvlkamienia'] += 1;
					$_SESSION['kamien'] -= 100;
					$tak = true;
				}
				break;
			case "zboze":
				if($_SESSION['zboze'] >= 100)
				{
					$_SESSION['lvlzboza'] += 1;
					$_SESSION['zboze'] -= 100;
					$tak = true;
					
				}
				break;
			case "drewno":
				if($_SESSION['drewno'] >= 100)
				{
					$_SESSION['lvldrewna'] += 1;
					$_SESSION['drewno'] -= 100;
					$tak = true;
				}
				break;
		
		}
		if ($tak)
		{
			$zapytanie = sprintf("UPDATE wioska SET %s = %s + 1 WHERE idgracza = %s",$budowla, $budowla,$_SESSION['id']);
			$zapytanie2 = sprintf("UPDATE uzytkownicy SET %s = %s - 100 WHERE id = %s",$budowla, $budowla,$_SESSION['id']);
		
			if (mysqli_query($conn, $zapytanie)) //pyta serwer czy cos
			{
				$_SESSION['dodanabudowla'] = "Ulepszone!";
				if (mysqli_query($conn, $zapytanie2))
				$_SESSION['dodanabudowla'] = "Ulepszone!";
				else
				{
					echo "Błąd ulepszania: 2 ";
					exit();
				}

			}
			
			else
			{
				echo "Błąd ulepszania ";
				exit();
			}
		}
		if (!$tak)
			$_SESSION['dodanabudowla'] = '<span style="color:red;">Za mało surowców!</span>';

	
		
	}
	header('Location: menuUlepszania.php');
	$conn->close();
	
	
	
?>