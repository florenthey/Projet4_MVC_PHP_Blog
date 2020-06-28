<?= $this->session->show('login'); ?>
<?= $this->session->show('logout'); ?>
<?php $this->title = "Connexion"; ?>
<?= $this->session->show('error_login'); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../public/index.php">Billet simple pour l'Alaska</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

 

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <form method="post" action="../public/index.php?route=login">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
            </div>
            <div class="col">
              <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            </div>
            <div class="col">
              <!-- <input type="submit" value="Connexion" id="submit" name="submit"> -->
              <!-- <button type="submit" class="btn btn-warning" id="submit" value="Connexion" name="submit"> -->

              <?php if (isset($_SESSION['id'])): ?>
                <button type="submit" class="btn btn-warning" id="submit" value="Connexion" name="submit"><a class="logout-btn" href="../public/index.php?route=logout">Déconnexion</a></button>
                <!-- <a class="btn btn-warning" class="nav-link" href="../public/index.php?route=logout">Déconnexion</a> -->
              <?php else: ?>
                <button type="submit" class="btn btn-warning" id="submit" value="Connexion" name="submit">
              <?php endif; ?>
                
              Connexion</button>
            </div>
          </div>
        </form>
      </li>
      <!-- <li class="nav-item">
        <?php if (isset($_SESSION['id'])): ?>
            <a class="nav-link" href="../public/index.php?route=logout">Déconnexion</a>
        <?php else: ?>
            <a class="nav-link" href="../public/index.php?route=login">Connexion</a>
        <?php endif; ?>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="../public/index.php?route=administration">Administration</a>
      </li>
    </ul>
  </div>
</nav>