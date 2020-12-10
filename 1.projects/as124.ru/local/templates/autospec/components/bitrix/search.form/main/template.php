<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);?>

<div class="header__search">

<form class="form-search" action="<?=$arResult["FORM_ACTION"]?>">


			<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
			);?><?else:?><!-- <input type="text" name="q" value="" size="15" maxlength="50" /> --><?endif;?>


		

			<input required type="text" name="text" class="search" placeholder="Поиск">

		<!-- 	<input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" /> -->

		<button class="submit-search">
						<svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
						    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <g id="форма-/-поиск-/-айдл" transform="translate(-236.000000, -12.000000)" fill="#FFFFFF" fill-rule="nonzero">
						            <path d="M246.121906,31.9639949 C240.531732,31.9639949 236,27.4949024 236,21.9819974 C236,16.4690925 240.531732,12 246.121906,12 C251.71208,12 256.243812,16.4690925 256.243812,21.9819974 C256.243812,27.4949024 251.71208,31.9639949 246.121906,31.9639949 Z M246.121906,29.5683155 C250.370439,29.5683155 253.814555,26.1718052 253.814555,21.9819974 C253.814555,17.7921897 250.370439,14.3956794 246.121906,14.3956794 C241.873374,14.3956794 238.429257,17.7921897 238.429257,21.9819974 C238.429257,26.1718052 241.873374,29.5683155 246.121906,29.5683155 Z M250.740163,27.9885588 L252.427667,26.2652513 L260,33.4766925 L258.312496,35.2 L250.740163,27.9885588 Z" id="Oval-2"></path>
						        </g>
						    </g>
						</svg>
					</button>
</form>

</div>