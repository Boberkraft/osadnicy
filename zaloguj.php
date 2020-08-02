<?php
	session_start();
	
	if (!isset($_POST['login']) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
		
	}

	require_once "connect.php";
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno; //dodaje kod błedu connect_error opis" gdyby nie @ to cos
	}
	else 
	{
	
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	
	$login = htmlentities($login, ENT_QUOTES, "UTF-8"); //quotes zamienia " i ' \ 3 paramter to charset
	$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8"); //Encje Html | zamienia np > na &gt 
	
	//$sql = ; //pamietac o zasadzie "  i ' !
	
	if ($rezultat = @$polaczenie->query(
	sprintf("SELECT * FROM uzytkownicy WHERE user ='%s' AND pass='%s'",
	mysqli_real_escape_string($polaczenie,$login), 
	mysqli_real_escape_string($polaczenie,$haslo))))
	{
		$ilu_userow = $rezultat->num_rows;
		if ($ilu_userow>0)
		{
			$_SESSION['zalogowany'] = true;
			
			//zwiekszanie surowcow
			
			
			
			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['wioska'] = $wiersz['wioska'];
			$_SESSION['id'] = $wiersz['id']; 
			
			if($wiersz['wioska'] == TRUE)
			{
				if ($rezultatwioska = @$polaczenie->query(sprintf("SELECT * FROM wioska WHERE idgracza=%s", $wiersz['id'] )))
				{
				$wierszewioski = $rezultatwioska->fetch_assoc();
				$_SESSION['lvlkamienia'] = $wierszewioski['kamien'];
				$_SESSION['lvlzboza'] = $wierszewioski['zboze'];
				$_SESSION['lvldrewna'] = $wierszewioski['drewno'];
				$stworzona = false;
				}
				
			}
			
			if($wiersz['wioska'] == FALSE)
			{
				$stworzona = true;
				$polaczenie->query(sprintf("INSERT INTO wioska VALUES (NULL, %s,1 ,1 ,1 )",$wiersz['id'])); //przyjrzeć się
				$polaczenie->query(sprintf("UPDATE uzytkownicy SET wioska=TRUE WHERE id=%s", $wiersz['id']));
				
				
				
				$_SESSION['lvlkamienia'] = 1;
				$_SESSION['lvlzboza'] =1;
				$_SESSION['lvldrewna'] = 1;
			}
			
			
			
			$staradata = $wiersz['ostatnielogowanie'];
			$staradata1 = strtotime($staradata);
			$nowadata = date("Y-m-d H:i:s");
			$nowadata1 = strtotime($nowadata);
		//	$datatest = date("Ymd i");
			$pszyrost = ($nowadata1-$staradata1)/10;
			
			$eror2= "</br> Przyrost na poziomie: ";
			
			$eror2= $eror2.$pszyrost;
		
			$czasLogowania= Floor(($nowadata1-$staradata1)/60);
			$_SESSION['error'] = $eror2."  </br>Ostatnie logowanie : ".$czasLogowania." minut temu";
			//$nowedrewno = $pszyrost*$wierszewioski['drewno'])+$wiersz['drewno']);
			$nowedrewno = $pszyrost*$wierszewioski['drewno']+$wiersz['drewno'];
			$nowekamien = $pszyrost*$wierszewioski['kamien']+$wiersz['kamien'];
			$nowezboze =   $pszyrost*$wierszewioski['zboze']+$wiersz['zboze'];
			
			
			$_SESSION['user'] = $wiersz['user'];
			$_SESSION['drewno'] = $wiersz['drewno'];
			$_SESSION['kamien'] = $wiersz['kamien'];
			$_SESSION['zboze'] = $wiersz['zboze'];
			$_SESSION['email'] = $wiersz['email'];
			$_SESSION['kwadrat'] = $wiersz['kwadrat'];
			$_SESSION['trojkat'] = $wiersz['trojkat'];
			$_SESSION['sinus'] = $wiersz['sinus'];
			$_SESSION['dnipremium'] = $wiersz['dnipremium'];
			if (!$stworzona)
			{
				$nowaDataDlaBazy = sprintf("CAST('%s' AS DATETIME)",$nowadata);
				if ($polaczenie->query(sprintf
				("UPDATE uzytkownicy SET drewno = %s, kamien=%s, zboze=%s, ostatnielogowanie =%s WHERE id= %s",
													$nowedrewno,$nowekamien,$nowezboze, $nowaDataDlaBazy,$wiersz['id']  )))
				{
				$_SESSION['drewno'] = $nowedrewno;
				$_SESSION['kamien'] = $nowekamien;
				$_SESSION['zboze'] = $nowezboze;
			//	$_SESSION['lvldrewna'] = "zapytanie udane";
				}
				else{
					
				}
			}
			
			
			
			unset($_SESSION['blad']);
			$rezultat->free();
			header('Location: gra.php');
			
			
		} else
		{
			$_SESSION['blad'] = '<span style="color:red"> Nieprawidłowy login lub hasło!</span>';
			header('Location: index.php');
		
		}
		
		
	}
	
	$polaczenie->close();
	}
	
	
?>