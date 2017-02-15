<?php 
	$pdo = new PDO('mysql:dbname=live;host=localhost', "live", "root");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRORMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
