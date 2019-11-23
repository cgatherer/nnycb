(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.BridgeStatusBehavior = {
    attach: function (context, settings) {
      // can access setting from 'drupalSettings';
      $('body').once('bridge_status').each(function () {
        var pathIsClosed = drupalSettings.bridge_status.path_is_closed;
        if (pathIsClosed) {
          $('.bridge-status--path-open span').text('Closed');
        } else {
          // check time of day
          var sunrise = drupalSettings.bridge_status.sunrise;
          var sunset = drupalSettings.bridge_status.sunset;
         // console.log(sunrise);
         // console.log(sunset);

          var today = new Date();
          var month = (today.getUTCMonth()+1);
          if (month < 10) month = '0' + month;
          var day = today.getUTCDate();
          if (day < 10) day = '0' + day;
          var date = today.getFullYear()+'-'+month+'-'+day;
          var hours = today.getUTCHours();
          if (hours < 10) hours = '0' + hours;
          var mins = today.getUTCMinutes();
          if (mins < 10) mins = '0' + mins;
          var secs = today.getUTCSeconds();
          if (secs < 10) secs = '0' + secs;
          var time = hours + ":" + mins + ":" + secs;
          var dateTime = date+'T'+time+'+00:00';
          // console.log(dateTime);

          if (dateTime > sunset || dateTime < sunrise) {
            $('.bridge-status--path-open span').text('Closed');
          }
        }
      });
    }
  }
})(jQuery, Drupal, drupalSettings);