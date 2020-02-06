<?php
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
									<label>Pavarde</label>
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
											<option>Pasirinkti</option>
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
											<option>Pasirinkti</option>
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
								echo $vardas." ".$pavarde." ".$lytis;
								$_SESSION['vard']=$vardas;
								$_SESSION['pavard']=$pavarde;
								$_SESSION['lyt']=$lytis;
								echo "<pre>";
								print_r($pasirinktia);
								print_r($pasirinktii);
								echo "</pre>";
								for($i=0;$i<count($pasirinktia);$i++){
									if($pasirinktia[$i] == 'l' || $pasirinktia[$i] == 'v')
										$pasirinktia[$i]=null;
								}
								for($i=0;$i<count($pasirinktii);$i++){
									if($pasirinktii[$i] == 'l' || $pasirinktii[$i] == 'v')
										$pasirinktii[$i]=null;
								}
								echo "<pre>";
								print_r($pasirinktia);
								print_r($pasirinktii);
								echo "</pre>";
								$resultarray=array_merge($pasirinktia, $pasirinktii);
								echo "<pre>";
								print_r($resultarray);
								echo "</pre>";
								$_SESSION['pasirinkti']=$resultarray;
								//if($_POST['vardas'] != null && $_POST['pavarde'] != null) header("Location: raportas_final.php");
				?>