<?php
require_once 'inc.global.php';

// formInput MANIPULATION:
// NOTES: If the $_REQUEST variable is empty display the form to edit a user
// otherwise save the information in $_REQUEST variable so as to edit the user and return to the user listing

$tpl = new TemplatePower("tpl/global.htm");
$tpl->assignInclude("BODY", "tpl/user_edit.htm");
$tpl->prepare();
$tpl->assign("page_title", "User Edit Form");

//Isset reference http://php.net/manual/en/function.isset.php

if(isset($_GET['id']) &&  (int) $_GET['id'] > 0) {
	
    $sql = 'SELECT * FROM users WHERE id = ' . (int) $_GET['id'];
    $query = mysql_query($sql, $db);
    
}
//strip_tages http://www.w3schools.com/php/func_string_strip_tags.asp
if (isset($_REQUEST['first_name'])) {
    $formInput['first_name'] = strip_tags(trim($_REQUEST['first_name']));
} 
else {
    $formInput['first_name'] = !empty($userInfo) && isset($userInfo)  ? $userInfo['first_name'] : '';
}

if (isset($_REQUEST['surname'])) {
    $formInput['surname'] = strip_tags(trim($_REQUEST['surname']));
} 
else {
    $formInput['surname'] = !empty($userInfo) && isset($userInfo)  ? $userInfo['surname'] : '';
}

if (isset($_REQUEST['email'])) {
    $formInput['email'] = strip_tags(trim($_REQUEST['email']));
} 
else {
    $formInput['email'] = !empty($userInfo) && isset($userInfo)  ? $userInfo['email'] : '';
}

if (isset($_REQUEST['username'])) {
    $formInput['username'] = strip_tags(trim($_REQUEST['username']));
} 
else {
    $formInput['username'] = !empty($userInfo) && isset($userInfo)  ? $userInfo['username'] : '';
}

if (isset($_REQUEST['password'])) {
    $formInput['password'] = strip_tags(trim($_REQUEST['password']));
} 
else {
    $formInput['password'] = !empty($userInfo) && isset($userInfo)  ? $userInfo['password'] : '';
}

$tpl->assign($formInput);

if(isset($_REQUEST['submit'])) {

    if(!empty($userInfo) && isset($userInfo) ) {

        $sql = 'UPDATE users SET first_name = \'' . mysql_real_escape_string($formInput['first_name']) . '\', surname = \'' . mysql_real_escape_string($formInput['surname']) . '\', email = \'' . mysql_real_escape_string($formInput['email']) . '\', username = \'' . mysql_real_escape_string($formInput['username']) . '\', password = \'' . mysql_real_escape_string($formInput['password']) . '\' WHERE id = ' . (int) $_GET['id'];
    } else {

        $sql = 'INSERT INTO users SET first_name = \'' . mysql_real_escape_string($formInput['first_name']) . '\', surname = \'' . mysql_real_escape_string($formInput['surname']) . '\', email = \'' . mysql_real_escape_string($formInput['email']) . '\', username = \'' . mysql_real_escape_string($formInput['username']) . '\', password = \'' . mysql_real_escape_string($formInput['password']) . '\'';
    }

    $result = mysql_query($sql, $db);

    if($result) {
        $_SESSION['message'] = "User data has been added.";
        header('Location: users.php');
    } else {

        $tpl->newBlock("messages");
        $tpl->assign("message", "Error ! has accured. Please try again.");
    }
}

mysql_close($db);
$tpl->printToScreen();

?>