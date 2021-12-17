// *** ELEMENTI START ***

var $psihoterapeut = $("#psihoterapeut");
var $seanseTableBody = $("#seanseTableBody");
var $inputPretraziKlijent = $("#inputPretraziKlijent");
var $btnSortirajPoVremenu = $("#btnSortirajPoVremenu");
var sveSeanse = [];

// *** ELEMENTI END ***

// *** FUNKCIJE START ***

function filtrirajPoKlijentu() {
    var klijent = this.value;
    filtriraneSeanse = sveSeanse.filter(seansa => {
        const klijentImePrezime = `${seansa.klijent.ime} ${seansa.klijent.prezime}`;
        return klijentImePrezime.includes(klijent);
    });
    populisiSeanse(filtriraneSeanse);
}

function sortirajPoVremenu() {
    let seanse = sveSeanse.slice();
    let poredak = $btnSortirajPoVremenu.attr("poredak");
    for (let i = 0; i < seanse.length - 1; i++) {
        for (let j = i + 1; j < seanse.length; j++) {
            let prethodnikSati = seanse[i].vreme.substring(0, 2);
            let prethodnikMinuti = seanse[i].vreme.substring(3);
            let sledbenikSati = seanse[j].vreme.substring(0, 2);
            let sledbenikMinuti = seanse[j].vreme.substring(3);

            if (poredak == "rastuci") {
                if ((prethodnikSati == sledbenikSati && prethodnikMinuti > sledbenikMinuti) || prethodnikSati > sledbenikSati) {
                    let pom = seanse[i];
                    seanse[i] = seanse[j];
                    seanse[j] = pom;
                }
            } else {
                if ((prethodnikSati == sledbenikSati && sledbenikMinuti > prethodnikMinuti) || sledbenikSati > prethodnikSati) {
                    let pom = seanse[i];
                    seanse[i] = seanse[j];
                    seanse[j] = pom;
                }
            }
        }
    }
    
    populisiSeanse(seanse);
    let noviPoredak = poredak == "rastuci" ? "opadajuci" : "rastuci";
    $btnSortirajPoVremenu.attr("poredak", noviPoredak);
    let noviTekst = noviPoredak == "rastuci" ? "rastuce" : "opadajuce";
    $btnSortirajPoVremenu.html(`Sortiraj po vremenu ${noviTekst}`);
}

function ucitajSeanse() {
    const psihoterapeutId = $psihoterapeut.attr("psihoterapeutId");
    $.ajax({
        type: "GET",
        url: "api/seanse.php",
        data: {
            psihoterapeutId: psihoterapeutId
        },
        success: seanseJSONString => {
            const seanseJSON = JSON.parse(seanseJSONString);
            sveSeanse = seanseJSON.slice();
            populisiSeanse(sveSeanse);
        }
    });
}

function populisiSeanse(seanse) {
    var seanseTableBody = "";
    for (const seansa of seanse) {
        seanseTableBody += vratiSeansuHtml(seansa);
    }
    $seanseTableBody.html(seanseTableBody);
    postaviOsluskivaceNaSeanse();
}

function vratiSeansuHtml(seansa) {
    return `
        <tr>
            <th scope="row">${seansa.klijent.ime} ${seansa.klijent.prezime}</th>
            <td>${seansa.datum}</td>
            <td>${seansa.vreme} h</td>
            <td>${seansa.trajanjeMin} min</td>
            <td>
                <form method="POST" action="seansa.php">
                    <input type="text" name="izmena" value="true" hidden>
                    <input type="number" name="seansaId" value="${seansa.seansaId}" hidden>
                    <input type="text" name="klijentJmbg" value="${seansa.klijent.jmbg}" hidden>
                    <input type="text" name="vreme" value="${seansa.vreme}" hidden>
                    <input type="text" name="trajanjeMin" value="${seansa.trajanjeMin}" hidden>
                    <input type="text" name="beleske" value="${seansa.beleske}" hidden>
                    <button type="submit" class="btn btn-secondary izmeniSeansu">
                        Izmeni
                    </button>
                    <button seansaId=${seansa.seansaId} class="btn btn-dark obrisiSeansu">
                        Obrisi
                    </button>
                </form>
            </td>
        </tr>
    `;
}

function postaviOsluskivaceNaSeanse() {
    $(".obrisiSeansu").on("click", event => {
        event.preventDefault();
        const seansaId = $(event.target).attr("seansaId");
        $.ajax({
            type: "POST",
            url: "api/seanse.php",
            data: {
                seansaId: seansaId,
                method: "DELETE"
            },
            success: response => {
                console.log(response);
                ucitajSeanse();
            }
        });
    });
}

// *** FUNKCIJE END ***

// *** EXECUTE START ***

$inputPretraziKlijent.on("input", filtrirajPoKlijentu);
$btnSortirajPoVremenu.on("click", sortirajPoVremenu);
ucitajSeanse();

// *** EXECUTE END ***