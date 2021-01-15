<?php

$errors = array();
if(!empty($_POST['submitted'])) {
  // die('ok');

  // Faille Xss
  $nom     = trim(strip_tags($_POST['nom']));
  $prenom  = trim(strip_tags($_POST['prenom']));
  $email   = trim(strip_tags($_POST['email']));
  $message = trim(strip_tags($_POST['message']));

  // Validation

    // Validation message
    $errors = validText($errors,$nom,'nom',4,150);

    // Validation message
    $errors = validText($errors,$prenom,'prenom',4,120);

    // Validation Email
    if(!empty($email)){
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors ['email'] = ' Veuillez renseigner un email valide.';
      }
    }else {
      $errors ['email'] = ' Veuillez renseigner un email.';
    }
    // die('ok');

    // Validation message
    $errors = validText($errors,$message,'message',10,2000);

  if(count($errors) == 0) {
    $sql = "INSERT INTO ort_message (email, nom, prenom, message, created_at)
            VALUES (:email, :nom, :prenom, :message, NOW())";
    $query = $pdo->prepare($sql);
    $query->bindValue(':nom',$nom,PDO::PARAM_STR);
    $query->bindValue(':prenom',$prenom,PDO::PARAM_STR);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':message',$message,PDO::PARAM_STR);
    $query->execute();
    $errors ['submitted'] = 'Mesage enregistré !';
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Qui sommes-nous ?</title>
</head>

<body>
  <header>
    <nav class="navigation">
      <div class="flexnav">
        <ul class="redir">
          <li class="">
            <a class="btnnav" href="index.php">Accueil</a>
          </li>
          <li class="">
            <a class="btnnav" href="about.php">A propos</a>
          </li>
        </ul>
        <a href="index.php"><img class="logo reverse" src="assets/img/logo3.png" alt="logo"></a>
        <ul class="getin">
          <li class="">
            <?php if (isLogged()) { ?>
          <li class="">
            <a href="dashboard.php" class="btnnav active">Mon dashboard</a>
          </li>
          <li class="">
          <a class="login" id="subdisconnect" href="logout.php">Deconnexion</a>
          </li>
        <?php } else { ?>
          <li class="salut"><a href="" id="btnNav" class="login" data-toggle="modal" data-target="#myModal">Connexion/Inscription</a></li>
        <?php } ?>
        </li>
        </ul>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>


            <ul class="nav nav-tabs" id="tabContent">
              <li class="active"><a href="#connexion" id="connect" data-toggle="tab">connexion</a></li>
              <li><a href="#inscription" id="inscript" data-toggle="tab">inscription</a></li>
              <li><a href="#mdp" id="motdp" class="hide" data-toggle="tab">mot de passe oublié</a></li>
            </ul>

            <div class="tab-content">

              <div class="tab-pane active" id="connexion">
                <!--Body-->
                <form action="ajax/connexion.php" id="formulaireco" class="d-flex flex-column align-items-center my-3" method="POST">
                  <!-- LOGIN -->
                  <div class="form-group col-xs-11">
                    <input type="text" id="login" name="login" class="form-control" value="" placeholder="Pseudo ou E-mail">
                    <span class="error my-3" id="error_login"></span>
                  </div>
                  <!-- PASSWORD -->
                  <div class="form-group col-xs-11">
                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="Mot de passe" />
                    <span class="error my-3" id="error_password"></span>
                  </div>
                  <input type="submit" id="subconnect" class="btn btn-primary" name="submitconnexion" value="Connexion" />
                </form>
                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-center text-md-left mt-1">
                    <p class="mdpoubli"><a href="#mdp" id="switch3" class="blue-text"> Mot de passe oublié ?</a></p>
                  </div>
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Fermer</button>
                </div>
              </div>


              <div class="tab-pane" id="inscription">
                <form method="POST" action="ajax/inscription.php" class="d-flex flex-column align-items-center my-3" id="forminscription" novalidate>
                  <!-- PSEUDO -->
                  <div class="form-group col-xs-11">
                    <input type="text" name="pseudo" id="pseudo" class="form-control" value="" placeholder="Pseudo" />
                    <span class="error error_pseudo"></span>
                  </div>
                  <!-- EMAIL -->
                  <div class="form-group col-xs-11">
                    <input type="email" name="email" id="email" class="form-control" value="" placeholder="Email" />
                    <span class="error error_email"></span>
                  </div>
                  <!-- PASSWORD1 -->
                  <div class="form-group col-xs-11">
                    <input type="password" name="password1" id="password1" class="form-control" value="" placeholder="Mot de passe" />
                    <span class="error error_password"></span>
                  </div>
                  <!-- PASSWORD2 -->
                  <div class="form-group col-xs-11">
                    <input type="password" name="password2" id="password2" class="form-control" value="" placeholder="Confirmer le mot de passe" />
                    <span class="error error_password2"></span>
                  </div>
                  <input type="submit" id="subinscription" class="btn btn-primary" name="submitinscription" value="Je m'inscris" />
                </form>

                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-right">
                  </div>
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Fermer</button>
                </div>
              </div>
              <div class="tab-pane" id="mdp">
                <form method="POST" action="ajax/forgot_password.php" class="d-flex flex-column align-items-center my-3" id="formmdp" novalidate>
                  <!-- EMAIL -->
                  <div class="form-group col-xs-11">
                    <input type="email" name="emailverif" id="emailverif" class="form-control" value="" placeholder="Email" />
                    <span class="error error_emailverif"></span>
                  </div>

                  <input type="submit" id="submdp" class="btn btn-primary" name="submdp" value="changez de mot de passe" />
                </form>

                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-right">
                    <p class="pt-1"></p>
                  </div>
                </div>

              </div>
              <div class="tab-pane" id="mdp">
                <form method="POST" action="recovery.php" class="d-flex flex-column align-items-center my-3" id="formrecovery" novalidate>
                  <!-- password -->


                  <input type="submit" id="subrecovery" class="btn btn-primary" name="subrecovery" value="changez de mot de passe" />
                </form>

                <!--Footer-->
                <div class="modal-footer">
                  <div class="options text-right">
                    <p class="pt-1"></p>
                  </div>
                  <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Fermer</button>
                </div>

              </div>
            </div>
          </div>


        </div>
    </nav>
  </header>