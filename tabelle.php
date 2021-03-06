<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-15">
	<title>Bullshitbingo</title>
	<!-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/> -->
	<!-- <link rel="stylesheet" type="text/css" href=".css"/> -->
</head>

<body>
 
<?php 
// ---------------------------------- Config ----------------------------------

// How many cells per line and column?
$field_size = 5;

// Width and height of a whole bingo field
$field_dim = $field_size * 125;

// Width and height of a single cell
$cell_dim = intval(100 / $field_size).'%';

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

$daten = preg_split("/\\s*?[\r\n]+\\s*/", $_REQUEST['daten'], -1, PREG_SPLIT_NO_EMPTY);
$daten = array_map('prep_data', $daten);

if(count($daten) < $field_size * $field_size) {
	echo "F&uuml;r ein Bingofeld werden mindestens "
		. ($field_size * $field_size)
		. " Begriffe gebraucht. Du hast "
		. count($daten)
		. " Begriffe eingegeben. Der Rest der Felder bleibt leer";
	do {
		$daten[] = "";
	} while(count($daten) < $field_size * $field_size);
}

$pages = intval($_REQUEST['pages']);

for($d=0; $d < $pages; $d++) { 
	shuffle($daten);

	if($d != 0) {
		echo "<p style='page-break-before:always'>";
	}
	echo "<table"
		." border='1'"
		." align='center'"
		." width='".$field_dim."'"
		." height='".$field_dim."'"
		.">";
	
	for($i=0; $i < $field_size; $i++) { 
		echo "<tr height='".$cell_dim."'>";
		for($j = 0; $j < $field_size; $j++) { 
			echo "<td width='".$cell_dim."' align='center'>";
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