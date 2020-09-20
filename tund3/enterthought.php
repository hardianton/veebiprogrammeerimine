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
?>
  
  <a href="home.php">Home</a>
  <hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte!</label>
  <input type="text" name="nonsens" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsens">
  </form>
  <hr>
  
</body>
</html>
