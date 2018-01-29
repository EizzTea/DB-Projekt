<?php
    include_once 'includes/dbh_inc.php';
    include_once 'header.php';
    /*$titel = select ;
    $position = mysqli_real_escape_string($db, $_POST['position']);
    $first = mysqli_real_escape_string($db, $_POST['first']);
    $last = mysqli_real_escape_string($db, $_POST['last']);
    $firm = mysqli_real_escape_string($db, $_POST['firm']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $telefon = mysqli_real_escape_string($db, $_POST['telefon']);
    $uid = mysqli_real_escape_string($db, $_POST['uid']);
    $pwd = mysqli_real_escape_string($db, $_POST['pwd']);*/
    $uid = $_SESSION["u_id"];
    $last = 'SELECT user_last FROM users WHERE user_uid=' . $uid . '';
    $first = 'SELECT user_first FROM users WHERE user_uid=' . $uid . '';

    $sql = "SELECT user_last, user_first, user_firm, user_pic FROM users";
    $result = $db->query($sql);
if ($result->num_rows > 0) {
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    while($row = $result->fetch_assoc()) {
        echo"
        <center>
            <img src='../uploads/userpic/". $row["user_pic"]. "' alt='Avatar' style='width:10%'>
            <form action='upload.php' method='post' enctype='multipart/form-data'>
            <input type='file' name='fileToUpload' id='fileToUpload'>
            <input type='submit' value='Upload Avatar' name='submit'>
            </form>
            <h4><b>" . $row["user_first"]." ". $row["user_last"]. "</b></h4> 
            <p>" . $row["user_firm"]. "</p> 
            <a style='font-size: 10px;' href='editor.php'>Bearbeiten</a><br>
            <a style='font-size: 10px;' href='newjob.php'>Neues Angebot erstellen</a>
            </center>
       "; 
    /*
        echo "
      <table>
      <tr><td>Name: " . $row["user_last"]. "    <a style='font-size: 10px;' href='editor.php'>Bearbeiten</a></td></tr>
      <tr><td>Vorname: " . $row["user_first"]. "    <a style='font-size: 10px;' href='editor.php'>Bearbeiten</a></td></tr>
      <tr><td>Firma: " . $row["user_firm"]. "    <a style='font-size: 10px;' href='editor.php'>Bearbeiten</a></td></tr>
      </table>";
        //echo " <br> Name: " . $row["user_last"]. " <br> Vorname: " . $row["user_first"]. " <br> Firma: " . $row["user_firm"]. "<br>";
    */
    };
};
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mein Profil</title>
  </head>
  <body>
    <!---<div class="Daten">
      <table>
          <tr><td>Name:</td><td><?php echo "Name: " . $row["user_last"]. "" ?></td><td><a class="edit" href="stellenangebote.php" style="textdecoration: none;">Bearbeiten</a></td></tr>
          <tr><td>Vorname:</td><td><?php echo $first; ?></td><td><a class="edit" href="stellenangebote.php" style="textdecoration: none;">Bearbeiten</a></td></tr>
          <tr><td>Telefon:</td><td></td></tr>
          <tr><td>Firma:</td><td></td></tr>
      </table>
    </div>-->
  </body>
</html>

<?php
    include_once 'header.php';
?>
