		<?php 
  			virtual ("menu.php");
  			virtual ("header.php");
			require 'funktiot.php';
		?>

		<div class="main">

			<?php 
			if (! isset($layid) || $layid == 1)
				{ 
				layout1(); 
				}
			else if ($layid == 2) 
				{
				layout2($layid, $fileid, $rowid, $file2id, $row2id, $picid); 
				}  
			else if ($layid == 3)
				{
				layout3($layid, $fileid, $rowid, $file2id, $row2id, $picid, $alinavimaara);
				}
			else if ($layid == 4)
				{
				layout4($layid, $fileid, $rowid);
				}  
			?>
		</div>  <!--  class main loppuu  -->
	</div>    <!--  class container loppuu  -->
</div>	  <!--  class keskittäjä loppuu  -->

</body>
</html>