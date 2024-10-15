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
		})
	</script>
<?php
}
add_action('wp_head', 'lang_switch_handler');
