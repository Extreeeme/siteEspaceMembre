<?php 
	$pdo = new PDO('mysql:dbname=BASE DE DONNEES;host="VOTRE HOST"', "UTILISATEUR", "MDP");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
