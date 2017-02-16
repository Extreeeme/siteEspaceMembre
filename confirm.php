<?php
	if(isset($_GET["id"]) && isset($_GET["token"])){
		$user_id = $_GET['id'];
		$user_token = $_GET["token"];
		require_once 'inc/db.php';
		$req = $pdo->prepare("SELECT * FROM user WHERE id = ?");
		$req->execute([$user_id]);
		$user = $req->fetch();

		if($user && $user->valid_token == $user_token){ //égal à $user["valid_token"]
			$pdo->prepare('UPDATE user SET valid_token = NULL, valid_at = NOW() WHERE id = ?')->execute([$user_id]);
			session_start();
			$_SESSION["auth"] = $user;
			$_SESSION["flash"]["success"] = "Votre compte a bien été validé";
			header('location: account.php');
			exit();
		}

	}
		
	header('location: index.php');
?>