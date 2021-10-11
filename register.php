<?php

require_once 'config/framework.php';
require_once 'config/connect.php';



$errors = [];

//echo sha1('raykai2001@gmail.com').'<br>';


if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
  // teste le pseudo 
  if(strlen($_POST['pseudo']) < 3 || strlen($_POST['pseudo']) > 30) {
    $errors['pseudo']= 'Votre pseudo doit compter entre 3 et 30 caractères maximum';
  }

  // teste le pseudo 
  if($_POST['email'] && !preg_match('#^[\w.-]+@[\w.-]+.[a-z]{2,6}$#i', $_POST['email'])) {
    $errors['email']= 'Votre email est invalide';
  }

  // teste les mots de passe identiques
  if (isset($_POST['password']) && $_POST['password'] === $_POST['password-repeat']) {
    $password_hash=password_hash($_POST['password'], PASSWORD_DEFAULT);
  } else {
    $errors['password'] = 'Les mots de passe ne sont pas identiques';
  }
    
  
  if (empty($errors)){
    $sql = "INSERT INTO users(email, password, pseudo, roles) VALUES ('".$_POST['email']."','".$password_hash."','".$_POST['pseudo']."','".json_encode(['ROLE_USER'])."')";
    if($mysqli->query($sql) === true) {
      redirectToRoute('/login.php');
    } else {
      echo 'une erreur !! veuillez recommncer';
    }
  }
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <link href="css/register.css" rel="stylesheet">

    <title>Hello, world!</title>

  </head>
  <body>

  <div id="form">
  <div class="row">
    
        <form method="POST">
          <input type="hidden" name="token" value="<?= miniToken(); ?>">
          <div class="form-groupe col-10 mb-3">
            <input type="Email" class="form-control" name="email" id="inputEmail" placeholder="Adresse Mail">
          </div>
          <div class="form-groupe col-10 mb-3">
            <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Mot de passe">
          </div>
          <div class="form-groupe col-10 mb-3">
            <input type="password" class="form-control" name="password-repeat" id="inputPassword" placeholder="Mot de passe repeat">
          </div>
          <div class="form-groupe col-10 mb-3">
            <input type="pseudo" class="form-control" name="pseudo" id="inputPseudo" placeholder="Pseudo">
          </div>
            <button type="submit">Valider</button>

        </form>
   
  </div>
  </div>
  


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    -->
  </body>
</html>