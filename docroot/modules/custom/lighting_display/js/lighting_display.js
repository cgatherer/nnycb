(function ($, Drupal) {

  $.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)')
      .exec(window.location.search);

    return (results !== null) ? results[1] || 0 : false;
  }

    Drupal.behaviors.lightingDisplay = {
        attach: function (context, settings) {
          $(window).once('lightingDisplay').each(function() {
            // check to see if there are is the query param "thanks" and if so, show the thank you message and back to form button

            var thanks = $.urlParam('thanks');
            if (thanks) {
              $(".thanks-msg").css("display", "block").css('visibility', 'visible');
            }

            a2a_config.templates.email = {
              subject: "Check out my Cuomo Bridge lighting Display Design: ${title}",
              body: "Click the link to see my Mario Cuomo Bridge lighting design request:\n${link}"
            };
            a2a_config.onclick = 1;
            a2a_config.track_links = 'ga';
            a2a_config.exclude_services = ["facebook", "twitter", "email"];

          });

        }
    };

})(jQuery, Drupal);
