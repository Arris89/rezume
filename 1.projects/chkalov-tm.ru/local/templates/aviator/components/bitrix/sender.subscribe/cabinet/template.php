<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$buttonId = $this->randString();
?>
<div class="item subscribe" id="sender-subscribe">


    <?
    $frame = $this->createFrame("sender-subscribe", false)->begin();
    ?>
    <? if (isset($arResult['MESSAGE'])): CJSCore::Init(array("popup")); ?>
        <div id="sender-subscribe-response-cont" style="display: none;">
            <div class="bx_subscribe_response_container">
                <table>
                    <tr>
                        <td style="padding-right: 40px; padding-bottom: 0px;"><img
                                    src="<?= ($this->GetFolder() . '/images/' . ($arResult['MESSAGE']['TYPE'] == 'ERROR' ? 'icon-alert.png' : 'icon-ok.png')) ?>"
                                    alt=""></td>
                        <td>
                            <div style="font-size: 22px;"><?= GetMessage('subscr_form_response_' . $arResult['MESSAGE']['TYPE']) ?></div>
                            <div style="font-size: 16px;"><?= htmlspecialcharsbx($arResult['MESSAGE']['TEXT']) ?></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script>

        </script>
    <? endif; ?>

    <script>
        (function () {
            var btn = BX('bx_subscribe_btn_<?=$buttonId?>');
            var form = BX('bx_subscribe_subform_<?=$buttonId?>');

            if (!btn) {
                return;
            }

            function mailSender() {
                setTimeout(function () {
                    if (!btn) {
                        return;
                    }

                    var btn_span = btn.querySelector("span");
                    var btn_subscribe_width = btn_span.style.width;
                    BX.addClass(btn, "send");
                    btn_span.outterHTML = "<span><i class='fa fa-check'></i> <?=GetMessage("subscr_form_button_sent")?></span>";
                    if (btn_subscribe_width) {
                        btn.querySelector("span").style["min-width"] = btn_subscribe_width + "px";
                    }
                }, 400);
            }

            BX.ready(function () {
                BX.bind(btn, 'click', function () {
                    setTimeout(mailSender, 250);
                    return false;
                });
            });

            BX.bind(form, 'submit', function () {
                btn.disabled = true;
                setTimeout(function () {
                    btn.disabled = false;
                }, 2000);

                return true;
            });
        })();
    </script>

    <?
    global $USER;
    $USER = new CUser;


    $us = $USER->GetID();

    $rsUser = CUser::GetByID($us);

    $arUser = $rsUser->Fetch();


    ?>


    <form id="bx_subscribe_subform_<?= $buttonId ?>" role="form" method="post" action="<?= $arUser2['EMAIL'] ?>"
          class="subform">
        <div class="sub-title">
            Вы подписаны:
        </div>
        <?= bitrix_sessid_post() ?>


        <input type="hidden" name="sender_subscription" value="add">

        <div class="bx-input-group" style="display:none;">

            <input class="bx-form-control" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?= $arUser['EMAIL'] ?>"
                   title="<?= GetMessage("subscr_form_email_title") ?>"
                   placeholder="<?= htmlspecialcharsbx(GetMessage('subscr_form_email_title')) ?>">
        </div>


        <? if (count($arResult["RUBRICS"]) > 0): ?>

        <? endif; ?>




        <?
        CModule::IncludeModule('emailsub');

        $mailingList = \Bitrix\Sender\Subscription::getMailingList($arFilter);

        foreach ($mailingList as $key1) {
            $pod[$key1['ID']] = $key1['NAME'];

        }


        //Список тех, на которые подписан
        $subscriptionDb = \Bitrix\Sender\MailingSubscriptionTable::getSubscriptionList(array(
            'select' => array('ID' => 'CONTACT_ID', 'EMAIL' => 'CONTACT.CODE', 'EXISTED_MAILING_ID' => 'MAILING.ID'),
            'filter' => array(
                '=CONTACT.CODE' => 'mails@mail.ru',
                '!MAILING.ID' => null
            ),
        ));
        while (($subscription = $subscriptionDb->fetch())) {
            $arSubscription[] = $subscription;

        }


        foreach ($arSubscription as $key2) {


            $ListS[] = $key2['EXISTED_MAILING_ID'];

        } ?>



        <? foreach ($arResult["RUBRICS"] as $itemID => $itemValue): ?>

            <? if (in_array($itemValue["ID"], $ListS)) {
                ?>

                <div style="    line-height: 28px;

    margin-bottom: 17px;
    vertical-align: middle;

    margin-top: 14px;">

                    <label for="SENDER_SUBSCRIBE_RUB_ID_<?= $itemValue["ID"] ?>" class="prettycheckbox">
                        <input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" class="prettyCheckable"
                               id="SENDER_SUBSCRIBE_RUB_ID_<?= $itemValue["ID"] ?>" value="<?= $itemValue["ID"] ?>"
                               checked>
                        <div class="checkb"></div>
                        <?= htmlspecialcharsbx($itemValue["NAME"]) ?>
                    </label>
                </div>
                <?

            } else {
                ?>

                <div style="    line-height: 28px;

    margin-bottom: 17px;
    vertical-align: middle;

    margin-top: 14px;">

                    <label for="SENDER_SUBSCRIBE_RUB_ID_<?= $itemValue["ID"] ?>" class="prettycheckbox">
                        <input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" class="prettyCheckable"
                               id="SENDER_SUBSCRIBE_RUB_ID_<?= $itemValue["ID"] ?>" value="<?= $itemValue["ID"] ?>">
                        <div class="checkb"></div>
                        <?= htmlspecialcharsbx($itemValue["NAME"]) ?>
                    </label>
                </div>

                <?

            }
            ?>

            <div class="clear">
            </div>


        <? endforeach; ?>



        <? if ($arParams['USER_CONSENT'] == 'Y'): ?>
            <div class="bx_subscribe_checkbox_container bx-sender-subscribe-agreement">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.userconsent.request",
                    "",
                    array(
                        "ID" => $arParams["USER_CONSENT_ID"],
                        "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                        "AUTO_SAVE" => "Y",
                        "IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
                        "ORIGIN_ID" => "sender/sub",
                        "ORIGINATOR_ID" => "",
                        "REPLACE" => array(
                            "button_caption" => GetMessage("subscr_form_button"),
                            "fields" => array(GetMessage("subscr_form_email_title"))
                        ),
                    )
                ); ?>
            </div>
        <? endif; ?>


        <button id="bx_subscribe_btn_<?= $buttonId ?>" style="
    margin-right: 3px;
    padding: 0 30px 0 40px;
    line-height: 52px;
    cursor: pointer;
    background: #88003d;
    border-radius: 3px;
    display: inline-block;
    border: 2px solid #88003d;
    border-radius: 2px;
    font-size: 20px;
    color: #fff;
    font-family: 'Open Sans', Arial, sans-serif;" class="savesub">
            <span>Сохранить</span>
        </button>


        <div id="unsub1" style="
    margin-right: 3px;
    padding: 0 30px 0 40px;
    line-height: 52px;
    cursor: pointer;
    background: #88003d;
    border-radius: 3px;
    display: inline-block;
    border: 2px solid #88003d;
    border-radius: 2px;
    font-size: 20px;
    color: #fff;
    font-family: 'Open Sans', Arial, sans-serif;"
             data-mail="<?= $arUser['EMAIL'] ?>"> Отписаться от всех рассылок
        </div>
        <br>
        <br>
        <br>
    </form>


    <div class="popup" id="popup-sub" style="display: none;">
        <span class="sublock">
        <div class="close"><a href="javascript:void(0)">
                <img class="popup-close1" id="subclose" src="<?= SITE_TEMPLATE_PATH ?>/images/popup-close.jpg" alt=""
                     height="23" width="23"></a></div>
        <div class="wrap">
            <h3>Вы успешно подписаны на рассылку</h3>
        </div>
            </span>
    </div>


    <script>
        $(document).ready(function () {

            $('#unsub1').on('click', function (e) {

                window.mailsub = $(this).attr('data-mail');

                unsub(mailsub);
            });
            function unsub(IDbask) {

                var emailsub = mailsub;

                $.post('/ajax/unsubscribe.php', {emailsub}, function (datab) {
                    location.reload();

                })
            }
        });


    </script>


    <?
    $frame->beginStub();
    ?>
    <? if (isset($arResult['MESSAGE'])): CJSCore::Init(array("popup")); ?>
        <div id="sender-subscribe-response-cont" style="display: none;">
            <div class="bx_subscribe_response_container">
                <table>
                    <tr>
                        <td style="padding-right: 40px; padding-bottom: 0px;"><img
                                    src="<?= ($this->GetFolder() . '/images/' . ($arResult['MESSAGE']['TYPE'] == 'ERROR' ? 'icon-alert.png' : 'icon-ok.png')) ?>"
                                    alt=""></td>
                        <td>
                            <div style="font-size: 22px;"><?= GetMessage('subscr_form_response_' . $arResult['MESSAGE']['TYPE']) ?></div>
                            <div style="font-size: 16px;"><?= htmlspecialcharsbx($arResult['MESSAGE']['TEXT']) ?></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script>

        </script>
    <? endif; ?>

    <script>
        (function () {
            var btn = BX('bx_subscribe_btn_<?=$buttonId?>');
            var form = BX('bx_subscribe_subform_<?=$buttonId?>');

            if (!btn) {
                return;
            }

            function mailSender() {
                setTimeout(function () {
                    if (!btn) {
                        return;
                    }

                    var btn_span = btn.querySelector("span");
                    var btn_subscribe_width = btn_span.style.width;
                    BX.addClass(btn, "send");
                    btn_span.outterHTML = "<span><i class='fa fa-check'></i> <?=GetMessage("subscr_form_button_sent")?></span>";
                    if (btn_subscribe_width) {
                        btn.querySelector("span").style["min-width"] = btn_subscribe_width + "px";
                    }
                }, 400);
            }

            BX.ready(function () {
                BX.bind(btn, 'click', function () {
                    setTimeout(mailSender, 250);
                    return false;
                });
            });

            BX.bind(form, 'submit', function () {
                btn.disabled = true;
                setTimeout(function () {
                    btn.disabled = false;
                }, 2000);

                return true;
            });
        })();
    </script>

    <form id="bx_subscribe_subform_<?= $buttonId ?>" role="form" method="post" action="<?= $arResult["FORM_ACTION"] ?>">
        <?= bitrix_sessid_post() ?>
        <input type="hidden" name="sender_subscription" value="add">

        <div class="bx-input-group">
            <input class="bx-form-control" type="email" name="SENDER_SUBSCRIBE_EMAIL" value=""
                   title="<?= GetMessage("subscr_form_email_title") ?>"
                   placeholder="<?= htmlspecialcharsbx(GetMessage('subscr_form_email_title')) ?>">
        </div>

        <div style="<?= ($arParams['HIDE_MAILINGS'] <> 'Y' ? '' : 'display: none;') ?>">
            <? if (count($arResult["RUBRICS"]) > 0): ?>
                <div class="bx-subscribe-desc"><?= GetMessage("subscr_form_title_desc") ?></div>
            <? endif; ?>
            <? foreach ($arResult["RUBRICS"] as $itemID => $itemValue): ?>
                <div class="bx_subscribe_checkbox_container">
                    <input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]"
                           id="SENDER_SUBSCRIBE_RUB_ID_<?= $itemValue["ID"] ?>" value="<?= $itemValue["ID"] ?>">
                    <label for="SENDER_SUBSCRIBE_RUB_ID_<?= $itemValue["ID"] ?>"><?= htmlspecialcharsbx($itemValue["NAME"]) ?></label>
                </div>
            <? endforeach; ?>
        </div>

        <? if ($arParams['USER_CONSENT_USE'] == 'Y'): ?>
            <div class="bx_subscribe_checkbox_container bx-sender-subscribe-agreement">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.userconsent.request",
                    "",
                    array(
                        "ID" => $arParams["USER_CONSENT_ID"],
                        "IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
                        "AUTO_SAVE" => "Y",
                        "IS_LOADED" => "N",
                        "ORIGIN_ID" => "sender/sub",
                        "ORIGINATOR_ID" => "",
                        "REPLACE" => array(
                            "button_caption" => GetMessage("subscr_form_button"),
                            "fields" => array(GetMessage("subscr_form_email_title"))
                        ),
                    )
                ); ?>
            </div>
        <? endif; ?>

        <div class="bx_subscribe_submit_container">
            <button class="sender-btn btn-subscribe" id="bx_subscribe_btn_<?= $buttonId ?>">
                <span><?= GetMessage("subscr_form_button") ?></span></button>
        </div>
    </form>
    <?
    $frame->end();
    ?>
</div>