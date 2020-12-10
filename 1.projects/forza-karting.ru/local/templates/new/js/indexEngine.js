/*
    jQuery Masked Input Plugin
    Copyright (c) 2007 - 2014 Josh Bush (digitalbush.com)
    Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
    Version: 1.4.0
*/
/*!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(a.length<o.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a)},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});*/
// Form Validation

window.onload = function() {
  //alert( 'Документ и все ресурсы загружены' );
};

jQuery.fn.validate = function() {
  var form = $(this);

  form.attr('valid', 1);
  $('.email', form).each(function() {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/;
    var id = $(this).attr('id');

    if ($(this).val() && filter.test($(this).val())) {
      $(this).removeClass('error');
      $('label[for=' + id + ']').removeClass('error');
    } else {
      $(this).addClass('error');
      $('label[for=' + id + ']').addClass('error');
      form.attr('valid', 0);
    }
  });
  $('.phone', form).each(function() {
    var filter = /^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/;
    var id = $(this).attr('id');

    if ($(this).val() && filter.test($(this).val())) {
      $(this).removeClass('error');
      $('label[for=' + id + ']').removeClass('error');
    } else {
      $(this).addClass('error');
      $('label[for=' + id + ']').addClass('error');
      form.attr('valid', 0);
    }
  });
  $('.required', form).each(function() {
    var id = $(this).attr('id');
    if ($(this).val() && $(this).val() != '') {
      $(this).removeClass('error');
      //$("label[for="+id+"]").removeClass("error");
    } else {
      $(this).addClass('error');
      //$("label[for="+id+"]").addClass("error");
      form.attr('valid', 0);
    }
  });
  $('.error').focus(function() {
    $(this).removeClass('error');
  });
  if (form.attr('valid') == 0)
    return false;
};

GetNoun = function(number, one, two, five) {
  number = Math.abs(number);
  number %= 100;
  if (number >= 5 && number <= 20) {
    return five;
  }
  number %= 10;
  if (number == 1) {
    return one;
  }
  if (number >= 2 && number <= 4) {
    return two;
  }
  return five;
};

function updateCheck() {
  var x = 0;
  var total = 0;
  $('#books').empty();
  if ($('#books').length == 0) return;

  $('.check').each(function() {
    var cost = $(this).data('cost');
    var num = $(this).data('num');
    var time = $(this).data('time');
    var race = $(this).data('race');
    var col = $('.check[data-num=' + num + ']').length;
    $('#books').
        append('<input type="hidden" name="book[]" value="' + cost + '">');
    $('#books').
        append('<input type="hidden" name="num[]" value="' + num + '">');
    $('#books').
        append('<input type="hidden" name="race[]" value="' + race + '">');
    total = total + parseInt(cost);
    x++;
  });

  /*$("#modal_booking table").html('');
  $.post("/ajax/total.php",{},function(data){
    $("#modal_booking table").html(data);
  });*/

  total = total + parseInt($('#other_total').val());
  x = x + parseInt($('#other_col').val());
  if (x > 0) {
    $('.cart .total').
        html(x + ' ' + GetNoun(x, 'машина', 'машины', 'машин') + ', ' + total +
            ' Р');
    $('.menu .m_right').addClass('active').removeClass('m_center-index');
  } else {
    $('.menu .m_right').removeClass('active').addClass('m_center-index');
  }

  $('#books').
      append('<input type="hidden" name="total" value="' + total + '">');
}

$(function() {
  // $(".phone").inputmask("+7 (999) 999-99-99");

  updateCheck();
  $('.line_race').on('click', function() {
    $('#race').modal().open();
    return false;
  });

  $('.col2').on('click', function() {
    $(this).prev().toggleClass('check');

    var date = $(this).prev().data('date');
    var line = $(this).prev().data('num');
    var cost = $(this).prev().data('cost');
    var time = $(this).prev().data('time');
    var type = $(this).prev().data('type');
    var col = $('.check').length;
    var col2 = $('.check').length;
    /*$.post("/ajax/cart.php",{date:date,line:line,col:col,cost:cost,time:time,type:type},function(date){
      
    });*/
    updateCheck();

    return false;
  });

  $('.payment').click(function() {
    $.post('/ajax/save_tmp_places.php', $('#booking').serialize(),
        function(data) {
          if ($('#auth').length > 0) {
            if ($('#auth').modal) {
              $('#auth').modal().open();
            } else {
              location.href = '/booking/';
            }
          } else {
            $('#booking').submit();
          }
        });
    return false;
  });

  // ajax отправка
  $('.sendform').click(function() {
    var name = $(this).attr('rel');
    var item = 'form[name=' + name + ']';
    var form = $(item).clone();
    $(item).validate();

    if ($(item).attr('valid') == 1) {
      $.post('/ajax/form.' + name + '.php', $(item).serialize(),
          function(data) {
            if (data != undefined) {
              $(item).find('.error-container').html(data);
              return;
            }
          });
    } else {
      // TODO document.location="#"+name;
    }
    return false;
  });

  // простая отправка
  $('.submit').click(function() {
    var name = $(this).attr('rel');
    var form = $('form[name=' + name + ']:first ');
    form.validate();
    if (form.attr('valid') == 1) {
      form.submit();
      return false;
    } else {
      return false;
    }
  });

  $('form').submit(function() {
    if ($('.sendform', $(this)).length == 1) {
      var name = $('.sendform', $(this)).attr('rel');
      var item = $(this);
      item.validate();
      if (item.attr('valid') == 1) {
        $.post('/ajax/form.' + name + '.php', $(item).serialize(),
            function(data) {
              $(item).html(data);
            });
      }
      return false;
    } else {
      $(this).validate();
      if ($(this).attr('valid') == 1) {
        return true;
      } else {
        return false;
      }
    }
  });

  //$('#modal_booking').modal().open();  

  $('.open_modal').on('click', function() {
    var modal = $(this).data('modal');
    $('#' + modal).modal().open();

    $('#modal_booking table').html('');
    $.post('/ajax/total.php', {}, function(data) {
      $('#modal_booking table').html(data);
    });

    return false;
  });

  $('.modal .close, .modal .closed').on('click', function(e) {
    e.preventDefault();
    $.modal().close();
  });

  $('.hint .close').click(function() {
    $(this).parent().remove();
    return false;
  });

  $('.js-save-tmp-places').on('click', function() {
    event.preventDefault();
    event.stopPropagation();
    url = $(this).attr('href');

    $.post('/ajax/save_tmp_places.php', $('#booking').serialize(),
        function(data) {
          location.href = url;
        });

    return false;
  });
});