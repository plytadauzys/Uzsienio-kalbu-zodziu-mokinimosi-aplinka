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
                            <h1 class="zodynas">Raportas</h1>
							<p class="zodynas">Čia galite matyti kiekvieno žodžio įsimenamumo vidurkį.</p>                   
                        </div> 
                        <br>
				<?php
						error_reporting(0);
						$dbc = mysqli_connect("vartvalds", "stud", "stud", "vartvalds");
						$record=mysqli_query($dbc,"SELECT * from atsakyti WHERE user='$session->username'");
						if(isset($_POST['submit'])){
							$tematika = $_POST['tematikos'];
						}
						if ($tematika == 'visos'){
							$record=mysqli_query($dbc,"SELECT * from atsakyti");
						} else if ($tematika == 'Literatūra') $record=mysqli_query($dbc,"SELECT * from atsakyti WHERE tematika='literatura' AND user='$session->username'");
							else if ($tematika == 'Transportas') $record=mysqli_query($dbc,"SELECT * from atsakyti WHERE tematika='transportas' AND user='$session->username'");
						echo "<form method='post'>";
						echo "<select name='tematikos'>
							  <option>Visos</option>
							  <option name='Literatura'>Literatūra</option>
							  <option>Transportas</option>
							  <input type='submit' name='submit' value='Pasirinkti tematiką'>
							  </select>";
	
						echo "<table border=\"1\" class='table table-dark'>
								<tr>
									<th>Žodis</th>
									<th>Vertimas</th>
									<th>Teisingai atsakytų vidurkis</th>
								</tr>";
								{while($row=mysqli_fetch_assoc($record)){
									echo "<tr><td>".$row['zodis']."</td><td>".$row['vertimas']."</td>";
									$zodis=$row['zodis'];
									$sql="SELECT atsakyta FROM atsakyti WHERE zodis='$zodis' AND user='$session->username'";
									$result=mysqli_query($dbc,$sql);
									$atsakyti=mysqli_fetch_object($result);
									$sql="SELECT atsakytateisingai FROM atsakyti WHERE zodis='$zodis' AND user='$session->username'";
									$result=mysqli_query($dbc,$sql);
									$atsakytii=mysqli_fetch_object($result);
									$vidurkis=round($atsakytii->atsakytateisingai/$atsakyti->atsakyta,2);
									$isimenamumas="";
									if($vidurkis < 0.25) $isimenamumas="   (Sunkiai įsimenamas)";
									else if ($vidurkis >= 0.25 && $vidurkis < 0.75) $isimenamumas="   (Įsimenamas)";
									else if ($vidurkis >= 0.75) $isimenamumas="   (Lengvai įsimenamas)";
									echo "<td>".$vidurkis.$isimenamumas."</td></tr>";
								}
								}
						echo "</table>";
						echo "</form>";
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