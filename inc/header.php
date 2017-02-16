<?php 
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
	  <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Site Espace Membre</title>


	 </head>

	  <body>

		<nav class="navbar navbar-inverse navbar">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Espace Membre</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					<?php  if(!isset($_SESSION["auth"])): ?>  
						<li><a href="login.php">Se connecter</a></li>
						<li><a href="register.php">S'inscrire</a></li>
					<?php else: ?> 
						<li><a href="logout.php">Se deconnecter</a></li>
					<?php endif; ?>	
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
		<?php if(isset($_SESSION["flash"])) : ?>
			<?php foreach ($_SESSION["flash"] as $type => $message) : ?>
				<div class="alert alert-<?= $type ?> ">
				<?= $message; ?>
		</div>
		<?php endforeach; ?>
		<?php unset($_SESSION["flash"]); ?>
		<?php endif; ?>