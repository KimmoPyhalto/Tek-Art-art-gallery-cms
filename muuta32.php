		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">

			<?php
			$lines = file($fileid);
			$lines2 = file($file2id);
			$pieces = explode("|",$lines[0]);
			
			$muutospaikka = $picid + 4;
			
			if (isset( $_POST["kuva"])) //Asiaosuuden muokkaus ja kirjoitus
				{
				$pieces[$muutospaikka] = $_POST["kuva"];
				$lines[0] = implode('|',$pieces);
				
				$return = @unlink($fileid);
				$writebuffer = count($lines)-1;
				for ($i = 0; $i <= $writebuffer; $i++) 
       				{
        			$lines[$i] = trim($lines[$i]);
					//echo "line1: ".$lines[$i]."<br /><br />";
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
				
				
				$uusrowid1 = $picid * 2 - 2; //Lisätään oikeaan paikkaan
				$stack[$uusrowid1] = $_POST["kuva"];
				$uusrowid2 = $uusrowid1 + 1; //Lisätään oikeaan paikkaan
				$stack[$uusrowid2] = "";  
				
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
						$stack3[$stack3paikka] = trim($stack[$y])."|".trim($stack[$y+1])."|".trim($stack[$y+2])."|".trim($stack[$y+3])."|".trim($stack[$y+4])."|".trim($stack[$y+5])."|".trim($stack[$y+6])."|".trim($stack[$y+7])."|".trim($stack[$y+8])."|".trim($stack[$y+9])."|".trim($stack[$y+10])."|".trim($stack[$y+11])."|".trim($stack[$y+12])."|".trim($stack[$y+13])."|".trim($stack[$y+14])."|".trim($stack[$y+15]); //kakka plus toimii
						$round = 2;
						}
					else
						{
						$stack3[$stack3paikka] = trim($stack[$y+$z])."|".trim($stack[$y+$z+1])."|".trim($stack[$y+$z+2])."|".trim($stack[$y+$z+3])."|".trim($stack[$y+$z+4])."|".trim($stack[$y+$z+5])."|".trim($stack[$y+$z+6])."|".trim($stack[$y+$z+7])."|".trim($stack[$y+$z+8])."|".trim($stack[$y+$z+9])."|".trim($stack[$y+$z+10])."|".trim($stack[$y+$z+11])."|".trim($stack[$y+$z+12])."|".trim($stack[$y+$z+13])."|".trim($stack[$y+$z+14])."|".trim($stack[$y+$z+15]);
						$z++;
						}
					$stack3[$stack3paikka] = rtrim($stack3[$stack3paikka], "|");
					$stack3paikka++;
					$y = $y + 15;
					$d = $d + 17;
					}
				
				$stack3pituus = count($stack3)-1;
				
				for ($v = 0; $v <= $stack3pituus; $v++) 
       				{
					$temppi = explode("|",$stack3[$v]);
					array_push($temppi, "");
					$stack3[$v] = implode("|",$temppi);
					$stack3[$v] = ltrim($stack3[$v], "|");
					$stack3[$v] = trim($stack3[$v]);
					}
							
				$status = 2;
				
				if ($status == 2) //Tiedostokirjoitusvaihe navitiedostolle (file2id)
					{
					$return = @unlink($file2id);

					$writebuffer = count($stack3)-1;
					for ($i = 0; $i <= $writebuffer; $i++) 
       					{
        				$stack3[$i] = trim($stack3[$i]); 
						//echo "line2: ".$stack3[$i]."<br /><br />";       
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
				Kuva: <br /><input type="text" name="kuva" value="<?php echo $pieces[$muutospaikka]; ?>"><br />
				<INPUT type="submit" value="Muuta">
			</form>
			
			<?php if ($ok == 1)
					{
					echo "Muutos ok";
					}
			?>
			
		</div>  
		
</body>
</html>