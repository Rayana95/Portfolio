<?php
require_once 'config/framework.php';
require_once 'config/connect.php';

if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
    $sql = 'SELECT * FROM users WHERE email="'.$_POST['email'].'"';
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (password_verify($_POST['password'], $row['password'])) {
                    $_SESSION['user'] = $row;
                    redirectToRoute('/compte.php');
                } else {
                    echo 'Compte non reconnu';
                }
            }
        } else {
            echo 'Compte non reconnu';
        }
        $result->close();
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

    <title>Login</title>


    <style>

#form{

    width: 500px;

    height: auto;

    position: absolute;

    left: 50%;

    top: 50%;

    transform: translate(-50%, -50%);

    -webkit-transform: translate(-50%, -50%);

}

</style>
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