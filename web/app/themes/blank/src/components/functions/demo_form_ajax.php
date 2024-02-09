<?php

function demo_form_ajax()
{
?>
	<script>
		let lang = document.documentElement.lang;

		if (lang == "fr-FR") {
			lang = "fr";
		}

		let copy = {
			emptyFields: {
				"en": "Fields marked with * are mandatory",
				"fr": "Les champs marqué d'un * sont obligatoire",
			},

			badMail: {
				"en": "Put a proper e-mail adress",
				"fr": "Adresse e-mail non conforme",

			},

			badPhone: {
				"en": "Put a proper phone number",
				"fr": "Numéro de téléphone non-valide",
			}
		}

		document.addEventListener("DOMContentLoaded", function() {

			let demoForm = document.querySelector("#demo_form")

			demoForm.addEventListener("submit", (e) => {

				e.preventDefault();

				// containers
				let formAndCalendar = document.querySelector('.form_and_calendar');
				let demoFormContainer = document.querySelector('.demo_form_container');
				let calendar = document.querySelector('.calendar_container');
				let gif = document.querySelector('.demo_gif');


				// form input
				let firstName = document.querySelector("#demo_first_name").value;
				let lastName = document.querySelector("#demo_last_name").value;
				let email = document.querySelector("#demo_email").value;
				let phone = document.querySelector("#demo_phone").value;
				let companyName = document.querySelector("#demo_company_name").value;
				let isAgency = document.querySelector("#are_you_agency").checked;
				let isConsent = document.querySelector("#demo_consent").checked;
				let sentBtn = document.querySelector("#demo_send_btn");
				let calendarContainer = document.querySelector('.calendar_container');


				let daysArray = Array.from(document.querySelectorAll('.days div'))

				// response
				let response = document.querySelector('#demo_response');

				// regexs 
				let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

				if (firstName === "" || lastName === "" || email === "" || phone === "") {
					// alert(copy.emptyFields[lang]);
					response.textContent = copy.emptyFields[lang];

				} else if (!email.match(mailRegex)) {
					response.textContent = copy.badMail[lang];
				} else if (!phone.match(phoneRegex)) {
					response.textContent = copy.badPhone[lang];
				} else {
					demoFormContainer.style.display = "none";

					gif.style.display = "block";

					setTimeout(() => {
						gif.style.display = "none"
						calendarContainer.style.display = "block"
					}, 1000)

				}
			})
		})
	</script>
<?php
}
add_action('wp_head', 'demo_form_ajax');
