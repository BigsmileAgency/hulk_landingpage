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
        "nl": "terug",
      },      
    }
  </script>
<?php
}

add_action('wp_head', 'copy_js');
