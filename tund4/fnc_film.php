<?php
$database = "if20_hardi_an_3";

function readfilms(){
	//var_dump($GLOBALS);

	//loeme andmebaasist
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//valmistame ette sql käsu
	$stmt = $conn->prepare("SELECT * FROM film");
	echo $conn->error;
	//seome tulemuse mingi muutujaga
	$stmt->bind_result($titlefromdb, $yearfromdb, $durfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	$stmt->execute();
	//võtan kuni on
	$filmshtml="\t <ol> \n";
	while($stmt->fetch()){
		$filmshtml .= "\t \t <li>" .$titlefromdb;
		$filmshtml .= "\t \t \t <ul> \n";
		$filmshtml .= "\t \t \t <li>Valmimisaasta: " . $yearfromdb ."</li> \n";
		$filmshtml .= "\t \t \t <li>Kestus: " . $yearfromdb ." minutit </li> \n";
		$filmshtml .= "\t \t \t <li>Žanr: " . $genrefromdb ."</li> \n";
		$filmshtml .= "\t \t \t <li>Stuudio: " . $studiofromdb ."</li> \n";
		$filmshtml .= "\t \t \t <li>Lavastaja: " . $directorfromdb ."</li> \n";
		$filmshtml .= "\t \t \t </ul> \n";
		$filmshtml .= "</li> \n";
	}
	$filmshtml .= "\t </ol> \n";

	$stmt->close();
	$conn->close();
	return $filmshtml;	
}

function writefilm($title, $year, $duration, $genre, $studio, $director){
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare(INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES());
}

function readfilmstable(){
	//var_dump($GLOBALS);

	//loeme andmebaasist
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//valmistame ette sql käsu
	$stmt = $conn->prepare("SELECT * FROM film");
	echo $conn->error;
	//seome tulemuse mingi muutujaga
	$stmt->bind_result($titlefromdb, $yearfromdb, $durfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	$stmt->execute();
	//võtan kuni on
	$filmshtml="<table border = '1'>";
	$filmshtml.="<caption>Filmid</caption>";
	while($stmt->fetch()){
		$filmshtml .= "<tr>";
		$filmshtml .= "<th>Pealkiri</th><th>Valmimisaasta</th><th>Kestus</th><th>Žanr</th><th>Stuudio</th><th>Lavastaja</th>";
		$filmshtml .= "</tr>";
		$filmshtml .= "<tr>";
		$filmshtml .= "<td>" . $titlefromdb ."</td>";
		$filmshtml .= "<td>" . $yearfromdb ."</td>";
		$filmshtml .= "<td>" . $durfromdb ."</td>";
		$filmshtml .= "<td>" . $genrefromdb ."</td>";
		$filmshtml .= "<td>" . $studiofromdb ."</td>";
		$filmshtml .= "<td>" . $directorfromdb ."</td>";
		$filmshtml .= "</tr>";
	}
	$filmshtml .= "</table>";

	$stmt->close();
	$conn->close();
	return $filmshtml;	
}
?>
