<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>

<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="contact-form-box" enctype="multipart/form-data">
<?=bitrix_sessid_post()?>

	<fieldset>
			<h3 class="page-subheading">Отправить сообщение</h3>
			<div class="clearfix">
				<div class="col-xs-12 col-md-3">
					<div class="form-group selector1">
						<label for="id_contact">Тема</label>
							<div class="selector" id="uniform-id_contact" style="width: 266px;">
								<span style="width: 256px; user-select: none;">-- Выбрать --</span>
									<select id="id_contact" class="form-control" name="THEME">
										<option value="0">-- Выбрать --</option>
										<option value="Вебмастер">Вебмастер</option>
										<option value="Клиентская служба">Клиентская служба</option>
										<option value="Оптовые закупки">Оптовые закупки</option>
									</select></div>
					</div>
						<p id="desc_contact0" class="desc_contact">&nbsp;</p>
													<p id="desc_contact1" class="desc_contact contact-title unvisible">
								<i class="icon-comment-alt"></i>Если на сайте возникнут технические проблемы
							</p>
													<p id="desc_contact2" class="desc_contact contact-title unvisible">
								<i class="icon-comment-alt"></i>По всем вопросам касательно товаров или заказов
							</p>
													<p id="desc_contact3" class="desc_contact contact-title unvisible">
								<i class="icon-comment-alt"></i>Для вопросов по оптовым закупкам
							</p>
																<p class="form-group">

						<label for="email">Адрес E-mail</label>
						<input class="form-control grey validate" type="text" id="email" name="user_email" data-validate="isEmail" value="<?=$arResult["AUTHOR_EMAIL"]?>">
											</p>
																<p class="form-group">
						<label for="fileUpload">Прикрепить файл</label>
					<div class="uploader" id="uniform-fileUpload">
						<input type="file" name="myfile" id="fileUpload" accept=".jpg,.jpeg,.png" class="form-control">
						<span class="filename" style="user-select: none;">Файлы не выбраны</span>
						<span class="action" style="user-select: none;">Выберите файл</span>
							</div>
						</p>
									</div>
				<div class="col-xs-12 col-md-9">
					<div class="form-group">
						<label for="message">Сообщение</label>
			<textarea class="form-control" id="message" name="MESSAGE"><?=$arResult["MESSAGE"]?></textarea>
					</div>
				</div>
			</div>

<?if($arParams["USE_CAPTCHA"] == "Y"):?>
<div id="captcha-box"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LfmF0YUAAAAAJbjT7YSo1srNQooub3ffwfTDYbT&amp;co=aHR0cHM6Ly9zdHlsZS1zcGIucnU6NDQz&amp;hl=ru&amp;v=r8WWNwsCvXtk22_oRSVCCZx9&amp;theme=light&amp;size=normal&amp;cb=62e81eygweb3" width="304" height="78" role="presentation" name="a-8n22sruqpu38" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></div>
<?endif;?>

	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">

		</fieldset>

</form>

