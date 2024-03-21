<?php
function demo_form_handler()
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
			}
		}


		document.addEventListener("DOMContentLoaded", function() {

			let demoSubmit = document.querySelector("#demo_form");
			let demoFormContainer = document.querySelector('.demo_form_container');
			let gif = document.querySelector('.demo_gif');
			let calendarContainer = document.querySelector('.calendar_container');
			let bookBtn = document.querySelector("#book_btn");
			let back = document.querySelector('#back_arrow')
			let firstName, lastName, email, phone, companyName, isAgency, isConsent;

			demoSubmit.addEventListener("submit", handleInfos)
			bookBtn.addEventListener('click', (e) => {
				handleTimeDay(e, firstName, lastName, email, phone, companyName, isAgency, isConsent)
			});
			back.addEventListener('click', handleBackButton)


			function handleInfos(e) {

				e.preventDefault();

				firstName = document.querySelector("#demo_first_name");
				lastName = document.querySelector("#demo_last_name");
				email = document.querySelector("#demo_email");
				phone = document.querySelector("#demo_phone");
				companyName = document.querySelector("#demo_company_name");
				isAgency = document.querySelector('input[type=radio][name=is_agency]:checked');
				isConsent = document.querySelector("#demo_consent").checked;
				let grey = companyName.style.borderColor

				// regexs 
				let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

				let fieldsArray = [firstName, lastName, email, phone]

				let success = 0;

				// fieldsArray.map((e) => {
				// 	if (e.value == "") {
				// 		handleAlert(e, copy.emptyFields, lang)
				// 		success++
				// 	} else if (e == email && !email.value.match(mailRegex)) {
				// 		handleAlert(e, copy.badMail, lang);
				// 		success++
				// 	} else if (e == phone && !phone.value.match(phoneRegex)) {
				// 		handleAlert(e, copy.badPhone, lang);
				// 		success++
				// 	} else {
				// 		rollBackAlert(e, grey)
				// 	}
				// })

				if (success == 0) {
					demoFormContainer.style.display = "none";
					gif.style.display = "flex";
					setTimeout(() => {
						gif.style.display = "none"
						if (window.innerWidth > 763) {
							calendarContainer.style.display = "grid"
						} else {
							calendarContainer.style.display = "flex"
						}
					}, 750);
				}
			}

			function handleTimeDay(e) {
				e.preventDefault();
				let time = document.querySelector('.time_selected');
				let day = document.querySelector('.date_selected');
				if (day == null || day == undefined) {
					alert(copy.noDate[lang]);
				} else if (time == null || time == undefined) {
					alert(copy.noTime[lang]);
				} else {

					bookBtn.disabled = true;

					let dataSet = 'first_name=' + firstName.value +
						'&last_name=' + lastName.value +
						'&full_date=' + date.toDateString() +
						'&phone=' + phone.value +
						'&email=' + email.value +
						'&company=' + companyName.value +
						'&is_agency=' + isAgency.value +
						'&is_consent=' + isConsent +
						'&time=' + time.innerHTML +
						'&lang=' + lang;

					// INSERT DB
					let xhrInsert = new XMLHttpRequest();
					let urlInsert = '<?= admin_url('admin-ajax.php') ?>';
					let dataSetInsert = 'action=insert_demo_request&' + dataSet

					xhrInsert.open("POST", urlInsert, true);
					xhrInsert.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhrInsert.onreadystatechange = function() {
						if (xhrInsert.readyState == 4 && xhrInsert.status == 200) {
							let result = xhrInsert.responseText;
							result = JSON.parse(result);
							if (result.error) {
								console.log(result);
								bookBtn.disabled = false;
							}
						}
					};
					xhrInsert.send(dataSetInsert);

					// SEND MAIL
					let xhrSend = new XMLHttpRequest();
					let urlSend = '<?= admin_url('admin-ajax.php') ?>';
					let dataSetSend = 'action=send_demo_request&' + dataSet;

					xhrSend.open("POST", urlSend, true);
					xhrSend.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhrSend.onreadystatechange = function() {
						if (xhrSend.readyState == 4 && xhrSend.status == 200) {
							let result = xhrSend.responseText;
							result = JSON.parse(result);
							if (!result.error) {
								if (!alert(copy.successSend[lang])) {
									firstName.value = "";
									lastName.value = "";
									email.value = "";
									phone.value = "";
									companyName.value = "";
									isAgency.value = "";
									isConsent = false;
									window.location.reload();
								}
							} else {
								console.log(result);
								alert(copy.problem[lang])
								bookBtn.disabled = false;
							}
						}
					};
					xhrSend.send(dataSetSend);
				}
			}

			function handleBackButton(e) {
				demoFormContainer.style.display = "block";
				calendarContainer.style.display = "none"
				firstName = "";
				lastName = "";
				email = "";
				phone = "";
				companyName = "";
				isAgency = "";
				isConsent = false;
			}

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
		})
	</script>
<?php
}
add_action('wp_head', 'demo_form_handler');
