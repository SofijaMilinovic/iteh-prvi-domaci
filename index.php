<?php

require_once "src/db/psihoterapeutDAO.php";

session_start();

$registracija = false;
$greska = null;

unset($_SESSION['psihoterapeut']);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $psihoterapeutDAO = new PsihoterapeutDAO();
    $psihoterapeut = $psihoterapeutDAO->pronadjiPsihoterapeutaSaUsernamePassword($username, $password);

    if ($psihoterapeut != null) {
        $_SESSION['psihoterapeut'] = $psihoterapeut;
        $_SESSION['prijava'] = true;
        header('Location: home.php');
        exit();
    } else {
        $greska = "Neuspesna prijava!";
    }
}

if (isset($_SESSION['registracija'])) {
    $registracija = true;
    unset($_SESSION['registracija']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Login</title>
</head>

<body>

    <div class="outer">
        <div class="middle">
            <div class="inner">

                <?php if ($registracija) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        "Uspesno ste se registrovali!"
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($greska) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $greska ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="#">
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control" required>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                    <a class="btn btn-primary" name="register" href="./registracija.php">Registruj se</a>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>