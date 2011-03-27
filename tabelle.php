<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-15">
<title></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href=".css"/>
</head>
<body>
<center>
 
<?php 

$daten = explode("\n",$_GET['daten']); 
for($i=0; $i<count($daten); $i++) {
	$daten[$i] = htmlentities($daten[$i]);
}

$pages = $_GET['pages'];
$pages = intval($pages);

for($d=0; $d<$pages; $d++)
{ 
	shuffle($daten);

	if($d == 0) {
		echo "<table border='1'>";
	} else {
		echo "<p style='page-break-before:always'><table border='1'>";	
	}
	
	for($i=0; $i<20; $i=$i+4) 
	{ 
		echo "<tr height='100'>"; 
		echo "<td width='100' align='center'>" . 
				$daten[$i] . "</td><td width='100' align='center'>" . 
				$daten[$i+1] . "</td><td width='100' align='center'>" . 
				$daten[$i+2] . "</td><td width='100' align='center'>" . 
				$daten[$i+3] . "</td><td width='100' align='center'>" . 
				$daten[$i+4] ."</td>"; 
		echo "</tr>";
	} 
	echo "</table><br><br><br></p>";
}
?> 

</center>

</body> 
</html>