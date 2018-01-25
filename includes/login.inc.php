<?php
include_once 'password.php';

session_start();

if (isset($_POST['submit'])) {

  include 'dbh_inc.php';

  $uid = mysqli_real_escape_string($db, $_POST['uid']);
  $pwd = mysqli_real_escape_string($db, $_POST['pwd']);

  //error handlers
  //Check if inputs are empty

  if (empty($uid) || empty($pwd)) {
      header("Location: ../index.php?login=empty");
      echo "<script>alert('Bitte füllen Sie die Felder aus!');</script>";
      exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    $result = mysqli_query($db, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck < 1 ) {
      header("Location: ../index.php?login=error");
      echo "<script>alert('Dieser Benutzer existiert nicht!');</script>";
      exit();
    }
    else {
      if ($row = mysqli_fetch_assoc($result)) {
        //de-Hasching password
        $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
        if ($hashedPwdCheck == FALSE) {
          header("Location: ../index.php?login=error");
            $message ='Das Passwort oder der Benutzername ist falsch!'; 
          echo "<script>alert('$message');
          window.location.replace(\"http:://localhost\");</script>";
          exit();
        }elseif ($hashedPwdCheck == true) {
          //Login User
          $_SESSION['u_id'] = $row['user_id'];
          $_SESSION['u_first'] = $row['user_first'];
          $_SESSION['u_last'] = $row['user_last'];
          $_SESSION['u_email'] = $row['user_email'];
          $_SESSION['u_uid'] = $row['user_uid'];
          header("Location: ../index.php?login=success");
          exit();
        }
      }
      }
  }
}
else {
  header("Location: ../index.php?login=error");
}

 ?>
