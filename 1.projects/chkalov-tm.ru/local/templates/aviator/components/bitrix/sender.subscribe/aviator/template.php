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
<div class="bx-subscribe" id="sender-subscribe">
    <?
    $frame = $this->createFrame("sender-subscribe", false)->begin();
    ?>
    <? if (isset($arResult['MESSAGE'])): CJSCore::Init(array("popup")); ?>
        <div id="sender-subscribe-response-cont" style="display: none;">
            <div class="popup">
                <table>
                    <tr>
                        <td style="padding-right: 40px; padding-bottom: 0px;">
                            <img src="<?= ($this->GetFolder() . '/images/' . ($arResult['MESSAGE']['TYPE'] == 'ERROR' ? 'icon-alert.png' : 'icon-ok.png')) ?>"
                                 alt="">
                        </td>
                        <td>
                            <div class="title">
                                <?= GetMessage('subscr_form_response_' . $arResult['MESSAGE']['TYPE']) ?>
                            </div>
                            <div style="margin-top: 15px;">
                                <?= htmlspecialcharsbx($arResult['MESSAGE']['TEXT']) ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script>
      /*      BX.ready(function () {*/
                $(".fade-screen").first().show();
                $(".popup.subscribe").show();
       /*     });*/
        </script>
    <? endif; ?>




    <form id="bx_subscribe_subform_<?= $buttonId ?>" role="form" method="post" action="<?= $arResult["FORM_ACTION"] ?>">
        <?= bitrix_sessid_post() ?>
        <input type="hidden" name="sender_subscription" value="add">


        <!-- 	<div class="bx-input-group1"> -->
        <input class="prod-subscribe-input" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?= $arResult["EMAIL"] ?>"
               title="<?= GetMessage("subscr_form_email_title") ?>"
               placeholder="<?= htmlspecialcharsbx(GetMessage('subscr_form_email_title')) ?>" required>
        <!-- 	</div> -->


        <div class="rcol text-center">
            <button class="prod-subscribe" id="bx_subscribe_btn_<?= $buttonId ?>">
                <span><?= GetMessage("subscr_form_button") ?></span>
            </button>

        </div>
    </form>


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
      /*      BX.ready(function () {*/
                $(".fade-screen").first().show();
                $(".popup.enter").show();
   /*         });*/
        </script>
    <? endif; ?>



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