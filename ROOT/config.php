<?php
// PDO :
$host = "sql211.infinityfree.com";
$username = "if0_38571743";
$password = "dK8QwlyhEaYV025";
$dbname = "if0_38571743_stashbridge";
$dbcharset = "utf8";
$dsn = "mysql:host=$host;dbname=$dbname;charset=$dbcharset";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
);
