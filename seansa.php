<?php

require_once "src/db/seansaDAO.php";
require_once "src/db/klijentDAO.php";
require_once "src/model/seansa.php";
include_once "src/model/psihoterapeut.php";

session_start();

$psihoterapeut = null;

if (isset($_SESSION['psihoterapeut'])) {
    $psihoterapeut = $_SESSION['psihoterapeut'];
} else {
    header('Location: index.php');
    exit();
};

$greska = null;
$mod = "ubaci";

$seansaId = "";
$klijentJmbg = "";
$vreme = "";
$trajanjeMin = "";
$beleske = "";

if (isset($_POST['izmena'])) {
    $mod = "izmeni";
    $seansaId = $_POST['seansaId'];
    $klijentJmbg = $_POST['klijentJmbg'];
    $vreme = $_POST['vreme'];
    $trajanjeMin = $_POST['trajanjeMin'];
    $beleske = $_POST['beleske'];
    unset($_POST['izmena']);
}

if (isset($_POST['klijent']) && isset($_POST['vreme']) && isset($_POST['trajanjeMin']) && isset($_POST['beleske'])) {

    $klijentDAO = new KlijentDAO();

    $klijentJmbg = substr($_POST['klijent'], 0, 13);
    $datum = date('y-m-d', time());
    $vreme = $_POST['vreme'];
    $trajanjeMin = $_POST['trajanjeMin'];
    $beleske = $_POST['beleske'];
    $klijent = $klijentDAO->pronadjiKlijenta($klijentJmbg);
    $psihoterapeut = $_SESSION['psihoterapeut'];

    $seansaId = $_POST['seansaId'];
    $seansa = new Seansa($seansaId, $datum, $vreme, $trajanjeMin, $beleske, $klijent, $psihoterapeut);
    $seansaDAO = new SeansaDAO();

    if ($seansaId) {
        $rezultat = $seansaDAO->izmeniSeansu($seansa);
        $_SESSION['rezultat'] = $rezultat;
    } else {
        $rezultat = $seansaDAO->ubaciNovuSeansu($seansa);
        $_SESSION['rezultat'] = $rezultat;
    }
}

if (isset($_SESSION['rezultat'])) {
    $rezultat = $_SESSION['rezultat'];
    if ($rezultat == 1) {
        if ($seansaId) {
            $_SESSION['seansaIzmenjena'] = true;
        } else {
            $_SESSION['seansaUbacena'] = true;
        }
        header('Location: home.php');
        unset($_SESSION['rezultat']);
        exit();
    } else {
        $greska = "Neuspesna operacija, greska u sistemu!";
    }
    unset($_SESSION['rezultat']);
}

$_POST = array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/seansa.css">
    <title>Index</title>
</head>

<body>

    <div class="navigacija">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div id="psihoterapeut" class="navigacija-text" psihoterapeutId="<?= $psihoterapeut->psihoterapeutId ?>">
                        <?= $psihoterapeut->ime ?> <?= $psihoterapeut->prezime ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <label for="seansaId" hidden>Seansa id</label>
                    <input type="number" name="seansaId" class="form-control" hidden value="<?= $seansaId ?>">

                    <label for="klijent">Klijent</label>
                    <div id="izabraniKlijent" klijentJmbg="<?= $klijentJmbg ?>" hidden></div>
                    <select id="selectKlijenti" class="form-select" name="klijent" style="margin-left: 30px; margin-bottom: 30px;">
                        <!-- js generated -->
                    </select>
                    <br>

                    <label for="vreme">Vreme (h)</label>
                    <input type="text" name="vreme" class="form-control" required value="<?= $vreme ?>">

                    <label for="trajanjeMin">Trajanje (min)</label>
                    <input type="number" name="trajanjeMin" class="form-control" min=0 required value="<?= $trajanjeMin ?>">

                    <label for="beleske">Beleske</label>
                    <textarea type="text" name="beleske" class="form-control" rows=5 required><?= $beleske ?></textarea>

                    <?php if ($mod == "ubaci") : ?>
                        <button id="btnUbaciSeansu" class="btn btn-primary">Ubaci seansu</button>
                    <?php endif; ?>
                    <?php if ($mod == "izmeni") : ?>
                        <button id="btnIzmeniSeansu" class="btn btn-primary">Izmeni seansu</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/seansa.js"></script>

</body>

</html>