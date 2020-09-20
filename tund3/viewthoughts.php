<?php
//loeme andmebaasi login info muutujad
require("../../../config.php");
//kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
$database = "if20_hardi_an_3";
if(isset($_POST["submitnonsens"])){
	if(!empty($_POST["nonsens"])){
		//andmebaasi lisamine
		//loome andmebaasi ühenduse
		$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
		//valmistame ette sql käsu
		$stmt = $conn->prepare("INSERT INTO nonsense(nonsenseidea) VALUES(?)");
		echo $conn->error;
		$stmt->bind_param("s", $_POST["nonsens"]);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	}
}

//loeme andmebaasist
$nonsenshtml="";
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
//valmistame ette sql käsu
$stmt = $conn->prepare("SELECT nonsenseidea FROM nonsense");
echo $conn->error;
//seome tulemuse mingi muutujaga
$stmt->bind_result($nonsensfromdb);
$stmt->execute();
//võtan kuni on
while($stmt->fetch()){
	$nonsenshtml .= "<p>" .$nonsensfromdb ."</p>";
}
$stmt->close();
$conn->close();
//ongi andmebaasist loetud
?>

<a href="home.php">Home</a>
<?php echo $nonsenshtml; ?>