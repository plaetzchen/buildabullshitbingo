<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-15">
	<title></title>
	<!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/> -->
	<!-- <link rel="stylesheet" type="text/css" href=".css"/> -->
</head>

<body>
 
<?php 
// ---------------------------------- Config ----------------------------------

$field_size = 5;

// --------------------------- User Input Functions ---------------------------

function prep_data($input) {
	$tmp = strip_magic($input);
	$tmp = htmlentities($tmp);
	$tmp = preg_replace(
		Array('/_tm/', '/\\(c\\)/'),
		Array('<sup>tm</sup>', '&copy;'),
		$tmp
		);
	return $tmp;
}

function strip_magic($input) {
	if (get_magic_quotes_gpc()) {
		return stripslashes_deep($input);
	} else {
		return $input;
	}
}

function stripslashes_deep($value) {
	if(is_array($value)) {
		return array_map('stripslashes_deep', $value);
	} else {
		return stripslashes($value);
	}
}

// ----------------------------------- Main -----------------------------------

$daten = preg_split("/[\r\n]+/", $_REQUEST['daten'], -1, PREG_SPLIT_NO_EMPTY);
$daten = array_map('prep_data', $daten);

$pages = intval($_REQUEST['pages']);

for($d=0; $d < $pages; $d++) { 
	shuffle($daten);

	if($d != 0) {
		echo "<p style='page-break-before:always'>";
	}
	echo "<table border='1' align='center'>";
	
	for($i=0; $i < $field_size; $i++) { 
		echo "<tr height='100'>";
		for($j = 0; $j < $field_size; $j++) { 
			echo "<td width='100' align='center'>";
			echo $daten[$i * $field_size + $j];
			echo "</td>";
		}
		echo "</tr>";
	} 
	echo "</table><br><br><br>";
	
	if($d != 0) {
		echo "</p>";
	}
}
?>

</body> 
</html>