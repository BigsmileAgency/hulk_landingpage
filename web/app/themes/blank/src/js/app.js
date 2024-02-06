import "../scss/app.scss";

$ = jQuery;

import LazyLoad from "vanilla-lazyload";
// import { gsap } from "gsap";

var lazy = new LazyLoad({
  threshold: 0,
});

$(document).ready(function () {
  linksHandle();

  lazy.update();
});

function linksHandle() {
  // IF # IN URL
  if (window.location.hash) {
    // to top right away
    scroll(0, 0);

    setTimeout(() => {
      $("html, body").animate(
        {
          scrollTop: $(window.location.hash).offset().top - 150 + "px",
        },
        1000,
        "swing"
      );
    }, 450);
  }

  $(document).on("click", "a", function (e) {
    // IF CLICK LINK #HREF
    const aProtocol = this.protocol;

    // if classic link
    if (
      this.pathname == window.location.pathname &&
      aProtocol == window.location.protocol &&
      this.host == window.location.host
    ) {
      e.preventDefault();

      const filterNav = $(".page-numbers");

      if (this.href.indexOf("#") != -1 && filterNav.length <= 0) {
        const hashUrl = $(this).prop("hash");

        if (hashUrl != "") {
          $("html, body").animate(
            {
              scrollTop: $(hashUrl).offset().top - 150 + "px",
            },
            1000,
            "swing"
          );

          // Close menu if mobile && open
          $("#burger").removeClass("active");
          reveseMobileMenu();
        }
      }
    } else {
      // If NOT mailto tel... links do animation
      if (
        aProtocol != "mailto:" &&
        aProtocol != "tel:" &&
        !this.hasAttribute("download") &&
        $(this).attr("target") != "_blank" &&
        !$(this).hasClass("cta__filter") &&
        !$(this).hasClass("sf-dump-ref") &&
        !e.ctrlKey
      ) {
        $("body").addClass("hide");
      }
    }
  });
}
