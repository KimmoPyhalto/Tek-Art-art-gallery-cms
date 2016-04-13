<?php

function layout1()
	{
	$fileid = "index.txt";
	$lines2 = file($fileid);
	$pieces2 = explode("|",$lines2[0]);
	
	$size = getimagesize("images/".$pieces2[3].".jpg");
	$height = $size[1] / 2;
	echo "<style> div.kuvakeskittaja {position: relative;	top:50%; margin-top: -".$height."px;} </style>"; 
	
	echo "<div class='tekstit'>";
	echo "<p class='polku'>".$pieces2[0]."</p>";
	echo "<h3 class='paaotsikko'>".$pieces2[1]."</h3>";
	echo "<p class='leipis1'>".$pieces2[2]."</p>";
	echo "<a href='muuta1.php?fileid=".$fileid."&rowid=0'> Muokkaa </a></div>";
	echo "<div class='kuva'><div class='kuvakeskittaja'><img src='images/".$pieces2[3].".jpg' class='paakuva1'></div>";
	}

function layout2($layid, $fileid, $rowid, $file2id, $row2id, $picid)
	{	
	$lines2 = file($fileid.".txt");
	$pieces2 = explode("|",$lines2[$rowid]);
					
	echo "<div class='tekstit2'>";
	echo "<p class='polku'>".$pieces2[0]."</p>";
	echo "<h3 class='paaotsikko2'>".$pieces2[1]."</h3>";
	$piecesbuffer = count($pieces2);
	
	if ($piecesbuffer < 5)   //Jos ladataan alueen pääsivu
		{
		echo "<p class='leipis2'>".$pieces2[2]."</p>";
		echo "<a href='muuta1.php?fileid=".$fileid.".txt&rowid=".$rowid."'> Muokkaa </a>";
		echo "</div>";
		
		$sizetarget = trim($pieces2[3]);
		$size = getimagesize("images/".$sizetarget.".jpg");
		$height = $size[1] / 2; 
		echo "<style> div.kuvakeskittaja {position: relative;	top:50%; margin-top: -".$height."px;} </style>";
		echo "<div class='kuva2'><div class='kuvakeskittaja'><img src='images/".$pieces2[3].".jpg' class='paakuva1'></div></div>"; 
		} 
	else					//Jos ladataan alueen sisäsivu
		{
		echo "<p class='leipis2'>".$pieces2[2]."</p>";   //Tiedot
		echo "<p class='leipis2'>".$pieces2[3]."</p>";
		echo "<p class='leipis2'>".$pieces2[4]."</p>";
		echo "<p class='leipis2'>".$pieces2[5]."</p>";
		
		$piecesbuffer4 = $piecesbuffer - 7;				//Alinavi 2
		for ($z = 0; $z <= $piecesbuffer4; $z++)
			{
			$picidnew1 = $z + 6;
			$znew = $z + 1;	
			$trimmi = trim($pieces2[$picidnew1]);
			if ($trimmi != "")
				{	
				echo "<a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$row2id."&picid=".$znew."'>";
				echo "<img src='images/".$pieces2[$picidnew1]."t.jpg' class='alinavikuva2'></a>";
				}
			}
								
		echo "</div>";   //Tekstit2 loppuu
		
		$sizetarget = trim($pieces2[6]);
		$size = getimagesize("images/".$sizetarget.".jpg");
    	$height = $size[1] / 2; 
		echo "<style> div.kuvakeskittaja {position: relative;	top:50%; margin-top: -".$height."px;} </style>";    //Pääkuvan asemointi
		$picidnew2 = $picid + 5;
		echo "<div class='kuva2'><div class='kuvakeskittaja'><img src='images/".$pieces2[$picidnew2].".jpg' class='paakuva1'></div></div>";
		} 
	
	if (isset($file2id)) 
		{
		$lines3 = file($file2id.".txt");
		$lines3buffer = count($lines3);
		$pieces3 = explode("|",$lines3[$row2id]);
		$pieces3buffer = count($pieces3) / 2 - 1;
		$z = 1;
		if (isset($picid))
			{
			$picidnew3 = $picid;
			}
		else
			{
			$picidnew3 = 1;
			}
	
		if (($lines3buffer > 1) && ($row2id > 0))  //Alinavin taaksepäin jos tarvis
			{
			$rew = $row2id - 1;
			echo "<div class='alinavi1'><a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$rew."&picid=".$picidnew3."' class='menut3'>< ".$row2id."/".$lines3buffer."</a></div>";
			}
				
		$w = 1;
		for ($y = 0; $y <= $pieces3buffer; $y++)  //Alinavi
			{
			$ybuffer1 = $y + 2;
			$newrowid = $row2id * 4 + $w;
			$ybuffer2 = $y * 2;
			$ybuffer3 = $y + $z;
			echo "<div class='alinavi".$ybuffer1."'>";
			echo "<a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$newrowid."&file2id=".$file2id."&row2id=".$row2id."&picid=1' class='menut3'>";
			echo "<img src='images/".$pieces3[$ybuffer2]."t.jpg' class='alinavikuva'>".$pieces3[$ybuffer3]."</a><br />";
			echo "<a href='lisaa_eteen2.php?fileid=".$fileid.".txt&rowid=".$newrowid."&file2id=".$file2id.".txt&row2id=".$row2id."'> Le </a>";
			
			echo "<a href='muuta2.php?fileid=".$fileid.".txt&rowid=".$newrowid."&file2id=".$file2id.".txt&row2id=".$row2id."'> M </a>";
			
			echo "<a href='poista2.php?fileid=".$fileid.".txt&rowid=".$newrowid."&file2id=".$file2id.".txt&row2id=".$row2id."'> P </a>";
			echo "<a href='siirra2.php?fileid=".$fileid.".txt&rowid=".$newrowid."&file2id=".$file2id.".txt&row2id=".$row2id."'> S </a>";
			echo "<a href='lisaa_taakse2.php?fileid=".$fileid.".txt&rowid=".$newrowid."&file2id=".$file2id.".txt&row2id=".$row2id."'> Lt </a></div>";
			$z++;
			$w++; 
			}
				
		if (($lines3buffer > 1) && (($row2id + 1) < $lines3buffer))  //Alinavin eteenpäin jos tarvis
			{
			$fwd = $row2id + 1;
			$fwdtxt = $row2id + 2;
			echo "<div class='alinavi6'><a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$fwd."&picid=".$picidnew3."' class='menut3'>".$fwdtxt."/".$lines3buffer." ></a></div>";
			} 
		}
	}

function layout3($layid, $fileid, $rowid, $file2id, $row2id, $picid, $alinavimaara)
	{		
	$lines2 = file($fileid.".txt");
	$pieces2 = explode("|",$lines2[$rowid]);
	$piecesbuffer = count($pieces2);
		
	echo "<div class='tekstit2'>";  //TEKSTIT2 ALKAA
	echo "<p class='polku'>".$pieces2[0]."</p>";
	echo "<h3 class='paaotsikko2'>".$pieces2[1]."</h3>";
	echo "<p class='leipis2'>".$pieces2[2]."</p>";
	echo "<p class='leipis2'>".$pieces2[3]."</p>";
	echo "<a href='muuta3.php?fileid=".$fileid.".txt&rowid=".$rowid."'> Muokkaa </a>";
	echo "</div>";
	
	$newpicid = 4 + $picid;
	$sizetarget = trim($pieces2[$newpicid]);
	$size = getimagesize("images/".$sizetarget.".jpg");
    $height = $size[1] / 2; 
	echo "<style> div.kuvakeskittaja {position: relative;	top:50%; margin-top: -".$height."px;} </style>";
	echo "<div class='kuva2'><div class='kuvakeskittaja'><img src='images/".$pieces2[$newpicid].".jpg' class='paakuva1'></div></div>"; 
						
	if (isset($file2id)) 
		{
		$lines3 = file($file2id.".txt");
		$lines3buffer = count($lines3);
		$pieces3 = explode("|",$lines3[$row2id]);
		$pieces3buffer = count($pieces3) / 2 - 1;
		$z = 1;
		
		if (isset($picid))
			{
			$picidnew3 = $picid;
			}
		else
			{
			$picidnew3 = 1;
			}
		
		if ($alinavimaara == 4)
			{
			$ylisa = 2;
			$alinavikerroin = '';
			$alinavieka = 'alinavi1';
			$alinavivika = 'alinavi6';
			}
		else
			{
			$ylisa = 1;
			$alinavikerroin = 2;
			$alinavieka = 'alinavi20';
			$alinavivika = 'alinavi29';
			}
			
		if (($lines3buffer > 1) && ($row2id > 0))  //Alinavin taaksepäin jos tarvis
			{
			$rew = $row2id - 1;
			echo "<div class='".$alinavieka."'><a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$rew."&picid=".$picidnew3."&alinavimaara=".$alinavimaara."' class='menut3'>< ".$row2id."/".$lines3buffer."</a></div>";
			}
				
		$w = 1;
		for ($y = 0; $y <= $pieces3buffer; $y++)  //Alinavi
			{
			$ybuffer1 = $y + $ylisa;
			$newrowid = $row2id * $alinavimaara + $w;
			$ybuffer2 = $y * 2;
			$ybuffer3 = $y + $z;
			echo "<div class='alinavi".$alinavikerroin.$ybuffer1."'>";
			echo "<a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=0&file2id=".$file2id."&row2id=".$row2id."&picid=".$newrowid."&alinavimaara=".$alinavimaara."' class='menut3'>";
			echo "<img src='images/".$pieces3[$ybuffer2]."t.jpg' class='alinavikuva'>".$pieces3[$ybuffer3]."</a><br />";
			
			echo "<a href='lisaa_eteen3.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> Le </a>";
			echo "<a href='muuta32.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> M </a>";
			echo "<a href='poista3.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> P </a>";
			echo "<a href='siirra3.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> S </a>";
			echo "<a href='lisaa_taakse3.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> Lt </a></div>";
			$z++;
			$w++; 
			}
				
		if (($lines3buffer > 1) && (($row2id + 1) < $lines3buffer))  //Alinavin eteenpäin jos tarvis
			{
			$fwd = $row2id + 1;
			$fwdtxt = $row2id + 2;
			echo "<div class='".$alinavivika."'><a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$fwd."&picid=".$picidnew3."&alinavimaara=".$alinavimaara."' class='menut3'>".$fwdtxt."/".$lines3buffer." ></a></div>";
			} 
		}
	}
	

function layout32($layid, $fileid, $rowid, $file2id, $row2id, $picid, $alinavimaara)
	{		
	$lines2 = file($fileid.".txt");
	$pieces2 = explode("|",$lines2[$rowid]);
	$piecesbuffer = count($pieces2);
		
	echo "<div class='tekstit2'>";  //TEKSTIT2 ALKAA
	echo "<p class='polku'>".$pieces2[0]."</p>";
	echo "<h3 class='paaotsikko2'>".$pieces2[1]."</h3>";
	echo "<p class='leipis2'>".$pieces2[2]."</p>";
	echo "<p class='leipis2'>".$pieces2[3]."</p>";
	echo "<a href='muuta3.php?fileid=".$fileid.".txt&rowid=".$rowid."'> Muokkaa </a>";
	echo "</div>";
	
	$newpicid = 4 + $picid;
	$sizetarget = trim($pieces2[$newpicid]);
	$size = getimagesize("images/".$sizetarget.".jpg");
    $height = $size[1] / 2; 
	echo "<style> div.kuvakeskittaja {position: relative;	top:50%; margin-top: -".$height."px;} </style>";
	echo "<div class='kuva2'><div class='kuvakeskittaja'><img src='images/".$pieces2[$newpicid].".jpg' class='paakuva1'></div></div>"; 
						
	if (isset($file2id)) 
		{
		$lines3 = file($file2id.".txt");
		$lines3buffer = count($lines3);
		$pieces3 = explode("|",$lines3[$row2id]);
		$pieces3buffer = count($pieces3) / 2 - 1;
		$z = 1;
		
		if (isset($picid))
			{
			$picidnew3 = $picid;
			}
		else
			{
			$picidnew3 = 1;
			}
		
		if ($alinavimaara == 4)
			{
			$ylisa = 2;
			$alinavikerroin = '';
			$alinavieka = 'alinavi1';
			$alinavivika = 'alinavi6';
			}
		else
			{
			$ylisa = 1;
			$alinavikerroin = 2;
			$alinavieka = 'alinavi20';
			$alinavivika = 'alinavi29';
			}
			
		if (($lines3buffer > 1) && ($row2id > 0))  //Alinavin taaksepäin jos tarvis
			{
			$rew = $row2id - 1;
			echo "<div class='".$alinavieka."'><a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$rew."&picid=".$picidnew3."&alinavimaara=".$alinavimaara."' class='menut3'>< ".$row2id."/".$lines3buffer."</a></div>";
			}
				
		$w = 1;
		for ($y = 0; $y <= $pieces3buffer; $y++)  //Alinavi
			{
			$ybuffer1 = $y + $ylisa;
			$newrowid = $row2id * $alinavimaara + $w;
			$ybuffer2 = $y * 2;
			$ybuffer3 = $y + $z;
			echo "<div class='alinavi".$alinavikerroin.$ybuffer1."'>";
			echo "<a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=0&file2id=".$file2id."&row2id=".$row2id."&picid=".$newrowid."&alinavimaara=".$alinavimaara."' class='menut3'>";
			echo "<img src='images/".$pieces3[$ybuffer2]."t.jpg' class='alinavikuva'>".$pieces3[$ybuffer3]."</a><br />";
			
			echo "<a href='lisaa_eteen33.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> Le </a>";
			echo "<a href='muuta33.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> M </a>";
			echo "<a href='poista33.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> P </a>";
			echo "<a href='siirra33.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> S </a>";
			echo "<a href='lisaa_taakse33.php?layid=".$layid."&fileid=".$fileid.".txt&rowid=0&file2id=".$file2id.".txt&row2id=".$row2id."&picid=".$newrowid."'> Lt </a></div>";
			$z++;
			$w++; 
			}
				
		if (($lines3buffer > 1) && (($row2id + 1) < $lines3buffer))  //Alinavin eteenpäin jos tarvis
			{
			$fwd = $row2id + 1;
			$fwdtxt = $row2id + 2;
			echo "<div class='".$alinavivika."'><a href='index_mod.php?layid=".$layid."&fileid=".$fileid."&rowid=".$rowid."&file2id=".$file2id."&row2id=".$fwd."&picid=".$picidnew3."&alinavimaara=".$alinavimaara."' class='menut3'>".$fwdtxt."/".$lines3buffer." ></a></div>";
			} 
		}
	}
	
	
function layout4($layid, $fileid, $rowid)
	{
	$lines2 = file($fileid.".txt");
	$pieces2 = explode("|",$lines2[0]); // Polku, Alkuotsikko, alkutekstit (2) ja kuvat (2)
	$pieces3 = explode("|",$lines2[1]); // Näyttelyitä ja otsikko
	$pieces4 = explode("|",$lines2[2]); // Julkisia teoksia ja otsikko
			
	echo "<div class='tekstit3'>";
	echo "<p class='polku_cv'>".$pieces2[0]."</p>";
	echo "</div>";
	echo "<div class='tekstit4'>";
	echo "<h3 class='paaotsikko_cv1'>".$pieces2[1]."</h3>";
	echo "<img src='images/".$pieces2[4].".jpg' class='artisti1'>"; // Kuva 1
	echo "<img src='images/".$pieces2[5].".jpg' class='artisti2'>"; // Kuva 2
	echo "<p class='leipis1'>".$pieces2[2]."</p>"; // Pääteksti 1
	echo "<p class='leipis1'>".$pieces2[3]."</p>"; // Pääteksti 2
		
	echo "<a href='muuta_cv1.php?fileid=".$fileid.".txt'> Muokkaa </a>";
		
	$pieces3buffer = count($pieces3) - 1;
	echo "<h3 class='paaotsikko_cv2'>".$pieces3[0]."</h3>"; // Näyttelyitä Otsikko
	for ($i = 1; $i <= $pieces3buffer; $i++)
		{
			echo "<p class='leipis1'>".$pieces3[$i]."</p>"; // Näyttelyt
		}
	
	echo "<a href='muuta_cv2.php?fileid=".$fileid.".txt&rowid=1'> Muokkaa </a>";
		
	$pieces4buffer = count($pieces4) - 1;
	echo "<h3 class='paaotsikko_cv2'>".$pieces4[0]."</h3>"; // Julkisia teoksia Otsikko
	for ($x = 1; $x <= $pieces4buffer; $x++)
		{
			echo "<p class='leipis1'>".$pieces4[$x]."</p>"; // Julkiset teokset
		}		
	
	echo "<a href='muuta_cv2.php?fileid=".$fileid.".txt&rowid=2'> Muokkaa </a>";
	
	echo "</div>";
			
	}
?>