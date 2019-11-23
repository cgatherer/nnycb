/**
 * @file
 * Global utilities.
 *
 */
(function($, Drupal, drupalSettings) {
  'use strict';
 
  $(document).ready(function(){
    
    // Variables
    var contentWrapper     = $('.cuomo-main-content');
    var lateralMenuTrigger = $('.cuomo-main-nav .cuomo-menu-trigger .dropdown-toggle');
    var lateralNav         = $('.cuomo-main-nav .cuomo-lateral-nav');
    var navigation         = $('header');
    var searchForm         = $('.search-form');
    var browserWindow      = $(window);
    var fixedTop           = 90;
    var subnavTop          = fixedTop;
    // check if hero or carousel is above the subnav
    var subnavChecked      = false;
    var lateralOpen        = false;

    var toolbarHeight = $('#toolbar-bar').height();
    var trayHeight = $('.toolbar-tray.is-active.toolbar-tray-horizontal').height();
    if (toolbarHeight) {
      subnavTop += 70;
    }

    // Search
    searchForm.click(function(){
      $(this).parent().toggleClass('search-open');
    });

    lateralMenuTrigger.click(function(e){
      lateralOpen = true;
      e.preventDefault();
      var thisLateral = $(this).siblings('ul.cuomo-lateral-nav');

      var scrollTop = browserWindow.scrollTop();

        if (scrollTop < fixedTop) {
          // position to bottom of main nav
          var bottom = fixedTop - scrollTop + 79;
          if (toolbarHeight) bottom += toolbarHeight;
          if (trayHeight) bottom += trayHeight;
          thisLateral.css('top', bottom);
        } else {
          thisLateral.removeAttr('style');
        }

      lateralMenuTrigger.removeClass('is-clicked');
      $(this).toggleClass('is-clicked');
      lateralNav.not(thisLateral).removeClass('lateral-menu-is-open');

      navigation.toggleClass('lateral-menu-is-open');
      contentWrapper.toggleClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
        // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
        $('body').toggleClass('overflow-hidden');
      });

      $(this).siblings('.cuomo-lateral-nav').toggleClass('lateral-menu-is-open');
      
      //check if transitions are not supported - i.e. in IE9
      if($('html').hasClass('no-csstransitions')) {
        $('body').toggleClass('overflow-hidden');
      }
    });

    // Close lateral menu clicking outside the menu itself
    contentWrapper.on('click', function(event){
      if( !$(event.target).is('.cuomo-menu-trigger, .cuomo-menu-trigger a') ) {
        lateralOpen = false;
        $(lateralNav).removeAttr('style');
        lateralMenuTrigger.removeClass('is-clicked');
        navigation.removeClass('lateral-menu-is-open');
        contentWrapper.removeClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
          $('body').removeClass('overflow-hidden');
        });
        $(lateralNav).removeClass('lateral-menu-is-open');
        //check if transitions are not supported
        if($('html').hasClass('no-csstransitions')) {
          $('body').removeClass('overflow-hidden');
        }
      }
    });

    // Mobile Nav
    $('.ny-state-nav--mobile .expand-menu-mobile').click(function(e){
      e.preventDefault();
      $(this).toggleClass('expand-menu-mobile--rotate');
      $('.ny-state-mobile-menu').slideToggle(500);
    });

    $('.cuomo-main-nav--mobile .expand-menu-mobile').click(function(e){
      e.preventDefault();
      $(this).toggleClass('expand-menu-mobile--rotate');
      $('.cuomo-mobile-menu').slideToggle(500);
      $('.cuomo-mobile-menu').toggleClass('cuomo-mobile-menu--expanded');
    });

    $('.cuomo-mobile-menu .dropdown-toggle').each(function(index) {
        $(this).on("click", function(e){
          e.preventDefault();
          $(this).toggleClass('dropdown-toggle--rotate');
          $(this).siblings('.cuomo-lateral-nav').slideToggle(500);
        });
    });

    var headerStuck = false;
    var subnavStuck = false;
    
    // Header Scroll
    browserWindow.scroll(function(){

      if (!subnavChecked) {
        var heroHeight = $('.hero').height();
        var noheroHeight = $('.no-hero').height();
        var firstCarouselHeight = $('.field--name-field-paragraphs .paragraph:first-child.paragraph--type--carousel').height();
        if (heroHeight) {
          subnavTop = fixedTop + heroHeight;
        } else if (noheroHeight) {
          subnavTop = fixedTop + noheroHeight;
        } else if (firstCarouselHeight) {
          subnavTop = fixedTop + firstCarouselHeight;
        }
      }
      var scrollTop = browserWindow.scrollTop();

      if (lateralOpen) {
        if (scrollTop < fixedTop) {
          // position to bottom of main nav
          var bottom = fixedTop - scrollTop + 79;
          if (toolbarHeight) bottom += toolbarHeight;
          if (trayHeight) bottom += trayHeight;
          $(lateralNav).css('top', bottom);
        } else {
          $(lateralNav).removeAttr('style');
        }

      }
      if (scrollTop >= fixedTop && !headerStuck) {
        headerStuck = true;
        $('.cuomo-main-nav').addClass('sticky');
        $('#main').addClass('sticky-nav');
        $('.cuomo-main-nav--mobile').addClass('sticky');
      }
      else if (scrollTop < fixedTop && headerStuck) {
        headerStuck = false;
        $('.cuomo-main-nav').removeClass('sticky');
        $('#main').removeClass('sticky-nav');
        $('.cuomo-main-nav--mobile').removeClass('sticky');
      }

      if (scrollTop >= subnavTop && !subnavStuck) {
        subnavStuck = true;
        $('.subnav-wrapper').addClass('sticky-pad');
        if ($('.field--name-field-block .menu--main').length) {
          $('#main').addClass('sticky-subnav');
        }
      }
      else if (scrollTop < subnavTop && subnavStuck) {
        subnavStuck = false;
        $('.subnav-wrapper').removeClass('sticky-pad');
        $('#main').removeClass('sticky-subnav');
      }
    });

    // Breadcrumb Reorder
    var $subnav = $('.paragraph--type--block .block-menu .navbar-nav');
    if ($subnav.length) {
      var $active_anchor = $subnav.find('li .is-active');
      if ($active_anchor.length) {
        $active_anchor.parent().prependTo($subnav);
      } else {
        var parent_url = drupalSettings.nnycb.node_main_parent_url;
        if (parent_url) {
           var $make_active = $subnav.find('li a[href="' + parent_url + '"]');
          if ($make_active.length) {
            $make_active.addClass('is-active');
            $make_active.parent().prependTo($subnav);
          }
        }
      }
    }

    // Breadcrumb Margin on Mobile
    var $bcWidth = $('.paragraph--type--block .block-menu h2').width();
    var $bcWindowWidth = $(window).width() < 767.98;
    if ($bcWindowWidth) {
      var $bcNav = $('.paragraph--type--block .field--type-block-field .block-menu .navbar-nav');
      var $bcNavMargin = $bcWidth + 50;
      $bcNav.css('margin-left', + $bcNavMargin + 'px');
    }

    // Remove br tags on mobile
    if($bcWindowWidth) {
      $('h1, h2').find('br').remove();
    }

    // Accordion Caret
    $('.accordion-btn').click(function(e){
      e.preventDefault();
      $(this).find('.accordion-arrow').toggleClass('accordion-arrow--open');
    });

    // Empty News and Events
    var $noNewsEvents = $('.path-frontpage .news-events .block-views-blocknews-and-events-block-1 .view-lay-id-block_1');
    if ($noNewsEvents.length == 0 ) {
      $(this).find('.block-views-blocknews-and-events-block-1').hide();
      $('#block-twitterfeedfrontpage').css('marginLeft','0px');
      $('.path-frontpage .news-events .new-events-teaser .col-auto').css('padding','0px');
    }

    var totalWidth = 0;
    $('.paragraph--type--block .menu--main .navbar-nav li').each(function() {
       totalWidth +=  $(this).outerWidth(true);
    });
    if (totalWidth > 0 && $(window).width() < 767.98 ) {
      var navWidth = totalWidth + 100;
      $('.paragraph--type--block .menu--main .navbar-nav').css('width', + navWidth + 'px');
    }
  });

  // Drupal Required Scripts
  Drupal.behaviors.bootstrap_barrio_subtheme = {
    attach: function(context, settings) {
      var position = $(window).scrollTop();
      $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
          $('body').addClass("scrolled");
        }
        else {
          $('body').removeClass("scrolled");
        }
        var scroll = $(window).scrollTop();
        if (scroll > position) {
          $('body').addClass("scrolldown");
          $('body').removeClass("scrollup");
        } else {
          $('body').addClass("scrollup");
          $('body').removeClass("scrolldown");
        }
        position = scroll;
      });
    }
  };

  Drupal.behaviors.bootstrap_navtabs = {
    attach: function(context, settings) {
      $('.nav-tabs a').click(function (e) {
        //get selected href
        var href = $(this).attr('href');

        // show tab for all tabs that match href
        $('.nav-tabs a[href="' + href + '"]').tab('show');
      });
      $('.nav-tabs-bottom .nav-tabs a').click(function (e) {
        var top = $('#nav-tabs-top').offset().top;
        $("html, body").animate({ scrollTop: top - 100 }, "slow");
      });
    }
  };

  function isIE() {
    var ua = navigator.userAgent;
    /* MSIE used to detect old browsers and Trident used to newer ones*/
    var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;

    return is_ie;
  }

  if (isIE()) {
    var $heroImgWrapper = $('.field--name-field-hero-image');
    if ($heroImgWrapper.length) {
      var $heroImg = $heroImgWrapper.find('img');
      $heroImg.on('load', function() {
        var height = $heroImg.height();
        var heroHeight = $('.hero').height();
        if (height > heroHeight) {
          var offset = (height - heroHeight)/2;
          $heroImgWrapper.css('top', '-' + offset + 'px');
        }
      }).each(function() {
        if(this.complete) $(this).trigger('load');
      });
    }
    var $carouselImgWrapper = $('.field--name-field-carousel-image');
    if ($carouselImgWrapper.length) {
      $carouselImgWrapper.each(function() {
        var $carouselImg = $(this).find('img');
        $carouselImg.on('load', function() {
          var height = $carouselImg.height();
          var carouselHeight = $carouselImgWrapper.height();
          if (height > carouselHeight) {
            var offset = (height - carouselHeight)/2;
            $carouselImgWrapper.css('top', '-' + offset + 'px');
          }
        }).each(function() {
          if(this.complete) $(this).trigger('load');
        });
      });

    }
  }

})(jQuery, Drupal, drupalSettings);