<?php
	include ('includes/connexion.inc.php');

/*
On récupère les variables id et message
On fait une requête préparée qui récupère l'id de l'utilisateur en comparant le sid avec le $_COOKIE[sid]
On fait une première condition sur la variable message : la variable existe-t-elle et n'est-elle pas vide ?
	Si oui, on effectue une deuxième condition à l'intérieur de la première sur la variable id : si elle existe et si elle n'est pas vide ?
		Si oui, on fait une mise à jour du messaege dans la BDD qui correspond au bon id
		Sinon, on insère le nouveau message en BDD
	Sinon, on redirige vers la page d'accueil
*/
	$id=$_POST['id'];
	$message=$_POST['message'];

	$query = "SELECT id FROM users where sid='$_COOKIE[sid]'";
 	$prepare = $pdo->prepare($query);
 	$prepare->execute();
 	$data = $prepare->fetch();
 	$user_id = $data['id'];

	if (isset($message) && !empty($message))
	{
		if(isset($id) && !empty($id))
		{
			$query = 'UPDATE messages SET contenu=:contenu WHERE id=:id';
			$prep = $pdo->prepare($query);
			$prep->bindValue(':contenu', $message);
			$prep->bindValue(':id', $id);
			$prep->execute();
		}
		else
		{
			$query = 'INSERT INTO messages (contenu,user_id) VALUES (:contenu,:user_id)';
			$prep = $pdo->prepare($query);
			$prep->bindValue(':contenu', $_POST['message']);
			$prep->bindValue(':user_id', $user_id);
			$prep->execute();
 		}
	}
	header('Location: index.php');
 		exit();
?>
