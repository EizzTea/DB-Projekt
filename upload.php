<?php

include_once 'includes/dbh_inc.php';
include_once 'header.php';

$target_dir = "uploads/userpic/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Prüfe die Echtheit der Datei //Prüfe ob die Datei eine Größe hat.
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
    echo "Datei existiert bereits";
    $uploadOk = 0;
}
// Prüfe die Dateigröße
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Die Datei ist zu groß";
    $uploadOk = 0;
}
// Erlaube folgende Dateitypen
if($imageFileType != "png") {
    echo "Es sind nur Dateien im PNG Format zugelassen!";
    $uploadOk = 0;
}
//Prüft die Dimensionen
list($width, $height) = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($width > "64" || $height > "64"||$width < "63" || $height < "63") {
    echo "Das Bild muss 64 x 64 Pixel sein.";
    $uploadOk = 0;
}

// Prüfe nach Fehlern
if ($uploadOk == 0) {
    echo "Upload fehlgeschlagen!";
// Wenn alles in Ordnung, lade die neue Datei mit einem zufälligen Namen hoch
} else {
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
            $uid = $_SESSION["u_id"];
            $sql = "SELECT user_id, user_pic FROM users";
            $result = $db->query($sql);
            echo"
        <center>
            <img src='../uploads/userpic/". $newfilename. "' alt='Avatar' style='width:10%'> </center>
            "; 
            $sql = 'UPDATE users SET user_pic = "'.$newfilename.'" WHERE user_id = "$uid"';
            mysqli_query($db, $sql);
                    header("Location: ./profil.php");
            die();    
        exit();
    } else {
        echo "Upload fehgeschlagen!";
    }
}
?>