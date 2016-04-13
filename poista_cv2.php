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
						
		echo "POISTA TIEDOT:<br /><br />";
		echo $pieces3[$item]."<br />";
			
		if (isset( $_POST["poista"])) //Asiaosuuden poisto ja kirjoitus
				{
				$delete = $_POST["poista"];
				if ($delete == 1)
					{
					unset($pieces3[$item]);
					$uus = array_merge($pieces3);
					$pieces3 = $uus;
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
        					fwrite ($fp, "$lines[$i]\n");
							fclose ($fp);
							}
						else
							{
							fwrite ($fp, "$lines[$i]");
							fclose ($fp);
							}
       					} 
					}
				$ok = 1;
				}   
			?>

			<form method="POST">
				<input type="hidden" name="poista" value="1"><br />
				<INPUT type="submit" value="POISTA">
			</form>
						
			<?php if ($ok == 1)
					{
					echo "Poisto ok";
					}
			?>
			
		</div>  
		
</body>
</html>