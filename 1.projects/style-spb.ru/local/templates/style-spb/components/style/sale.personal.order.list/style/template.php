<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Page\Asset;

?>

<div id="slider_row" class="row">
</div>


<div class="row">
    <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">

        <h1 class="page-heading bottom-indent"><? $APPLICATION->ShowTitle() ?></h1>
        <p class="info-title">Список заказов, оформленных вами с момента регистрации в нашем магазине.</p>


        <div class="block-center" id="block-history">
  
  <?if(!empty($arResult['ORDERS'])){?>
      
            <table id="order-list" class="table table-bordered footab default footable-loaded footable">
                <thead>
                <tr>
                    <th class="first_item footable-first-column" data-sort-ignore="true">Код заказа:</th>
                    <th class="item footable-sortable">Дата<span class="footable-sort-indicator"></span>
                    </th>
                    <th data-hide="phone" class="item footable-sortable">Сумма<span
                                class="footable-sort-indicator"></span></th>
                    <th data-sort-ignore="true" data-hide="phone,tablet" class="item">Оплата</th>
                    <th class="item footable-sortable">Статус<span class="footable-sort-indicator"></span>
                    </th>

                    <th data-sort-ignore="true" data-hide="phone,tablet"
                        class="last_item footable-last-column">&nbsp;
                    </th>
                </tr>
                </thead>

                <tbody>

            <? foreach ($arResult['ORDERS'] as $key => $order) {?>

                    <tr class="first_item">
                        <td class="history_link bold footable-first-column">
                            <span class="footable-toggle"></span>
                            <a class="color-myaccount"
                               href="javascript:void(0)" style="text-decoration:none;">
                                <?= $order['ORDER']['ID'] ?>
                            </a>
                        </td>
                        <td data-value=" <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?>" class="history_date bold">
                            <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?>
                        </td>
                        <td class="history_price" data-value="<?= $order["PAYMENT"][0]["FORMATED_SUM"] ?>">
							<span class="price">
								<?= $order["PAYMENT"][0]["FORMATED_SUM"] ?>
							</span>
                        </td>
                        <td class="history_method">Наличные</td>
                        <td data-value="3" class="history_state">
															<span class="label dark"
                                                                  style="background-color:#FF8C00; border-color:#FF8C00;">
									
													<?
                                                    if ($arStatus = CSaleStatus::GetByID($order['ORDER']['STATUS_ID'])) {
                                                        print_r($arStatus['NAME']);
                                                    }
                                                    ?>
								</span>
                        </td>
                        <td class="history_detail footable-last-column">
                            <a class="btn btn-default button button-small"
                               href="javascript:void(0)">
								<span class="more_info" data-id="<?=$order['ORDER']['ID']?>">
									Подробности<i class="icon-chevron-right right"></i>
								</span>
                            </a>
                        </td>
                    </tr>
                    <?}?>
                </tbody>
            </table>
        <?} else {?>
            <p class="info-title">У вас нет заказов</p>
        <?}?>

     </div>

        <ul class="footer_links clearfix" style="padding: 20px 0 0px 0; height: 65px;">
            <li>
                <a class="btn btn-default button button-small" href="/personal/">
			<span>
				<i class="icon-chevron-left"></i> Вернуться к учетной записи
			</span>
                </a>
            </li>
            <li>
                <a class="btn btn-default button button-small" href="/">
                    <span><i class="icon-chevron-left"></i> Главная</span>
                </a>
            </li>
        </ul>

    </div><!-- #center_column -->
</div><!-- .row -->

   <script>
    /*перезаказать*/
       $(document).on('click', '.link-button', function () {
             var id = $(this).attr('data-id'); /*id заказа*/
            $.post('/local/templates/style-spb/ajax/order/rebasket.php', {id}, function (data) {
                  location.replace('/personal/cart/');

            })
        });

           /*показать подробности о заказе*/
       $(document).on('click', '.more_info', function () {

             var id = $(this).attr('data-id'); /*id заказа*/

            $.post('/local/templates/style-spb/ajax/order/ordinfo.php', {id}, function (data) {

                    var datad = JSON.parse(data);

    var info =   `<div id="block-order-detail" class="unvisible" style="display: block;">
                <div class="box box-small clearfix">
                    <form id="submitReorder" action="/order/" method="post" class="submit">
                        <input type="hidden" value="" name="id_order">
                        <input type="hidden" value="" name="submitReorder">
                    </form>
                    <p class="dark">
                        <strong>Код размещённого заказа: ${datad.ID}</strong>
                    </p>
                </div>
                <div class="info-order box">
                    <p><strong class="dark">Перевозчик</strong> ${datad.ID_DEV}</p>
                    <p><strong class="dark">Способ оплаты:</strong> <span
                                class="color-myaccount">Наличные</span></p>
                </div>
                <h1 class="page-heading">Следите за вашим заказом</h1>
                <div class="table_block">
                    <table class="detail_step_by_step table table-bordered">
                        <thead>
                        <tr>
                            <th class="first_item">Дата</th>
                            <th class="last_item">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="first_item item">
                            <td class="step-by-step-date">${datad.DATE}</td>
                            <td><span style="background-color:#FF8C00; border-color:#FF8C00;" class="label dark">${datad.STATUS}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="adresses_bloc">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <ul class="address alternate_item box">
                                <li><h3 class="page-subheading">Адрес доставки (Мой адрес)</h3></li>
                                <li><span class="address_firstname">${datad.DELIVERY_INFO.UF_FIO}</span>
                                </li>
                                <li class="address_company">${datad.DELIVERY_INFO.UF_COMPANY}</li>
                                <li><span class="address_vat_number"></span></li>
                                <li><span class="address_address1">${datad.DELIVERY_INFO.UF_STREET}</span></li>
                                <li><span class="address_address2"></span></li>
                                <li><span class="address_postcode"> ${datad.DELIVERY_INFO.UF_INDEX}</span> 
                                <span class="address_city">
                                    ${datad.DELIVERY_INFO.UF_CITY}
                                </span>
                                </li>
                                <li><span class="address_Country:name">${datad.DELIVERY_INFO.UF_COUNTRY}</span></li>
                                <li><span class="address_phone">${datad.DELIVERY_INFO.UF_PHONE}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form action="https://style-spb.ru/order-follow" method="post">
                    <div id="order-detail-content" class="table_block table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="first_item">Код</th>
                                <th class="item">Товар</th>
                                <th class="item">Количество</th>
                                <th class="item">Цена</th>
                                <th class="last_item">Сумма</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr class="item">
                                <td colspan="1">
                                    <strong>Доставка </strong>
                                </td>
                                <td colspan="4">
                                    <span class="price-shipping">${datad.SUM_DEV} р</span>
                                </td>
                            </tr>
                            <tr class="totalprice item">
                                <td colspan="1">
                                    <strong>Итого, к оплате:</strong>
                                </td>
                                <td colspan="4">
                                    <span class="price">${datad.SUM} р</span>
                                </td>
                            </tr>
                            </tfoot>
                            <tbody id="itemlist">
                            </tbody>
                        </table>
                    </div>
                </form>
                <form action="" method="post" class="std"
                      id="sendOrderMessage">
                    <h3 class="page-heading bottom-indent">Добавить сообщение:</h3>
                    <p>Если вы хотите добавить комментарий к заказу, пожалуйста, напишите его ниже.</p>
                    <p class="form-group">
                        <textarea class="form-control" cols="67" rows="3" name="msgText"></textarea>
                    </p>
                    <div class="submit">
                        <input type="hidden" name="id_order" value="">
                        <input type="submit" class="unvisible" name="submitMessage" value="Отправить">
                        <button type="submit" name="submitMessage" class="button btn btn-default button-medium"><span>Отправить<i
                                        class="icon-chevron-right right"></i></span></button>
                    </div>
                </form>
            </div>`;

                $('#block-order-detail').remove();
                $('#order-list').after(info);

            })
        });

          </script>