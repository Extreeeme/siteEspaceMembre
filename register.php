<?php
	session_start();
	if (!empty($_POST)){
		require_once 'inc/function.php';
		require_once 'inc/db.php';
		if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
			$_SESSION["flash"]["danger"]= "Votre pseudo n'est pas valide (alpha_numerique)";
		}else{
			$req = $pdo->prepare('SELECT id FROM user WHERE pseudo = ?');
			$req->execute([$_POST["username"]]);
			$user = $req->fetch();
			if($user){
				$_SESSION["flash"]["danger"]= "Ce pseudo est déjà utilisé";
			}
		}
		if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
			$_SESSION["flash"]["danger"] = "Votre mail n'est pas valide";
		}else{
			$req = $pdo->prepare('SELECT id FROM user WHERE mail = ?');
			$req->execute([$_POST["mail"]]);
			$user = $req->fetch();
			if($user){
				$_SESSION["flash"]["danger"] = "Ce mail est déjà utilisé";
			}
		}
		if (empty($_POST['password']) || $_POST["password"] != $_POST["password-confirm"]){
			$_SESSION["flash"]["danger"]= "Les mots de passe ne correspondent pas";
		}
		if (empty($_SESSION["flash"])){
			$token = str_random(60);
			$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
			$req = $pdo->prepare('INSERT INTO user SET pseudo = ?, mail = ?, password = ?, valid_token = ?');
			$req->execute([$_POST["username"], $_POST["mail"], $password, $token]);
			$user_id = $pdo->lastInsertId();

			// mail($_POST["mail"], "Mail de confirmation", "Merci de cliquer sur le lien pour confirmer votre  compte\n\n http://localhost/siteEspaceMembre/confirm.php?id=$user_id&token=$token");

			my_mail(
				$_POST["mail"], 
				$_POST["username"], 
				"Confirmation de votre compte", 
				"Mail de confirmation : Merci de cliquer sur le lien pour confirmer votre  compte<br/>\n\n http://localhost/siteEspaceMembre/confirm.php?id=$user_id&token=$token"
				);
			$_SESSION["flash"]["success"] = "Un mail de confirmation vous a été envoyé";
			header('location: login.php');
			exit();
		}
		
	}
?>


<?php require 'inc/header.php';?>

<h1>S'inscrire</h1>

<form action="" method="post">
	
	<div class="form-group">
		<input type="text" name="username" class="form-control" placeholder="Pseudo" />
	</div>	

	<div class="form-group">
		<input type="text" name="mail" class="form-control" placeholder="Votre adresse mail" />
	</div>

	<div class="form-group">	
		<input type="password" name="password" class="form-control" placeholder="Mot de passe" />	
	</div>

	<div class="form-group">	
		<input type="password" name="password-confirm" class="form-control" placeholder="Confirmation du mot de passe" />	
	</div>

	<button type="submit" class="btn btn-primary">Inscription</button>

</form>

<?php require 'inc/footer.php';?>