<?php
	if (!empty($_POST) && !empty($_POST["username"]) && !empty($_POST["password"])){
		require_once 'inc/db.php';
		require_once "inc/function.php";
		$req = $pdo->prepare('SELECT * FROM user WHERE (pseudo = :username OR mail = :username) AND valid_at IS NOT NULL');
		$req->execute(["username"=> $_POST['username']]);
		$user = $req->fetch();
		session_start();
		if(!empty($user)){
			if (password_verify($_POST["password"], $user->password)){
				$_SESSION["auth"] = $user;
				$_SESSION["flash"]["success"] = "Vous êtes connecté";
				header ("location: account.php");
				exit();
			}else{
				$_SESSION["flash"]["danger"] = "Identifiant ou mot de passe incorrect";
			}
		}else{
			$_SESSION["flash"]["danger"] = "Identifiant ou mot de passe incorrect";
		}

	}

?>

<?php  require 'inc/header.php'; ?>

<h1>Se connecter </h1>

<form action="" method="post">
	
	<div class="form-group">
		<input type="text" name="username" class="form-control" placeholder="Pseudo ou mail" />
	</div>	

	<div class="form-group">	
		<input type="password" name="password" class="form-control" placeholder="Mot de passe" />	
		<a href="remember.php">Mot de passe oublié ?</a>
	</div>

	<button type="submit" class="btn btn-primary">Connexion</button>

</form>

<?php  require 'inc/footer.php'; ?>