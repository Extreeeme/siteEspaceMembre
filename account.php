<?php
	session_start();
	require_once 'inc/function.php';
	user_only();

	if(!empty($_POST)){
		if(!empty($_POST["password"]) && $_POST["password"] != $_POST["password-confirm"]){
			$_SESSION["flash"]["danger"] = 'Les mots de passe ne correspondent pas';
		}else{
			$user_id = $_SESSION["auth"]->id;
			$password = password_hash($_POST["password"],PASSWORD_BCRYPT);
			require_once 'inc/db.php';
			$pdo->prepare("UPDATE user SET password = ? WHERE id = ?")->execute([$password, $user_id]);
			$_SESSION['flash']["success"] = "Votre mot de passe a été modifié";
		}
	}
?>

<?php require 'inc/header.php';?>
<h1>Votre compte</h1>

<form action="" method="post">

	<div class="form-group">	
		<input type="password" name="password" class="form-control" placeholder="Modifier votre mot de passe" />	
	</div>

	<div class="form-group">	
		<input type="password" name="password-confirm" class="form-control" placeholder="Confirmation du nouveau mot de passe" />	
	</div>

	<button type="submit" class="btn btn-primary">Modifier le mot de passe</button>

</form>
<?php require 'inc/footer.php';?>