<?PHP

function db_connect($db_name)
{
	/*
		 Allgemeine Daten fuer die Datenbankanbindung
		 und direkter Connect zur Datenbank. Nach
		 Einbindung dieses Segments kann direkt mit
		 MySQL-Befehlen auf die Datenbank zugegriffen
		 werden.
	*/

	/* Datenbankserver - In der Regel die IP */
	$db_server = 'localhost';

	/* Datenbankuser */
	$db_user = 'root';

	/* Datenbankpasswort */
	$db_passwort = '';
			 
	/* Erstellt Connect zu Datenbank her */
	$db = @ mysql_connect ( $db_server, $db_user, $db_passwort )
	   or die ( 'Konnte keine Verbindung zur Datenbank herstellen' );

	$db_check = @ mysql_select_db ( $db_name );

	if ( $db )
	{
	  // echo 'Verbindung zur Datenbank wurde hergestellt';
	}
}

function liste($sql,$tabellen)
{
	$result = mysql_query ( $sql ) or die(mysql_error());

	$menge = mysql_num_rows ( $result );	// Anzahl der Datensätze
	$felder = mysql_num_fields ( $result );	// Anzahl der Felder

	echo '<b>' . $menge . ' Datensätze gefunden</b><br>';

	$z=0;
	echo "<table border='0' cellspacing='2'>";

	// Überschriften (Feldnamen)
	echo "<tr bgcolor='yellow'>";
	for ($i=0;$i < $felder;$i++) echo "<th>".mysql_field_name($result,$i)."</th>";
	echo "</tr>";
	// Daten
	while ( $row = mysql_fetch_row ( $result ) )
	{
		if ($z % 2 == 0) $farbe="lightgreen"; else $farbe="lightgrey";
		echo "<tr bgcolor='$farbe'>";
		for ($i=0;$i < $felder;$i++) echo "<td>$row[$i]</td>"; // Ausgabe eines Datensatzes
		echo "</tr>";
		$z++;
	}
	echo "</table>";
}

function maske($tabellen,$sort)
{	
	// Holen der globalen FORM-Variablen
	if (isset($_GET["funktion"])) $funktion = $_GET["funktion"]; else $funktion="";
	if (isset($_GET["suchtext"])) $suchtext = $_GET["suchtext"]; else $suchtext="";
	if (isset($_GET["suchfeld"])) $suchfeld = $_GET["suchfeld"]+0; else $suchfeld=0;
	
	// Holen der globalen SESSION-Variablen
	if (isset($_SESSION["satznr"])) $satznr = $_SESSION["satznr"]; else $satznr=0;
	if (isset($_SESSION["newdata"])) $newdata = $_SESSION["newdata"]; else $newdata=false;
	if (isset($_SESSION["feldname"])) $feldname = $_SESSION["feldname"]; else $feldname[0]="";
	if (isset($_SESSION["suchen"])) $suchen = $_SESSION["suchen"]; else $suchen=false;
	if (isset($_SESSION["sql_s"])) $sql_s = $_SESSION["sql_s"]; else $sql_s="";
	
	// echo "Funktion: $funktion<br>";
	
	//	SQL-Befehl Standard oder Suchmodus
	if (! $suchen || $funktion=="X") 
		$sql = "SELECT * FROM " . $tabellen[0][0] . " " . $sort;
	else $sql= $sql_s;
	
	$result = mysql_query ( $sql ) or die (mysql_error());
	$menge = mysql_num_rows ( $result ); 	// Anzahl Reihen / Datensaetze
	$felder = mysql_num_fields ( $result ); // Anzahl Spalten / Felder
	$pk_name = mysql_field_name($result,0); // Name des Primärschlüssels
	
	if ($menge > 0) 
		$id = mysql_result($result, $satznr, 0); // ID des aktuellen Datensatzes
	else $newdata = true;
	
	switch ($funktion) 
	{
		case "|<": 
			$satznr = 0;
		break;
		
		case "<": 
			if ($satznr > 0) $satznr--;
		break;
		
		case ">": 
			if ($satznr < $menge - 1) $satznr++;
		break;
		
		case ">|": 
			$satznr = $menge - 1;
		break;
		
		case "New":
			$newdata = true;
		break;

		case "Delete":
			if ($menge ==0 ) break;
			$sql_d = "DELETE FROM " . $tabellen[0][0] . " WHERE " . $pk_name . "=" . $id;
			// echo $sql_d;
			mysql_query($sql_d) or die(mysql_error());
			if ($satznr == $menge-1) $satznr--;
			if ($menge==1) $newdata=true;
		break;

		case "Save":
			if ($newdata)
			{
				// Speichern nach Neueingabe
				$fehler = false;
				$sql_i ="INSERT INTO " . $tabellen[0][0] . " SET ";
				for ( $i = 1; $i < $felder; $i++ )
				{
					$fn = mysql_field_name($result,$i);	// Feldname
					if ( isset($tabellen[$i][0]) && $_GET[$fn] == 0 ) $fehler = true;
					$sql_i .= $fn . " = '" . $_GET[$fn] . "'";
					if ($i < $felder-1) $sql_i .= ", ";
				}
				//echo $sql_i;
				
				if ($fehler)
				{
					echo "<script>alert('Eine Select-Box wurde nicht korrekt ausgewählt!')</script>";
					break;
				}
				mysql_query($sql_i) or die(mysql_error());
				$id = mysql_insert_id ();		// ID des neuen Datensatzes
				$newdata = false;
			}
			else
			{
				// Speichern nach Änderung
				$sql_u ="UPDATE " . $tabellen[0][0] . " SET ";
				for ( $i = 1; $i < $felder; $i++ )
				{
					$fn = mysql_field_name($result,$i);	// Feldname
					$sql_u .= $fn . " = '" . $_GET[$fn] . "'";
					if ($i < $felder-1) $sql_u .= ", ";
				}
				$sql_u .= " WHERE " . $pk_name . "=" . $id;
				//echo "$sql_u<br>";
				mysql_query($sql_u) or die(mysql_error());
			}
		break;
		
		case "suchen":
			$fn = mysql_field_name ( $result, $suchfeld );
			if (strtolower(substr($fn,-3)) == "_id")
			{
				// in welchen Feldern soll überhaupt gesucht werden?
				$ht_felder=explode(",",$tabellen[$suchfeld][1]); 
				// z. B. $tabellen[1][1]= "2,3,5" wird zu $ht_felder[0]=2; $ht_felder[1]=3; $ht_felder[2]=5
				
				// Feldnamen der verknüpften Hilfstabelle feststellen
				$sql_h ="SELECT * FROM " . $tabellen[$suchfeld][0];
				$result_h = mysql_query ( $sql_h) or die (mysql_error());
				$anz_felder_h = mysql_num_fields($result_h);
				for ($i=0;$i<$anz_felder_h;$i++) $fn_h[$i] = mysql_field_name ( $result_h, $i );
				
				// Ergebnismenge der Hilfstabelle erstellen (nur PK-Werte)
				$sql_h = "SELECT ".$fn_h[0]." FROM ".$tabellen[$suchfeld][0]." WHERE ";
				// WHERE-Bedingung für alle definierten Felder erstellen
				for ($i=0; $i< count($ht_felder);$i++) 
				{
					if ($i > 0) $sql_h .= " OR ";
					$sql_h .= $fn_h[$ht_felder[$i]] . " LIKE '" . $suchtext . "%' ";
				}
				//echo "$sql_h<br>";
				$result_h = mysql_query ( $sql_h ) or die (mysql_error());
				$menge_h = mysql_num_rows ( $result_h );
				if ($menge_h > 0)
				{
					// $sql_s erstellen für die Selektion der Haupttabelle
					// festellen, ob FK-Wert der Haupttabelle in der Menge der PK-Werte der Hilfstabelle ist
					// SQL-Mengenoperator Feld IN Wertmenge, z. B.: ...WHERE PLZ_ID IN (3,56,678,779,865)... 
					$sql_s = "SELECT * FROM " . $tabellen[0][0] . " WHERE " . $fn . " IN (";
					for ($i=0; $i < $menge_h; $i++)
					{
						if ($i > 0) $sql_s .= ",";
						$sql_s .= mysql_result($result_h,$i,0);
					}
					$sql_s .= ")";
					//echo $sql_s; break;
					$result = mysql_query ( $sql_s ) or die (mysql_error());
					$menge = mysql_num_rows ( $result ); 					// Anzahl Datensaetze
				} else $menge=0;
			}
			else
			{
				$sql_s = "SELECT * FROM " . $tabellen[0][0] . " WHERE " . $fn ." LIKE '" . $suchtext . "%' " . $sort;
				$result = mysql_query ( $sql_s ) or die (mysql_error());
				$menge = mysql_num_rows ( $result ); 					// Anzahl Datensaetze
			}
			
		
			if ($menge > 0)
			{
				// gefunden
				$suchen = true;	
				$satznr = 0;	// erster gefundener Datensatz
			}
			else
			{
				// nichts gefunden
				$suchen = false;
				echo "<script> 
						alert('Kein Datensatz gefunden!');
					  </script>";
				// Standard Datenumfang wieder herstellen 
				$sql = "SELECT * FROM " . $tabellen[0][0] . " " . $sort;
				$result = mysql_query ( $sql ) or die (mysql_error());
				$menge = mysql_num_rows ( $result ); 	// Anzahl Reihen / Datensaetze
				
			}  

		break;
		
		case "X":	// Suchfunktion zurücksetzen
			$suchen = false;
			$suchtext="";
		break;
		
	}

	// Flag für Neueingabe zurücksetzen
	if ( ($funktion == "|<" or $funktion== "<" or $funktion== ">" or $funktion== "<|") && $menge > 0 ) $newdata=false;

	if ($funktion=="Delete" OR $funktion=="Save") 
	{
		// Daten aktualisieren
		$result = mysql_query ( $sql ) or die (mysql_error());
		$menge = mysql_num_rows ( $result ); // Anzahl Reihen/Datensaetze
	}
	
	if ($funktion == "Save")
	{
		// Festellen der neuen / aktuellen Satznr
		$satznr=0;
		while ($id != mysql_result($result, $satznr, 0)) $satznr++;
	}
	
	$hilf = $satznr+1;
	echo "Datensatz $hilf von $menge";
	
	echo "<form name='maske' action='' method='get'>";
	
	echo "<table border ='1' width='600px'>";
	for ( $i = 1; $i < $felder; $i++ )
	{	
		$fn = mysql_field_name($result,$i);
		$feldname[$i] = $fn;	// Array der Feldnamen aufbauen
		echo "<tr><td width='250px'> " . $fn . "</td><td>";
		if (strtolower(substr($fn,-3)) == "_id" && $i > 0) 
		{	
			// Select-Box mit Zugriff auf eine verknüpfte Tabelle
			
			// 1. Abfrage ohne Sortierung nur zur Festellung der Feldnamen
			$sql_h ="SELECT * FROM " . $tabellen[$i][0] ;
			$result_h = mysql_query ( $sql_h ) or die (mysql_error());
			$fn_h = mysql_field_name($result_h,1);

			// 2. Abfrage mit Sortierung
			$sql_h ="SELECT * FROM " . $tabellen[$i][0] . " ORDER BY " . $fn_h ;
			$result_h = mysql_query ( $sql_h ) or die (mysql_error());
			$menge_h = mysql_num_rows ( $result_h ); // Anzahl Reihen/Datensaetze
			$felder_h = mysql_num_fields ( $result_h ); // Anzahl Spalten/Felder
			
			if ($menge_h > 0) $fk_value = mysql_result($result, $satznr, $i); // ID-Wert der Haupttabelle
				else $fk_value=0;
			
			echo "<select name='$fn' size='1' style='width:100%'>";
			if ($newdata == true) echo "<option value='0'>-- bitte wählen --</option>";
			for ($k=0;$k < $menge_h;$k++)
			{
				$f0 = mysql_result($result_h, $k , 0);	// z. B. PLZ_ID

				$ht_felder=explode(",",$tabellen[$i][1]); // z. B. "1,3,4"

				$wert = "";
				for ($h = 0; $h < count($ht_felder); $h++) $wert .= " " . mysql_result ( $result_h, $k, $ht_felder[$h]+0 );
				trim($wert);

				echo"<option value='".$f0."' ";
				if ($funktion != "neu" && $f0 == mysql_result ( $result, $satznr, $i)) echo "selected";
				echo ">$wert</option>";

			}
			echo "</select>";			
			
		}
		else
		{
			// normales Inputfeld
			echo "<input style='text-align:left' name='$fn' type='text' 	size='50' maxlength='30' value='";
			if ($newdata == false) echo mysql_result($result, $satznr, $i); 
			echo "'>";
		}
		
		echo "</td></tr>";
	}

	echo "<tr><td>";
		echo "<input name='funktion' type='submit' value='|<'>";
		echo "<input name='funktion' type='submit' value='<'>";
		echo "<input name='funktion' type='submit' value='>'>";		
		echo "<input name='funktion' type='submit' value='>|'></td><td>";
		echo "<input name='funktion' type='submit' value='New'>";
		echo "<input name='funktion' type='submit' value='Save'>";
		echo "<input name='funktion' type='submit' value='Delete'>";
		
		// globale Variablen in die Session eintragen
		// satznr für die Navigation durch die Datensätze nötig
		$_SESSION["satznr"] = $satznr;
		$_SESSION["newdata"] = $newdata;
		$_SESSION["feldname"] = $feldname;
		$_SESSION["suchen"] = $suchen;
		$_SESSION["sql_s"] = $sql_s;
		
		
	echo "</td></tr>";
	echo "<tr>
			<td>Suchen im Feld:<br>
				<select name='suchfeld'>";
				for ( $i = 1; $i < $felder; $i++ )
				{
					$fn = mysql_field_name($result,$i);
					echo "<option value='$i' ";
					if ($i == $suchfeld) echo "selected";
					echo">$fn</option>";
				}
	echo		"</select>
			</td>
			<td><input style='text-align:left' name='suchtext' type='text' size='30' maxlength='30' value='$suchtext'>
				<input name='funktion' type='submit' value='suchen'> 
				<input name='funktion' type='submit' value='X'> 
			</td>
		  </tr>";
	echo "</table>";
	echo "</form>";
	
}

?>