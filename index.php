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

<div class="row">
  <form method="post" action="message.php">
    <div class="col-sm-10">
        <div class="form-group">
          <!-- On affiche le message -->
          <textarea id="message" name="message" class="form-control" placeholder="Message">
            <?php echo $message ?>
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
/*Code consacré à la pagination*/
  $index = 0;
  $mpp = 3;

  if(isset($_GET['p']) && !empty($_GET['p']))
  {
    $page = $_GET['p'];
    $index = ($page - 1)* $mpp;
  }
  $query = 'SELECT * , messages.id as message_id FROM messages INNER JOIN utilisateur ON messages.utilisateur_id = utilisateur.id LIMIT '.$index.','.$mpp.'';
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
    /*On affiche les boutons de création, modification et suppression seulement si l'utilisateur est connecté*/
    if($connecte == true)
    {
?>
      <blockquote>
        <?= $data['contenu'] ?>
        <div class="col-sm-2">
          <?php echo "<a href='index.php?id=" .$data['id']."&p=".$page."'><button type='button' class='btn btn-warning'>Modifier</button></a>" ?>
        </div>
        <div class="col-sm-2">
          <?php echo "<a href='suppression.php?id=" .$data['id']."&p=".$page."'><button type='button' class='btn btn-danger'>Supprimer</button></a>" ?>
        </div>
        <div class="col-sm-12">
          <?= "Ajouté le ".$data['date'] ?>
        </div>
      </blockquote>
<?php
    }else
    {
 ?>
      <blockquote>
        <?= $data['contenu'] ?>
        <div class="col-sm-2">
          <?php echo "<a href='index.php?id=" .$data['id']. "'></a>" ?>
        </div>
        <div class="col-sm-2">
          <?php echo "<a href='suppression.php?id=" .$data['id']. "'></a>" ?>
        </div>
        <div class="col-sm-12">
          <?= "Ajouté le ".$data['date'] ?>
        </div>
      </blockquote>
 <?php
    }
  }
?>

<?php
  $requete = 'SELECT COUNT(*) as total_messages FROM messages';
  $prep = $pdo->query($requete);
  $data = $prep->fetch();
  $nombre_message = $data['total_messages'];

  $nb_pages = ($nombre_message) ? ceil($nombre_message/$mpp) : 1;
  $page = 0;
  if ($page > 1)
  {
    $previous = $page - 1;
  }else
  {
    $previous = 1;
  }
  if($page < $nb_pages)
  {
    $next = $page + 1;
  }else
  {
    $next = $page;
  }
?>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a <?php echo "href='index.php?p=$previous'" ?> aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i=1; $i < $nb_pages+1; $i++)
    {
    ?>
      <li>  <?php echo "<a href='index.php?p=$i'>$i</a>" ?></li>
    <?php
    }
    ?>
    <li>
      <a <?php echo "href='index.php?p=$next'" ?> aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

<?php include('includes/bas.inc.php'); ?>
