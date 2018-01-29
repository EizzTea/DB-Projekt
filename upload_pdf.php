<?php

include_once 'includes/dbh_inc.php';
include_once 'header.php';


$titel = mysqli_real_escape_string($db, $_POST['titel']);
$beschreibung = mysqli_real_escape_string($db, $_POST['beschreibung']);
$position = mysqli_real_escape_string($db, $_POST['position']);
$fachbereich = mysqli_real_escape_string($db, $_POST['bereich']);
$beginn = mysqli_real_escape_string($db, $_POST['beginn']);
$url = mysqli_real_escape_string($db, $_POST['url']);
$pdf = mysqli_real_escape_string($db, $_POST['fileToUpload']);

    if (empty($titel) || empty($position) || empty($beschreibung) || empty($beginn) || empty($url)|| empty($pdf))
  { 
    header("Location: ../newjob.php?error=empty_fields");
  };

$target_dir = "uploads/pdf/pdf_files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

$FileTypePDF = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Die Datei ist unzulässig";
        $uploadOk = 0;
    }
}
// Fehlerprüfung
// Prüfe ob Datei bereits verhanden
if (file_exists($target_file)) {
    echo "PDF existiert bereits";
    $uploadOk = 0;
}
// Prüfe die Dateigröße
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Die PDF Datei ist zu groß";
    $uploadOk = 0;
}
// Erlaube folgende Dateitypen
if($FileTypePDF != "pdf") {
    echo "Das Stellenangebot muss im PDF Format sein! ";
    $uploadOk = 0;
}

// Prüfe nach Fehlern
if ($uploadOk == 0) {
    echo "Upload fehlgeschlagen!";
// Wenn alles in Ordnung, lade die neue Datei mit einem zufälligen Namen hoch
} else {
    $tempPDF = explode(".", $_FILES["fileToUpload"]["name"]);
    $newfilenamePDF = round(microtime(true)) . '.' . end($tempPDF);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilenamePDF)) {
            $uid = $_SESSION["u_id"];
            $sql= 'INSERT INTO tbl_angebote(angebot_user_id, angebot_titel, angebot_beschreibung, angebot_position, angebot_fachbereich, angebot_beginn, angebot_url, angebot_pdf) 
            VALUES("$uid", "'.$titel.'", "'.$beschreibung.'", "'.$position.'", "'.$fachbereich.'", "'.$beginn.'", "'.$url.'", "'.$newfilenamePDF.'")';
            mysqli_query($db, $sql);
                    header("Location: ./newjob.php");
    } else {
        echo "Upload fehgeschlagen!";
    }
}
?>