<?php
  $username = "Hardi Anton";
  $fulltimenow = date("d.m.Y H:i:s");
  $daynow = date("d");
  $monthnow = date("m");
  $hournow = date("H");
  $yearnow = date("Y");
  $timenow = date("H:i:s");
  $partofday = "lihtsalt aeg";
  
  //vaatame mida vormist serverile saadetakse
  //var_dump($_POST);
  
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  //küsime nädalapäeva
  $weekdaynow = date ("N");
  
  if($hournow < 6){
	  $partofday = "uneaeg";
  }
  if($hournow >= 6 and $hournow < 8){
	  $partofday = "hommikuste protseduuride aeg";
  }
  if($hournow >= 8 and $hournow < 18){
	  $partofday = "akadeemilise aktiivsuse aeg";
  }
  if($hournow >= 18 and $hournow < 22){
	  $partofday = "õhtuste toimetuste aeg";
  }
  if($hournow >= 22){
	  $partofday = "päeva kokkuvõtte ning magamamineku aeg";
  }
  
  //jälgime semestri kulgu
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $semesterdurationdays = $semesterduration->format("%r%a");
  $today = new DateTime("now");
  $fromsemesterstart = $semesterstart->diff($today);
  //saime aja erinevuse objektina, seda niisama näidata ei saa
  $fromsemesterstartdays = $fromsemesterstart->format("%r%a");
  $semesterpercentage = 0;
  
  
  
  $semesterinfo = "Semester kulgeb vastavalt akadeemilisele kalendrile.";
  if($semesterstart > $today){
	  $semesterinfo = "Semester pole veel peale hakanud!";
  }
  if($fromsemesterstartdays === 0){
	  $semesterinfo = "Semester algab täna!";
  }
  if($fromsemesterstartdays > 0 and $fromsemesterstartdays < $semesterdurationdays){
	  $semesterpercentage = ($fromsemesterstartdays / $semesterdurationdays) * 100;
	  $semesterinfo = "Semester on täies hoos, kestab juba " .$fromsemesterstartdays ." päeva, läbitud on " .$semesterpercentage ."%.";
  }
  if($fromsemesterstartdays == $semesterdurationdays){
	  $semesterinfo = "Semester lõppeb täna!";
  }
  if($fromsemesterstartdays > $semesterdurationdays){
	  $semesterinfo = "Semester on läbi saanud!";
  }
  
  //loen kataloogist piltide nimekirja
  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  $allpicfiles = [];
  $picfiletypes = ["image/jpeg", "image/png"];
  //käin kogu massiivi läbi ja kontrollin igat faili kas on sobiv
  foreach($allfiles as $file){
	  $fileinfo = getImagesize("../vp_pics/" . $file);
	  if(in_array($fileinfo["mime"], $picfiletypes) == true){
		  array_push($allpicfiles, $file);
	  }
  }
  //$allpicfiles = array_slice($allfiles, 2);
  //var_dump($allpicfiles);
  
  //paneme kõik pildid järjest ekraanile
  //uurime mitu pilti on ehk mitu faili on nimekirjas
  $piccount = count($allpicfiles);
  //$i = $i + 1; on sama mis
  //$i += 1; on sama mis
  //$i ++;
  $imghtml = "";
  $picnum = mt_rand(0, ($piccount - 1));
  $imghtml .= '<img src="../vp_pics/' .$allpicfiles[$picnum] .'" ';
  $imghtml .= 'alt="Random pic">';

require("header.php");
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise aeg: <?php echo $weekdaynameset[$weekdaynow - 1] .", " . $daynow .". " . $monthnameset[$monthnow - 1] ." ". $yearnow .", kell " . $timenow ; ?>. 
  <?php echo "Parajasti on " .$partofday ."."; ?></p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
  <p><a href="enterthought.php">Sisesta mõte</a></p>
  <p><a href="viewthoughts.php">Vaata sisestatud mõtteid</a></p>
  
</body>
</html>
