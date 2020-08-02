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
	
	if (isset('email')) 
	{
		//wszystko ok?
		$wszystkoOK = TRUE;

		//nick
		$nick = $_POST['login'];

		if (strlen($nick) < 3 || strlen($nick) > 20) 
		{
			$wszystkoOK = false;
			$_SESSION['e_nick'] = 'Nick musi posiadać od 3 do 20 znaków';
		}

		if($wszystkoOK)
		{
			//wszystko ok
		

		}

	}
	$data = date("Y-m-d H:i:s");
	$data = sprintf("CAST('%s' AS DATETIME)",$data);  //chyj
	
	$zapytanie = sprintf("INSERT INTO uzytkownicy VALUES (NULL, '".$login."', '".$haslo."', '".$email."',100, 100,100,0,0,10, 100, FALSE ,%s)",$data);
	$zapytanieCzyJestGracz = sprintf('SELECT user FROM uzytkownicy WHERE user = "%s" ', $login);
	
	
	//$zapytanie = "INSERT INTO uzytkownicy VALUES (NULL, '".$login."', '".$haslo."', '".$email."',100, 100,100, 100)"; //pamietac o zasadzie "  i ' !
	$odpowiedzGracz = mysqli_query($conn,$zapytanieCzyJestGracz);
	$wierszGracza = $odpowiedzGracz -> fetch_assoc();
	if ($wierszGracza['user'] == $login)
	{
		echo "wybacz taki gracz już istnieje";
		$_SESSION['brak'] = '<p style="color:red;"><b>Gracz z taką nazwą istnieje!</b></p>';
		header('Location: zarejestruj.php');
		exit();
	}
	
		
	
	if (mysqli_query($conn, $zapytanie)) //pyta serwer czy cos
	{
		echo "Nowy użytkownik dodany";
		echo '</br></br> <a href="index.php">Zaloguj się</a>';	
		$_SESSION['blad'] = '<p style="color:green;"><b>Nowy użytkownik dodany!</br> Zaloguj się</b></p>';
		header('Location: index.php');
	}
	
	else
	{
		echo "Błąd dodawania użytkownika";
	}
	
	//$conn->query($zapytanie);
	
		
	}
	//echo $zapytanie;
	$conn->close();
	
	
	
?>