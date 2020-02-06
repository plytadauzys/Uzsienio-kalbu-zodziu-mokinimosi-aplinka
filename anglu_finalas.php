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
            <title>Anglų žodynas</title>
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
                            <h1 class="zodynas">Anglų žodynas</h1>
							<p class="zodynas">Čia yra finalas.</p>                   
                        </div> 
                        <br>
				<?php
						//error_reporting(0);
						$teisingi = $_SESSION['visia'] - $_SESSION['neteisingi'];
						$visi=$_SESSION['visia'];
						$ats = "Teisingai atsakėte ".round($teisingi)."/".round($visi).".";
						echo "<p style='font-size:30px'>$ats</p>";
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