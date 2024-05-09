/*
 * Note that this is atoastr v2.1.3, the "latest" version in url has no more maintenance,
 * please go to https://cdnjs.com/libraries/atoastr.js and pick a certain version you want to use,
 * make sure you copy the url from the website since the url may change between versions.
 * */
window.atoastr=function(h){var v,t,C,w=0,n="error",o="info",i="success",a="warning",e={clear:function(e,t){var s=b();v||T(s);r(e,s,t)||function(e){for(var t=v.children(),s=t.length-1;0<=s;s--)r(h(t[s]),e)}(s)},remove:function(e){var t=b();v||T(t);if(e&&0===h(":focus",e).length)return void D(e);v.children().length&&v.remove()},error:function(e,t,s){return l({type:n,iconClass:b().iconClasses.error,message:e,optionsOverride:s,title:t})},getContainer:T,info:function(e,t,s){return l({type:o,iconClass:b().iconClasses.info,message:e,optionsOverride:s,title:t})},options:{},subscribe:function(e){t=e},success:function(e,t,s){return l({type:i,iconClass:b().iconClasses.success,message:e,optionsOverride:s,title:t})},version:"2.1.4",warning:function(e,t,s){return l({type:a,iconClass:b().iconClasses.warning,message:e,optionsOverride:s,title:t})}};return e;function T(e,t){return e||(e=b()),(v=h("#"+e.containerId)).length||t&&(s=e,(v=h("<div/>").attr("id",s.containerId).addClass(s.positionClass)).appendTo(h(s.target)),v=v),v;var s}function r(e,t,s){var n=!(!s||!s.force)&&s.force;return!(!e||!n&&0!==h(":focus",e).length)&&(e[t.hideMethod]({duration:t.hideDuration,easing:t.hideEasing,complete:function(){D(e)}}),!0)}function O(e){t&&t(e)}function l(t){var o=b(),e=t.iconClass||o.iconClass;if(void 0!==t.optionsOverride&&(o=h.extend(o,t.optionsOverride),e=t.optionsOverride.iconClass||e),!function(e,t){if(e.preventDuplicates){if(t.message===C)return!0;C=t.message}return!1}(o,t)){w++,v=T(o,!0);var i=null,a=h("<div/>"),s=h("<div/>"),n=h("<div/>"),r=h("<div/>"),l=h(o.closeHtml),c={intervalId:null,hideEta:null,maxHideTime:null},d={atoastId:w,state:"visible",startTime:new Date,options:o,map:t};return t.iconClass&&a.addClass(o.atoastClass).addClass(e),function(){if(t.title){var e=t.title;o.escapeHtml&&(e=u(t.title)),s.append(e).addClass(o.titleClass),a.append(s)}}(),function(){if(t.message){var e=t.message;o.escapeHtml&&(e=u(t.message)),n.append(e).addClass(o.messageClass),a.append(n)}}(),o.closeButton&&(l.addClass(o.closeClass).attr("role","button"),a.prepend(l)),o.progressBar&&(r.addClass(o.progressClass),a.prepend(r)),o.rtl&&a.addClass("rtl"),o.newestOnTop?v.prepend(a):v.append(a),function(){var e="";switch(t.iconClass){case"atoast-success":case"atoast-info":e="polite";break;default:e="assertive"}a.attr("aria-live",e)}(),a.hide(),a[o.showMethod]({duration:o.showDuration,easing:o.showEasing,complete:o.onShown}),0<o.timeOut&&(i=setTimeout(p,o.timeOut),c.maxHideTime=parseFloat(o.timeOut),c.hideEta=(new Date).getTime()+c.maxHideTime,o.progressBar&&(c.intervalId=setInterval(f,10))),function(){o.closeOnHover&&a.hover(m,g);!o.onclick&&o.tapToDismiss&&a.click(p);o.closeButton&&l&&l.click(function(e){e.stopPropagation?e.stopPropagation():void 0!==e.cancelBubble&&!0!==e.cancelBubble&&(e.cancelBubble=!0),o.onCloseClick&&o.onCloseClick(e),p(!0)});o.onclick&&a.click(function(e){o.onclick(e),p()})}(),O(d),o.debug&&console&&console.log(d),a}function u(e){return null==e&&(e=""),e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}function p(e){var t=e&&!1!==o.closeMethod?o.closeMethod:o.hideMethod,s=e&&!1!==o.closeDuration?o.closeDuration:o.hideDuration,n=e&&!1!==o.closeEasing?o.closeEasing:o.hideEasing;if(!h(":focus",a).length||e)return clearTimeout(c.intervalId),a[t]({duration:s,easing:n,complete:function(){D(a),clearTimeout(i),o.onHidden&&"hidden"!==d.state&&o.onHidden(),d.state="hidden",d.endTime=new Date,O(d)}})}function g(){(0<o.timeOut||0<o.extendedTimeOut)&&(i=setTimeout(p,o.extendedTimeOut),c.maxHideTime=parseFloat(o.extendedTimeOut),c.hideEta=(new Date).getTime()+c.maxHideTime)}function m(){clearTimeout(i),c.hideEta=0,a.stop(!0,!0)[o.showMethod]({duration:o.showDuration,easing:o.showEasing})}function f(){var e=(c.hideEta-(new Date).getTime())/c.maxHideTime*100;r.width(e+"%")}}function b(){return h.extend({},{tapToDismiss:!0,atoastClass:"atoast",containerId:"atoast-container",debug:!1,showMethod:"fadeIn",showDuration:300,showEasing:"swing",onShown:void 0,hideMethod:"fadeOut",hideDuration:1e3,hideEasing:"swing",onHidden:void 0,closeMethod:!1,closeDuration:!1,closeEasing:!1,closeOnHover:!0,extendedTimeOut:1e3,iconClasses:{error:"atoast-error",info:"atoast-info",success:"atoast-success",warning:"atoast-warning"},iconClass:"atoast-info",positionClass:"atoast-top-right",timeOut:5e3,titleClass:"atoast-title",messageClass:"atoast-message",escapeHtml:!1,target:"body",closeHtml:'<button type="button">&times;</button>',closeClass:"atoast-close-button",newestOnTop:!0,preventDuplicates:!1,progressBar:!1,progressClass:"atoast-progress",rtl:!1},e.options)}function D(e){v||(v=T()),e.is(":visible")||(e.remove(),e=null,0===v.children().length&&(v.remove(),C=void 0))}}(window.jQuery);


jQuery( document ).ready(function() {

  /**
   * [bState Change Button State]
   * @param  {[type]} _state [description]
   * @return {[type]}        [description]
   */
  jQuery.fn.bootButton = function(_state) {

    //  Empty
    if(!this[0])return;

    if(_state == 'loading')
      this.attr('data-reset-text',this.html());

    if(_state == 'loading') {

      if(!this[0].dataset.resetText) {
        this[0].dataset.resetText = this.html();
      }

      this.addClass('disabled').attr('disabled','disabled').html('<i class="fa fa-circle-o-notch fa-spin"></i> ' + this[0].dataset.loadingText);
    }
    else if(_state == 'reset')
      this.removeClass('disabled').removeAttr('disabled').html(this[0].dataset.resetText);
    else if(_state == 'update')
      this.removeClass('disabled').removeAttr('disabled').html(this[0].dataset.updateText);
    else
      this.addClass('disabled').attr('disabled','disabled').html(this[0].dataset[_state+'Text']);
  };

  //  Serialize the Form
  jQuery.fn.ASLSerializeObject = function(){var o={};var a=this.serializeArray();jQuery.each(a,function(){if(o[this.name]!==undefined){if(!o[this.name].push){o[this.name]=[o[this.name]];}o[this.name].push(this.value||'');}else{o[this.name]=this.value||'';}});return o;};

  (function($) {
    
    var container = document.querySelector('#sl-frm.asl-form');


    //  Main container is missing!
    if(!container) {
      return;
    }



    //http://getbootstrap.com/customize/?id=23dc7cc41297275c7297bb237a95bbd7
    if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(t){"use strict";var e=t.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1||e[0]>3){}}(jQuery),+function(t){"use strict";function e(e){var n=e.attr("data-target");n||(n=e.attr("href"),n=n&&/#[A-Za-z]/.test(n)&&n.replace(/.*(?=#[^\s]*$)/,""));var i=n&&t(n);return i&&i.length?i:e.parent()}function n(n){n&&3===n.which||(t(a).remove(),t(o).each(function(){var i=t(this),a=e(i),o={relatedTarget:this};a.hasClass("open")&&(n&&"click"==n.type&&/input|textarea/i.test(n.target.tagName)&&t.contains(a[0],n.target)||(a.trigger(n=t.Event("hide.bs.adropdown",o)),n.isDefaultPrevented()||(i.attr("aria-expanded","false"),a.removeClass("open").trigger(t.Event("hidden.bs.adropdown",o)))))}))}function i(e){return this.each(function(){var n=t(this),i=n.data("bs.adropdown");i||n.data("bs.adropdown",i=new r(this)),"string"==typeof e&&i[e].call(n)})}var a=".adropdown-backdrop",o='[data-toggle="adropdown"]',r=function(e){t(e).on("click.bs.adropdown",this.toggle)};r.VERSION="3.3.7",r.prototype.toggle=function(i){var a=t(this);if(!a.is(".disabled, :disabled")){var o=e(a),r=o.hasClass("open");if(n(),!r){"ontouchstart"in document.documentElement&&!o.closest(".navbar-nav").length&&t(document.createElement("div")).addClass("adropdown-backdrop").insertAfter(t(this)).on("click",n);var s={relatedTarget:this};if(o.trigger(i=t.Event("show.bs.adropdown",s)),i.isDefaultPrevented())return;a.trigger("focus").attr("aria-expanded","true"),o.toggleClass("open").trigger(t.Event("shown.bs.adropdown",s))}return!1}},r.prototype.keydown=function(n){if(/(38|40|27|32)/.test(n.which)&&!/input|textarea/i.test(n.target.tagName)){var i=t(this);if(n.preventDefault(),n.stopPropagation(),!i.is(".disabled, :disabled")){var a=e(i),r=a.hasClass("open");if(!r&&27!=n.which||r&&27==n.which)return 27==n.which&&a.find(o).trigger("focus"),i.trigger("click");var s=" li:not(.disabled):visible a",l=a.find(".adropdown-menu"+s);if(l.length){var d=l.index(n.target);38==n.which&&d>0&&d--,40==n.which&&d<l.length-1&&d++,~d||(d=0),l.eq(d).trigger("focus")}}}};var s=t.fn.adropdown;t.fn.adropdown=i,t.fn.adropdown.Constructor=r,t.fn.adropdown.noConflict=function(){return t.fn.adropdown=s,this},t(document).on("click.bs.adropdown.data-api",n).on("click.bs.adropdown.data-api",".adropdown form",function(t){t.stopPropagation()}).on("click.bs.adropdown.data-api",o,r.prototype.toggle).on("keydown.bs.adropdown.data-api",o,r.prototype.keydown).on("keydown.bs.adropdown.data-api",".adropdown-menu",r.prototype.keydown)}(jQuery),+function(t){"use strict";function e(e){var n,i=e.attr("data-target")||(n=e.attr("href"))&&n.replace(/.*(?=#[^\s]+$)/,"");return t(i)}function n(e){return this.each(function(){var n=t(this),a=n.data("bs.collapse"),o=t.extend({},i.DEFAULTS,n.data(),"object"==typeof e&&e);!a&&o.toggle&&/show|hide/.test(e)&&(o.toggle=!1),a||n.data("bs.collapse",a=new i(this,o)),"string"==typeof e&&a[e]()})}var i=function(e,n){this.$element=t(e),this.options=t.extend({},i.DEFAULTS,n),this.$trigger=t('[data-toggle="collapse"][href="#'+e.id+'"],[data-toggle="collapse"][data-target="#'+e.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};i.VERSION="3.3.7",i.TRANSITION_DURATION=350,i.DEFAULTS={toggle:!0},i.prototype.dimension=function(){var t=this.$element.hasClass("width");return t?"width":"height"},i.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var e,a=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(a&&a.length&&(e=a.data("bs.collapse"),e&&e.transitioning))){var o=t.Event("show.bs.collapse");if(this.$element.trigger(o),!o.isDefaultPrevented()){a&&a.length&&(n.call(a,"hide"),e||a.data("bs.collapse",null));var r=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[r](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var s=function(){this.$element.removeClass("collapsing").addClass("collapse in")[r](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!t.support.transition)return s.call(this);var l=t.camelCase(["scroll",r].join("-"));this.$element.one("bsTransitionEnd",t.proxy(s,this)).emulateTransitionEnd(i.TRANSITION_DURATION)[r](this.$element[0][l])}}}},i.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var e=t.Event("hide.bs.collapse");if(this.$element.trigger(e),!e.isDefaultPrevented()){var n=this.dimension();this.$element[n](this.$element[n]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var a=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return t.support.transition?void this.$element[n](0).one("bsTransitionEnd",t.proxy(a,this)).emulateTransitionEnd(i.TRANSITION_DURATION):a.call(this)}}},i.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},i.prototype.getParent=function(){return t(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(t.proxy(function(n,i){var a=t(i);this.addAriaAndCollapsedClass(e(a),a)},this)).end()},i.prototype.addAriaAndCollapsedClass=function(t,e){var n=t.hasClass("in");t.attr("aria-expanded",n),e.toggleClass("collapsed",!n).attr("aria-expanded",n)};var a=t.fn.collapse;t.fn.collapse=n,t.fn.collapse.Constructor=i,t.fn.collapse.noConflict=function(){return t.fn.collapse=a,this},t(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(i){var a=t(this);a.attr("data-target")||i.preventDefault();var o=e(a),r=o.data("bs.collapse"),s=r?"toggle":a.data();n.call(o,s)})}(jQuery),+function(t){"use strict";function e(){var t=document.createElement("bootstrap"),e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var n in e)if(void 0!==t.style[n])return{end:e[n]};return!1}t.fn.emulateTransitionEnd=function(e){var n=!1,i=this;t(this).one("bsTransitionEnd",function(){n=!0});var a=function(){n||t(i).trigger(t.support.transition.end)};return setTimeout(a,e),this},t(function(){t.support.transition=e(),t.support.transition&&(t.event.special.bsTransitionEnd={bindType:t.support.transition.end,delegateType:t.support.transition.end,handle:function(e){return t(e.target).is(this)?e.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery);
  
  
    // fetch all the forms we want to apply custom style
    var inputs = container.querySelectorAll('.asl-form .form-control');

    // loop over each input and watch blue event
    var validation = Array.prototype.filter.call(inputs, function(input) {
      
      input.addEventListener('focus', function(event) {

        input.parentNode.classList.add('is-focused');
      });

      input.addEventListener('blur', function(event) {
        
        input.parentNode.classList.remove('is-focused');

        // reset
        //input.parentNode.classList.remove('is-invalid')
        input.parentNode.classList.remove('has-error');
        
        if (input.checkValidity && input.checkValidity() === false) {
            input.parentNode.classList.add('has-error');
        }
        /*else {
          input.parentNode.classList.add('is-valid')
        }*/

      }, false);
    });

    var sl_categories = container.querySelector('#sl-categories');

    //  Add a Multiselect dropdown
    if(sl_categories) {

      //  Multiple Categories
      if(asl_form_configuration.single_cat_select == '1') {

      }

      sl_categories = $(sl_categories);
      
      sl_categories.multiselect({
        enableFiltering: false,
        includeFilterClearBtn: false,
        disableIfEmpty: true,
        nonSelectedText: asl_form_configuration.words.select_option,
        filterPlaceholder: asl_form_configuration.words.search || "Search",
        nonSelectedText: asl_form_configuration.words.none_selected || "None Selected",
        nSelectedText: asl_form_configuration.words.selected || "selected",
        allSelectedText: (asl_form_configuration.words.all_selected || "All selected"),
        includeSelectAllOption: false,
        numberDisplayed: 1,
        maxHeight: 400,
        onChange: function(option, checked) {
        }
      });
    }
    
    //  Register button
    var $reg_btn    = $('.asl-cont #sl-btn-save');

    //  Agree Checkbox
    var agree_check = container.querySelector('#sl-agr-check');
    
    if(agree_check) {

      $(agree_check).bind('click', function(e) {

        if(this.checked) {
          $reg_btn.removeClass('disabled');
        }
        else
          $reg_btn.addClass('disabled');
      });
    }


    /**
     * [resetRegisterForm Reset the register form]
     * @return {[type]} [description]
     */
    function resetRegisterForm() {

      Array.prototype.filter.call(inputs, function(input) {

        input.value = '';
      });

      // Disable until agree to check
      if(agree_check) {
        agree_check.checked = false;
        $reg_btn.addClass('disabled');
      }

    };



    
    

    //  Click Event of the save button
    $reg_btn.bind('click', function(e) {

      //  Clear previous messages
      atoastr.clear();

      //  Validate  the agree checkbox
      if(agree_check && !agree_check.checked) {
        agree_check.classList.add('is-invalid');
        return;
      }


      var form_data = {categories: ((sl_categories)? sl_categories.val(): null)},
          is_valid  = true;

      //  Validate these fields
      Array.prototype.filter.call(inputs, function(_input) {

        form_data[_input.name] = _input.value;

        if(['city', 'description', 'country'].indexOf(_input.name) != -1 && !$.trim(_input.value)) {
          _input.parentNode.classList.add('has-error');
          is_valid = false;
        }
      });

      // Validate the Data 
      if(!is_valid) {
        atoastr.error((asl_form_configuration.words.fill_form || 'Please fill up the form.')); 
        return;
      }

      $reg_btn.bootButton('loading');

      //  Add the nounce
      $.ajax({
        url: ASL_FORM.ajax_url,
        data: {action: 'asl_reg_store', form_params: form_data, vkey: ASL_FORM.vkey},
        type: 'POST',
        dataType: 'json',
        /**
         * [success description]
         * @param  {[type]} _data [description]
         * @return {[type]}       [description]
         */
        success: function(_response) {

          //  Reset the button
          $reg_btn.bootButton('reset');

          if (_response.success) {
            atoastr.success(_response.message);
            resetRegisterForm();

            //  When there is a redirect URL
            if(asl_form_configuration.redirect) {
              window.location = asl_form_configuration.redirect;
            }
            
          } else {
            atoastr.error((_response.message || 'Error in registering the form.'));
          }
        },
        /**
         * [error description]
         * @param  {[type]} _data [description]
         * @return {[type]}       [description]
         */
        error: function(_data) {}
      });
      
    });

  })(jQuery);
});
