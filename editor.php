<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<TITLE>Berufe</TITLE>
</HEAD>
<BODY BGCOLOR="#fff" TEXT="#000000" LINK="#0000ff" VLINK="#0000AA">



<?php
include_once 'header.php';


	header('content-type:text/html; charset=iso-8859-1');
	include("funktionen.php");
	db_connect("db-projekt");
	
	$tabellen[0][0] = "users";
	//$tabellen[1][0] = "tbl_benutzer";	$tabellen[1][1] = "8";
    //$tabellen[2][0] = "tbl_berufe";		$tabellen[2][1] = "1";
	//$tabellen[3][0] = "tbl_stellenart";	$tabellen[3][1] = "1";
    $tabellen[4][0] = "tbl_unternehmen"; $tabellen[4][1] = "1,5";
	
	$sort = "ORDER BY user_uid";

	maske($tabellen,$sort);
    

    include_once 'footer.php';

?>

</BODY>
</HTML>


<?php include_once 'footer.php'; ?>
