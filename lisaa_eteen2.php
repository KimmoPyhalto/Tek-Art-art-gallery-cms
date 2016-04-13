		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">

			<?php
			$lines = file($fileid);
			$lines2 = file($file2id);
			$pieces = explode("|",$lines[$rowid]);
			
			$alanavinkuva = $rowid * 2 - 2;
			$alanavinotsikko = $rowid * 2 - 1;
			$status = 0;
			$ok = 0;
								
			if (isset( $_POST["polku"])) //Asiaosuuden muokkaus ja kirjoitus
				{
				array_splice($lines, $rowid, 0, $_POST["polku"]."|".$_POST["otsikko"]."|".$_POST["asia1"]."|".$_POST["asia2"]."|".$_POST["asia3"]."|".$_POST["asia4"]."|".$_POST["kuva1"]."|".$_POST["kuva2"]."|".$_POST["kuva3"]."|".$_POST["kuva4"]);
				
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
				$status = 1;
       			}  
			//****************************************************
			if ($status == 1) //Alinavin muokkaus ja uudelleenkirjoitus HUOM. Tässä kuuluu normaalisti olla numero 1
				{
				$stack = array();
				$lines2maara = count($lines2);
								
				for ($i = 0; $i <= $lines2maara-1; $i++)
					{
					$pieces2[$i] = explode("|",$lines2[$i]); //Räjäytetään lines2:n kaikki rivit
					$pieces3 = $pieces2[$i];  
					
					$pieces2maara = count($pieces3);
					for ($x = 0; $x <= $pieces2maara-1; $x++)
						{
						array_push($stack, $pieces3[$x]); //Luodaan 1-ulot. taulukko koko filestä
						}
					}
								
				$uusrowid1 = $rowid * 2 - 2; //Lisätään oikeaan paikkaan
				array_splice($stack, $uusrowid1, 0, $_POST["kuva1"]);  
				$uusrowid2 = $uusrowid1 + 1;
				array_splice($stack, $uusrowid2, 0, $_POST["alanaviotsikko"]); 
				
				$stackmaara = count($stack);
				$d = 0; //while
				$y = 0; //päälisääntyjä
				$z = 1; //lisälisääntyjä
				$stack3paikka = 0;
				$round = 1; //ekalle riville
				while ($d < $stackmaara) //Uudelleenkokoaminen
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
				$status = 2;
				
				if ($status == 2) //Tiedostokirjoitusvaihe navitiedostolle (file2id)
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
				Polku: <br /><input type="text" name="polku" size="60"><br />
				Otsikko: <br /><input type="text" name="otsikko" size="40"><br />
				Asia1: <br /><TEXTAREA name="asia1" rows="3" cols="35"></TEXTAREA><br />
				Asia2: <br /><TEXTAREA name="asia2" rows="3" cols="35"></TEXTAREA><br />
				Asia3: <br /><TEXTAREA name="asia3" rows="3" cols="35"></TEXTAREA><br />
				Asia4: <br /><TEXTAREA name="asia4" rows="3" cols="35"></TEXTAREA><br />
				Kuva1: <br /><input type="text" name="kuva1"><br />
				Kuva2: <br /><input type="text" name="kuva2"><br />
				Kuva3: <br /><input type="text" name="kuva3"><br />
				Kuva4: <br /><input type="text" name="kuva4"><br />
				
				Alanavin otsikko: <br /><input type="text" name="alanaviotsikko"><br />
				<!-- Alanavin kuva: <br /><input type="text" name="alanavinkuva"><br /> -->
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