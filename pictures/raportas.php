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
            <title>Raportas</title>
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
                            <h1 class="zodynas">Raporto formavimas</h1>                  
                        </div> 
                        <br>
				<?php
						error_reporting(0);
						if($_POST['vardas'] != null && $_POST['pavarde'] != null)
									echo "<a href='raportas_final.php'>Peržiūrėti</a>";
						$dbc = mysqli_connect("vartvalds", "stud", "stud", "vartvalds");
						$query1="SELECT * from zodynas_anglu";
						$query2="SELECT * from zodynas_italu";
						$result1=mysqli_query($dbc, $query1);
						$result2=mysqli_query($dbc, $query2);
						$anglu=array();
						$italu=array();
						while($row=mysqli_fetch_assoc($result1)){
							$anglu[]=$row;	
						}
						while($row=mysqli_fetch_assoc($result2)){
							$italu[]=$row;
						}
						echo "<form method='post'>
								<div class='form-group'>
									<label>Vardas</label>
									<input name='vardas' type='text'>
								</div>
								<div class='form-group'>
									<label>Pavardė</label>
									<input name='pavarde' type='text'>
								</div>
								<div class='form-group'>
									<label>Vyras</label>
									<input type='radio' name='lytis' value='vyras'>
								</div>
								<div class='form-group'>
									<label>Moteris</label>
									<input type='radio' name='lytis' value='moteris'>
								</div>";
								{for($i = 0; $i < count($anglu); $i++){
									$inputas="angl".$i;
									echo "<div class='form-group'>";
									echo "<label>".$anglu[$i]['zodis']."</label>";
									echo "<select class='form-control form-control-sm' name='$inputas'>
											<option value='n'>Pasirinkti</option>
											<option value='l'>Lengvas(0-5 neteisingi)</option>
											<option value='v'>Vidutinis(6-12 neteisingu)</option>
											<option value='s'>Sunkus (13 ir daugiau neteisingu)</option>
										  </select>";
									echo "</div>";
								}}
								{for($i = 0; $i < count($italu); $i++){
									$inputas="ital".$i;
									echo "<div class='form-group'>";
									echo "<label>".$italu[$i]['zodis']."</label>";
									echo "<select class='form-control form-control-sm' name='$inputas'>
											<option value='n'>Pasirinkti</option>
											<option value='l'>Lengvas(0-5 neteisingi)</option>
											<option value='v'>Vidutinis(6-12 neteisingu)</option>
											<option value='s'>Sunkus (13 ir daugiau neteisingu)</option>
										  </select>";
									echo "</div>";
								}}
								echo "<input type='submit' name='spausdinti' value='Spausdinti'>
							</form>";
								$pasirinktia=array(); //anglu
								$pasirinktii=array(); //italu
								$vardas="";
								$pavarde="";
								$lytis="";
								if(isset($_POST['spausdinti'])){
									for($i=0;$i<count($anglu);$i++){
										$pasirinktia[$i]=$_POST['angl'.$i];
									}
									for($i=0;$i<count($italu);$i++){
										$pasirinktii[$i]=$_POST['ital'.$i];
									}
									$vardas=$_POST['vardas'];
									$pavarde=$_POST['pavarde'];
									$lytis=$_POST['lytis'];
								}
								$_SESSION['vard']=$vardas;
								$_SESSION['pavard']=$pavarde;
								$_SESSION['lyt']=$lytis;
								for($i=0;$i<count($pasirinktia);$i++){
									if($pasirinktia[$i] == 'l' || $pasirinktia[$i] == 'v' || $pasirinktia[$i] == 'n'){
										$pasirinktia[$i]=null;
									} else if($pasirinktia[$i] == 's'){
										$pasirinktia[$i]=$anglu[$i]['zodis'];
									}
								}
								for($i=0;$i<count($pasirinktii);$i++){
									if($pasirinktii[$i] == 'l' || $pasirinktii[$i] == 'v'|| $pasirinktii[$i] == 'n'){
										$pasirinktii[$i]=null;
									} else if($pasirinktii[$i] == 's'){
										$pasirinktii[$i]=$italu[$i]['zodis'];
									}
								}
								$resultarray=array_merge($pasirinktia, $pasirinktii);
								$_SESSION['pasirinkti']=$resultarray;
								//if($_POST['vardas'] != null && $_POST['pavarde'] != null) header("Location: raportas_final.php");
								
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