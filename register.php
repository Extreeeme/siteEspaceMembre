<?php
	$error = array();
	if (!empty($_POST)){
		require_once 'function.php';
		if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
			$error['username'] = "Votre pseudo n'est pas valide (alpha_numerique)";
		}
		if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
			$error['mail'] = "Votre mail n'est pas valide";
		}
		if (empty($_POST['password']) || $_POST["password"] != $_POST["password-confirm"]){
			$error['password'] = "Les mots de passe ne correspondent pas";
		}
		if (empty($error)){
			require_once 'inc/db.php';
			$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
			$req = $pdo->prepare('INSERT INTO user SET pseudo = ?, mail = ?, password = ?');
			$req->execute([$_POST["username"], $_POST["mail"], $password]);
		}else{
			debug($error);	
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