<?php

require_once 'inc.config.php';

require_once 'lib/templatepower/class.TemplatePower.inc.php';

// DATABASES:
// NOTE: All settings are defined as constants in inc.config.php

// 1: Create a link to the MySQL server and store the MySQL link identifier in a variable named $DB

$db = mysql_connect(DB_HOST, DB_USER, DB_PASS);
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// 2: Select the MySQL database to use as defined by DB_NAME

mysql_select_db(DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//OR

//$result = mysqli_query($con,"SELECT * FROM ".DB_NAME);
?>