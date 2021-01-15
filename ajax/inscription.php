<?php
session_start();
// inscription.php
include('../inc/pdo.php');
include('../inc/function.php');
// TABLE users
$errors = array();
$success= false;
  // Faille xss
  $pseudo    = cleanXss($_POST['pseudo']);
  $email     = cleanXss($_POST['email']);
  $password1 = cleanXss($_POST['password1']);
  $password2 = cleanXss($_POST['password2']);
  // validation pseudo (3, 50, unique)
  if(!empty($pseudo)) {
    if(mb_strlen($pseudo) < 3) {
      $errors['pseudo'] = 'Min 3 caratères';
    } elseif(mb_strlen($pseudo) > 50) {
      $errors['pseudo'] = 'Max 50 caratères';
    } else {
      $sql = "SELECT id FROM ort_users WHERE pseudo = :pseudo";
      $query = $pdo->prepare($sql);
      $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
      $query->execute();
      $verifPseudo = $query->fetch();
      if(!empty($verifPseudo)) {
        $errors['pseudo'] = 'Ce pseudo existe déjà';
      }
    }
  } else {
    $errors['pseudo'] = 'Veuillez renseigner ce champ';
  }
  // validation email (email valide, unique)
  if(!empty($email)) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] =  'Veuillez renseigner un email valide';
    } else {
      $sql = "SELECT id FROM ort_users WHERE email = :email";
      $query = $pdo->prepare($sql);
      $query->bindValue(':email',$email,PDO::PARAM_STR);
      $query->execute();
      $verifEmail = $query->fetch();
      if(!empty($verifEmail)) {
        $errors['email'] = 'Cet email existe déjà';
      }
    }
  } else {
    $errors['email'] = 'Veuillez renseigner un email';
  }
  // password (min 6 , identiques)
  if(!empty($password1) && !empty($password2)) {
    if($password1 != $password2) {
      $errors['password2'] = 'Veuillez renseigner des mot de passe identiques';
    } elseif(mb_strlen($password1) < 6) {
      $errors['password'] = 'Min 6 caractères';
    }
  } else {
    $errors['password'] = 'Veuillez renseigner vos mots de passe';
  }

  // if no error
  if(count($errors) == 0) {
    // hash password
    $hashPassword = password_hash($password1,PASSWORD_DEFAULT);
    $role = 'abonne';
    $token = generateRandomString(120);
    $sql = "INSERT INTO ort_users (pseudo,email,password,token,created_at,role)
                          VALUES (:pseudo, :email,:password,'$token',NOW(),'$role')";
    $query = $pdo->prepare($sql);
    //$query->bindValue(':title',$title,PDO::PARAM_STR);
    $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
    $query->bindValue(':password',$hashPassword,PDO::PARAM_STR);
    $query->execute();

  
    $sql = "SELECT * FROM ort_users WHERE pseudo = :login OR email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$email,PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();
    // debug($user);
    // die();
    if(!empty($user)) { // $user existe pas => $error = 'erreur credentials'
      // password_verify()
      // die();
      if (password_verify($password1, $user['password'])) {
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
        $errors['password'] = 'Error credentials';
      }
    } else {
      $errors['login'] = 'une erreur est survenue dans l\'email ou le mot de passe' ;
    }
  

  }

  $data = array(
    'errors' => $errors,
    'success' => $success
  );
  showJson($data);