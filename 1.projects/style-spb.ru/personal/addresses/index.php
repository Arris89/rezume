<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавление адреса");

CModule::IncludeModule('highloadblock');
if($USER->IsAuthorized()){
?>

    <div class="columns-container">
        <div id="columns" class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">


      <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","style",Array(
        "START_FROM" => "0", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);?>
                        
            </div>
            <!-- /Breadcrumb -->

            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">
                    <h1 class="page-heading">Мои адреса</h1>
                    <p>При оформлении заказа укажите ваш почтовый адрес и адрес доставки. Можно также добавить другие
                        адреса, например, для отправки подарков или доставки покупок в офис.</p>
                    <div class="addresses">
                        <p><strong class="dark">Ваши адреса перечислены ниже.</strong></p>
                        <p class="p-indent">Не забывайте обновлять персональную информацию в случае её изменения.</p>

                        <div class="bloc_adresses row">


                        <? 
         
    $ID = 5; // ИД справочника

    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();

    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    $entity_data_class = $hlentity->getDataClass();

    $result = $entity_data_class::getList(array(
                "select" => array("UF_USER","UF_CITY","UF_INDEX","UF_PHONE","UF_COUNTRY","UF_STREET","UF_COMPANY","UF_FIO","ID" ), // Поля для выборки
                "order" => array(),
                "filter" => array("UF_USER"=>$arUser['ID']),
    ));

    while ($resds = $result->fetch()) {

                        ?>
                            <div class="col-xs-12 col-sm-6 address">
                                <ul class="first_item item box">
                                    <li><h3 class="page-subheading">Мой адрес</h3></li>
                                    <li>
                                            <span class="address_name">
                                                <?=$resds["UF_FIO"]?>
                                            </span>
                                    </li>
                                    <li>
                                            <span class="address_company">
                                                  <?=$resds["UF_COMPANY"]?>
                                            </span>
                                    </li>
                                    <li>
                                            <span class="address_company">
                                            </span>
                                    </li>
                                    <li>
                                            <span class="address_address1">
                                                <?=$resds["UF_STREET"]?>
                                          </span>
                                    </li>
                                    <li>
                                            <span class="address_address2">
                                            </span>
                                    </li>
                                    <li>
                                            <span>
                                                 <?=$resds["UF_INDEX"]?>
                                            </span>
                                        <span class="address_city">
                                                 <?=$resds["UF_CITY"]?>
                                        </span>
                                    </li>
                                    <li>
                                            <span>
                                                <?=$resds["UF_COUNTRY"]?>
                                             </span>
                                    </li>
                                    <li>
                                            <span class="address_phone">
                                                 <?=$resds["UF_PHONE"]?>
                                            </span>
                                    </li>
                                    <li>
                                            <span class="address_phone_mobile">
                                              </span>
                                    </li>
                                    <li class="address_update">
                                        <a class="btn btn-default button button-small"
                                           href="" title="Обновить">
                                           <span>Обновить
                                                <i class="icon-chevron-right right"></i>
                                            </span>
                                        </a>
                                        <a class="btn btn-default button button-small" href="javascript:void(0)"
                                           data-id="addresses_confirm" title="Удалить">
                                           <span class="delete" data-id="<?=$resds["ID"]?>">Удалить
                                                 <i class="icon-remove right"></i>
                                            </span>
                                         </a>
                                    </li>
                                </ul>
                            </div>
                        <?}?>
                        </div>
                    </div>
                    <div class="clearfix main-page-indent">
                        <a href="/address/" title="Добавить адрес"
                           class="btn btn-default button button-medium">
                           <span>Добавить новый адрес
                                <i class="icon-chevron-right right"></i>
                            </span>
                        </a>
                    </div>
                    <ul class="footer_links clearfix">
                        <li><a class="btn btn-default button button-small" href="/personal/"><span>
                            <i class="icon-chevron-left"></i> Вернуться к учетной записи</span></a></li>
                        <li><a class="btn btn-default button button-small" href="/"><span>
                            <i class="icon-chevron-left"></i> Главная</span></a></li>
                    </ul>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>
<? 
    } else {

            header('Location: /authentication/');

        }?>

<script>
       $(document).on('click', '.delete', function () {

                var id = $(this).attr('data-id');
                    alert(id);
                $.post('/local/templates/style-spb/ajax/deladress.php', {id}, function (data) {
                    location.reload();
            })
        });
</script>       


<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>