<?php
$pdo = new PDO('mysql:host=localhost;dbname=micro_blog', 'root', '', $arrExtraParam);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*Par défaut, l'utilisateur n'est pas connecté
Après qu'il connecte, on crée un cookie à partir de sid
Après la création de ce cookie, l'utilisateur est bien connecté*/
$connecte=false;
if(isset($_COOKIE['sid']))
{
  $cookie = $_COOKIE['sid'];
  $query = "SELECT * FROM users where sid='$cookie'";
  $prep = $pdo->prepare($query);
  $prep->bindValue(1, $cookie);
  $prep->execute();
  if($data=$prep->fetch())
  {
    $connecte=true;
  }
}
?>
