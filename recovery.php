<?php
session_start();
require('inc/pdo.php');
require('inc/function.php');


$errors = [];

if (!empty($_GET['email']) && !empty($_GET['token']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    $mail = CleanXss($_GET['email']);
    $token = CleanXss($_GET['token']);

    $user = select($pdo, 'ort_users', '*', 'email', $mail);
    if (!empty($user) && $user['token'] == $token) {
        if (!empty($_POST['subrecovery'])) {
            $password = CleanXss($_POST['password']);
            $passwordConfirm = CleanXss($_POST['password-confirm']);

            $errors = checkField($errors, $password, 'password', 6, 200);
            $errors = checkField($errors, $passwordConfirm, 'password-confirm', 6, 200);

            if ($password != $passwordConfirm) {
                $errors['password-confirm'] == 'Les mots de passes ne sont pas identiques';
            }
            if (count($errors) == 0) {
                $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                $token = generateRandomString(200);

                update($pdo, 'ort_users', [
                    'password = "' . $passwordHashed . '"',
                    'token = "' . $token . '"'
                ], 'id', $user['id']);
                $user = select($pdo, 'ort_users', '*', 'id', $user['id']);
                header('Location: ../index.php');
                die();
            }
        }
    } else {
        // header('Location: ./error.php');
        die();
    }
} else {
    // header('Location: ./error.php');
    die();
}

$title = 'Changement de mot de passe - OnRunTime';
include('inc/header.php');
?>

<form method="POST" action="" class="d-flex flex-column align-items-center my-3" id="formrecovery" novalidate>

    <!-- password -->
    <div class="form-group col-xs-5">
        <input type="password" name="password" id="password" class="form-control" value="<?= (!empty($_POST['password'])) ? $_POST['password'] : '' ?>" placeholder="Mot De Passe" />
        <span class="error error_password"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
    </div>
    <!-- password-confirm -->
    <div class="form-group col-xs-5">
        <input type="password" name="password-confirm" id="password-confirm" class="form-control" value="<?= (!empty($_POST['password-confirm'])) ? $_POST['password-confirm'] : '' ?>" placeholder="Confirmer Le Mot De Passe" />
        <span class="error error_password-confirm"><?php if(!empty($errors['password-confirm'])) { echo $errors['password-confirm']; } ?></span>
    </div>
    <input type="submit" id="subrecovery" class="btn btn-primary" name="subrecovery" value="changez votre mot de passe" />
</form>


<?php include('inc/footer.php');