<?php
function demo_form_handler()
{
?>
	<script>
		let lang = document.documentElement.lang;

		if (lang == "fr-FR") {
			lang = "fr";
		} else if (lang == "en-EN") {
			lang = "en"
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
			},

			noTime: {
				"en": "Select a time-slot please",
				"fr": "Selectionner une plage horaire SVP",
			},

			successSend: {
				"en": "We have received your request, bye",
				"fr": "Nous avons bien reçus votre demand, bye"
			},

			problem: {
				"en": "Problem, try again",
				"fr": "Un problème est survenu réessayez",
			}
		}


		document.addEventListener("DOMContentLoaded", function() {

			document.querySelector("#demo_form").addEventListener("submit", (e) => {
				e.preventDefault();

				// containers
				let demoFormContainer = document.querySelector('.demo_form_container');
				let gif = document.querySelector('.demo_gif');
				let calendarContainer = document.querySelector('.calendar_container');

				// form input
				let firstName = document.querySelector("#demo_first_name").value;
				let lastName = document.querySelector("#demo_last_name").value;
				let email = document.querySelector("#demo_email").value;
				let phone = document.querySelector("#demo_phone").value;
				let companyName = document.querySelector("#demo_company_name").value;
				let isAgency = document.querySelector("#are_you_agency").checked;
				let isConsent = document.querySelector("#demo_consent").checked;
				let bookBtn = document.querySelector("#book_btn");

				// response
				let response = document.querySelector('.demo_response');

				// regexs 
				let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

				response.classList.add('error')

				if (firstName === "" || lastName === "" || email === "" || phone === "") {
					// alert(copy.emptyFields[lang]);
					response.textContent = copy.emptyFields[lang];
				} else if (!email.match(mailRegex)) {
					response.textContent = copy.badMail[lang];
				} else if (!phone.match(phoneRegex)) {
					response.textContent = copy.badPhone[lang];
				} else {

					response.classList.remove('error')
					demoFormContainer.style.display = "none";
					gif.style.display = "block";
					response.textContent = ""

					setTimeout(() => {
						gif.style.display = "none"
						calendarContainer.style.display = "block"
					}, 500)

					bookBtn.addEventListener('click', function(e) {
						e.preventDefault();
						response.classList.add('success');
						
						let time = document.querySelector('.time_selected');
						
						if (time == null || time == undefined) {

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
								'&time=' + time.innerHTML;

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
										setTimeout((e) => {
											window.location = '/';
										}, 2000)
									} else {
										response.textContent = copy.problem[lang];
										console.log(result);
										bookBtn.disabled = false;
									}
								}
							};
							xhrSend.send(dataSetSend);
						}
					});
				}
			})
		})
	</script>
<?php
}
add_action('wp_head', 'demo_form_handler');
