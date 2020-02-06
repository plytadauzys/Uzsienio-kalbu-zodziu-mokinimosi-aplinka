<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
     		</script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
     		</script>
            <title>Italų žodynas</title>
            <link href="styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                        <center><h1 class="nelogin">Užsienio kalbų žodžių mokymosi aplinka</h1></center>
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");
                        ?>              
                        <table><tr><td>
                                    <a href="index.php">Pradžia</a>
                                </td></tr></table>               
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1 class="zodynas">Italų žodynas</h1>
                            <p class="zodynas">Čia yra antras mokymosi etapas. Teisingai išverskite pirmame etape blogai išverstus žodžius.</p>                   
                        </div> 
                        <br>
				<?php
						error_reporting(0);
						$dbc = mysqli_connect("vartvalds", "stud", "stud", "vartvalds");
						$record=mysqli_query($dbc,"SELECT * from italu_neteisingi");
						$record2=mysqli_query($dbc,"SELECT * from italu_antro_laikinas");
						$zodziai=array();
						while($row=mysqli_fetch_assoc($record)){
							$zodziai[]=$row;	
						}
						$laikinas=array();
						while($row=mysqli_fetch_assoc($record2)){
							$laikinas[]=$row;	
						}
						$query="SELECT * FROM italu_laikinas ORDER BY id DESC";
						mysqli_query($dbc, $query);
						$query="DELETE FROM italu_antro_laikinas";
						mysqli_query($dbc, $query);
						echo "<form method='post'>";
						$idetilaikinus=array();
						$laikinizodziai=array();
						{for($i = 0; $i < count($zodziai); $i++){
							$inputas="vertim".$i;
							echo "<div class='form-group'>";
							echo "<label>".$zodziai[$i]['zodis']."</label>";
							echo "<input name='$inputas' type='text'><br>";
							echo "</div>";
							$idetilaikinus[$i]=$zodziai[$i]['vertimas'];
							$laikinizodziai[$i]=$zodziai[$i]['zodis'];
							$query="INSERT INTO italu_antro_laikinas (zodis,vertimas) Values ('$laikinizodziai[$i]','$idetilaikinus[$i]')";
							mysqli_query($dbc, $query);
						}
						};
						echo "<input type='submit' name='submit' value='Baigti'>";
						echo "</form>";
						$suvesti=array();
						if(isset($_POST['submit'])){
							for ($i=0; $i<count($zodziai);$i++){
								$inputas="vertim".$i;
								$suvesti[$i]=$_POST[$inputas];	
							}
						}
						for($i=0;$i<count($zodziai);$i++){
								if ($_POST['vertim'.$i]!=null) $err++;	
							}
						$neteisinguskaicius=0;
						$laikinas2=array();
						$laikinas3=array();
						for ($i = 0; $i<count($zodziai);$i++){
							if($_POST['vertim'.$i] != null){
							$suvzod=$laikinas[$i]['zodis'];
							$suvvert=$laikinas[$i]['vertimas'];
							$sql="SELECT * FROM atsakyti WHERE zodis='$suvzod' AND userid='$session->userid'";
							$result=mysqli_query($dbc,$sql);
							
							if($result->num_rows == 0){
								$sql="INSERT INTO atsakyti (userid, zodis, vertimas, atsakyta, atsakytateisingai) Values ('$session->userid','$suvzod','$suvvert',0,0)";
								mysqli_query($dbc,$sql);
							}
							$sql="SELECT atsakyta FROM atsakyti WHERE zodis='$suvzod' AND userid='$session->userid'";
							$result=mysqli_query($dbc,$sql);
							$atsakyta=mysqli_fetch_object($result);
							if($err==round(count($zodziai))){
							$atsakyta->atsakyta++;
							$sql="UPDATE atsakyti SET atsakyta=atsakyta+1 WHERE zodis='$suvzod'";
							mysqli_query($dbc,$sql);
							}
							}
							if($err==count($zodziai)) {
							if($suvesti[$i]!= $laikinas[$i]['vertimas']){
								$laikinas2[$i]=$laikinas[$i]['vertimas'];
								$laikinas3[$i]=$laikinas[$i]['zodis'];
								$neteisinguskaicius++;
							} else if ($suvesti[$i] == $laikinas[$i]['vertimas']) {
								$_SESSION['ineteisingi']--;
								$sql="SELECT atsakytateisingai FROM atsakyti WHERE zodis='$suvzod' AND userid='$session->userid'";
								$result=mysqli_query($dbc,$sql);
								$atsakytateisingai=mysqli_fetch_object($result);
								$atsakytateisingai->atsakytateisingai++;
								$sql="UPDATE atsakyti SET atsakytateisingai='$atsakytateisingai->atsakytateisingai' WHERE zodis='$suvzod' AND userid='$session->userid'";
								mysqli_query($dbc,$sql);
							}
							}
						}
						$err=0;
						for($i=0;$i<count($zodziai);$i++){
							if ($_POST['vertim'.$i]!=null) $err++;
						}
						if(empty($laikinas2) && empty($laikinas3) && $err==count($zodziai)) {echo "visi teisingi"; header("Location: italu_finalas.php");}
						else if (!empty($laikinas2) && !empty($laikinas3) && $err==count($zodziai)) {echo "yra neteisingu"; header("Location: italu_finalas.php");}
						
				?>
                <tr><td>
                        <?php
                        //include("include/footer.php");
                        ?>
                    </td></tr>      
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>