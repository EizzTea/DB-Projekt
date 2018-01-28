<?php
    include_once 'header.php';
?>

    <section class="main-container">
      <div class="main-wrapper">
        <h2>SignUp</h2><br>
        <form class="signup-form" action="includes/signup_inc.php" method="post">   
          <p style="margin-bottom: 5px; margin-top: 6px;">Titel: </p>
          <input type="text" name="titel" placeholder="Titel">
          <p style="margin-bottom: 5px; margin-top: 6px;">Vorname: </p>
          <input type="text" name="first" placeholder="Vorname">
          <p style="margin-bottom: 5px; margin-top: 6px;">Nachname: </p>
          <input type="text" name="last" placeholder="Nachname">
          <p style="margin-bottom: 5px; margin-top: 6px;">Firma: </p>
          <input type="text" name="firm" placeholder="Firma">
          <p style="margin-bottom: 5px; margin-top: 6px;">E-Mail: </p>
          <input type="email" name="email" placeholder="E-Mail">
          <p style="margin-bottom: 5px; margin-top: 6px;">Position: </p>
          <input type="text" name="position" placeholder="Position">
          <p style="margin-bottom: 5px; margin-top: 6px;">Telefon-Nr: </p>
          <input type="text" name="telefon" placeholder="Telefon">
          <p style="margin-bottom: 5px; margin-top: 6px;">Username: </p>
          <input type="text" name="uid" placeholder="Username">
          <p style="margin-bottom: 5px; margin-top: 6px;">Passwort: </p>
          <input type="password" name="pwd" placeholder="Password">
          <input style="visibility: hidden;" type="text" name="rang" value="User">
          <button style="margin-bottom: 5px; margin-top: 6px;" type="submit" name="submit">Sign Up</button>
        </form>
      </div>
    </section>

