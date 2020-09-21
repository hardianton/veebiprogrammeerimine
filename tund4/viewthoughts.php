<?php
$username = "Hardi Anton";
//loeme andmebaasi login info muutujad
require("../../../config.php");
//kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
$database = "if20_hardi_an_3";

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


<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  <li><a href="home.php">Avalehele</a></li>
  <hr>
<?php echo $nonsenshtml; ?>