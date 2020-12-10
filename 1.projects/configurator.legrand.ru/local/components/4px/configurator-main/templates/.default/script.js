/*
 * Фильтр для конфигуратора
 */
$(function () {

    var frame = {
        pathAjaxFileCatalog: '/local/templates/clegrand/ajax/configurator/configurator-catalog-frame/index.php',
        pathAjaxFileFilter: '/local/templates/clegrand/ajax/configurator/configurator-filter-frame/index.php',
        collection: $('select[name="collection"]'),
        color: $('select[name="frame-color"]'),
        material: $('select[name="frame-material"]'),
        class: {
            catalogWrap: 'configurator-catalog-frame-js',
            filterWrap: 'select-col-frame-js',
        },
        type: 'frame'
    };

    var mechanism = {
        pathAjaxFileCatalog: '/local/templates/clegrand/ajax/configurator/configurator-catalog-mechanism/index.php',
        pathAjaxFileFilter: '/local/templates/clegrand/ajax/configurator/configurator-filter-mechanism/index.php',
        collection: $('select[name="collection"]'),
        color: $('select[name="mechanism-color"]'),
        mechanism: $('select[name="mechanism"]'),
        class: {
            catalogWrap: 'configurator-catalog-mechanism-js',
            filterWrap: 'select-col-mechanism-js',
        },
        type: 'mechanism'
    };

    var mechanismFilterIndependent = {
        pathAjaxFileCatalog: '/local/templates/clegrand/ajax/configurator/configurator-catalog-mechanism/index.php',
        pathAjaxFileFilter: '/local/templates/clegrand/ajax/configurator/configurator-filter-mechanism/index.php',
        collection: $('select[name="collection"]'),
        mechanism: $('select[name="mechanism"]'),
        color: $('select[name="mechanism-color"]'),
        class: {
            catalogWrap: 'configurator-catalog-mechanism-js',
            filterWrap: 'select-col-mechanism-js',
        },
        currentCollectionName: '',
        dataFilter: '',
        type: 'mechanism'
    };

    /*
     * Фильтрация механизмов при клике по рамке
     */
    $(document).on('click', '.btn-collection-js', function () {

        mechanismFilterIndependent['collectionName'] = $(this).closest('.config-frame__item').data('kollect');
        mechanismFilterIndependent['collectionOption'] = mechanismFilterIndependent['collection'].find('option[value="' + mechanismFilterIndependent['collectionName'] + '"]');

        if (typeof mechanismFilterIndependent['collectionName'] !== "undefined"
            && mechanismFilterIndependent['currentCollectionName'] != mechanismFilterIndependent['collectionName']
        ) {
            mechanismFilterIndependent['dataFilter'] = mechanismFilterIndependent['collectionOption'].data('filter') + '=' + mechanismFilterIndependent['collectionOption'].data('filter-value');
            mechanismFilterIndependent['dataQuery'] = mechanismFilterIndependent['collectionOption'].data('query');
            mechanismFilterIndependent['collectionQuery'] = '?ajax=y&type=mechanism&' + mechanismFilterIndependent['dataFilter'] ;
            mechanismFilterIndependent['collectionQueryFilter'] = '?ajax=y&type=mechanism&' + mechanismFilterIndependent['dataQuery'];

            var selectCollectionCatalog = [],
                selectCollectionFilter = [];

            $('.' + mechanismFilterIndependent['class']['filterWrap'] + ' .select-js').find('option:selected').each(function () {

                var dataQuery = this.getAttribute('data-query'),
                    dataFilter = this.getAttribute('data-filter'),
                    dataValue = this.getAttribute('data-filter-value');

                if (dataFilter !== null && dataValue !== null) {
                    selectCollectionCatalog.push(dataFilter + '=' + dataValue);
                }

                if (dataQuery !== null) {
                    selectCollectionFilter.push(dataQuery);
                }
            });

            mechanismFilterIndependent['urlCatalog'] = mechanismFilterIndependent['pathAjaxFileCatalog'] + mechanismFilterIndependent['collectionQuery'];
            if (selectCollectionCatalog.length > 0) {
                mechanismFilterIndependent['urlCatalog'] = mechanismFilterIndependent['pathAjaxFileCatalog'] + mechanismFilterIndependent['collectionQuery'] + '&' + selectCollectionCatalog.join('&');
            }

            mechanismFilterIndependent['urlCatalogFilter'] = mechanismFilterIndependent['pathAjaxFileFilter'] + mechanismFilterIndependent['collectionQueryFilter'];
            if (selectCollectionCatalog.length > 0) {
                mechanismFilterIndependent['urlCatalogFilter'] = mechanismFilterIndependent['pathAjaxFileFilter'] + mechanismFilterIndependent['collectionQueryFilter'] + '&' + selectCollectionFilter.join('&');
            }

            checkCountElementsAjax(mechanismFilterIndependent);
        }
    });

    /*
     * Вызов функции фильтрации на событие изменения select рамок
     */
    frame['collection'].on('change', function () {
        $('.config-panel .preloader-js').css('display', 'flex');
        getChangeSelectFrame();
        checkFirstOption($(this));
    });

    frame['color'].on('change', function () {
        $('.config-panel .preloader-js').css('display', 'flex');
        getChangeSelectFrame();
        checkFirstOption($(this));
    });

    frame['material'].on('change', function () {
        $('.config-panel .preloader-js').css('display', 'flex');
        getChangeSelectFrame();
        checkFirstOption($(this));
    });


    /*
     * Вызов функции фильтрации на событие изменения select механизмов
     */
    mechanism['collection'].on('change', function () {
        $('.config-panel .preloader-js').css('display', 'flex');

        if ($('select[name="collection"]').find('option:selected').val() == 'all') {
            delete mechanismFilterIndependent['dataFilter'];
            delete mechanismFilterIndependent['dataQuery'];
        }

        getChangeSelectMechanism();
        checkFirstOption($(this));
    });

    mechanism['mechanism'].on('change', function () {
        $('.config-panel .preloader-js').css('display', 'flex');
        getChangeSelectMechanism();
        checkFirstOption($(this));
    });

    mechanism['color'].on('change', function () {
        $('.config-panel .preloader-js').css('display', 'flex');
        getChangeSelectMechanism();
        checkFirstOption($(this));
    });

    /*
     * Проверка количества возвращаемых элементов
     * Учитываются только свойства механихмов
     * (Цвет механизма, Группа функций)
     */
    function checkCountElementsAjax(params) {

        $('.config-panel .preloader-js').css('display', 'flex');

        $.ajax({
            url: params.urlCatalogFilter,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                //console.log('Selected ' + params.type + ': ' + data['ELEMENT_COUNT']);
            },
            error: function () {
                console.log('Error updating filter ' + params.type + ' for catalog!');
            },
            complete: function (jqXHR, textStatus) {

                var data = jqXHR.responseJSON,
                    countElements = parseInt(data['ELEMENT_COUNT'], 10);

                if (jqXHR.status == 200 && textStatus == 'success') {
                    if (countElements > 0) {
                        configuratorFilterAjax(params);
                        configuratorCatalogAjax(params);

                        setTimeout(function() {
                            $('.config-panel .preloader-js').css('display', 'none');
                        }, 2000);
                    } else {

                        if (params.type == 'mechanism') {

                            var selectedColor = params.color.find('option:selected'),
                                selectedMechanism = params.mechanism.find('option:selected'),
                                colorFilter = selectedColor.data('query'),
                                mechanismFilter = selectedMechanism.data('query'),
                                colorCatalog = selectedColor.data('filter') + '=' + selectedColor.data('filter-value'),
                                mechanismCatalog = selectedMechanism.data('filter') + '=' + selectedMechanism.data('filter-value');

                            if (selectedColor.val() != 'all' || colorCatalog != 'all') {

                                if (selectedColor.val() != 'all') {
                                    selectedColor.prop('selected', false);
                                    params.urlCatalogFilter = params.urlCatalogFilter.replace('&' + colorFilter, '');
                                    params.urlCatalog = params.urlCatalog.replace('&' + colorCatalog, '');

                                    $('.config-panel select:not(.basic)').selectric({
                                        onRefresh: function () {
                                        },
                                    });

                                    console.log('The COLOR mechanism was deleted!');
                                } else {
                                    selectedMechanism.prop('selected', false);
                                    params.urlCatalogFilter = params.urlCatalogFilter.replace('&' + mechanismFilter, '');
                                    params.urlCatalog = params.urlCatalog.replace('&' + mechanismCatalog, '');

                                    $('.config-panel select:not(.basic)').selectric({
                                        onRefresh: function () {
                                        },
                                    });

                                    console.log('The MECHANISM was deleted!');
                                }

                                updateUrl();

                                checkCountElementsAjax(params);

                            } else {
                                return false;
                            }
                        }

                        if (params.type == 'frame') {
                            var selectedColorFrame = params.color.find('option:selected'),
                                selectedMaterialFrame = params.material.find('option:selected'),
                                colorFilterFrame = selectedColorFrame.data('query'),
                                materialFilterFrame = selectedMaterialFrame.data('query'),
                                colorCatalogFrame = selectedColorFrame.data('filter') + '=' + selectedColorFrame.data('filter-value'),
                                materialCatalogFrame = selectedMaterialFrame.data('filter') + '=' + selectedMaterialFrame.data('filter-value');

                            if (selectedColorFrame.val() != 'all' || colorCatalogFrame != 'all') {

                                if (selectedColorFrame.val() != 'all') {
                                    selectedColorFrame.prop('selected', false);
                                    params.urlCatalogFilter = params.urlCatalogFilter.replace('&' + colorFilterFrame, '');
                                    params.urlCatalog = params.urlCatalog.replace('&' + colorCatalogFrame, '');

                                    $('.config-panel select:not(.basic)').selectric({
                                        onRefresh: function () {
                                        },
                                    });

                                    console.log('The COLOR frame was deleted!');
                                } else {
                                    selectedMaterialFrame.prop('selected', false);
                                    params.urlCatalogFilter = params.urlCatalogFilter.replace('&' + materialFilterFrame, '');
                                    params.urlCatalog = params.urlCatalog.replace('&' + materialCatalogFrame, '');

                                    $('.config-panel select:not(.basic)').selectric({
                                        onRefresh: function () {
                                        },
                                    });

                                    console.log('The FRAME was deleted!');
                                }

                                checkCountElementsAjax(params);

                            } else {
                                return false;
                            }
                        }
                    }
                }
            }
        });
    }

    /*
     * Фильтрация рамок
     */
    function getChangeSelectFrame() {
        frame['query'] = getQueryFilter(frame);

        frame['urlCatalog'] = frame['pathAjaxFileCatalog'] + '?ajax=y&type=frame';
        if (frame['query']['queryCatalog'].length > 0) {
            frame['urlCatalog'] = frame['pathAjaxFileCatalog'] + '?ajax=y&type=frame&' + frame['query']['queryCatalog'];
        }

        frame['urlCatalogFilter'] = frame['pathAjaxFileFilter'] + '?ajax=y&type=frame';
        if (frame['query']['queryCatalogFilter'].length > 0) {
            frame['urlCatalogFilter'] = frame['pathAjaxFileFilter'] + '?ajax=y&type=frame&' + frame['query']['queryCatalogFilter'];
        }

        checkCountElementsAjax(frame);
    }

    /*
     * Фильтрация механизмов
     */
    function getChangeSelectMechanism() {

        mechanism['query'] = getQueryFilter(mechanism);

        mechanism['urlCatalog'] = mechanism['pathAjaxFileCatalog'] + '?ajax=y&type=mechanism';
        if (mechanism['query']['queryCatalogFilter'].length > 0) {
            mechanism['urlCatalog'] = mechanism['pathAjaxFileCatalog'] + '?ajax=y&type=mechanism&' + mechanism['query']['queryCatalog'];
        }

        mechanism['urlCatalogFilter'] = mechanism['pathAjaxFileFilter'] + '?ajax=y&type=mechanism';
        if (mechanism['query']['queryCatalog'].length > 0) {
            mechanism['urlCatalogFilter'] = mechanism['pathAjaxFileFilter'] + '?ajax=y&type=mechanism&' + mechanism['query']['queryCatalogFilter'];
        }

        checkCountElementsAjax(mechanism);
    }

    /*
     * Каталог рамок
     */
    function configuratorCatalogAjax(params) {
        $.ajax({
            url: params.urlCatalog,
            type: 'GET',
            dataType: 'html',
            success: function (html, textStatus) {
                if(textStatus == 'success') {
                    $('.' + params.class.catalogWrap).html(html);
                }
            },
            error: function () {
                console.log('Error updating catalog!');
            },
            complete: function (jqXHR, textStatus) {
                if(jqXHR.status == 200 && textStatus == 'success') {

                    setTimeout(function() {
                        $('.config-panel .preloader-js').css('display', 'none');
                    }, 2000);

                    mechanismFilterIndependent['currentCollectionName'] = mechanismFilterIndependent['collectionName'];

                    var instance = $('img.lazy:visible').lazy({
                        chainable: false,
                        beforeLoad: function(element) {
                            //console.log('before load')
                        },
                        afterLoad: function(element) {
                            $(element).closest('.config-frame__item').addClass('loaded')
                        },
                    });

                    instance.update();

                    setTimeout(function() {
                        $('.simplebar-content-wrapper').on('scroll', function() {
                            const scrollTop = $(this).scrollTop();
                            const scrollHeight = $(this)[0].scrollHeight;
                            if (scrollTop > scrollHeight - 480 - 40) {
                                const index = $(this).find('.loaded').length - 1;
                                for (let i = 0; i < 3; i++) {
                                    $(this).find('.config-frame__item').eq(index).nextAll().eq(i).css('display', 'flex');
                                }
                            }
                            $('img.lazy:visible').lazy({
                                chainable: false,
                                beforeLoad: function(element) {
                                    console.log('before load')
                                },
                                afterLoad: function(element) {
                                    $(element).closest('.config-frame__item').addClass('loaded')
                                },
                            });
                            instance.update();
                        });
                    }, 50);
                }
            }
        });
    }

    /*
     * Фильтр рамок
     */
    function configuratorFilterAjax(params) {

        var disabledSelectCatalogFilter = {};

        $.ajax({
            url: params.urlCatalogFilter,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log('Selected ' + params.type + ': ' + data['ELEMENT_COUNT']);
            },
            error: function () {
                console.log('Error updating filter ' + params.type + ' for catalog!');
            },
            complete: function (jqXHR, textStatus) {

                if (jqXHR.status == 200 && textStatus == 'success') {
                    var data = jqXHR.responseJSON;

                    for (keyItems in data['ITEMS']) {
                        for (idElement in data['ITEMS'][keyItems]) {
                            for (keyFilter in data['ITEMS'][keyItems][idElement]) {

                                var arrFilter = data['ITEMS'][keyItems][idElement][keyFilter];

                                if (arrFilter['DISABLED']) {
                                    disabledSelectCatalogFilter[arrFilter['CONTROL_NAME_ALT'] + '=' + arrFilter['HTML_VALUE_ALT']] = arrFilter['DISABLED'];
                                }
                            }
                        }
                    }

                    $('.' + params.class.filterWrap + ' .select-js').find('option').each(function () {

                        //сброс значений фильтра
                        $(this).prop('disabled', false);

                        if (this.getAttribute('data-filter') != 'arrFilter_102') {

                            //обновление значений фильтра
                            var dataQuery = this.getAttribute('data-query');
                            if (disabledSelectCatalogFilter[dataQuery]) {
                                $(this).prop('disabled', true);
                            }
                        }
                    });

                    $('.config-panel select:not(.basic)').selectric({
                        onRefresh: function () {
                        },
                    });

                } else {
                    console.log('statusFilterUpdate: ' + jqXHR.status);
                    console.log('textStatusFilterUpdate: ' + textStatus);
                }
            }
        });
    }

    /*
     * Формирование url запроса (get параметров)
     * для фильтрации рамок и механизмов
     */
    function getQueryFilter(params) {

        var selectCollectionFilter = [],
            selectCollectionCatalog = [];

        if (params.type == 'mechanism') {

            $('select[name="collection"]').find('option:selected').each(function () {

                var dataQuery = this.getAttribute('data-query'),
                    dataFilter = this.getAttribute('data-filter'),
                    dataValue = this.getAttribute('data-filter-value');

                if (dataQuery !== null) {
                    selectCollectionFilter.push(dataQuery);
                }

                if (dataFilter !== null && dataValue !== null) {
                    selectCollectionCatalog.push(dataFilter + '=' + dataValue);
                }
            });
        }

        $('.' + params.class.filterWrap + ' .select-js').find('option:selected').each(function () {

            var dataQuery = this.getAttribute('data-query'),
                dataFilter = this.getAttribute('data-filter'),
                dataValue = this.getAttribute('data-filter-value');

            if (dataQuery !== null) {
                selectCollectionFilter.push(dataQuery);
            }

            if (dataFilter !== null && dataValue !== null) {
                selectCollectionCatalog.push(dataFilter + '=' + dataValue);
            }
        });

        var queryCatalogFilter = selectCollectionFilter.join('&'),
            queryCatalog = selectCollectionCatalog.join('&');

        if (typeof mechanismFilterIndependent['dataFilter'] != 'undefined'
            && queryCatalog.indexOf(mechanismFilterIndependent['dataFilter']) < 0
            && params.type == 'mechanism'
        ) {
            if ($('select[name="collection"]').find('option:selected').val() == 'all') {
                queryCatalog = queryCatalog + '&' + mechanismFilterIndependent['dataFilter'];
            }
        }

        if (typeof mechanismFilterIndependent['dataQuery'] != 'undefined'
            && queryCatalog.indexOf(mechanismFilterIndependent['dataQuery']) < 0
            && params.type == 'mechanism'
        ) {
            if ($('select[name="collection"]').find('option:selected').val() == 'all') {
                queryCatalogFilter = queryCatalogFilter + '&' + mechanismFilterIndependent['dataQuery'];
            }
        }

        updateUrl();

        var result = {
            queryCatalogFilter: queryCatalogFilter,
            queryCatalog: queryCatalog
        }

        return result;
    }

    /*
     * Запись/обновление параметров фильтра в поисковую строку
     */
    function updateUrl() {

        var selectFilter = [];

        $('.select-js').find('option:selected').each(function () {

            var dataQuery = this.getAttribute('data-query');

            if (dataQuery !== null) {
                selectFilter.push(dataQuery);
            }
        });

        query = selectFilter.join('&');

        if (window.history.pushState) {

            var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname,
                newUrl = baseUrl;

            if (query !== '') {
                newUrl = baseUrl + '?set_filter=y&' + query;
            }

            window.history.pushState(null, null, newUrl);
        } else {
            console.warn('History API не поддерживается');
        }
    }

    function checkFirstOption(elem) {
        const currentValue = elem.val();
        const option = elem.find('option:first-child');
        const wrapper = elem.closest('.selectric-wrapper');

        if (currentValue === option.data('name')) {
            wrapper.find('span.label').text(option.data('value'));
        }
    }
});