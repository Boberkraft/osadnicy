<?php
	session_start();

	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	unset($_SESSION['dodanabudowla']);
	unset($_SESSION['kupione']);

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Podsumowanie zamówienia</title>
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css" type="text/css"/>

</head>
<body>

<?php
//kolor 
	$a=$_SESSION['drewno']; //amplitur
	$a1= $_SESSION['lvldrewna']; 
	$b=$_SESSION['kamien'];	//faza
	$b1= $_SESSION['lvlkamienia'];
	$c=$_SESSION['zboze']; //hz
	$c1= $_SESSION['lvlzboza'];
	$d=$_SESSION['dnipremium'];
	$g=$_SESSION['user'];
	$e = $_SESSION['error'];
	$i = $_SESSION['kwadrat'];
	$o = $_SESSION['trojkat'];
	$p = $_SESSION['sinus'];

	/* <b>Drewno</b>: $a</br> Na poziomie $a1 </br></br>
		<b>kamień</b>: $b </br> Na poziomie $b1 </br></br>
		<b>zboże</b>: $c </br> Na poziomie $c1 </br></br>*/
echo<<<END
<div id="top">


	<div id="menu" >
		<div id="leweMenu"> 
			<div style="height:211px;"><img src="skwadrat.png" alt=""></img><div class="napis"><b>Sygnał kwadratowy </b></div><span>Posiadasz : $i</span></div>
			
			<div style="height:211px;"><img src="stroj.png" alt=""></img><div class="napis"><b>Sygnał trójkątny </b></div><span>Posiadasz: $o</span></div>
			
			<div style="height:211px;"><img src="ssinus.png" alt=""></img><div class="napis"><b>Sygnał sinusoidalny </b></div><span>Posiadasz: $p</span></div>
			
			<div class="dolDiv"><img src="amplituda.png" alt=""></img><b>Amplituda</b>:</br> $a</br> </br><b>Na poziomie</b>:</br> $a1 </br></br></div>
			<div class="dolDiv"><img src="faza.png" alt=""><b>Faza początkowa</b>: </br>$b </br></br> <b>Na poziomie</b>:</br> $b1 </br></br></img></div>
			<div class="dolDiv"><img src="hz.png" alt=""><b>Częstotlowość</b>: </br>$c </br></br> <b>Na poziomie</b>:</br> $c1 </br></br></img></div>
		</div>
		
		<div id="praweMenu1">
			Witaj  $g <div style="text-align:right;float:right;margin-right: 10px;"><a class="przycisk" href="logout.php">Wyloguj się!</a></div> </br> Poziom Fajności to $d </br> </br> </br> $e </br></br> Trójkąty bronią, Kwadraty atakują, sinusy są bezużyteczne!
		</div>
		
		<div id="praweMenu2">
			<a class="przycisk" style="width:90px;margin-top:30px;margin-left:30px;" href="menuUlepszania.php">Ulepsz</a></br>
			
			<a class="przycisk" style="width:90px;margin-top:30px;margin-left:30px;"href="menuKupowania.php"> Kup sygnały</a></br>
			<a class="przycisk" style="width:90px;margin-top:30px;margin-left:30px;"href="ranking.php"> Ranking</a></br>
			<a class="przycisk" style="width:90px;margin-top:30px;margin-left:30px;"href="404.php"> Kontakt z OP</a></br>
		</div>
	<!--<div style="clear:both;"></div>-->
	
	
</div>
END;
/*
	
	echo "<p>Witaj ".$_SESSION['user'].' !  [<a href="logout.php"]>Wyloguj się!</a>]  <a href="menuUlepszania.php">[Ulepsz]</a><a href="ranking.php"> [Ranking]</a></p>';
	echo "<p><b>Drewno</b>: ".$_SESSION['drewno'];
	echo "| <b>Kamień</b>: ".$_SESSION['kamien'];
	echo "| <b>Zboże</b>: ".$_SESSION['zboze']."</p>";
	
	
	echo "<p><b>Email</b>: ".$_SESSION['email'];
	echo "</br><b>Poziom fajności: </b>: ".$_SESSION['dnipremium']."</p>";
	echo "<p><b>Poziom drewna</b>: ".$_SESSION['lvldrewna'];
	echo "| <b>Poziom kamienia</b>: ".$_SESSION['lvlkamienia'];
	echo "| <b>Poziom zboża</b>: ".$_SESSION['lvlzboza']."</p>";
	echo "| <b>Błędy</b>: ".$_SESSION['error']."</p>";
	
	<div style="color:#303099;">
		&#36;_SESSION['<span style="color:#993030">if(&#36;conn->connect_errno!=0){echo "Error:".&#36;conn->connect_errno;</span>']
		</div> 
		<!-- wcale tego tutaj nie dałem by wyglądało mądrze XDDDDD
	*/
	echo<<<END
	</br> 
		<h2>
		<!--
		
		JEBAĆ TO JEBANE PHP 

			W C++ o błędach powiadamia kompilator
			A w PHP klient ( ͡° ͜ʖ ͡°)
			
			Jak można pisać w #php? po jednym dniu spędzonym z tym językiem(?) rzygam składnią, to jest tak kurewsko wkurwiające że się 
			wytrzymać nie da, bierzecie jakieś środki na uspokojenie czy coś? Jest jakiś kurs typu "nie wkurw się przy pisaniu kodu php"? 
			No kurwa nie mogę, ledwo formularz logowania i sesji zrobiłem i już nie nadążam z browarem na uspokojenie bo szlag mnie jasny trafia. 
			Jak żyć?
			
			Funkcje już dotknęłem :^)
			
		
		-->
		</h2>
END;
	

?>
</br></br></br>
<form>

</form>

</body>
</html>

