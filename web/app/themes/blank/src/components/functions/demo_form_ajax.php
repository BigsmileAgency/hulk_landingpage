<?php

function demo_form_ajax()
{
?>
	<script>
		let lang = document.documentElement.lang;
		let rdv
		let i = 0;

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

			document.querySelector("#demo_form").addEventListener("submit", (e) => {
				e.preventDefault();

				// containers
				let formAndCalendar = document.querySelector('.form_and_calendar');
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
				let sentBtn = document.querySelector("#demo_send_btn");

				// response
				let response = document.querySelector('.demo_response');

				// regexs 
				let mailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				let phoneRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;


				// if (firstName === "" || lastName === "" || email === "" || phone === "") {
				// 	// alert(copy.emptyFields[lang]);
				// 	response.textContent = copy.emptyFields[lang];
				// } else if (!email.match(mailRegex)) {
				// 	response.textContent = copy.badMail[lang];
				// } else if (!phone.match(phoneRegex)) {
				// 	response.textContent = copy.badPhone[lang];
				// } else {

				demoFormContainer.style.display = "none";
				gif.style.display = "block";

				setTimeout(() => {
					gif.style.display = "none"
					calendarContainer.style.display = "block"
				}, 1)
				
				renderCalendar();
				let daysArray = Array.from(document.querySelectorAll('.day'));

				document.querySelector(".prev").addEventListener("click", (e) => {
					e.preventDefault();
					date.setMonth(date.getMonth() - 1);
					renderCalendar();

				});
				
				document.querySelector(".next").addEventListener("click", (e) => {
					e.preventDefault();
					date.setMonth(date.getMonth() + 1);
					renderCalendar();

				});
	
				let timeArray = Array.from(document.querySelectorAll('.slot'));
				let today = document.querySelector('.today')
							
				console.log(daysArray);
	
				function dateIsSelected(e) {
					const thisDate = e.target;
					today.classList.remove('today')
					const otherDates = daysArray.filter(date => {
						return (date !== thisDate);
					})
					otherDates.forEach((e) => {
						e.classList.remove(('date_selected'))
					})
					thisDate.classList.add('date_selected')
				}
	
				function timeIsSelected(f) {
					const thisTime = f.target;
					const otherTime = timeArray.filter(time => {
						return (time !== thisTime);
					})
					otherTime.forEach((e) => {
						e.classList.remove(('time_selected'))
					})
					thisTime.classList.add('time_selected')
				}
	
				daysArray.forEach((day) => {
					day.addEventListener('click', (e) => {
						dateIsSelected(e);
					})
				})
	
				timeArray.forEach((time) => {
					time.addEventListener('click', (f) => {
						timeIsSelected(f)
					})
				})
				
				// }
			})	
			
		})
	</script>
<?php
}
add_action('wp_head', 'demo_form_ajax');
