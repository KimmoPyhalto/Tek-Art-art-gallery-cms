		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">

			<?php
			$lines = file($fileid);
			$lines2 = file($file2id);
			$linesbuffer = count($lines)-1;
			$status = 0;
			$ok = 0;
			
			echo "SIIRRä TIEDOT:<br /><br />";
			echo $lines[$rowid]."<br /><br />";
			echo "Nykyinen paikka: ".$rowid."<br /><br />";
								
			if (isset( $_POST["uuspaikka"])) //Asiaosuuden siirto ja kirjoitus
				{
				
					$temp = $lines[$rowid];
					unset($lines[$rowid]);
					$uuspaikka = $_POST["uuspaikka"];
					array_splice($lines, $uuspaikka, 0, $temp);
					
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
			if ($status == 1) //Alinavin siirto ja uudelleenkirjoitus HUOM. Tässä kuuluu normaalisti olla numero 1
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
				
				$uus2rowid11 = $rowid * 2 - 2; //Lasketaan poistettavan paikka
				$uus2rowid21 = $uus2rowid11 + 1; //Lasketaan poistettavan paikka 
				
				$temp2 = $stack[$uus2rowid11]; //Otetaan talteen
				$temp3 = $stack[$uus2rowid21]; //Otetaan talteen
				
				unset($stack[$uus2rowid11]); //Poistetaan vanha
				unset($stack[$uus2rowid21]); //Poistetaan vanha
				
				$uus2paikka1 = $_POST["uuspaikka"]; //Haetaan uuden paikan arvo
				
				$uus2rowid12 = $uus2paikka1 * 2 - 2; //Lasketaan uusi paikka
				$uus2rowid22 = $uus2rowid12 + 1; //Lasketaan uusi paikka
				
				array_splice($stack, $uus2rowid12, 0, $temp2); //Laitetaan uuteen paikkaan
				array_splice($stack, $uus2rowid22, 0, $temp3); //Laitetaan uuteen paikkaan
				
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
			
			<form method="post">
				Uusi paikka: <select name="uuspaikka" size="1"> 
				<?php
				for($lb = 1; $lb <= $linesbuffer; $lb++)
					{
					echo " <option>".$lb."</option>";
					}
				?>
				</select>
				<input type="submit" value="Siirrä">
			</form>
			
			<?php if ($ok == 1)
					{
					echo "Siirto ok";
					}
			?>
			
		</div>  
		
</body>
</html>