<?php
	include ('includes/connexion.inc.php');
  include ('includes/haut.inc.php');

/*
De part ce code php, on vérifie si les variables pseudo et password existent
	Si elles le sont, nous allons chercher dnas la base de données le mot de passe et le pseudo contenu
		Grâce à une requête préparée, on compare les pseudos et les mots de passe cryptés.
			Si ils correspondent, l'utilisateur est redirigé vers la page d'accueil et peut modifier/créer/supprimer un article
*/
	if(isset($_POST['pseudo']) && isset($_POST['password']))
	{
  	$pwd=$_POST['password'];
  	$pseudo=$_POST['pseudo'];

  	$query="SELECT * FROM utilisateur WHERE pseudo=? and mdp=?";
  	$prep = $pdo->prepare($query);
  	$prep->bindValue(1,$pseudo);
  	$prep->bindValue(2,$pwd);
  	$prep->execute();

  	if($prep->fetch())
		{
    	$sid=$pseudo.time();
    	$sid=md5($sid);
    	setcookie("sid",$sid,time()+300,null,null,false,true);
    	$query="UPDATE utilisateur SET sid=? where pseudo=?";
    	$prep = $pdo->prepare($query);
    	$prep->bindValue(1,$sid);
    	$prep->bindValue(2,$pseudo);
    	$prep->execute();
    	header("Location:index.php");
  	}
	}
?>

<div id="notif" class="hidden"></div><!-- div créée pour le script en jQuery -->
<form id="form" method="post" action="connexion.php">
  <div class="row">
  <div class="form-group col-sm-2">
    <label for="pseudo">Pseudo</label>
    <input type="pseudo" name="pseudo" class="form-control" id="pseudo" placeholder="Pseudo">
  </div>
</div>
<div class="row">
  <div class="form-group col-sm-2">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
  </div>
</div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

<!--
Par le biais de jQuery, on préviens l'utilisateur si des champs ne sont pas renseignés pour qu'il puisse se connecter
On commence par récupérer la valeur des deux champs
	Si elle est vide :
		On supprime la class hidden de la div, et on lui attribut les class alert et alert-danger
		Ensuite, on afffiche un message d'erreur qui viendra se glisser en dessous des champs grâce à slideDown
	Sinon, l'utilisateur peut accéder au contenu de la page
-->
<script>
	$(document).ready(function()
	{
		$('#form').submit(function()
		{
			var pseudo = $('#pseudo').val();
			var mdp = $('#password').val();
			if(pseudo == "" && mdp == "")
			{
					$(#notif).removeClass();
					$(#notif).addClass(alert alert-danger);
					$(#pseudo).html("Erreur, veuillez remplir le champs");
					$(#password).html('Erreur, veuillez remplir le champs');
					$(#notif).slideDown();
					//alert('Veuillez remplir les champs');
					return false;
			}
			else
			{
					return true;
			}
		});
	});
</script>

<?php include('includes/bas.inc.php'); ?>
