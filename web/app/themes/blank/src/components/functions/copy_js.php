<?php

function copy_js()
{
?>
  <script>
    let lang = document.documentElement.lang;

    if (lang == "fr-FR") {
      lang = "fr";
    } else if (lang == "en-US") {
      lang = "en"
    } else if (lang == "nl-NL") {
      lang = "nl"
    }

    let language = {
      "en": "English",
      "fr": "Français",
      "nl": "Nederlands"
    }

    let grey = "#333";

    // regexs 
    let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

    //  HANDLERS FUNCTIONS
    function handleAlert(field, message, lang) {
      field.style.borderColor = "red";
      let response = field.nextElementSibling;
      response.innerHTML = `<img class="response_img" src="<?php echo get_template_directory_uri() ?>/images/material_error.svg" /><p class="response_text">${message[lang]}</p>`
    }

    function rollBackAlert(field, grey) {
      field.style.borderColor = grey;
      let response = field.nextElementSibling;
      response.innerHTML = ""
    }

    let copy = {
      emptyFields: {
        "en": "You must fill in this field",
        "fr": "Vous devez renseigner ce champs",
        "nl": "U moet dit veld invullen",
      },

      badMail: {
        "en": "Not a valid e-mail adress",
        "fr": "Adresse e-mail non valide",
        "nl": "Geen geldig e-mail adres",
      },

      badPhone: {
        "en": "Not a valid phone number",
        "fr": "Numéro de téléphone non valide",
        "nl": "Geen geldig telefoonnummer",
      },

      badPassword: {
        "en": "Passwords doesn't match",
        "fr": "Les mots de passe ne correspondent pas",
        "nl": "Passwords nee",
      },

      noTime: {
        "en": "Select a time slot please",
        "fr": "Selectionner une plage horaire SVP",
        "nl": "Selecteer een tijdslot",
      },

      noDate: {
        "en": "Select a date please",
        "fr": "Selectionner une date SVP",
        "nl": "Selecteer een datum",
      },

      noAvailable: {
        "en": "no availability for this date",
        "fr": "pas de disponibilitées pour cette date",
        "nl": "geen beschikbaarheid voor deze datum",
      },

      successSend: {
        "en": "We have received your request. You will receive a confirmation e-mail in the next few minutes.",
        "fr": "Nous avons bien reçu votre demande, vous allez recevoir un mail de confirmation dans les prochaines minutes",
        "nl": "We hebben je aanvraag ontvangen en sturen je binnen enkele minuten een bevestigingsmail.",
      },

      problem: {
        "en": "Problem, try again",
        "fr": "Un problème est survenu réessayez",
        "nl": "Probleem, probeer het opnieuw",
      },

      updateSuccess: {
        "en": "Meeting successfully updated",
        "fr": "Rendez-vous mis à jour avec succés",
        "nl": "Afspraken succesvol bijgewerkt",
      },

      cancelSuccess: {
        "en": "Meeting successfully canceled",
        "fr": "Rendez-vous annulé avec succés",
        "nl": "Afspraak succesvol geannuleerd",
      },

      back: {
        "en": "Back",
        "fr": "Retour",
        "nl": "Terug",
      },

      "customerIsConfirmed": {
        "en": "Your subscription has been updated",
        "fr": "Votre abonnement a été mise à jour",
        "nl": "Uw abonnement is bijgewerkt",
      },

      "customerAlreadyConfirmed": {
        "en": "You already subscribe",
        "fr": "Vous déjà inscit",
        "nl": "Uw abonnement is bijgewerkt",
      },
    }
  </script>
<?php
}

add_action('wp_head', 'copy_js');
