<?php
	include ('includes/connexion.inc.php');
  include ('includes/haut.inc.php');

  if(isset($_POST['pseudo'])){
    $password = md5($_POST['password']);
    $pseudo=$_POST['pseudo'];
    $connecte = false;
    $query = "SELECT * from utilisateur where pseudo='$pseudo' and password='$password'";
    $prep = $pdo->prepare($query);
    $prep->execute();
    if ($prep->fetch())
    {
      $connecte=true;
      $sid = $pseudo.time();
      setcookie('sid',$sid,time() + 365*24*3600, null, null, false, true);
      $update = "UPDATE utilisateur SET sid='$sid' where pseudo='$pseudo'";
      $prepare = $pdo->prepare($update);
      $prepare->execute();
    }
  }else{
      header("Location: connexion.php");
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
