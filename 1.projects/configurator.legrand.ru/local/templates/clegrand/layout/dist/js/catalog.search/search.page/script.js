"use strict";

$(function () {
  var countInputWord = 0,
      searchBlock = $('.search-result-js'),
      url = '/local/templates/clegrand/ajax/specification/search/index.php',
      timerId;
  $(document).on('click', '.search-js', function (event) {
    event.preventDefault();
    var arQueryRaw = $('input[name="q"]').val().trim().split(' '),
        arQuery = arQueryRaw.filter(function (searchWord) {
      return searchWord.length > 1;
    }),
        query = arQuery.join('+');
    search(url, query);
  });
  $(document).on('keyup', 'input[name="q"]', function (event) {
    var _this = $(this),
        arQueryRaw = _this.val().trim().split(' ');

    var arQuery = arQueryRaw.filter(function (searchWord) {
      return searchWord.length > 1;
    }),
        query = arQuery.join('+');
    countInputWord = query.length;

    switch (event.keyCode) {
      case 13: //enter

      case 27: //escape

      case 32: //spacebar

      case 37: //left arrow

      case 38: //up arrow

      case 39: //right arrow

      case 40:
        //down arrow
        break;

      default:
        search(url, query);
        break;
    }
  });
  $(document).on('keydown', 'input[name="q"]', function (event) {
    switch (event.keyCode) {
      case 13: //enter

      case 27:
        //escape
        searchBlock.hide();
        return false;
        break;

      case 32: //spacebar

      case 37: //left arrow

      case 38: //up arrow

      case 39: //right arrow

      case 40:
        //down arrow
        break;
    }
  });
  $('body').mouseup(function (event) {
    var targetBlock = event.target;

    if (!searchBlock.is(targetBlock) && searchBlock.has(targetBlock).length === 0) {
      searchBlock.hide();
    }
  });
  $(document).on('click', 'input[name="q"]', function (event) {
    if (countInputWord > 2) {
      searchBlock.show();
    }

    event.stopPropagation();
  });

  function searchAjax(url, query) {
    $.ajax({
      url: url + '?q=' + query + '&how=r',
      type: 'GET',
      dataType: 'html',
      success: function success(html, textStatus) {
        if (textStatus == 'success' && typeof html === 'string') {
          if (html !== '') {
            searchBlock.find('.search__list').html(html);
          } else {
            searchBlock.find('.search__list').html('<li><p>Сожалеем, но ничего не найдено.</p></li>');
          }

          searchBlock.removeClass('load');
        }
      },
      error: function error() {
        console.log('Error search!');
      },
      complete: function complete(jqXHR, textStatus) {
        if (jqXHR.status == 200 && textStatus == 'success') {
          searchBlock.show();
        }
      }
    });
  }

  function search(url, query) {
    if (query.length > 2) {
      // очитка поискового поля
      //searchBlock.find('.search__list').html('');
      searchBlock.show();
      searchBlock.addClass('load');
      clearTimeout(timerId);
      timerId = setTimeout(searchAjax, 600, url, query);
    } else {
      searchBlock.hide();
    }
  }
});