<?php
function demo_form_handler()
{
?>
	<script>

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

				fieldsArray.map((e) => {
					if (e.value == "") {
						handleAlert(e, copy.emptyFields, lang)
						success++
					} else if (e == email && !email.value.match(mailRegex)) {
						handleAlert(e, copy.badMail, lang);
						success++
					} else if (e == phone && !phone.value.match(phoneRegex)) {
						handleAlert(e, copy.badPhone, lang);
						success++
					} else {
						rollBackAlert(e, grey)
					}
				})

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
        date.setDate(day.innerHTML);
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

					// INSERT DB + SEND MAIL
					let xhrSend = new XMLHttpRequest();
					let urlSend = '<?= admin_url('admin-ajax.php') ?>';
					let dataSetSend = 'action=send_demo_request&' + dataSet;

					xhrSend.open("POST", urlSend, true);
					xhrSend.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhrSend.onreadystatechange = function() {
						if (xhrSend.readyState == 4 && xhrSend.status == 200) {
							let result = xhrSend.responseText;
							result = JSON.parse(result);
							console.log(result)
							if (!result.error) {
								// console.log(result);
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
add_action('demo_handle', 'demo_form_handler');
