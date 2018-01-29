<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<TITLE>Angebot erstellen</TITLE>
</HEAD>
<BODY>
<?php include_once 'header.php';?>

    <center>
          <h3>Neues Angebot erstellen</h3>
          <form  action="./upload_pdf.php" method="post" enctype="multipart/form-data">   
          <p style="margin-bottom: 5px; margin-top: 6px;">Titel des Angebots: </p>
          <input type="text" name="titel" placeholder="Titel">
          <p style="margin-bottom: 5px; margin-top: 6px;">Kurze Beschreibung: </p>
          <input type="text" name="beschreibung" placeholder="Beschreibung">
          <p style="margin-bottom: 5px; margin-top: 6px;">Verlinkung zur Homepage: </p>
          <input type="text" name="url" placeholder="Homepage">
          <p style="margin-bottom: 5px; margin-top: 6px;">Angebotene Position: </p>
          <input type="text" name="position" placeholder="Position">
          <p style="margin-bottom: 5px; margin-top: 6px;">Fachbereich der angebotenen Stelle: </p>
          <input type="text" name="bereich" placeholder="Fachbereich">
          <p style="margin-bottom: 5px; margin-top: 6px;">Beginn der Ausübung: </p>
          <input type="date" name="beginn" placeholder="Beginn"><br><br>

          <p style="margin-bottom: 5px; margin-top: 6px;">Angebot im PDF Format: </p>
          <input type='file' name='fileToUpload' id='fileToUpload'>

          <p><button style="margin-bottom: 5px; margin-top: 6px;" type="submit" name="submit">Angebot erstellen</button></p>
        </form>
    </center>
</BODY>
</HTML>