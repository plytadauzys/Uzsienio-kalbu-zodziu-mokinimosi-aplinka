<?php
include("include/session.php");
?>
<html>
    <head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Uzsieno kalbu zodziu mokymosi aplinka.</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
			<center><h1 class="login">Užsienio kalbų žodžių mokymosi aplinka</h1></center>  
            <?php
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/meniu.php");
                ?>
                <div style="text-align: center;color:darkslateblue">
                    <br><br>
                </div><br>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            } else {
                echo "<div align=\"center\">";
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                echo "<table class=\"center\"><tr><td>";
                include("include/loginForm.php");
                echo "</td></tr></table></div><br></td></tr>";
            }
            echo "<tr><td>";
            //include("include/footer.php");
            echo "</td></tr>";
            ?>
</body>
</html>