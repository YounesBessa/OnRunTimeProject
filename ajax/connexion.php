<?php
// connexion
session_start();
include('../inc/pdo.php');
include('../inc/function.php');
$errors = array();
$success= false;
// if form soumis
  // Faille XSS
  $login    = cleanXss($_POST['login']);
  $password = cleanXss($_POST['password']);
  if(!empty($login) && !empty($password)) {
    // request  users si il ya un user qui a soit email ou pseudo
    $sql = "SELECT * FROM ort_users WHERE pseudo = :login OR email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    // debug($user);
    // die();
    if(!empty($user)) { // $user existe pas => $error = 'erreur credentials'
      // password_verify()
      // die();
      if (password_verify($password, $user['password'])) {
        // die();
        // ok connexion possible
          // nourrir $_SESSION avec des données
        $success= true;
        $_SESSION['user'] = array(
          'id'     => $user['id'],
          'pseudo' => $user['pseudo'],
          'role'   => $user['role'],
          'ip'     => $_SERVER['REMOTE_ADDR'] // ::1
        );
 
      } else {
        $errors['password'] = 'mot de passe incorrect';
      }
    } else {
      $errors['login'] = 'une erreur est survenue dans l\'email ou le mot de passe' ;
    }
  } else {
    $errors['login'] = 'Veuillez renseigner les champs';
    $errors['password'] = 'Veuillez renseigner les champs';
  }

  $data = array(
    'errors' => $errors,
    'success' => $success
  );
  showJson($data);