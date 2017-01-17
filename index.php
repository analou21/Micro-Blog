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
  <!--/*$mpp=5;
  $total_message='SELECT COUNT(*) AS total FROM messages';
  $donnees_total=$total_message;
  $total=$donnees_total['total'];
  $nb_pages=ceil($total/$mpp);
  if(isset($_GET['page']))
  {
    $page=intval($_GET['page']);
    if($page>$nb_pages)
    {
      $page=$nb_pages;
    }
  }
  else
  {
    $page=1;
  }
  $index=($page-1)*$mpp;
  $retour_messages='SELECT * FROM messages ORDER BY id DESC LIMIT '.$index.', '.$mpp.'';

  while($donnees_messages=$retour_messages)
  {
    echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                     <td><strong>Ecrit par : '.$donnees_messages['pseudo'].'</strong></td>
                </tr>
                <tr>
                     <td>'.nl2br($donnees_messages['contenu']).'</td>
                </tr>
            </table><br /><br />';
  }
  echo '<p align="center">Page : ';
  for($i=1; $i<=$nb_pages; $i++)
  {
     if($i==$page)
     {
       echo ' [ '.$i.' ] ';
     }
     else
     {
       echo ' <a href="messages.php?page='.$i.'">'.$i.'</a> ';
     }
   }
echo '</p>';
?>*/-->

<?php include('includes/bas.inc.php'); ?>
