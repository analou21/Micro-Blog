<?php
  include('includes/connexion.inc.php');
  include('includes/haut.inc.php');

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
  if($connecte == true)
  {
?>
    <div class="row">
      <form method="post" action="message.php">
        <div class="col-sm-10">
          <div class="form-group">
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
  }
?>
<?php
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
            <?php echo "<a href='index.php?id=" .$data['id']. "'><button type='button' class='btn btn-warning'>Modifier</button></a>" ?>
          </div>
          <div class="col-sm-2">
            <?php echo "<a href='suppression.php?id=" .$data['id']. "'><button type='button' class='btn btn-danger'>Supprimer</button></a>" ?>
          </div>
      <?php
        }
      ?>
      <div class="col-sm-12">
        <?= "Ajouté le ".$data['date'] ?>
      </div>
    </blockquote>
<?php
  }
?>
<?php

?>
    <ul class="pagination">
      <ul class="pager">
        <li><a href="prec"><</a></li>
        <li><a href="p1">1</a></li>
        <li><a href="p2">2</a></li>
        <li><a href="p3">3</a></li>
        <li><a href="p4">4</a></li>
        <li><a href="p5">5</a></li>
        <li><a href="sui">></a></li>
      </ul>
    </ul>

<?php include('includes/bas.inc.php'); ?>
