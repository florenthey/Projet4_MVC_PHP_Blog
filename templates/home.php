<?php $this->title = "Accueil"; ?>
<?php $this->meta = "Page d'accueil, affichage des derniers articles"; ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>

<?= $this->session->show('logout'); ?>

<div class="container-img">
  <!-- <img class="alaska-img" src="./img/Alaska.jpg"> -->
  <video title="Aurore bauréale" class="alaska-img" src="./img/video.mp4"  muted autoplay loop controls>
  Votre navigateur ne gère pas l'élément <code>video</code>.
</video>
  <div class="text-img">
  <h1>Jean Forteroche présente:</h1>
  <h2 class="display-4">Billet simple pour l'Alaska</h2>
    <p>Le nouveau roman du roi du thriller, en lecture libre.
  </div>
  <div class="text-img-responsive">
  <h1>Jean Forteroche présente:</h1>
  <h2 class="display-4">Billet simple pour l'Alaska</h2>
    <p>Le nouveau roman du roi du thriller, en lecture libre.
  </div>
</div>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <p class="lead">"...Jean-Michel se trouva face à une crevasse de près d'une trentaine de mètres, il ne survivrait pas à une telle chute. <br>
    Le problème, c'est qu'il ne survivrait pas non plus à la silhouette encapuchonnée qui approchait lentement, un couteau perlant de sang à la main, souillant de rouge les neiges jusqu'alors immaculées de cette région de l'Alaska..."</p>
  </div>
</div>

<div class="container">
<?php setlocale(LC_TIME, "fr_FR"); ?>
<?php
  foreach ($articles as $article) { 
      ?>
        <div class="card text-center border-dark">
          <div class="card-header">
            <a class="chapter-title"href="./index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= $article->getTitle();?></a>
          </div>
          <div class="card-body">
            <h3 class="card-title"></h3>
            <p class="card-text"><?= mb_strimwidth($article->getContent(), 0, 350, " ...");?></p>
            <p class="text-center">
              <a class="btn btn-warning" href="./index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= htmlspecialchars($article->getTitle());?> (...suite)</a>
            </p>
          </div>
          <div class="card-footer text-muted">
            <p>Publié le : <?= $dateFormat = strftime("%A %d %B %G", strtotime($article->getCreatedAt())); ?></p>
          </div>
        </div>
        <br>
        <br>
      <?php
  }
?>
</div>