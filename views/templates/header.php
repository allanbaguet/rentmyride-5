<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rent My Ride - Location de véhicules hors du commun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/public/assets/css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Rent My Ride</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/controllers/vehiclesList-ctrl.php">Tous les véhicules</a>
          </li>


          <?php
          if (empty($_SESSION["client"])) {
          ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/controllers/clientsSignIn-ctrl.php">Connexion</a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/controllers/clientsSignUp-ctrl.php">Inscription</a>
            </li>
          <?php } else { ?>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/controllers/clientsSignOut-ctrl.php">Déconnexion</a>
            </li>
          <?php } ?>

        </ul>
        <form class="d-flex" role="search" id="formSearch" action="/controllers/vehiclesList-ctrl.php">
          <div class="row">
            <div class="col-12 col-md-6">
              <select name="id_categories" id="id_categories" class="form-select mb-3 mb-md-0">
                <option value="">Toutes catégories</option>
                <?php
                foreach ($categories as $key => $category) {
                  $isSelected = ($category->id_categories == $id_categories) ? 'selected ' : '';
                  echo '<option ' . $isSelected . ' value="' . $category->id_categories . '">' . $category->name . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <input class="form-control  mb-3 mb-md-0" type="search" name="search" value="<?= $search ?? '' ?>" placeholder="Ex: Van rouge" aria-label="Search">

            </div>
          </div>

        </form>
      </div>
    </div>
  </nav>
  <div class="container-fluid">