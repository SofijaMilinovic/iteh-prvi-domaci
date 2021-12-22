<?php

require_once "src/db/psihoterapeutDAO.php";

session_start();

unset($_SESSION['psihoterapeut']);

$greska = null;

if (isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    $psihoterapeut = new Psihoterapeut(null, $username, $ime, $prezime);
    $psihoterapeut->password = $password;
    $psihoterapeutDAO = new PsihoterapeutDAO();
    $rezultat = $psihoterapeutDAO->ubaciNovogPsihoterapeuta($psihoterapeut);
    
    if ($rezultat == 1) {
        $_SESSION['registracija'] = true;
        header('Location: index.php');
        exit();
    } else if ($rezultat == -1) {
        $greska = "Neuspesno ste se registrovali, uneti username je zauzet!";
    } else {
        $greska = "Neuspesno ste se registrovali, greska u sistemu!";
    }
}

$_POST = array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Index</title>

</head>

<body>

    <div class="outer">
        <div class="middle">
            <div class="inner">

                <?php if ($greska) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $greska ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <form id="form" method="POST" action="#">
                    <label for="ime">Ime</label>
                    <input id="inputIme" type="text" name="ime" class="form-control">
                    <div id="greskaImeAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div id="greskaImeText">
                            <!-- js generated -->
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <label for="prezime">Prezime</label>
                    <input id="inputPrezime" type="text" name="prezime" class="form-control">
                    <div id="greskaPrezimeAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div id="greskaPrezimeText">
                            <!-- js generated -->
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <label for="username">Korisnicko ime</label>
                    <input id="inputUsername" type="text" name="username" class="form-control">
                    <div id="greskaUsernameAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div id="greskaUsernameText">
                            <!-- js generated -->
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <label for="password">Lozinka</label>
                    <input id="inputPassword" type="password" name="password" class="form-control">
                    <div id="greskaPasswordAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div id="greskaPasswordText">
                            <!-- js generated -->
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <button id="btnRegister" class="btn btn-primary">Registruj se</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/registracija.js"></script>

</body>

</html>