<?php
function lang_switch_handler()
{
?>
  <script>
    document.addEventListener("DOMContentLoaded", (e) => {
      e.preventDefault();

      console.log(window.location);
      console.log(window.location.pathname.replace('/' + lang, ''));

      let switchContainer = document.querySelector('#lang_btns');
      let langArray = ["en", "fr", "nl"];
      let otherLang = [];

      if (langArray.includes(lang)) {
        otherLang = langArray.filter((e) => e !== lang)
      }

      switchContainer.innerHTML = `<div class="current_lang lang_display">${lang.toUpperCase()}</div>`

      otherLang.map((e) => {
        switchContainer.innerHTML += `<div class="other_lang lang_display">${e.toUpperCase()}</div>`
      })

      let langBtn = document.querySelectorAll('.lang_display')

      langBtn.forEach((e) => {
        e.addEventListener('click', (click) => {
          console.log(lang, click.target.innerHTML.toLowerCase());
          if (click.target.innerHTML.toLowerCase() !== lang) {
            let newLang = click.target.innerHTML.toLowerCase()
            if (newLang == "en") {
              window.location = window.location.href.replace('/' + lang, '');
            } else {
              window.location = '/' + newLang + window.location.pathname.replace('/' + lang, '');
            }
          }
        });
      });
    })
  </script>
<?php
}
add_action('wp_head', 'lang_switch_handler');
