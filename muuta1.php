		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">

			<?php
			$lines = file($fileid);
			$pieces = explode("|",$lines[0]);
			$status = 0;
			$ok = 0;
			/* $piecesbufferold = count($pieces[$item])-1;
			$pieces[$item][$piecesbufferold] = trim($pieces[$item][$piecesbufferold]); */
					
					echo "fileid ".$fileid;
					echo "lines ".$lines;
					echo "p0".$pieces[0];
					echo "p". $pieces;
					print_r($pieces);
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
				
				if (isset( $_POST["asia"]))
					{
					$pieces[2] = $_POST["asia"];
					$status = 1;
					}
				
				if (isset( $_POST["kuva"]))
					{
					$pieces[3] = $_POST["kuva"];
					$status = 1;
					}
				
				if ($status == 1)
					{
					$lines[0] = implode('|',$pieces);
   			
					$return = @unlink($fileid);

					$writebuffer = count($lines)-1;
					for ($i = 0; $i <= $writebuffer; $i++) 
       					{
        				$lines[$i] = trim($lines[$i]);        
						$fp = fopen($fileid, "a");
						if ($writebuffer > 0)
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
					$status = 0;
					$ok = 1; 
					} 

			 
			
			?>

			<form method="POST">
				Polku: <br /><input type="text" name="polku" size="60" value="<?php echo $pieces[0]; ?>"><br />
				Otsikko: <br /><input type="text" name="otsikko" size="40" value="<?php echo $pieces[1]; ?>"><br />
				Asia: <br /><TEXTAREA name="asia" rows="10" cols="35"><?php echo $pieces[2]; ?></TEXTAREA><br />
				Kuva: <br /><input type="text" name="kuva" value="<?php echo $pieces[3]; ?>"><br />
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