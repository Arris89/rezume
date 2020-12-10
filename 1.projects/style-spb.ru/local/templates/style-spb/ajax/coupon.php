<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');

$sCoupon = $_POST['code'];
\Bitrix\Sale\DiscountCouponsManager::add($sCoupon);
$oBasket = \Bitrix\Sale\Basket::loadItemsForFUser(
    \Bitrix\Sale\Fuser::getId(),
    \Bitrix\Main\Context::getCurrent()->getSite()
);
$oDiscounts = \Bitrix\Sale\Discount::loadByBasket($oBasket);
$oBasket->refreshData(['PRICE', 'COUPONS']);
$oDiscounts->calculate();
$result = $oDiscounts->getApplyResult();

