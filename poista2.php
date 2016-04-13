		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">

			<?php
			$lines = file($fileid);
			$lines2 = file($file2id);
			$status = 0;
			$ok = 0;
			
			echo "POISTA TIEDOT:<br /><br />";
			echo $lines[$rowid]."<br />";
								
			if (isset( $_POST["poista"])) //Asiaosuuden poisto ja kirjoitus
				{
				$delete = $_POST["poista"];
				if ($delete == 1)
					{
					unset($lines[$rowid]);
					$uus = array_merge($lines);
					$lines = $uus;
									
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
					
					
       			}  
			//****************************************************
			if ($status == 1) //Alinavin poisto ja uudelleenkirjoitus HUOM. Tässä kuuluu normaalisti olla numero 1
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
				
				$uus2rowid1 = $rowid * 2 - 2; //Poistetaan oikeasta paikasta
				unset($stack[$uus2rowid1]);
				$uus2rowid2 = $uus2rowid1 + 1; //Poistetaan oikeasta paikasta
				unset($stack[$uus2rowid2]);
				
				$uus2 = array_merge($stack);
				$stack = $uus2;
				
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
				<input type="hidden" name="poista" value="1"><br />
				<INPUT type="submit" value="Poista">
			</form>
			
			<?php if ($ok == 1)
					{
					echo "POISTO OK";
					}
			?>
			
		</div>  
		
</body>
</html>