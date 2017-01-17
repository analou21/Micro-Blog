<?php
	include ('includes/connexion.inc.php');
  include ('includes/haut.inc.php');

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
    	?>
    		<script>alert("Connecté sous le pseudo : <?php echo $pseudo ?> ");</script>
    	<?php
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

<form method="post" action="connexion.php">
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

<?php include('includes/bas.inc.php'); ?>
