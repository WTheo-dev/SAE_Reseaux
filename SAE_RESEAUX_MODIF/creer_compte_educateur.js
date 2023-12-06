const createAccountButton = document.getElementById("create-account-button");
const popup = document.getElementById("popup");
        

        createAccountButton.addEventListener("click", function(event) {
            const emailInput = document.getElementById("email");
            if (!isValidEmail(emailInput.value)) {
                event.preventDefault(); // Empêche la soumission du formulaire
                alert("Adresse e-mail non valide. Veuillez entrer une adresse e-mail valide.");
            } else {
                popup.style.display = "block";
                event.preventDefault();
            }
        });

        closePopupButton.addEventListener("click", function() {
            popup.style.display = "none";
        });

        function isValidEmail(email) {
            // Utilisez une expression régulière pour valider l'adresse e-mail
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailPattern.test(email);
        }