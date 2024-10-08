
jQuery( function ( $ ) {

  "use strict";

  var inputs = {

    remove_text: (function ( $ ) {

      var instance,
          remove_text = function() {

            $( document.body ).on('click', '.bonzer-inputs.input-wrapper button.remove', function ( e ) {

              $( this ).parents( '.bonzer-inputs.input-wrapper' ).find( '.input, input' ).val( '' ).change();

              e.preventDefault();
              e.stopPropagation();

            });

          };

      instance = instance || remove_text;

      return function(){
        instance();
      };

    } ( jQuery ) ),

    /*==========================================================
     * ICON INPUT-TYPE TOGGLE
     *==========================================================*/
    icons_toggle: function () {

      var instance,
          $icon_input_wrapper = $( ".icon-input-wapper" );

      var Toggler = {

        wrapper: ".icon-input-wapper",

        _cache_dom: function() {

          this.$wrapper            = $( ".icon-input-wapper" );
          this.$icons              = this.$wrapper.find( '.all-icons' );
          this.$icons_type_wrapper = this.$wrapper.find('.icon-types-wrapper');

        },

        _bind_events: function() {

          var _this = this;

          $( document.body ).on( "focus", ".icon-input-wapper .input", function(e){

            var $wrapper = $( e.currentTarget ).parents( _this.wrapper );

            _this.show_icons( e, $wrapper );
          });

          $( document.body ).on( "click", ".icon-input-wapper .close-popup", function(e){

            var $wrapper = $( this ).parents( _this.wrapper );

            _this.hide_icons( e, $wrapper);
          });

          $( document.body ).on( "click", ".icon-input-wapper .icon-types-wrapper a", function(e){

            var $wrapper = $( e.currentTarget ).parents( _this.wrapper );

            _this.show_icons_category( e, $wrapper );
          });

          $(document.body).on( "click", ".icon-input-wapper .icons li a", function(e){

            var $wrapper = $( e.currentTarget ).parents( _this.wrapper );

            _this.select_icon( e, $wrapper );
          });

          $( document.body ).on( "click", ".icon-input-wapper .remove", function ( e ) {

            var $wrapper = $( e.currentTarget ).parents( _this.wrapper );

            _this.remove_icon( e, $wrapper );
          });

        },

        init: function () {

          this._cache_dom();
          this._init();
          this._bind_events();
          // hide close button initially
          $icon_input_wrapper.find( ".close-popup" ).hide();

        },

        _init: function() {

          var _this = this;

          $icon_input_wrapper.each( function() {
            _this._append_icon( $( this ).find('.input') );
          });      

        },

        _append_icon: function ( $input ){

          var $input     = $input || $icon_input_wrapper.find( ".input" ),
              icon_class = $input.val(),
              icon;

          if ( icon_class ) {

            icon = $('body').find('.bonzer-inputs-all-icons.original').find('a[data-icon-class="'+icon_class+'"]').html();

            $input.siblings('.icon-holder').html(icon);

          }

        },

        show_icons: function( e, $wrapper ){

          var this_obj            = this,
              $input              = $( e.currentTarget ),
              $icon_input_wrapper = $input.parents( this_obj.wrapper ),
              $icons              = $wrapper.find( '.bonzer-inputs-all-icons' ),
              $icons_cloned;

          if ( ! $icons.length ) {
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
          if ( $wrapper.find('.icon-types-wrapper li.active').length === 0 ) {

            $wrapper.find('.icon-types-wrapper li:first a').trigger('click');

          };     

          e.stopPropagation();     
          e.preventDefault();

        },
        remove_icon: function ( e, $wrapper ){

          $wrapper.find('.icon-holder').empty();

          e.stopPropagation();
          e.preventDefault();
        },

        show_icons_category: function(e, $wrapper){

          var $this  = $( e.currentTarget ),
              target = $this.data( 'target' ) + '-type-icons';

          $this.parent( 'li' ).addClass( 'active' ).siblings().removeClass( 'active' );
          $wrapper.find( '[data-target-id="'+target+'"]' ).fadeIn().siblings( '.icons-wrapper' ).hide();

          e.stopPropagation();
          e.preventDefault();

        },

        select_icon: function ( e, $wrapper ) {

          var $this  = $( e.currentTarget ),
              $class = $this.data( "icon-class" ),
              $input = $wrapper.find('.input');

          $input.val( $class ).change();
          $wrapper.find('.bonzer-inputs-all-icons').hide();
          $wrapper.find( ".close-popup" ).hide();

          this._append_icon( $input );

          e.preventDefault();
          e.stopPropagation();

        },

        hide_icons: function ( e , $wrapper ) {

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

        var $this  = $( this ),
            value  = $this.val(),
            $icons = $this.parents( "ul.bonzer-inputs-all-icons" );

        if ( value ) {

          $icons.find( "li" ).not( ".icons-search-form, .icon-types-wrapper, .icon-types-wrapper ul li" ).hide();

        } else {

          $icons.find( "li" ).show();

        }

        $icons.find( "li.icons-wrapper" ).each( function () {

          $this = $( this );

          var value_regex     = new RegExp( value ),
              $target_element = $this.find( "ul.icons" ).find( 'a' );

          $target_element.each( function () {

            var $icon      = $( this ),
                icon_class = $icon.attr( "data-icon-class" ),
                synoniums  = $icon.attr( "data-synoniums" );

            if ( value_regex.test( icon_class ) || value_regex.test( synoniums ) ) {
              $icon.parents( 'li' ).show();
            }

          } );
        } );

        e.preventDefault();
        e.stopPropagation();
      } );
    },

    /*==========================================================
     * Calendar
     *==========================================================*/
    calendar: (function ( ) {

      $.datepicker.setDefaults( {pickerClass: 'calendar-input'} );

      var _activate_calendar = function ( $input_wrapper, callback ) {

        var $input = $input_wrapper.find( '.calendar-input' ),
            id     = $input.attr( 'id' );

        $input.removeClass( 'hasDatepicker' );

        callback.call( this, id );

      };

      return {

        text: function ( $wrapper ) {

          $wrapper = $wrapper || $( 'body' );

          $wrapper.find( '.calendar-input-wapper' ).each( function ( index, input_wrapper ) {

            var $input_wrapper = $( input_wrapper );

            _activate_calendar.call( this, $input_wrapper, function ( id ) {

              $input_wrapper.find( 'input#' + id ).datepicker( {
                changeMonth: true,
                changeYear: true,
                "dateFormat": 'dd-M-yy',
              } );

            } );
          } );
        },

        multi_text: function ( $wrapper ) {

          $wrapper = $wrapper || $( 'body' );

          $wrapper.find( '.multi-text-calendar-input-wapper' ).each( function ( index, input_wrapper ) {

            var $input_wrapper = $( input_wrapper );

            _activate_calendar.call( this, $input_wrapper, function ( id ) {

              $input_wrapper.find( 'input#' + id ).datepicker( {
                changeMonth: true,
                changeYear: true,
                "dateFormat": 'dd-M-yy',
                onSelect: function () {
                  $( this ).parents( '.bonzer-inputs.input-wrapper' ).find( '.add' ).trigger( 'click' );
                }
              } );
            } );
          } );
        }
      }
    }( )),

    handle_input_fields: (function () {

      var Inputs = {
        /**
         * -------------------------------------------------------------------------
         * Initializer
         * -------------------------------------------------------------------------
         * 
         * @return {void}
         */
        init: function ( ) {
          this.multi_text().init();
          this.multi_select();
          this.select();
          this.radio();
          this.conditional();
          this.checkbox();
        },

        checkbox: function(){

          $('.input-wrapper.bonzer-inputs input.checkbox-input').on('change', function(){

            var $this      = $(this),
                prev_value = $this.val(),
                new_value  = prev_value == 'yes' ? 'no' : 'yes';

            $this.val(new_value);

          });

        },
        /**
         * -------------------------------------------------------------------------
         * Handle Multi Text Input
         * -------------------------------------------------------------------------
         * 
         * @return {void}
         */
        multi_text: function ( ) {
        
          var Item = function ( value, index ) {
            this.value = value;
            this.index = index;
          };

          Item.prototype.html = function () {

            // li
            var $li = $( '<li></li>', {
              'class': 'inline',
              'data-value': this.value
            } );

            // p
            var $p = $( '<p></p>', {
              'class': 'value',
              text: this.value
            } ).appendTo( $li );

            // Remove
            $( '<i></i>', {
              'class': 'fa fa-times-circle remove-item',
              'title': 'Remove'
            } ).prependTo( $p );

            // Index
            $( '<i></i>', {
              'class': 'item-index',
              'text': this.index
            } ).prependTo( $p );

            // Move
            $( '<i></i>', {
              'class': 'fa fa-arrows move-item',
              'title': 'Move'
            } ).prependTo( $p );

            return $li;

          };

          return {

            items: {},

            init: function () {

              this._cache_dom();
              this._init();
              this._bind_events();
            },

            _init: function () {

              var _this = this,
                  values_string,
                  id;

              this.$wrapper.each( function ( index, wrapper ) {

                var $wrapper = $( wrapper );

                values_string     = $wrapper.find( '.input.all-values' ).val();                
                id                = $wrapper.find( '.input.all-values' ).attr( 'name' );
                _this.items[ id ] = values_string ? values_string.split( '|' ) : [];

                if ( _this.items[ id ].length > 0 ) {

                  $wrapper.find( '.values-entered' ).addClass( 'has-values' );
                  _this._render_items( $wrapper );

                }
                
              } );

            },

            _cache_dom: function () {

              this.wrapper  = '.multi-text-input-wapper';
              this.$wrapper = $( '.multi-text-input-wapper' );

            },

            _bind_events: function () {

              var _this = this;

              $( document.body ).on( 'keypress', this.wrapper + ' .input.text', function ( e ) {

                var $input   = $( e.currentTarget ),
                    $wrapper = $input.parents( _this.wrapper );

                if ( e.which === 13 ) {
                  _this.add_item( e, $wrapper );
                }

              } );

              $( document.body ).on( 'click', this.wrapper + ' .add', function ( e ) {

                var $button = $( e.currentTarget ),
                    $wrapper = $button.parents( _this.wrapper );

                _this.add_item.call( _this, e, $wrapper );

              } );

              $( document.body ).on( 'click', this.wrapper + ' .values-entered li i.remove-item', function ( e ) {

                var $button  = $( e.currentTarget ),
                    $wrapper = $button.parents( _this.wrapper );

                _this.remove_item( e, $wrapper );

              } );

              $( document.body ).on( 'mouseenter', this.wrapper + ' .values-entered', function ( e ) {

                var $ul = $( e.currentTarget );

                _this.reorder( $ul.parents( _this.wrapper ) );

                e.stopPropagation();

              } );

            },
            add_item: function ( e, $wrapper ) {

              var $this  = $( e.currentTarget ),
                  $input = $wrapper.find( '.input.text' ),
                  value  = $input.val().trim(),
                  $ul    = $wrapper.find( '.values-entered' ),
                  id     = $wrapper.find( '.input.all-values' ).attr( 'name' );

              if ( $.inArray( value, this.items[ id ] ) === -1 && value !== '' ) {

                this.items[ id ] = this.items[ id ] || [];
                this.items[ id ].push( value );

                this._render_items( $wrapper );

                if ( ! $ul.hasClass('has-values') ) {
                  $ul.addClass( 'has-values' );
                };

                setTimeout( function () {
                  $input.val( '' );
                }, 10 );

              }

              e.preventDefault();
              e.stopPropagation();
            },

            remove_item: function ( e, $wrapper ) {

              var $button = $( e.currentTarget ),
                  $li     = $button.parent().parent( 'li' ),
                  index   = $li.index(),
                  id      = $wrapper.find( '.input.all-values' ).attr( 'name' );

              this.items[ id ].splice( index, 1 );

              $wrapper.find( '.input.all-values' ).val( this.items[id].join( '|' ) ).change();
              $li.remove();
              this._reindex_items( $wrapper );

              if ( this.items[ id ].length === 0 ) {
                $wrapper.find( '.values-entered' ).removeClass( 'has-values' );
              }

              e.preventDefault();
              e.stopPropagation();

            },

            reorder: function ( $wrapper ) {

              var _this = this,
                  id    = $wrapper.find( '.input.all-values' ).attr( 'name' );

              $wrapper.find( '.values-entered' ).sortable( {
                handle: ".move-item",
                containment: "parent",
                placeholder: "sortable-placeholder",

                stop: function ( event, ui ) {

                  var $item           = $( ui.item );
                      _this.items[id] = $item.parent( 'ul' ).find( 'li' ).map( function ( index, li ) {
                                          return $( li ).data( 'value' );
                                        } ).toArray();

                  $item.parents( '.bonzer-inputs.input-wrapper' ).find( '.input.all-values' ).val( _this.items[ id ].join( '|' ) ).change();
                  _this._reindex_items( $item.parents( '.bonzer-inputs.input-wrapper' ) );
                }

              } );
            },
            _reindex_items: function ( $wrapper ) {

              $wrapper.find( '.values-entered li' ).each( function ( index, li ) {

                $( li ).find( '.item-index' ).text( index + 1 );
              } );

            },
            _render_items: function ( $wrapper ) {

              var item, 
                  $item,
                  $items_holder = $wrapper.find( '.values-entered' ),
                  id            = $wrapper.find( '.input.all-values' ).attr( 'name' );

              $items_holder.empty();
              $wrapper.find( '.input.all-values' ).val( this.items[id].join( '|' ) ).change();

              $.each( this.items[ id ], function ( index, value ) {

                item  = new Item( value, index + 1 );
                $item = item.html();

                $items_holder.append( $item );
              } );
            }
          };
        },
        /**
         * -------------------------------------------------------------------------
         * Handles Radio Inputs
         * -------------------------------------------------------------------------
         * 
         * @param {selector} $wrapper
         * @return {void}
         */
        radio: function ( ) {

          $( document.body ).on( 'click', '.radio-input-wapper .radio-input', function ( e ) {

            var $this = $( e.currentTarget );

            $this.parents( ".radio-input-wapper" ).find( ".input" ).val( $this.val() ).change();

            e.stopPropagation();
          } );
        },
        /**
         * -------------------------------------------------------------------------
         * Handles Multi Select Inputs
         * -------------------------------------------------------------------------
         * 
         * @return {void}
         */
        multi_select: function () {

          $( document.body ).on( 'change', '.multi-select-input-wapper select', function ( e ) {

            var $this = $( e.currentTarget ),
                value = $this.val();

            $this.parents( ".multi-select-input-wapper" )
                 .find( ".input" )
                 .val( value ).change();

            e.stopPropagation();
            e.preventDefault();
          } );
        },
        /**
         * -------------------------------------------------------------------------
         * Handles Select Inputs
         * -------------------------------------------------------------------------
         * 
         * @return {void}
         */
        select: function () {

          $( document.body ).on( 'change', '.select-input-wapper select', function ( e ) {

            var $this = $( e.currentTarget ),
                value = $this.val();

            $this.find( 'option' ).each( function ( index, option ) {

              if ( $( option ).val() === value ) {

                $( option ).prop( 'selected', true );
                $( option ).attr( 'selected', true );

              } else {

                $( option ).prop( 'selected', false );
                $( option ).removeAttr( 'selected' );
              }

            } );
            e.stopPropagation();
            e.preventDefault();
          } );
        },
        /**
         * -------------------------------------------------------------------------
         * Handle Conditionals
         * -------------------------------------------------------------------------
         * 
         * @return {void}
         */
        conditional: function () {

          var $input_wrapper = $( ".bonzer-inputs.input-wrapper" );

          $input_wrapper.each( function () {

            var $this = $( this );
            /*==========================================================
             * Conditionals
             *==========================================================*/
            if ( $this.data( 'showif' ) && $.isArray( $this.data( 'showif' ) ) ) {

              var conditionals = $this.data( 'showif' );

              $.each( conditionals, function ( index, conditional ) {

                var value,
                    toggle_conditinal_inputs = function ( $this_input ) {

                      value = ($this_input.is( ':checkbox' )) ? $this_input.filter( ':checked' ).val() : $this_input.val();

                      if ( value === conditional['value'] ) {

                        $this.removeClass( 'hidden' );

                      } else {

                        $this.addClass( 'hidden' );

                      }

                    };

                $( "#" + conditional['id'] ).on( 'change blur click keyup', function () {

                  var $this_input = $( this );

                  setTimeout( function () {
                    toggle_conditinal_inputs( $this_input );
                  }, 10 );

                } );

                toggle_conditinal_inputs( $( "#" + conditional['id'] ) );
              } );
            }
          } );
        },       
      };

      return Inputs;
    }( )),

    chosen: function ( $wrapper ) {

      var $input_wrapper,
          is_wrapper = $wrapper ? true : false;

      $wrapper = $wrapper || $( 'body' );

      if ( $wrapper.is('.multi-select-input-wapper') ) {
        $input_wrapper = $wrapper;
      } else{
        $input_wrapper = $wrapper.find( '.multi-select-input-wapper' );
      }

      return {
        activate: function () {

          if ( ! is_wrapper ) {

            $input_wrapper.each(function () {

              var $this = $(this);

              if ( ! $this.is( ':hidden' )) {
                $this.find( 'select' ).chosen();
              }

            });

          } else {

            if ( ! $input_wrapper.is( ':hidden' )) {
              $input_wrapper.find( 'select' ).chosen();
            }

          }
          
        },
        deactivate: function () {

          $input_wrapper.find( '.chosen-container' ).remove();
          $input_wrapper.find( 'select' ).show();

        }
      }
    },

    color: function () {

      var wrapper = '.color-input-wapper',
          counter = 0;

      function color_picker( ) {

        $( ".color-picker" ).spectrum( {
          color: $( this ).val(),
          showInput: true,
          className: "full-spectrum",
          showInitial: false,
          showPalette: true,
          showSelectionPalette: false,
          // maxSelectionSize: 10,
          preferredFormat: "hex",
          localStorageKey: "bonzer_spectrum.demo",
          showAlpha: true,
          palette: [
            [
              "rgb(0, 0, 0)", 
              "rgb(67, 67, 67)", 
              "rgb(102, 102, 102)",
              "rgb(204, 204, 204)", 
              "rgb(217, 217, 217)", 
              "rgb(255, 255, 255)"
            ],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
              "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
              "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
              "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
              "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
              "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
              "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
              "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
              "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
              "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
              "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
          ]
        } );
      };
      color_picker();

      // $( document.body ).on( 'mouseenter', wrapper, function ( e ) {

      //   if ( $( wrapper ).find( '.full-spectrum' ).length ) {
      //     $( wrapper ).find( '.full-spectrum' ).spectrum("destroy");
      //     // $( wrapper ).find( ".full-spectrum" ).remove();
      //   }   

      //   color_picker();

      //   e.preventDefault();
      //   e.stopPropagation();
      // } );

    },

    tooltip: function(){

      $.widget.bridge('uitooltip', $.ui.tooltip);

      $( '.bonzer-inputs.input-wrapper .button.remove, .bonzer-inputs.input-wrapper .button.add' ).uitooltip({

        position: {
          my: "center bottom-0",
          at: "center top",
          using: function( position, feedback ) {
            $( this ).css( position );
            $( "<div>" )
              .addClass( "arrow" )
              .addClass( feedback.vertical )
              .addClass( feedback.horizontal )
              .appendTo( this );
          }
        }
      });
    }
  };

  inputs.tooltip();
  inputs.remove_text();
  inputs.color();
  inputs.icons_toggle();
  inputs.search_icon();
  inputs.calendar.text();
  inputs.calendar.multi_text();
  inputs.handle_input_fields.init();  
  inputs.chosen().activate();
  
  $( document.body ).on( 'mouseenter', '.multi-select-input-wapper', function ( e ) {

    var $this = $(e.currentTarget);
    inputs.chosen($this).activate();

    e.preventDefault();
    e.stopPropagation();
  } );
  $( document.body ).on( 'mouseleave', '.multi-select-input-wapper', function ( e ) {

    var $this = $( e.currentTarget );
    // bonzer_inputs.chosen( $this ).deactivate();
    e.preventDefault();
    e.stopPropagation();
  } );
  
  (function add_style_type(){

    $(".bonzer-inputs.bonzer-inputs.input-wrapper").each(function () {
      $(this).addClass(bonzer_inputs.style_type);
    });
    
  }());
  
  $.extend(bonzer_inputs, inputs);
});