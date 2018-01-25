<?php
  session_start();
 ?>

<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="index-style.css">
      <title>Jobbörse</title>
    </head>
    <body>

      <header>
        <nav>
          <div class="main-wrapper">
            <ul>
              <li><a href="index.php">Home</a></li>
            </ul>
            <div class="nav-login">
              <?php
                if (isset($_SESSION['u_id'])) {
                    echo'
                    <table class"LoggedInUser">
                        <tr>

                            <td id="UserName">Hallo ' . $_SESSION["u_first"] . '</td>

                            <td id="menu">
                            <div class="dropdown">
                            <span>___<br>___<br>___</span>
                            <div class="dropdown-content">
                            <a href="profil.php">Mein Profil</a>
                            <a href="stellenangebote.php">Editor</a>
                            <a href="#"><form action="includes/logout.inc.php" method="post">
                                <button type="submit" name="submit">Logout</button>
                                </form></a>
                            </div>
                            </div>



                            </td>
                            </td>
                        </tr>
                    </table>';


                }
                else {
                  echo'<form action="includes/login.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="submit">Login</button>
                  </form>
                <a href="signup.php">Sign up</a>';
                }
               ?>

            </div>

          </div>
        </nav>
      </header>
