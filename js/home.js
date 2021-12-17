// *** ELEMENTI START ***

var $psihoterapeut = $("#psihoterapeut");
var $seanseTableBody = $("#seanseTableBody");

// *** ELEMENTI END ***

// *** FUNKCIJE START ***

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
            populisiSeanse(seanseJSON);
        }
    });
}

function populisiSeanse(seanseJSON) {
    var seanseTableBody = "";
    for (const seansa of seanseJSON) {
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
    $(".izmeniSeansu").on("click", event => {
        // const seansaId = $(event.target).attr("seansaId");
        // $.ajax({
        //     type: "POST",
        //     url: "seansa.php",
        //     data: {
        //         seansaId: seansaId
        //     }
        // });
    });

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

ucitajSeanse();

// *** EXECUTE END ***