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
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                        </div> 
                        <br>
				<?php
						$vardas=$_SESSION['vard'];
						$pavarde=$_SESSION['pavard'];
						$lytis=$_SESSION['lyt'];
						$pasirinkti=$_SESSION['pasirinkti'];
						echo "Vardas: ".$vardas."<br><br>";
						echo "Pavardė: ".$pavarde."<br><br>";
						echo "Lytis: ".$lytis;
						echo "<table border=\"1\" class='table table-dark'>";
								echo "<tr>
									<th>Žodis</th>
								</tr>";
								{for($i=0;$i<count($pasirinkti);$i++)
									{
									if($pasirinkti[$i] != null)
										echo "<tr><td>".$pasirinkti[$i]."</td></tr>";
									}
								};
								echo "</table><br><br>";
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