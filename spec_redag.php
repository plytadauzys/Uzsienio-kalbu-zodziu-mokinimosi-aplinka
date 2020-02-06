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
                            <h1 class="zodynas">Specifinio žodyno redagavimas</h1>
							<p class="zodynas">Čia galite papildyti/redaguoti savo žodyną.</p>
                        </div>
                        <br>
						<?php
							error_reporting(0);
							$dbc = mysqli_connect("vartvalds", "stud", "stud", "vartvalds");
							$vartot=$session->username;
							//echo $vartot;
							$query="SELECT * from specifinis WHERE vartotojas='$vartot'";
							$result=mysqli_query($dbc, $query);
							echo "<table border=\"1\" class='table table-dark'>";
								echo "<tr>
									<th>Zodis</th>
									<th>Vertimas</th>
									<th>Šalinimas</th>
									<th>Redagavimas</th>
								</tr>";
								{while($row=mysqli_fetch_assoc($result))
									{
									echo "<tr><td>".$row['zodis']."</td><td>".$row['vertimas']."</td><td>"."<a href='spec_redag.php?fn=delete&id=".$row['id']."' >Trinti</a>"."</td><td>"."<a href='spec_redag.php?fn=edit&id=".$row['id']."' >Redaguoti</a>"."</td></tr>";
									}
								};
								echo "</table><br><br>";
							echo"<form method='post'>
								<div class='form-group'>
     								<label>Žodis</label>
									<input name='zodis' type='text'>
								</div>
								<div class='form-group'>
     								<label>Vertimas</label>
									<input name='vertimas' type='text'>
								</div>
    							<input type='submit' name='submit' value='Pridėti'>
								</form>";
							if(isset($_POST['submit'])){
								$zodis=$_POST['zodis'];
								$vertimas=$_POST['vertimas'];
							}
							if($zodis != null && $vertimas != null && $_POST['submit']){
								$sql="INSERT INTO specifinis(zodis, vertimas, vartotojas) VALUES ('$zodis','$vertimas','$vartot')";
								mysqli_query($dbc, $sql);
								$zodis=null;
								$vertimas=null;
								header("Location:spec_redag.php");
							}
							if ($_GET['fn'] == "delete")
     							if (!empty($_GET['id'])){
            						$id=$_GET['id'];
									echo $id;
									$sql="DELETE from specifinis WHERE id='$id'";
									mysqli_query($dbc, $sql);
									for ($i=0; $i<1; $i++)
										header("Location:spec_redag.php");
								}
							$redag=false;
							
							if ($_GET['fn'] == "edit")
     							if (!empty($_GET['id'])){
            						$id=$_GET['id'];
									$id1=$id;
									$redag=true;
									$sql1="SELECT zodis,vertimas from specifinis WHERE id='$id'";
									$getit=mysqli_query($dbc,$sql1);
									$vertim="";
									while($row=mysqli_fetch_assoc($getit)){
									echo"<form method='post'>
											<div class='form-group'>
     											<label>".$row['zodis']."</label>
												<input name='keiciamozodis' type='text'>
											</div>
											<div class='form-group'>
												<label>".$row['vertimas']."</label>
												<input name='keiciamovertimas' type='text'>
											</div>
    										<input type='submit' name='submit1' value='Keisti'>
											</form>";
										$vertim=$row['vertimas'];
										$zod=$row['zodis'];
									}
									//$sql="DELETE from specifinis WHERE id='$id'";
									//mysqli_query($dbc, $sql);
									//for ($i=0; $i<1; $i++)
										//header("Location:spec_redag.php");
								}
							if ($redag)
							{
								if(isset($_POST['submit1'])){
									$vertim=$_POST['keiciamovertimas'];
									$zod=$_POST['keiciamozodis'];
								}
								if($_POST['keiciamozodis']!=null && $_POST['keiciamovertimas']){
									$sql2="UPDATE specifinis SET vertimas='$vertim' WHERE id='$id1'";
									$sql3="UPDATE specifinis SET zodis='$zod' WHERE id='$id1'";
									mysqli_query($dbc,$sql2);
									$refresh=mysqli_query($dbc,$sql3);
								} else "Nepalikite tuščių langelių.";
								if(mysqli_fetch_assoc($refresh))
							   	{
								   for ($i=0; $i<1; $i++)
										header("Location:spec_redag.php");
							   	}
							}
							if($_POST['keiciamozodis']!=null && $_POST['keiciamovertimas']){
								header("Location:spec_redag.php");
							}
							else "Nepalikite tuščių langelių.";
							
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