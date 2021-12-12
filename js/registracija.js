// *** ELEMENTI START ***

var $form = $("#form");

var $inputIme = $("#inputIme");
var $greskaImeAlert = $("#greskaImeAlert");
var $greskaImeText = $("#greskaImeText");

var $inputPrezime = $("#inputPrezime");
var $greskaPrezimeAlert = $("#greskaPrezimeAlert");
var $greskaPrezimeText = $("#greskaPrezimeText");

var $inputUsername = $("#inputUsername");
var $greskaUsernameAlert = $("#greskaUsernameAlert");
var $greskaUsernameText = $("#greskaUsernameText");

var $inputPassword = $("#inputPassword");
var $greskaPasswordAlert = $("#greskaPasswordAlert");
var $greskaPasswordText = $("#greskaPasswordText");

var $btnRegister = $("#btnRegister");

// *** ELEMENTI END ***

// *** FUNKCIJE START ***

function hasCharacter(str) {
    return /^[a-z0-9]+$/i.test(str);
}

function hasLowerCase(str) {
    return hasCharacter(str) && str.toUpperCase() != str;
}

function hasUpperCase(str) {
    return hasCharacter(str) && str.toLowerCase() != str;
}

function hasNumber(str) {
    return /\d/.test(str);
}

function isEmail(str) {
    return /^\S+@\S+\.\S+$/.test(str);
}

function hasOnlyCharacters(str) {
    return /^[A-Za-z]+$/.test(str);
}

function vratiGreskuZaUsername() {
    var username = $inputUsername.val();
    if (!username.length > 0 || !isEmail(username)) {
        return "<p>Korisnicko ime mora biti email</p>";
    }
    return null;
}

function vratiGreskuZaPassword() {
    var greska = "";
    var password = $inputPassword.val();

    if (password.length < 6) {
        greska += "<p>Lozinka mora imati bar 6 karaktera.</p>";
    }

    if (!hasNumber(password)) {
        greska += "<p>Lozinka mora imati bar 1 broj.</p>";
    }

    if (!hasLowerCase(password)) {
        greska += "<p>Lozinka mora imati bar 1 malo slovo.</p>";
    }

    if (!hasUpperCase(password)) {
        greska += "<p>Lozinka mora imati bar 1 veliko slovo.</p>";
    }

    return greska;
}

function vratiGreskuZaIme() {
    var ime = $inputIme.val();
    if (ime && ime.length != 0 && hasOnlyCharacters(ime)) {
        return null;
    }
    return "<p>Ime mora sadrzati samo slova</p>";
}

function vratiGreskuZaPrezime() {
    var prezime = $inputPrezime.val();
    if (prezime && prezime.length != 0 && hasOnlyCharacters(prezime)) {
        return null;
    }
    return "<p>Prezime mora sadrzati samo slova</p>";
}

function validateForm() {
    var sveOk = true;
    var greskaIme = vratiGreskuZaIme();
    var greskaPrezime = vratiGreskuZaPrezime();
    var greskaUsername = vratiGreskuZaUsername();
    var greskaPassword = vratiGreskuZaPassword();

    if (greskaIme) {
        $greskaImeText.html(greskaIme);
        $greskaImeAlert.show();
        sveOk = false;
    } else {
        $greskaImeText.html("");
        $greskaImeAlert.hide();
    }

    if (greskaPrezime) {
        $greskaPrezimeText.html(greskaPrezime);
        $greskaPrezimeAlert.show();
        sveOk = false;
    } else {
        $greskaPrezimeText.html("");
        $greskaPrezimeAlert.hide();
    }

    if (greskaUsername) {
        $greskaUsernameText.html(greskaUsername);
        $greskaUsernameAlert.show();
        sveOk = false;
    } else {
        $greskaUsernameText.html("");
        $greskaUsernameAlert.hide();
    }

    if (greskaPassword) {
        $greskaPasswordText.html(greskaPassword);
        $greskaPasswordAlert.show();
        sveOk = false;
    } else {
        $greskaPasswordText.html("");
        $greskaPasswordAlert.hide();
    }

    return sveOk;
}

// *** FUNKCIJE END ***

// *** EXECUTE START ***

$greskaImeAlert.hide();
$greskaPrezimeAlert.hide();
$greskaUsernameAlert.hide();
$greskaPasswordAlert.hide();

$btnRegister.on("click", (event) => {
    event.preventDefault();
    if (validateForm()) {
        $form.submit();
    }
})

// *** EXECUTE END ***
