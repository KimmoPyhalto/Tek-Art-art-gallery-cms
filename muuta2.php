		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">
		
			<?php
			
			//*****************Yleiset**********
			
			$lines = file($fileid);
			$lines2 = file($file2id);
			$pieces = explode("|",$lines[$rowid]);
			$stack = array();
			$lines2maara = count($lines2);
			$status = 0;
			$ok = 0;
			
			for ($i = 0; $i <= $lines2maara-1; $i++) //Alinavin muutos 1-ulot. taulukoksi
				{
				$pieces2[$i] = explode("|",$lines2[$i]); //Räjäytetään lines2:n kaikki rivit
				$pieces3 = $pieces2[$i];  
				$pieces2maara = count($pieces3);
				for ($x = 0; $x <= $pieces2maara-1; $x++)
					{
					array_push($stack, $pieces3[$x]); //Luodaan 1-ulot. taulukko koko filestä
					}
				}
			
			$alanavinkuva = $rowid * 2 - 2; //Lasketaan alanavin muutospaikat
			$alanavinotsikko = $rowid * 2 - 1;
			
			//*****************Tiedon muokkaus asiatiedostolle**********
			
				if (isset( $_POST["polku"])) 
				 	{
					$pieces[0] = $_POST["polku"];
					$status = 1;
					}
									
				if (isset( $_POST["otsikko"]))
					{
					$pieces[1] = $_POST["otsikko"];
					$status = 1;
					}
				
				if (isset( $_POST["asia1"]))
					{
					$pieces[2] = $_POST["asia1"];
					$status = 1;
					}
				
				if (isset( $_POST["asia2"]))
					{
					$pieces[3] = $_POST["asia2"];
					$status = 1;
					}
				
				if (isset( $_POST["asia3"]))
					{
					$pieces[4] = $_POST["asia3"];
					$status = 1;
					}
				
				if (isset( $_POST["asia4"]))
					{
					$pieces[5] = $_POST["asia4"];
					$status = 1;
					}
				
				if (isset( $_POST["kuva1"]))
					{
					$pieces[6] = $_POST["kuva1"];
					$status = 1;
					}
				
				if (isset( $_POST["kuva2"]))
					{
					$pieces[7] = $_POST["kuva2"];
					$status = 1;
					}
				
				if (isset( $_POST["kuva3"]))
					{
					$pieces[8] = $_POST["kuva3"];
					$status = 1;
					}
				
				if (isset( $_POST["kuva4"]))
					{
					$pieces[9] = $_POST["kuva4"];
					$status = 1;
					}
				
				//*****************Tiedostokirjoitusvaihe asiatiedostolle (fileid)**********
				
				if ($status == 1) 
					{
					$lines[$rowid] = implode('|',$pieces);
   			
					$return = @unlink($fileid);

					$writebuffer = count($lines)-1;
					for ($i = 0; $i <= $writebuffer; $i++) 
       					{
        				$lines[$i] = trim($lines[$i]);        
						$fp = fopen($fileid, "a");
						if ($writebuffer > 0 && $i != $writebuffer)
							{
        					fwrite ($fp, "$lines[$i]\n");
							fclose ($fp);
							}
						else
							{
							fwrite ($fp, "$lines[$i]");
							fclose ($fp);
							}
       					} 
					$status = 2;
					 
					} 
				
				//*****************Alinavin muutos**********
				
			if ($status == 2) //HUOM. Tässä kuuluu normaalisti olla numero 2
				{
				
				$stack[$alanavinkuva] = $_POST["kuva1"]; //Tässä määritellään alanavin kuva
				
				if (isset( $_POST["alanaviotsikko"])) //Tässä määritellään alanavin otsikko
					{
					$stack[$alanavinotsikko] = $_POST["alanaviotsikko"];
					}
				
				//*****************Alinavin uudelleenkokoaminen**********
				
				$stackmaara = count($stack);  
				$d = 0; //while
				$y = 0; //päälisääntyjä
				$z = 1; //lisälisääntyjä
				$stack3paikka = 0;
				$round = 1; //ekalle riville
				while ($d < $stackmaara) 
					{
					if ($round == 1)
						{
						$stack3[$stack3paikka] = trim($stack[$y])."|".trim($stack[$y+1])."|".trim($stack[$y+2])."|".trim($stack[$y+3])."|".trim($stack[$y+4])."|".trim($stack[$y+5])."|".trim($stack[$y+6])."|".trim($stack[$y+7]); //kakka plus toimii
						$round = 2;
						}
					else
						{
						$stack3[$stack3paikka] = trim($stack[$y+$z])."|".trim($stack[$y+$z+1])."|".trim($stack[$y+$z+2])."|".trim($stack[$y+$z+3])."|".trim($stack[$y+$z+4])."|".trim($stack[$y+$z+5])."|".trim($stack[$y+$z+6])."|".trim($stack[$y+$z+7]);
						$z++;
						}
					$stack3[$stack3paikka] = rtrim($stack3[$stack3paikka], "|");
					$stack3paikka++;
					$y = $y + 7;
					$d = $d + 8;
					}
				$status = 3;
												
				//*****************Tiedostokirjoitusvaihe navitiedostolle (file2id)**********
												
				if ($status == 3) 
					{
					$return = @unlink($file2id);

					$writebuffer = count($stack3)-1;
					for ($i = 0; $i <= $writebuffer; $i++) 
       					{
        				$stack3[$i] = trim($stack3[$i]);        
						$fp = fopen($file2id, "a");
						if ($writebuffer > 0 && $i != $writebuffer)
							{
							fwrite ($fp, "$stack3[$i]\n");
							fclose ($fp);
							}
						else
							{
							fwrite ($fp, "$stack3[$i]");
							fclose ($fp);
							}
       					} 
					$status = 0;
					$ok = 1; 
					} 
				}
							 
			 
			
			?>

			<form method="POST">
				Polku: <br /><input type="text" name="polku" size="60" value="<?php echo $pieces[0]; ?>"><br />
				Otsikko: <br /><input type="text" name="otsikko" size="40" value="<?php echo $pieces[1]; ?>"><br />
				Asia1: <br /><TEXTAREA name="asia1" rows="3" cols="35"><?php echo $pieces[2]; ?></TEXTAREA><br />
				Asia2: <br /><TEXTAREA name="asia2" rows="3" cols="35"><?php echo $pieces[3]; ?></TEXTAREA><br />
				Asia3: <br /><TEXTAREA name="asia3" rows="3" cols="35"><?php echo $pieces[4]; ?></TEXTAREA><br />
				Asia4: <br /><TEXTAREA name="asia4" rows="3" cols="35"><?php echo $pieces[5]; ?></TEXTAREA><br />
				Kuva1: <br /><input type="text" name="kuva1" value="<?php echo $pieces[6]; ?>"><br />
				Kuva2: <br /><input type="text" name="kuva2" value="<?php echo $pieces[7]; ?>"><br />
				Kuva3: <br /><input type="text" name="kuva3" value="<?php echo $pieces[8]; ?>"><br />
				Kuva4: <br /><input type="text" name="kuva4" value="<?php echo $pieces[9]; ?>"><br />
				
				Alanavin otsikko: <br /><input type="text" name="alanaviotsikko" value="<?php echo $stack[$alanavinotsikko]; ?>"><br />
				
				<INPUT type="submit" value="Päivitä">
			</form>
			
			<?php if ($ok == 1)
					{
					echo "Päivitys ok";
					}
			?>
			
		</div>  
		
</body>
</html>