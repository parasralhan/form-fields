jQuery(function ($) {
  "use strict";
  var general = {
    remove_text: (function ( $ ) {
      var instance,
          remove_text = function(){
            $(document.body).on('click', '.input-wrapper button.remove', function ( e ) {
              $( this ).parents( '.input-wrapper' ).find( '.input, input' ).val( '' ).change();
              e.preventDefault();
              e.stopPropagation();
            });
          };
      instance = instance || remove_text;
      return function(){
        instance();
      };
    }(jQuery)),
    /*==========================================================
     * ICON INPUT-TYPE TOGGLE
     *==========================================================*/
    icons_toggle: function () {
      var instance,
          $icon_input_wrapper = $( ".icon-input-wapper" );
      var Toggler = {
        wrapper: ".icon-input-wapper",
        _cache_dom: function(){
          this.$wrapper = $( ".icon-input-wapper" );
          this.$icons = this.$wrapper.find( '.all-icons' );
          this.$icons_type_wrapper = this.$wrapper.find('.icon-types-wrapper');
        },
        _bind_events: function(){
          var this_obj = this;
          $(document.body).on( "focus", ".icon-input-wapper .input", function(e){
            var $wrapper = $(e.currentTarget).parents(this_obj.wrapper);
            this_obj.show_icons(e, $wrapper);
          });
          $(document.body).on( "click", ".icon-input-wapper .close-popup", function(e){
            var $wrapper = $(this).parents(this_obj.wrapper);
            this_obj.hide_icons( e, $wrapper);
          });
          $(document.body).on( "click", ".icon-input-wapper .icon-types-wrapper a", function(e){
            var $wrapper = $(e.currentTarget).parents(this_obj.wrapper);
            this_obj.show_icons_category(e, $wrapper);
          });
          $(document.body).on( "click", ".icon-input-wapper .icons li a", function(e){
            var $wrapper = $(e.currentTarget).parents(this_obj.wrapper);
            this_obj.select_icon(e, $wrapper);
          });
          $( document.body ).on( "click", ".icon-input-wapper .remove", function ( e ) {
            var $wrapper = $( e.currentTarget ).parents( this_obj.wrapper );
            this_obj.remove_icon( e, $wrapper );
          } );
        },
        init: function () {
          var this_obj = this;
          this._cache_dom();
          this._init();
          // Bind events
          this._bind_events();
          // hide close button initially
          $icon_input_wrapper.find( ".close-popup" ).hide();
        },
        _init: function(){
          var this_obj = this;
          $icon_input_wrapper.each(function (){
            this_obj._append_icon($(this).find('.input'));
          });          
        },
        _append_icon: function ($input){
          var $input = $input || $icon_input_wrapper.find( ".input" ),
              icon_class = $input.val(),
              icon;
          if (icon_class) {
            icon = $('body').find('.bonzer-inputs-all-icons.original').find('a[data-icon-class="'+icon_class+'"]').html();
            $input.siblings('.icon-holder').html(icon);
          };
        },
        show_icons: function(e, $wrapper){
          var this_obj = this,
              $input = $( e.currentTarget ),
              $icon_input_wrapper = $input.parents( this_obj.wrapper ),
              $icons = $wrapper.find( '.bonzer-inputs-all-icons' ),
              $icons_cloned;
          if (!$icons.length) {
            // Append Icons
            $icons_cloned = $( "body" ).find('.bonzer-inputs-all-icons.original').clone().hide();
            $icons_cloned.removeClass('original').appendTo( $icon_input_wrapper );
            $icons = $icons_cloned;
          }
          // Show Close Button
          $wrapper.find( ".close-popup" ).show();
          // Show Icons
          $icons.slideDown();
          // Activate first Category
          if ($wrapper.find('.icon-types-wrapper li.active').length === 0) {
            $wrapper.find('.icon-types-wrapper li:first a').trigger('click');
          };     
          e.stopPropagation();     
          e.preventDefault();
        },
        remove_icon: function (e, $wrapper){
          $wrapper.find('.icon-holder').empty();
          e.stopPropagation();
          e.preventDefault();
        },
        show_icons_category: function(e, $wrapper){
          var $this = $( e.currentTarget );
          var target = $this.data( 'target' ) + '-type-icons';
          $this.parent( 'li' ).addClass( 'active' ).siblings().removeClass( 'active' );
          $wrapper.find( '[data-target-id="'+target+'"]' ).fadeIn().siblings( '.icons-wrapper' ).hide();
          e.stopPropagation();
          e.preventDefault();
        },
        select_icon: function ( e, $wrapper ) {
          var this_obj = this;
          var $this = $( e.currentTarget ),
              $class = $this.data( "icon-class" ),
              $input = $wrapper.find('.input');
          $input.val( $class ).change();
          $wrapper.find('.bonzer-inputs-all-icons').hide();
          $wrapper.find( ".close-popup" ).hide();
          this._append_icon($input);
          e.preventDefault();
          e.stopPropagation();
        },
        hide_icons: function ( e , $wrapper) {
          var this_obj = this,
              $button = $( e.currentTarget );
          $button.hide();
          $wrapper.find('.bonzer-inputs-all-icons').hide();
          e.stopPropagation();
          e.preventDefault();
        },
      }; 
      Toggler.init();
    },
    /*---------------------------------------------------------------
     | SEARCH ICONs
     ----------------------------------------------------------------*/
    search_icon: function ( ) {
      $( document.body ).on( "keyup", ".icons-search-form input", function (e) {
        var $this = $( this );
        var value = $this.val();
        var $icons = $this.parents( "ul.bonzer-inputs-all-icons" );
        if (value) {
          $icons.find( "li" ).not( ".icons-search-form, .icon-types-wrapper, .icon-types-wrapper ul li" ).hide();
        } else {
          $icons.find( "li" ).show();
        }
        $icons.find( "li.icons-wrapper" ).each( function () {
          $this = $( this );
          var value_regex = new RegExp( value );
          var $target_element = $this.find( "ul.icons" ).find( 'a' );
          $target_element.each( function () {
            var $icon = $( this );
            var icon_class = $icon.attr( "data-icon-class" );
            var synoniums = $icon.attr( "data-synoniums" );
            if (value_regex.test( icon_class ) || value_regex.test( synoniums )) {
              $icon.parents( 'li' ).show();
            }
          } );
        } );
        e.preventDefault();
        e.stopPropagation();
      } );
    }
  };

  general.remove_text();
  general.icons_toggle();
  general.search_icon();
});