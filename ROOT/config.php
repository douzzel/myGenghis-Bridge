<?php

	// PDO :
	$host       = "localhost";
	$username   = "root";
	$password   = "root";
	$dbname     = "stashbridge";
	$dbcharset  = "utf8";
	$dsn        = "mysql:host=$host;dbname=$dbname;charset=$dbcharset";
	$options    = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    	PDO::ATTR_EMULATE_PREPARES => false
    );
