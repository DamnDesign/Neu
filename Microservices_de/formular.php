<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Unbenanntes Dokument</title>
</head>

<body>

<?php

//			Bedingung				Anweisung if true	Anweisung if false
$vorname = isset($_POST['vorname']) ? $_POST['vorname'] : "";	//ternäre schreibweise verkürzt das nachfolgende
/*
if(isset($_POST['vorname']))
{
	$vorname = $_POST['vorname'];
}
else
{
	$vorname = "";
}
*/
$nachname = isset($_POST['nachname']) ? $_POST['nachname'] : "";
$mail = isset($_POST['mail']) ? $_POST['mail'] : "";
$nachricht = isset($_POST['nachricht']) ? $_POST['nachricht'] : "";
$zahlung = isset($_POST['zahlung']) ? $_POST['zahlung'] : "";
$interesse = isset($_POST['interesse']) ? implode(", ", $_POST['interesse']) : "";

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="formular">

	<p>
		<label>Vorname</label><br />      
		<input type="text" name="vorname" value="<?php echo $vorname; ?>" />
	</p>
    <p>
		<label>Nachname</label><br />      
		<input type="text" name="nachname" value="<?php echo $nachname; ?>" />
	</p>
    <p>
		<label>E-Mail-Adresse</label><br />      
		<input type="text" name="mail" value="<?php echo $mail; ?>" />
	</p>
    <p>
		<label>Nachricht</label><br />      
		<textarea type="text" name="nachricht" cols="40" rows="5"><?php echo $nachricht; ?></textarea>
	</p>
    <p>
    	<label>Zahlungsart:</label><br />
        <input type="radio" name="zahlung" value="Bar" <?php if($zahlung == "Bar"){echo 'checked="checked"';} ?> /> Bar <br />
        <input type="radio" name="zahlung" value="EC-Karte" <?php if($zahlung == "EC-Karte"){echo 'checked="checked"';} ?> /> EC-Karte <br />
        <input type="radio" name="zahlung" value="Master-Card" <?php if($zahlung == "Master-Card"){echo 'checked="checked"';} ?> /> Master-Card <br />
        <input type="radio" name="zahlung" value="Visa" <?php if($zahlung == "Visa"){echo 'checked="checked"';} ?> /> Visa <br />   
    </p>
    <p>
    	<label>Interessen</label><br />
        <input type="checkbox" name="interesse[]" value="Kultur" <?php if(strstr($interesse, "Kultur")){echo 'checked="checked"';} ?> /> Kultur <br />
        <input type="checkbox" name="interesse[]" value="Natur" <?php if(strstr($interesse, "Natur")){echo 'checked="checked"';} ?> /> Natur <br />
        <input type="checkbox" name="interesse[]" value="Musik" <?php if(strstr($interesse, "Musik")){echo 'checked="checked"';} ?> /> Musik <br />
        <input type="checkbox" name="interesse[]" value="Sport" <?php if(strstr($interesse, "Sport")){echo 'checked="checked"';} ?> /> Sport
    </p>
    <p>     
		<input type="submit" name="senden" value="Senden" />
        <input type="reset" name="reset" value="Zurücksetzen" />
	</p>

</form>

<?php

if(isset($_POST['senden']))
{
	
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$mail = $_POST['mail'];
	$nachricht = $_POST['nachricht'];
	$zahlung = $_POST['zahlung'];
	
	if(isset($_POST['interesse']))
	{
		$interesse = implode(", ", $_POST['interesse']);	
	}
	else
	{
		$interesse = "keine";	
	}
	
	
	if(empty($zahlung))
	{
		$zahlung = "keine";
	}
	
	if(empty($vorname))
	{
		echo "<script>alert('Bitte einen Vornamen eingeben.')</script>";
		echo "<script>document.formular.vorname.focus()</script>";
		exit;
	}
	if(empty($nachname))
	{
		echo "<script>alert('Bitte einen Nachnamen eingeben.')</script>";
		echo "<script>document.formular.nachname.focus()</script>";
		exit;
	}	
	if(empty($mail))
	{
		echo "<script>alert('Bitte eine E-Mail-Adresse eingeben.')</script>";
		echo "<script>document.formular.mail.focus()</script>";
		exit;
	}
	
	if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,5}$/", $mail))
	{
		echo "<script>alert('Bitte eine richtige E-Mail-Adresse eingeben.')</script>";
		echo "<script>document.formular.mail.focus()</script>";
		exit;
	}
	
	echo "<hr>";
	echo "Vorname: $vorname <br />";
	echo "Nachname: $nachname <br />";
	echo "E-Mail-Adresse: $mail <br />";
	echo "Nachricht: $nachricht <br />";
	echo "Zahlungsart: $zahlung <br />";
	echo "Interesse: $interesse";
	
	
	$betreff = "Kontaktformular";
	
	$inhalt = "Vorname: " . $vorname . "\n";
	$inhalt .= "Nachname: " . $nachname . "\n\n";		// .= dem variableninhalt wird etwas hinzugefügt
	$inhalt .= "E-Mail-Adresse: " . $mail . "\n\n";
	$inhalt .= $nachricht;
	
	//mail("email@adresse.de", $betreff, $inhalt);
	
	//echo "<script>alert('Das Formular wurde erfolgreich verschickt.')</script>";
	
}

?>

</body>
</html>