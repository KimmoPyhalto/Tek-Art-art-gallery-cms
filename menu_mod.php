<html lang="fi">
<head>
<title>etusivu</TITLE>

<link rel="stylesheet" href="tyylit.css" />

</head>
<body>

<div class="keskittaja">
	<div class="container">
		<div class="left">
			<h4 class="menul0">MENU</h4>
			
			<?php 
			$lines = file("menu_mod.txt");
			$rowbuffer = count($lines) - 1;
			$type = 1;
			for ($x = 0; $x <= $rowbuffer; $x++) //LOOPPI PääRIVEILLE 
       			{
				$pieces = explode("|",$lines[$x]);
				if ($pieces[0] == 11)
					{
					echo "<ul class='menul1'><li><a href='".$pieces[1]."' class='menut1'>".$pieces[2]."</a></li></ul>";
					$type = 1;
					}
				else if ($pieces[0] == 12 && $type != 2)
					{
					echo "<ul class='menul1'><li><a href='index_mod.php?layid=2&fileid=".$pieces[1]."&rowid=0&file2id=".$pieces[2]."&row2id=0' class='menut1'>".$pieces[3]."</a></li></ul>";
					$type = 1;
					}
				else if ($pieces[0] == 12 && $type == 2)
					{
					echo "</ul></ul><ul class='menul1'><li><a href='index_mod.php?layid=2&fileid=".$pieces[1]."&rowid=0&file2id=".$pieces[2]."&row2id=0' class='menut1'>".$pieces[3]."</a></li></ul>";
					$type = 1;
					}
				else if ($pieces[0] == 13 && $type == 1)
					{
					echo "<ul class='menul1'><li><a href='index_mod.php?layid=2&fileid=".$pieces[1]."&rowid=0' class='menut1'>".$pieces[2]."</a><ul>";
					$type = 1;
					}
				else if ($pieces[0] == 13 && $type == 2)
					{
					echo "</ul></ul><ul class='menul1'><li><a href='index_mod.php?layid=2&fileid=".$pieces[1]."&rowid=0' class='menut1'>".$pieces[2]."</a><ul>";
					$type = 1;
					}
				else if ($pieces[0] == 14)  //Taidekorteille
					{
					echo "<li class='menul2'><a href='index_mod.php?layid=3&fileid=".$pieces[1]."&rowid=0&file2id=".$pieces[2]."&row2id=0&picid=0&alinavimaara=".$pieces[3]."' class='menut2'>".$pieces[4]."</a></li>";
					$type = 2;
					}
				else if ($pieces[0] == 16)  //Painetut kortit ja julisteet - lisätty
					{
					echo "<li class='menul2'><a href='index_mod.php?layid=32&fileid=".$pieces[1]."&rowid=0&file2id=".$pieces[2]."&row2id=0&picid=0&alinavimaara=".$pieces[3]."' class='menut2'>".$pieces[4]."</a></li>";
					$type = 2;
					}
				else if ($pieces[0] == 15 && $type != 2)
					{
					echo "<ul class='menul1'><li><a href='index_mod.php?layid=4&fileid=".$pieces[1]."&rowid=0' class='menut1'>".$pieces[2]."</a></li></ul>";
					$type = 1;
					}
				else if ($pieces[0] == 15 && $type == 2)
					{
					echo "</ul></ul><ul class='menul1'><li><a href='index_mod.php?layid=4&fileid=".$pieces[1]."&rowid=0' class='menut1'>".$pieces[2]."</a></li></ul>";
					$type = 1;
					}
				else
					{
					echo "<li class='menul2'><a href='index_mod.php?layid=2&fileid=".$pieces[1]."&rowid=0&file2id=".$pieces[2]."&row2id=0' class='menut2'>".$pieces[3]."</a></li>";
					$type = 2;
					}
				} 
			?>
		</div>