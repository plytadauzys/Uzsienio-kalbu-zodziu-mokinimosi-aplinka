<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link href="styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<table class="center"><tr><td>
                        <center><h1 class="nelogin">Užsienio kalbų žodžių mokymosi aplinka</h1></center>
                    </td></tr><tr><td> 
                        <table><tr><td>
                                    <a href="index.php">Pradžia</a>
                                </td></tr></table>
		<div align="center">
			<table>
                                    <tr><td>
										 
  <form method="post" action="register.php" class="login">
	  <center style="font-size:18pt;"><b>Registracija</b>
  	<?php include('errors.php'); ?>
  	<div class="s1">
		<p style="text-align:left;">Vartotojo vardas:</p>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
		<p style="text-align:left;">El pastas:</p>
  	  <label> </label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
		<p style="text-align:left;">Slaptažodis:</p>
  	  <label> </label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  </form>
										</td></tr></table>
                            </div>
		</td></tr>
            </table>
</body>
</html>