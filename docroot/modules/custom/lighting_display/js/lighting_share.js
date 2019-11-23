(function ($, Drupal) {

  $.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)')
      .exec(window.location.search);

    return (results !== null) ? results[1] || 0 : false;
  }

    Drupal.behaviors.lightingShare = {
        attach: function (context, settings) {
          $(window).once('lightingShare').each(function() {
            // check to see if there are is the query param "thanks" and if so, show the thank you message and back to form button

            var towerColor = $.urlParam('towers');
            if (towerColor) {
              var towerClass = '.towers-' + towerColor;
              $(towerClass).show();
              $('.color-towers .color-name').text(towerColor);
            }
            var towerHex = decodeURIComponent($.urlParam('towersh'));
            if (towerHex) {
              $('.color-towers .color-value').css('background-color', towerHex);
            }
            var pier1Color = $.urlParam('pier1');
            if (pier1Color) {
              var pier1Class = '.pier1-' + pier1Color;
              $(pier1Class).show();
              $('.color-pier1 .color-name').text(pier1Color);
            }
            var pier1Hex = decodeURIComponent($.urlParam('pier1h'));
            if (pier1Hex) {
              $('.color-pier1 .color-value').css('background-color', pier1Hex);
            }
            var pier2Color = $.urlParam('pier2');
            if (pier2Color) {
              var pier2Class = '.pier2-' + pier2Color;
              $(pier2Class).show();
              $('.color-pier2 .color-name').text(pier2Color);
            }
            var pier2Hex = decodeURIComponent($.urlParam('pier2h'));
            if (pier2Hex) {
              $('.color-pier2 .color-value').css('background-color', pier2Hex);
            }

            var applicantName = decodeURIComponent($.urlParam('usr'));
            if (applicantName != 'false') {
              $('.applicant-name .info-value').text(applicantName);
            }
            var applicantOrg = decodeURIComponent($.urlParam('org'));
            if (applicantOrg != 'false') {
              $('.applicant-org .info-value').text(applicantOrg);
            }
            var displayName = decodeURIComponent($.urlParam('name'));
            if (displayName != 'false') {
              $('.display-name .info-value').text(displayName);
            }

            var href = window.location.href;
            $('.share-url').text(href).attr('href', href);

            a2a_config.templates.email = {
              subject: "Check out my Cuomo Bridge lighting Display design: ${title}",
              body: "Click the link to see my Mario Cuomo Bridge lighting design idea:\n${link}"
            };
            a2a_config.onclick = 1;
            a2a_config.track_links = 'ga';
            a2a_config.exclude_services = ["facebook", "twitter", "email"];

          });

        }
    };

})(jQuery, Drupal);
