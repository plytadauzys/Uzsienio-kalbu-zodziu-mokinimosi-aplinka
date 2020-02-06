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
            <title>Specifinis žodynas</title>
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
                            <h1 class="zodynas">Specifinis žodynas</h1>
                            <p class="zodynas">Čia yra pirmas mokymosi etapas. Teisingai išverskite duotus žodžius.</p>                   
                        </div> 
                        <br>
				<?php
						error_reporting(0);
						$dbc = mysqli_connect("vartvalds", "stud", "stud", "vartvalds");
						$sql="DELETE from spec_neteisingi";
						mysqli_query($dbc, $sql);
						$vartot=$session->username;
						$record=mysqli_query($dbc,"SELECT * from specifinis WHERE vartotojas='$vartot'");
						$record2=mysqli_query($dbc,"SELECT * from spec_laikinas");
						$laikinas=array();
						$zodziai=array();
						while($row=mysqli_fetch_assoc($record)){
							$zodziai[]=$row;	
						}
						while($row=mysqli_fetch_assoc($record2)){
							$laikinas[]=$row;
						}
						$query="DELETE FROM spec_laikinas";
						mysqli_query($dbc, $query);
						shuffle($zodziai);
						$idetilaikinus=array();
						$laikinizodziai=array();
						echo "<form method='post'>";
						{for($i = 0; $i < round(count($zodziai)/2); $i++){
							$inputas="vertim".$i;
							echo "<div class='form-group'>";
							echo "<label>".$zodziai[$i]['zodis']."</label>";
							echo "<input name='$inputas' type='text'><br>";
							echo "</div>";
							$idetilaikinus[$i]=$zodziai[$i]['vertimas'];
							$laikinizodziai[$i]=$zodziai[$i]['zodis'];
							$query="INSERT INTO spec_laikinas (zodis,vertimas) Values ('$laikinizodziai[$i]','$idetilaikinus[$i]')";
							mysqli_query($dbc, $query);
						}
						};
						echo "<input type='submit' name='submit' value='Baigti'>";
						echo "</form>";
						$suvesti=array();
						if(isset($_POST['submit'])){ 
							//$sql="DELETE from spec_neteisingi";
							//mysqli_query($dbc, $sql);
							for ($i=0; $i<round(count($zodziai)/2);$i++){
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
						for ($i = 0; $i<round(count($zodziai)/2);$i++){
							if($suvesti[$i]!= $laikinas[$i]['vertimas']){
								$laikinas2[$i]=$laikinas[$i]['vertimas'];
								$laikinas3[$i]=$laikinas[$i]['zodis'];
								$sql="INSERT INTO spec_neteisingi (zodis,vertimas) Values ('$laikinas3[$i]','$laikinas2[$i]')";
								mysqli_query($dbc, $sql);
								$neteisinguskaicius++;
								$_SESSION['sneteisingi']=$neteisinguskaicius;
								$_SESSION['visis']=round(count($zodziai)/2);
							}
						}
						if(empty($laikinas2) && empty($laikinas3) && $_POST['vertim0']!=null) header("Location: spec_teisingi.php");
						else if (!empty($laikinas2) && !empty($laikinas3) && $_POST['vertim0']!=null) header("Location: spec_antras.php");
						
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