function redirigerVersExportExcel() {
    window.location.href = 'export-excel.php';
}

function goToPagePostCoSuperAdmin(){
    window.location.href = "page_postco_superadmin.php";

}

function supprimerLigne(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function openModal() {
    $('#modifierModal').modal('show');
}

function closeModal() {
    $('#modifierModal').modal('hide');
}

var apprentiIdToModifier = null;

function setModifierApprentiId(id, prenom, nom) {
    apprentiIdToModifier = id;

    // Pré-remplir les champs du formulaire avec les données actuelles
    document.getElementById("nouveauNom").value = nom;
    document.getElementById("nouveauPrenom").value = prenom;
}


function modifierApprenti() {
    var nouveauNom = document.getElementById("nouveauNom").value;
    var nouveauPrenom = document.getElementById("nouveauPrenom").value;

    if (apprentiIdToModifier !== null) {
        $.ajax({
            type: "POST",
            url: "modifier_apprenti.php", 
            data: {
                id_apprenti: apprentiIdToModifier,
                nouveauNom: nouveauNom,
                nouveauPrenom: nouveauPrenom
            },
            success: function (response) {
                if (response === "success") {
                    alert("Apprenti mis à jour avec succès");
                    updateTableRow(apprentiIdToModifier, nouveauNom, nouveauPrenom);
                    closeModal();
                } else {
                    console.error("Échec de la mise à jour de l'apprenti");
                    alert("Échec de la mise à jour de l'apprenti");
                }
            },
            error: function (error) {
                console.error(error);
                alert("Une erreur s'est produite lors de la mise à jour de l'apprenti");
            }
        });
    }

    apprentiIdToModifier = null;
}

function updateTableRow(id, nouveauNom, nouveauPrenom) {
    var rows = document.getElementsByTagName("tr");

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var idCell = cells[2]; // Assuming your ID is in the third cell, adjust if needed

        if (idCell.innerText == id) {
            // Assuming the first and second cells contain the 'nom' and 'prenom' values
            cells[0].innerText = nouveauNom;
            cells[1].innerText = nouveauPrenom;
            break;
        }
    }
}


document.getElementById("modificationForm").addEventListener("submit", function (event) {
    event.preventDefault(); 

    var nouveauNom = document.getElementById("nouveauNom").value;
    var nouveauPrenom = document.getElementById("nouveauPrenom").value;

    var cells = document.querySelector("tbody tr").getElementsByTagName("td");
    cells[0].innerText = nouveauNom;
    cells[1].innerText = nouveauPrenom;

    closeModal();
});
