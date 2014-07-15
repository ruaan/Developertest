<?php
require_once 'inc.global.php';

// DATA RETRIEVAL:
// NOTES: Refer to the provided TemplatePower manual for help

// 1: Create the TemplatePower object using tpl/global.htm. Name the variable $tpl

$tpl = new TemplatePower("tpl/global.htm");

// 2: Assign tpl/users.htm to the BODY include block in tpl/global.htm

$tpl->assignInclude("BODY", "tpl/users.htm");

// 3: Prepare the template

$tpl->prepare();

// 4: Assign the word 'Users' as the page title

$tpl->assign("page_title", "Users Table");


// 5: Write the SQL query to retrieve all users from the database and order the results by first name

$sql = 'SELECT id, first_name, surname, email, username FROM users ORDER BY first_name';

// This will run your query

$query = mysql_query($sql, $db);

// This will fetch the rows

while ( ($row = mysql_fetch_array($query, MYSQL_ASSOC)) !== false ) // Returns a associative array 
{
// 6: Create a new block to assign the user information to
	
    $tpl->newBlock("user");
	
// 7: Assign all necessary information to the template here. Refer to the template for variable names
	
    $tpl->assign($row);
}


mysql_close($db); //Close database after database $query

// 8: Display the template
$tpl->printToScreen(); // Print template

?>