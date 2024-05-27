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
					switchContainer.innerHTML = `<div class="current_lang lang_display">${lang.toUpperCase()}</div>`
					otherLang.map((e) => {
						switchContainer.innerHTML += `<div class="other_lang lang_display">${e.toUpperCase()}</div>`
					})
				} else {
					mobileSwitch.innerHTML = `<div class="current_lang lang_display">${lang.toUpperCase()}</div>`
					otherLang.map((e) => {
						mobileSwitch.innerHTML += `<div class="other_lang lang_display">${e.toUpperCase()}</div>`
					})
				}
				 
				let langBtn = document.querySelectorAll('.lang_display');
				langBtn.forEach((e) => {
					e.addEventListener('click', (click) => {
						if (click.target.innerHTML.toLowerCase() !== lang) {
							let newLang = click.target.innerHTML.toLowerCase();
							let search = window.location.search;
							if (newLang == "en") {
								window.location = window.location.href.replace('/' + lang, '');		
							} else {
								window.location = '/' + newLang + window.location.pathname.replace('/' + lang, '');
							}
						}
					});
				});
			}
			displayButtons();
			window.addEventListener('resize', displayButtons);
		})
	</script>
<?php
}
add_action('wp_head', 'lang_switch_handler');
