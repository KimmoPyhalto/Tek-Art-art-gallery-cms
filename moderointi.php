<?php
  session_start();
  
  if (isset($_POST["un"]) && isset($_POST["pw"])) 
				{
				if ($_POST["un"] == "Kimmo_1978")
					{
					if ($_POST["pw"] == "Karoliina_1981")
						{
						echo "oikein<br />";
						$_SESSION["code"] = "99368635778JJhhfdllooOOii768";
						echo "<a href='index_mod.php'>T&auml;st&auml; sis&auml;&auml;n</a>";
						}
					else
						{
						echo "Salasana v&auml;&auml;rin!";
						}
					}
				else
					{
					echo "K&auml;ytt&auml;j&auml;tunnus v&auml;&auml;rin!";
					}
				}
?>
<font face="Arial, Helvetica, sans-serif">
<h3>Taideateljee Ipi & Pekka Pyh&auml;lt&ouml; - Yll&auml;pito</h3>

<h4>

<form method="POST">
				K&auml;ytt&auml;j&auml;tunnus:<br /><input type="text" size="20" name="un"><br />
				Salasana:<br /><input type="password" size="20" name="pw"><br /><br />
				<INPUT type="submit" value="Sis&auml;&auml;n">
			</form>

</h4></font>