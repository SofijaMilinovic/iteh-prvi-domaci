// *** ELEMENTI START ***

var $klijenti = $("#selectKlijenti");
var $izabraniKlijent = $("#izabraniKlijent");

// *** ELEMENTI END ***

// *** FUNKCIJE START ***

function populisiKlijente(klijentiJSON) {

    var izabraniKlijentJmbg = $izabraniKlijent.attr("klijentJmbg");
    var selected = "";
    var selectHtml = "";
    for (const klijent of klijentiJSON) {
        var datumRodjenja = klijent.datumRodjenja.replaceAll("-", ".");
        if (klijent.jmbg == izabraniKlijentJmbg) {
            selected = "selected";
        }
        selectHtml += `<option ${selected}>${klijent.jmbg} - ${klijent.ime} ${klijent.prezime} - ${datumRodjenja}</option>`
        selected = ""
    }
    $klijenti.html(selectHtml);

}

// *** FUNKCIJE END ***

// *** EXECUTE START ***

$.ajax({
    type: "GET",
    url: "api/klijenti.php",
    success: klijentiJSONString => {
        const klijentiJSON = JSON.parse(klijentiJSONString);
        populisiKlijente(klijentiJSON);
    }
});

// *** EXECUTE END ***
