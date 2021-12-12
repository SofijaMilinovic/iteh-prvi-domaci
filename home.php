<?php

include_once "src/model/psihoterapeut.php";

session_start();

$prijava = false;
$seansaUbacena = false;
$psihoterapeut = $_SESSION['psihoterapeut'];

if (!isset($psihoterapeut)) {
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['prijava'])) {
    $prijava = true;
    unset($_SESSION['prijava']);
}

if (isset($_SESSION['seansaUbacena'])) {
    $seansaUbacena = true;
    unset($_SESSION['seansaUbacena']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>

</head>

<body>

    <div class="navigacija">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="navigacija-text">
                        <?= $psihoterapeut->ime ?> <?= $psihoterapeut->prezime ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <?php if ($prijava) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            "Uspesno ste se prijavili!"
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($seansaUbacena) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            "Seansa je uspesno ubacena!"
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container tabela">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <a class="btn btn-primary" href="./seansa.php">Ubaci novu seansu</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/home.js"></script>

</body>

</html>