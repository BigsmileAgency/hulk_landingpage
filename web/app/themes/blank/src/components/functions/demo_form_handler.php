<?php
function demo_form_handler()
{
?>
	<script>
		document.addEventListener("DOMContentLoaded", function() {

			let demoSubmit = document.querySelector("#demo_form");
			let demoFormContainer = document.querySelector('.demo_form_container');
			let bookBtn = document.querySelector("#book_btn");
			let firstName, lastName, email, phone, companyName, isAgency, isConsent;
			
			demoSubmit.addEventListener("submit", sendInfos);

			function sendInfos(e) {
				
				e.preventDefault();
				
				firstName = document.querySelector("#demo_first_name");
				lastName = document.querySelector("#demo_last_name");
				email = document.querySelector("#demo_email");
				phone = document.querySelector("#demo_phone");
				companyName = document.querySelector("#demo_company_name");
				isAgency = document.querySelector('input[type=radio][name=is_agency]:checked');
				isConsent = document.querySelector("#demo_consent").checked;
				let grey = companyName.style.borderColor
				
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

					bookBtn.disabled = true;

					let dataSet = 'first_name=' + firstName.value +
						'&last_name=' + lastName.value +
						'&phone=' + phone.value +
						'&email=' + email.value +
						'&company=' + companyName.value +
						'&is_agency=' + isAgency.value +
						'&is_consent=' + isConsent +
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
		})
	</script>
<?php
}
add_action('demo_handle', 'demo_form_handler');

