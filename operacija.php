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
            <title>Anglu zodynas</title>
            <link href="styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                        <h1 style="color:darkslateblue;font-family:'Arial',Arial,serif">Uzsieno kalbu zodziu mokymosi aplinka</h1>
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");
                        ?>              
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Anglu zodynas</h1>
                            Cia yra pirmas mokymosi etapas. Teisingai isverskite duotus zodzius.                   
                        </div> 
                        <br>
				<?php
						//error_reporting(0);
						$dbc = mysqli_connect("vartvalds", "stud", "stud", "vartvalds");
						$sql="DELETE from anglu_neteisingi";
						mysqli_query($dbc, $sql);
						$record=mysqli_query($dbc,"SELECT * from zodynas_anglu WHERE tematika='literatura'");
						$record2=mysqli_query($dbc,"SELECT * from anglu_laikinas");
						$laikinas=array();
						$zodziai=array();
						while($row=mysqli_fetch_assoc($record)){
							$zodziai[]=$row;	
						}
						while($row=mysqli_fetch_assoc($record2)){
							$laikinas[]=$row;
						}
						$query="SELECT * FROM anglu_laikinas ORDER BY id DESC";
						mysqli_query($dbc, $query);
						$query="DELETE FROM anglu_laikinas LIMIT 3";
						mysqli_query($dbc, $query);
						shuffle($zodziai);
						$idetilaikinus=array();
						$laikinizodziai=array();
						echo "<form method='post'>";
						{for($i = 0; $i < count($zodziai)/2; $i++){
							$inputas="vertim".$i;
							echo "<div class='form-group'>";
							echo "<label>".$zodziai[$i]['zodis']."</label>";
							echo "<input name='$inputas' type='text'><br>";
							echo "</div>";
							$idetilaikinus[$i]=$zodziai[$i]['vertimas'];
							$laikinizodziai[$i]=$zodziai[$i]['zodis'];
							$query="INSERT INTO anglu_laikinas (zodis,vertimas) Values ('$laikinizodziai[$i]','$idetilaikinus[$i]')";
							mysqli_query($dbc, $query);
						}
						};
						echo "<input type='submit' name='submit' value='Baigti'>";
						echo "</form>";
						$suvesti=array();
						if(isset($_POST['submit'])){ 
							//$sql="DELETE from anglu_neteisingi";
							//mysqli_query($dbc, $sql);
							for ($i=0; $i<count($zodziai)/2;$i++){
								$inputas="vertim".$i;
								$suvesti[$i]=$_POST[$inputas];	
								
							}
							/*echo "<pre>";
						print_r($suvesti);
						print_r($laikinas);
						echo "</pre>";*/
						}
						
						$neteisinguskaicius=0;
						$laikinas2=array();
						$laikinas3=array();
						for ($i = 0; $i<count($zodziai)/2;$i++){
							if($suvesti[$i]!= $laikinas[$i]['vertimas']){
								$laikinas2[$i]=$laikinas[$i]['vertimas'];
								$laikinas3[$i]=$laikinas[$i]['zodis'];
								$sql="INSERT INTO anglu_neteisingi (zodis,vertimas) Values ('$laikinas3[$i]','$laikinas2[$i]')";
								mysqli_query($dbc, $sql);
								$neteisinguskaicius++;
								$_SESSION['neteisingi']=$neteisinguskaicius;
							}
						}
						if(empty($laikinas2) && empty($laikinas3) && $_POST['vertim0']!=null) header("Location: anglu_teisingi.php");
						else if (!empty($laikinas2) && !empty($laikinas3) && $_POST['vertim0']!=null) header("Location: anglu_antras.php");
						else echo "laukiam mygtuko paspaudimo";
				?>
                <tr><td>
                        <?php
                        include("include/footer.php");
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