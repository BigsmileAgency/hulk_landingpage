<?php
function lang_switch_handler()
{
?>
	<script>
		document.addEventListener("DOMContentLoaded", (e) => {
			e.preventDefault();

			let switchContainer = document.querySelector('.lang_btns');
			let mobileSwitch = document.querySelector('.mobile_lang_btns');
			let langArray = ["en", "fr", "nl"];
			let otherLang = [];

			if (langArray.includes(lang)) {
				otherLang = langArray.filter((e) => e !== lang);
			}

			function displayButtons() {
				// Selon la taille de l'écran 
				if (window.innerWidth > 768) {
					switchContainer.innerHTML = `<a class="current_lang lang_display">${lang.toUpperCase()}</a>`
					otherLang.map((e) => {
						switchContainer.innerHTML += `<a href="/${e}${window.location.pathname.replace('/' + lang, '')}" class="other_lang lang_display">${e.toUpperCase()}</a>`
					})
				} else {
					mobileSwitch.innerHTML = `<a class="current_lang lang_display">${lang.toUpperCase()}</a>`
					otherLang.map((e) => {
						// mobileSwitch.innerHTML += `<a class="other_lang lang_display">${e.toUpperCase()}</a>`
						mobileSwitch.innerHTML += `<a href="/${e}${window.location.pathname.replace('/' + lang, '')}" class="other_lang lang_display">${e.toUpperCase()}</a>`

					})
				}
				 
				// let langBtn = document.querySelectorAll('.lang_display');
				// langBtn.forEach((element) => {
				// 	element.addEventListener('click', ({target}) => {
				// 		if (target.innerHTML.toLowerCase() !== lang) {
				// 			let newLang = target.innerHTML.toLowerCase();
				// 			if (newLang == "en") {
				// 				window.location = window.location.href.replace('/' + lang, '');		
				// 			} else {
				// 				window.location = '/' + newLang + window.location.pathname.replace('/' + lang, '');
				// 			}
				// 		}
				// 	});
				// 	element.addEventListener("keyup", ({keyCode,target}) => {
				// 		if (keyCode == 13) {
				// 			if (target.innerHTML.toLowerCase() !== lang) {
				// 				let newLang = target.innerHTML.toLowerCase();
				// 				if (newLang == "en") {
				// 					window.location = window.location.href.replace('/' + lang, '');		
				// 				} else {
				// 					window.location = '/' + newLang + window.location.pathname.replace('/' + lang, '');
				// 				}
				// 			}
				// 		}
				// 	})
				// });
			}
			// displayButtons();
			window.addEventListener('resize', displayButtons);
		})
	</script>
<?php
}
add_action('wp_head', 'lang_switch_handler');
