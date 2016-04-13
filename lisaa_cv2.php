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
						
		$kuvapaikka = count($pieces3);
			
			if (isset( $_POST["nayttely"])) 
				{
				array_splice($pieces3, $kuvapaikka, 0, $_POST["nayttely"]);
				for ($x = 0; $x <= $kuvapaikka; $x++) 
					{
						$pieces3[$x] = trim($pieces3[$x]);
					}
				$lines[$rowid] = implode('|',$pieces3);
				
					$return = @unlink($fileid);
					$writebuffer = count($lines)-1;
					for ($i = 0; $i <= $writebuffer; $i++) 
       					{
        				
						$lines[$i] = trim($lines[$i]);
						//echo "line1: ".$lines[$i]."<br /><br />";
						
						$fp = fopen($fileid, "a");
        				if ($writebuffer > 0 && $i != $writebuffer)
							{
							//echo "line".$i.": ".$lines[$i]."<br /><br />";
        					fwrite ($fp, "$lines[$i]\n");
							fclose ($fp);
							}
						else
							{
							//echo "line".$i.": ".$lines[$i]."<br /><br />";
							fwrite ($fp, "$lines[$i]");
							fclose ($fp);
							}
       					} 
					
				$ok = 1;
				}   
			?>

			<form method="POST">
				<?php if ($rowid == 1)
							{
								echo "Näyttely: ";
							} 
						else 
							{
								echo "Teos: ";
							}
				?>
				<br /><input type="text" size="100" name="nayttely"><br />
				<INPUT type="submit" value="Lisää">
			</form>
						
			<?php if ($ok == 1)
					{
					echo "Lisäys ok";
					}
			?>
			
		</div>  
		
</body>
</html>