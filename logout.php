
<?php
require 'php/PageController.php';
// remove all session variables
session_unset();

// destroy the session
session_destroy();

ob_start();
header('Location: '.'index.php');
ob_end_flush();

?>