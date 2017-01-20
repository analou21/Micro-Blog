<?php
  include('includes/connexion.inc.php');
  include('includes/haut.inc.php');

/*
On initialise les varibles message et id
Si la variable id existe et qu'elle n'est pas vide
  On récupère la variable id et on va chercher, dans la BDD, tous les messages qui correspondent à cet id
    Si la requête retourne des messages, on les affiche sur la page
    Sinon on redirige vers la page d'accueil sans modification
*/
  $message = '';
  $id = '';
  if(isset($_GET['id']) && !empty($_GET['id']))
  {
    $id = $_GET['id'];
    $sql = 'SELECT * from messages where id='.$id.'';
    $requete = $pdo->query($sql);
    if($data = $requete->fetch())
    {
      $message =  $data['contenu'];
    }else
    {
      header("Location: index.php");
    }
  }
?>
<?php

/*On affiche les boutons de création, modification et suppression seulement si l'utilisateur est connecté*/
  if($connecte == true)
  {
?>
    <div class="row">
      <form method="post" action="message.php">
        <div class="col-sm-10">
          <div class="form-group">
            <textarea id="message" name="message" class="form-control" placeholder="Message">
              <?php echo $message ?><!-- On affiche le message -->
            </textarea>
            <input type="hidden" name="id" value="<?php echo $id ?>"/>
          </div>
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
        </div>
      </form>
    </div>
<?php
  }
?>
<?php
/*Code consacré à la pagination*/
  $index = 0;
  $mpp = 4;

  if(isset($_GET['p']) && !empty($_GET['p']))
  {
    $page = $_GET['p'];
    $index = ($page - 1)* $mpp;
  }
  $query = 'SELECT * , messages.id as message_id FROM messages INNER JOIN users ON messages.user_id = users.id LIMIT '.$index.','.$mpp.'';
  $stmt = $pdo->prepare($query);
  $stmt->execute();
/*
On récupère les messages dans la BDD
Si l'utilisateur clique sur modifier, on affiche le nouveau message
Si l'utilisateur clique sur supprimer, on supprime le message sélectionné
*/
  $query = 'SELECT * FROM messages';
  $stmt = $pdo->query($query);
  while ($data = $stmt->fetch())
  {
?>
    <blockquote>
      <?= $data['contenu'] ?>
      <?php
        if($connecte == true)
        {
      ?>
          <div class="col-sm-2">
            <?php echo "<a href='index.php?id=" .$data['message_id']. "'></a>" ?>
          </div>
          <div class="col-sm-2">
            <?php echo "<a href='suppression.php?id=" .$data['message_id']. "'></a>" ?>
          </div>
      <?php
        }
      ?>
      <!-- Affichage de la date et de l'auteur du message -->
      <div class="col-sm-12">
        <?= "Ajouté le ".$data['date'] ?>
      </div>
      <div class="col-sm-12">
        <?= "Ajouté par ".$data['pseudo'] ?>
      </div>
    </blockquote>
<?php
  }
?>

<?php include('includes/bas.inc.php'); ?>
