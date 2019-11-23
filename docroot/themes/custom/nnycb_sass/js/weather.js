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
        url: 'https://api.openweathermap.org/data/2.5/forecast?zip=10591,us&units=imperial&cnt=3&appid=40e16fbeed946b77e017347d9947098d',
        dataType: "jsonp",
        success: function(data) {
          var widget = showWeather(data);

          $('.showWeather').html(widget); 
        }
    });
  });

  function showWeather(data) {
    var temp = Math.round(data.list[0].main.temp);
    var wind = Math.round(data.list[0].wind.speed);
    return "<div class='weather-forcast'>" +
           "<div class='weather-forcast--conditions'>weather<br>conditions</div>" +
           "<div class='weather-forcast--icon'><img src='/themes/custom/nnycb_sass/images/icons/" + data.list[0].weather[0].icon + ".png' width='100' height='100' alt='Weather in Tarrytown, US'></div>" +
           "<div class='weather-forcast--temp'><span class='degrees'>" + temp + "° F</span><br><span class='decs'>" + data.list[0].weather[0].main + "</span><br><span class='speed'> " + wind + " MPH Winds</span></div>" +
           "<div class='weather-forcast--tomorrow'><span class='day'>Tomorrow</span><br><span class='degrees'>" + Math.round(data.list[1].main.temp) + "° F</span><br><img src='/themes/custom/nnycb_sass/images/icons/" + data.list[1].weather[0].icon + ".png' width='45' height='45' alt='Weather in Tarrytown, US'></div>" +
           "<div class='weather-forcast--day-after'><span class='day'>The Day After</span><br><span class='degrees'>" + Math.round(data.list[2].main.temp) + "° F</span><br><img src='/themes/custom/nnycb_sass/images/icons/" + data.list[2].weather[0].icon + ".png' width='45' height='45' alt='Weather in Tarrytown, US'></div>" +
           "</div>";
  }
})(jQuery, Drupal);