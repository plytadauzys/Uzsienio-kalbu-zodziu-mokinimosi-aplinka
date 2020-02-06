<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Paskyros redagavimas</title>
            <link href="styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>       
            <table class="center"><tr><td>
                        <h1 style="color:darkslateblue;font-family:'Arial',Arial,serif">Uzsieno kalbu zodziu mokymosi aplinka</h1>
                    </td></tr><tr><td> 
                        <?php
                        /**
                         * User has submitted form without errors and user's
                         * account has been edited successfully.
                         */
                        include("include/meniu.php");
                        ?>
                        <table><tr><td>
                                    <a href="index.php">Pradžia</a>
                                </td></tr></table>               
                        <br> 
                        <?php
                        if (isset($_SESSION['useredit'])) {
                            unset($_SESSION['useredit']);
                            echo "<p><b>$session->username</b>, Jūsų paskyra buvo sėkmingai atnaujinta.<br><br>";
                        } else {
                            echo "<div align=\"center\">";
                            if ($form->num_errors > 0) {
                                echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                            } else {
                                echo "";
                            }
                            ?>
                            <table bgcolor=#9ca4f0 style="border-width: 2px; border-style: double;">
                                <tr><td>
                                        <form action="process.php" style="text-align:left;" method="POST">
                                            <p>Dabartinis slaptažodis:<br>
                                                <input type="password" name="curpass" maxlength="30" size="25" value="<?php echo $form->value("curpass"); ?>">
                                                <br><?php echo $form->error("curpass"); ?></p>
                                            <p>Naujas slaptažodis:<br>
                                                <input type="password" name="newpass" maxlength="30" size="25" value="<?php echo $form->value("newpass"); ?>">
                                                <br><?php echo $form->error("newpass"); ?></p>
                                            <p>E-paštas:<br>
                                                <input type="text" name="email" maxlength="30" size="25" value="<?php
                    if ($form->value("email") == "") {
                        echo $session->userinfo['email'];
                    } else {
                        echo $form->value("email");
                    }
                            ?>"> <br><?php echo $form->error("email"); ?></p>
                                            <input type="hidden" name="subedit" value="1">
                                            <input type="submit" value="Atnaujinti">
                                        </form>
                                    </td></tr>
                            </table>

                            <?php
                            echo "</div>";
                        }
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