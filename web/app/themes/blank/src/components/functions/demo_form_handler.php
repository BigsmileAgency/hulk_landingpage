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
				"en": "Fields marked with * are mandatory",
				"fr": "Les champs marqué d'un * sont obligatoire",
				"nl": "Velden gemarkeerd met * zijn verplicht",
			},

			badMail: {
				"en": "Put a proper e-mail adress",
				"fr": "Adresse e-mail non conforme",
				"nl": "E-mailadres niet conform",
			},

			badPhone: {
				"en": "Put a proper phone number",
				"fr": "Numéro de téléphone non-valide",
				"nl": "Plaats een goed telefoonnummer",
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
				"en": "We have received your request, bye",
				"fr": "Nous avons bien reçus votre demand, bye",
				"nl": "We hebben uw verzoek ontvangen, tot ziens",
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
			let response = document.querySelector('.demo_response');
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
				firstName = document.querySelector("#demo_first_name").value;
				lastName = document.querySelector("#demo_last_name").value;
				email = document.querySelector("#demo_email").value;
				phone = document.querySelector("#demo_phone").value;
				companyName = document.querySelector("#demo_company_name").value;
				isAgency = document.querySelector("#are_you_agency").checked;
				isConsent = document.querySelector("#demo_consent").checked;

				// regexs 
				let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

				response.classList.add('error')

				// if (firstName === "" || lastName === "" || email === "" || phone === "") {
				// 	// alert(copy.emptyFields[lang]);
				// 	response.textContent = copy.emptyFields[lang];
				// } else if (!email.match(mailRegex)) {
				// 	response.textContent = copy.badMail[lang];
				// } else if (!phone.match(phoneRegex)) {
				// 	response.textContent = copy.badPhone[lang];
				// } else {

					response.classList.remove('error')
					demoFormContainer.style.display = "none";
					gif.style.display = "block";
					response.textContent = ""

					setTimeout(() => {
						gif.style.display = "none"
						calendarContainer.style.display = "block"
					}, 750);
				// }
			}


			function handleTimeDay(e) {
				e.preventDefault();
				response.classList.add('success');
				let time = document.querySelector('.time_selected');
				let day = document.querySelector('.date_selected');
				if (day == null || day == undefined) {
					alert(copy.noDate[lang]);
				} else if (time == null || time == undefined) {
					alert(copy.noTime[lang]);
				} else {

					bookBtn.disabled = true;

					let dataSet = 'first_name=' + firstName +
						'&last_name=' + lastName +
						'&full_date=' + date.toDateString() +
						'&phone=' + phone +
						'&email=' + email +
						'&company=' + companyName +
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
								response.textContent = copy.problem[lang];
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
								response.textContent = copy.successSend[lang];
								console.log(result);
								if (lang !== "en") {
									setTimeout((e) => {
										window.location = '/' + lang;
									}, 2000)
								} else {
									setTimeout((e) => {
										window.location = '/';
									}, 2000)
								}
							} else {
								response.textContent = copy.problem[lang];
								console.log(result);
								bookBtn.disabled = false;
							}
						}
					};
					xhrSend.send(dataSetSend);
				}
			}


			function handleBackButton(e) {
				e.preventDefault();
				demoFormContainer.style.display = "block";
				calendarContainer.style.display = "none"
				response.textContent = ""
				firstName = "";
				lastName = "";
				email = "";
				phone = "";
				companyName = "";
				isAgency = false;
				isConsent = false;
			}
			
		})
	</script>
<?php
}
add_action('wp_head', 'demo_form_handler');
