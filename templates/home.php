<?php $this->title = "Accueil"; ?>
<?php $this->meta = "Page d/'accueil, affichage des derniers articles"; ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>

<div class="container-img">
  <!-- <img class="alaska-img" src="../public/img/Alaska.jpg"> -->
  <video class="alaska-img" src="../public/img/video.mp4"  muted autoplay loop controls>
  Votre navigateur ne gère pas l'élément <code>video</code>.
</video>
  <div class="text-img">
  <h2>Jean Forteroche présente:</h2><br>
  <h1 class="display-4">Billet simple pour l'Alaska</h1><br>
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
<?php
  foreach ($articles as $article) { 
      ?>
        <div class="card text-center border-dark">
          <div class="card-header">
            <a class="chapter-title"href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= htmlspecialchars($article->getTitle());?></a>
          </div>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text"><?= htmlspecialchars(mb_strimwidth($article->getContent(), 0, 350, " ..."));?></p>
            <a class="btn btn-danger" href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>">Lire le chapitre</a>
          </div>
          <div class="card-footer text-muted">
          <p>Publié le : <?= htmlspecialchars($article->getCreatedAt());?></p>
          </div>
        </div>
        <br>
        <br>
      <?php
  }
?>
</div>