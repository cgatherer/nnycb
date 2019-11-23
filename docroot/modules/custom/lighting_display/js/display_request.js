(function ($, Drupal, drupalSettings) {

    $.widget("custom.selectmenu", $.ui.selectmenu, {
      _renderItem: function(ul, item) {

        var li = $("<li>"),
          wrapper = $("<div>");

        if (item.disabled) {
          li.addClass("ui-state-disabled");
        }
        var hex = item.value.split('|')[1];
        $("<span>", {
          style: "background-color: " + hex,
          "class": "ui-color-chip"
        })
          .appendTo(wrapper);
        wrapper.append(item.label);

        return li.append(wrapper).appendTo(ul);
      }
    });

    Drupal.behaviors.displayRequest = {
        attach: function (context, settings) {
          $(window).once('displayRequest').each(function() {

            var shareparams = {};
            var sharebase = '/share-lighting-design';

            $('.block-lighting-display-form-block').parent().css('margin-top', '-65px').css('margin-bottom', '-140px');


            var $selects = $('#edit-step-2 select');
            $selects
              .selectmenu({
                position: { my : "top+60", at: "center+20" }
              })
              .selectmenu("menuWidget")
              .addClass("ui-menu-icons customicons");

            $selects.selectmenu('disable');

            $.getJSON( "/calendar-service/available", function( data ) {
              var availableDates = [];
              var slots = {};
              $.each( data, function( i, val ) {
                var date = val['date'];
                slots[date] = val;
                availableDates.push( date );
              });

              function available(date) {
                var dmy = (date.getMonth()+1) + "/" + date.getDate() + '/' + date.getFullYear();
                if ($.inArray(dmy, availableDates) != -1) {
                  return [true, "","Available"];
                } else {
                  return [false,"","unAvailable"];
                }
              }

              function prepShareParams(key, val) {
                shareparams[key] = val;
                var newshareurl = sharebase + '?' + $.param(shareparams);
                $('.share-button').attr('href', newshareurl);
              }

              function showColor(element, valParts) {
                var val = valParts.split('|')[0];
                var hex = valParts.split('|')[1];
                var $swatch = $("<span></span>").addClass('ui-color-chip selected').css('background-color', hex);
                var menuSelector = '#edit-' + element + '-color-button';
                var $menu = $(menuSelector);
                var $menubutton = $menu.find('.ui-color-chip');
                if ($menubutton.length) {
                  $menubutton.replaceWith($swatch);
                } else {
                  $menu.append($swatch);
                }
                $('.' + element).hide();
                var color = val.toLowerCase().replace(' ', '-');
                var classVal = '.' + element + '-' + color;
                $(classVal).show();
                prepShareParams(element, color)
                prepShareParams(element+'h', hex);
              }


              $('#edit-requested-date').datepicker(
                {beforeShowDay: available, minDate: new Date(),
                  dateFormat: 'm/d/yy',
                  onSelect: function(dateText, inst) {

                    $selects.selectmenu('enable');
                    console.log(dateText);
                    console.log(slots);
                    var selected_slot = slots[dateText];
                    //set the slot entity id on the hidden form field
                    $("#slot-id").val(selected_slot['slot_id']);
                    // get the palette and load it into the selects
                    var palette  = selected_slot['color_palette'];
                    $selects.find('option').remove();

                    $selects.append($("<option></option>").html('Select Color'));

                    var colorPalettes = drupalSettings.color_palettes[0];
                    var availablePalette = colorPalettes[palette];
                    $.each(availablePalette, function (i, val) {
                      var name = val['name'];
                      var hex = val['hex'];
                      var optval = name + '|' + hex;
                      $selects.append($("<option></option>").val(optval).html(name));
                    });


                    $('#edit-towers-color').on('selectmenuchange', function() {
                      showColor('towers', this.value);
                    });

                    $('#edit-pier1-color').on('selectmenuchange', function() {
                      showColor('pier1', this.value);
                    });
                    $('#edit-pier2-color').on('selectmenuchange', function() {
                      showColor('pier2', this.value);
                    });
                    $('#edit-applicant-name').on('change', function() {
                      prepShareParams('usr', this.value);
                    });
                    $('#edit-org').on('change', function() {
                      prepShareParams('org', this.value);
                    });
                    $('#edit-display-name').on('change', function() {
                      prepShareParams('name', this.value);
                    });

                    // enable step 2

                  }
                }
              );

            });
          });

        }
    };

})(jQuery, Drupal, drupalSettings);
