		<?php 
  			virtual ("menu_mod.php");
  			virtual ("header_mod.php");
			require 'funktiot_mod.php';
		?>

		<div class="main">

			<?php
			$lines = file($fileid);
			$pieces3 = explode("|",$lines[$rowid]);
			$status = 0;
			$ok = 0;
			/* $piecesbufferold = count($pieces[$item])-1;
			$pieces[$item][$piecesbufferold] = trim($pieces[$item][$piecesbufferold]); */
			
			if (isset( $_POST["otsikko"]))
					{
					$pieces3[0] = $_POST["otsikko"];
					$status = 1;
					}
						
			$pieces3buffer = count($pieces3) - 1;
			for ($x = 1; $x <= $pieces3buffer; $x++)
				{		
					if (isset( $_POST["nayttely".$x]))
					{
					$pieces3[$x] = $_POST["nayttely".$x];
					$status = 1;
					}
				}
				
				if ($status == 1)
					{
					$lines[$rowid] = implode('|',$pieces3);
   			
					$return = @unlink($fileid);

					$writebuffer = count($lines)-1;
					for ($i = 0; $i <= $writebuffer; $i++) 
       					{
						//$lines[$i] = htmlspecialchars($lines[$i], ENT_QUOTES);
						//$str = "A 'quote' is <b>bold</b>";
						//echo htmlentities($str, ENT_QUOTES, ISO-8859-15);
						//$lines[$i] = str_replace($jaja, "", $lines[$i]);
        				$lines[$i] = trim($lines[$i]); 
						//echo $lines[$i]."<br /><br />";     
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
					$status = 0;
					$ok = 1; 
					} 
			?>

			<form method="POST">
				
				<p>Otsikko: <br /><input type="text" name="otsikko" size="40" value="<?php echo $pieces3[0]; ?>"><br /></p>
				<p><?php if ($rowid == 1)
							{
								echo "Näyttelyt: ";
							} 
						else 
							{
								echo "Teokset: ";
							}
					?><br />
			<?php
			$pieces3buffer = count($pieces3) - 1;
			for ($i = 1; $i <= $pieces3buffer; $i++)
				{		
					echo "<input type='text' name='nayttely".$i."' size='100' value='".$pieces3[$i]."'><a href='poista_cv2.php?fileid=".$fileid."&rowid=".$rowid."&item=".$i."'>Poista</a><br />";
				}
			?>
				
			<INPUT type="submit" value="Päivitä">
			</form>
			</p>
			
			<p><?php echo "<a href='lisaa_cv2.php?fileid=".$fileid."&rowid=".$rowid."'>"; 
											if ($rowid == 1)
												{
													echo "Lisää Näyttely";
												} 
											else 
												{
													echo "Lisää Teos";
												}
										?></a></p>
			
			<?php if ($ok == 1)
					{
					echo "Päivitys ok";
					}
			?>
			
		</div>  
		
</body>
</html>