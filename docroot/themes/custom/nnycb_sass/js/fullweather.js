/**
 * @file
 * Global utilities.
 *
 */
(function($) {
  'use strict';

  $(document).ready(function(){
    $.ajax({
        type: 'GET',
        url: 'https://api.openweathermap.org/data/2.5/forecast?zip=10591,us&units=imperial&cnt=8&appid=40e16fbeed946b77e017347d9947098d',
        dataType: "jsonp",
        success: function(data) {
          var widget = showWeather(data);

          $('.showFullWeather').html(widget);
        }
    });
  });

  function showWeather(data) {
    var temp = Math.round(data.list[0].main.temp);
    var wind = Math.round(data.list[0].wind.speed);
    var i = 1;
    var markup = '';
    var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    while (i < data.list.length) {
      var stamp = data.list[i].dt;
      var dt = new Date();
      dt.setTime(stamp*1000);
      var dayOfWeek = days[dt.getDay()];
      markup += "<div class='weather-forcast--day-after'>";
      markup += "<span class='day'>" + dayOfWeek + "</span><br>";
      markup += "<span class='degrees'>" + Math.round(data.list[i].main.temp) + "° F</span><br>";
      markup += "<img src='/themes/custom/nnycb_sass/images/icons/" + data.list[i].weather[0].icon + ".png' width='45' height='45' alt='Weather in Tarrytown, US'>";
      markup += "</div>";
      i++;
    }

    return "<div class='weather-forcast'>" +
      "<div class='weather-forcast--conditions'>weather<br>conditions</div>" +
      "<div class='weather-forcast--icon'><img src='/themes/custom/nnycb_sass/images/icons/" + data.list[0].weather[0].icon + ".png' width='100' height='100' alt='Weather in Tarrytown, US'></div>" +
      "<div class='weather-forcast--temp'><span class='degrees'>" + temp + "° F</span><br><span class='decs'>" + data.list[0].weather[0].main + "</span><br><span class='speed'> " + wind + " MPH Winds</span></div>" +
      markup +
      "</div>";
  }
})(jQuery, Drupal);