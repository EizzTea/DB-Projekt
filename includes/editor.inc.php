<?php

if (isset($_SESSION["u_id"])) $u_id = $_SESSION["u_id"];
if(isset($_POST['continue'])){
    $u_id++;
    
}
elseif(isset($_POST['back'])){
    if($u_id !=1){
    $u_id = $u_id--;
    <script type="text/javascript" language="Javascript"> 
    alert("Keine Datensätze vorhanden");
    </script>
    }
}