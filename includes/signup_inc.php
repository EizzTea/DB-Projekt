<?php
include_once 'password.php';
if (isset($_POST['submit'])) {

  include_once 'dbh_inc.php';

  $titel = mysqli_real_escape_string($db, $_POST['titel']);
  $position = mysqli_real_escape_string($db, $_POST['position']);
  $first = mysqli_real_escape_string($db, $_POST['first']);
  $last = mysqli_real_escape_string($db, $_POST['last']);
  $firm = mysqli_real_escape_string($db, $_POST['firm']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $telefon = mysqli_real_escape_string($db, $_POST['telefon']);
  $uid = mysqli_real_escape_string($db, $_POST['uid']);
  $pwd = mysqli_real_escape_string($db, $_POST['pwd']);
  $rang = mysqli_real_escape_string($db, $_POST['rang']);
  //error handlers
  //Check for empty fields
    
    if (empty($titel) || empty($position) || empty($first) || empty($last) || empty($firm) || empty($email) || empty($telefon) || empty($uid) || empty($pwd))
  { 
      
    header("Location: ../signup.php?signup=empty");
    exit();
  }
  else {
    //Check input are valid
    if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
      header("Location: ../signup.php?signup=invalid");
      exit();
    }
    else{
      //Chech if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup=email");
        exit();
      }
      else {
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
          header("Location: ../signup.php?signup=UsernameExists");
            echo "<script>alert('Der Benutzername existiert bereits!')</script>";
          exit();
            
        }
        else {
          //hashing password
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
          //Insert User in DB
          $sql = 'INSERT INTO users (user_titel, user_position, user_first, user_last, user_firm, user_email, user_telefon, user_uid, user_pwd, user_rang) VALUES ("' . mysql_real_escape_string($titel) . '", "' . mysql_real_escape_string($position) . '", "' . mysql_real_escape_string($first) . '", "' . mysql_real_escape_string($last) . '", "' . mysql_real_escape_string($firm) . '", "' . mysql_real_escape_string($email) . '", "' . mysql_real_escape_string($telefon) . '", "' . mysql_real_escape_string($uid) . '", "' . mysql_real_escape_string($hashedPwd) . '", "' . mysql_real_escape_string($rang) . '");';
          mysqli_query($db, $sql);
          header("Location: ../signup.php?signup=Success");
          exit();
        }
      }
    }

  }
}
else {
  header("Location: ../signup.php");
  exit();
}
