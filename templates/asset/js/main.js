(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html, body").animate(
          {
            scrollTop: target.offset().top - 70
          },
          1000,
          "easeInOutExpo"
        );
        return false;
      }
    }
  });

  // Scroll to top button appear
  $(document).scroll(function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $(".scroll-to-top").fadeIn();
    } else {
      $(".scroll-to-top").fadeOut();
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $(".js-scroll-trigger").click(function() {
    $(".navbar-collapse").collapse("hide");
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $("body").scrollspy({
    target: "#mainNav",
    offset: 80
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Floating label headings for the contact form
  $(function() {
    $("body")
      .on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass(
          "floating-label-form-group-with-value",
          !!$(e.target).val()
        );
      })
      .on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
      })
      .on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
      });
  });

  document
    .getElementById("Disable___sendMessageButton")
    .addEventListener("submit", function(event) {
      event.preventDefault();
      //traitement en ajax
      // Get form
      var form = $("#contactForm")[0];
      console.log("form");
      var data = new FormData(form);
      console.log(data);

      //traitement AJAX
      $.ajax({
        type: "POST",
        enctype: "multipart/form-data",
        url: "/upload.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function(data) {
          $("#output").text(data);
          console.log("SUCCESS : ", data);
          $("#btnSubmit").prop("disabled", false);
        },
        error: function(e) {
          $("#output").text(e.responseText);
          console.log("ERROR : ", e);
          $("#btnSubmit").prop("disabled", false);
        }
      });
    });
})(jQuery); // End of use strict
