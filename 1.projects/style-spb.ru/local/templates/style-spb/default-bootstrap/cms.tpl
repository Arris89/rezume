{*
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if isset($cms) && !isset($cms_category)}
	{if !$cms->active}
		<br />
		<div id="admin-action-cms">
			<p>
				<span>{l s='This CMS page is not visible to your customers.'}</span>
				<input type="hidden" id="admin-action-cms-id" value="{$cms->id}" />
				<input type="submit" value="{l s='Publish'}" name="publish_button" class="button btn btn-default"/>
				<input type="submit" value="{l s='Back'}" name="lnk_view" class="button btn btn-default"/>
			</p>
			<div class="clear" ></div>
			<p id="admin-action-result"></p>
		</div>
	{/if}
	<div class="rte{if $content_only} content_only{/if}">
		{hook h="DisplaySlidersPro" CMS="1"}
		{$cms->content}
		{if $cms->id==6}
			{literal}
				<div id="cmsYandexMap"></div>
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=87YByDSibgWv0TbBSBsK3hyAbCZJYt-o&width=100%&height=500&lang=ru_RU&sourceType=constructor&scroll=true&id=cmsYandexMap"></script>
			{/literal}
		{/if}

{*		{if $cms->id==7}
*			{literal}
*				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A97c34a4de15df730ae4817eb03a1ea203a5f8ec3f6f20cd232affa0a7c1024f2&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
*			{/literal}
*		{/if}
*}		
		{if $cms->id==11}
		{literal}
		<style>
		.opt_form > input, .opt_form>select{
			max-width: 400px;
			width: 100%;
			border: 1px solid #bcbcbc;
			padding: 5px;
			margin-bottom: 5px;
			border-radius: 5px;
		}

		</style>
		<form class="opt_form" action="https://style-spb.ru/opt/opt_form.php" method="post">
			<input type="text" name="name" class="fti" placeholder="Имя*" required />
			<br/>
			<input type="text" name="surname" class="fti" placeholder="Фамилия*" required />
			<br/>
			<input type="text" name="yurname" class="urlic" placeholder="Название юридического лица*" required />
			<br/>
			<input type="tel" name="tel" class="urlic" placeholder="Телефон*" required />
			<br/>
			<input type="email" name="email" class="urlic" placeholder="E-mail" />
			<br/>
			<input type="text" name="city" class="urlic" placeholder="Город*" required />
			<br/>
			<select class="inputselect" name="magtype" id="form_dropdown_opt_mag" placeholder="Тип магазина">
				<option value="" disabled selected>Тип магазина</option>
				<option value="отдельно стоящий  магазин">Отдельно стоящий  магазин</option>
				<option value="магазин в торговом центре">Магазин в торговом центре</option>
				<option value="планирую открытие">Планирую открытие</option>
				<option value="совместные закупки">совместные закупки</option>
				<option value="другое">другое</option>
			</select>
			<br/>
			<input type="submit" />

		</form>
		
		
		<br><br>
		<h3>Адрес офиса в Санкт-Петербурге</h3>
		<p>Левашовский проспект д. 13, лит. А., офис 131 (+ карта)</p>
		<p>Телефон: 8 (812)703 00 51, 8 (812) 703 00 53</p>
		<div id="cmsYandexMapSpb"></div>
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=nMWaQyaCjeJSYhVDxfqB7KdpPaQ-z81n&width=500&height=300&lang=ru_RU&sourceType=constructor&scroll=true&id=cmsYandexMapSpb"></script>
		<br>
		<h3>Адрес офиса в Москве</h3>
		<p>ул. Краснобогатырская, д. 89 стр.1 офис 207 (+карта)</p>
		<p>Телефон: 8 (495) 225 23 58, 8(495) 685 95 08</p>
		<div id="cmsYandexMapMsk"></div>
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=afodpuq11mf8iJesrWxc47LhIf-3YfmA&width=500&height=300&lang=ru_RU&sourceType=constructor&scroll=true&id=cmsYandexMapMsk"></script>
		<br><br>
		<p>«Style National Club» - является одной из лидирующих текстильных компаний Санкт-Петербурга, которая предлагает женские пальто оптом от производителя и в розницу. Компания успешно работает в сфере разработки и пошива одежды для женского пола с 1997 года. В «Style National Club» можно купить женские пальто оптом или в розницу высочайшего качества и по доступной стоимости.</p>
<h2>Как выгодно купить женские пальто оптом от производителя?</h2>

<p>Компания «Style National Club» предлагает для партнеров максимально гибкие и взаимовыгодные условия сотрудничества. Работая с нами, Вы будете получать постоянные скидки и сможете участвовать в заказе коллекций модной и удобной женской одежды. Для сотрудничества достаточно отправить заявку и дождаться звонка менеджера, который более детально объяснит все условия.</p>
<h2>Женские пальто оптом от производителя</h2>

<p>Наша фирма предлагает высококачественные и стильные пальто и другую одежду, которая подойдет для женщин и девушек разных возрастов. Наши модели являются элегантными и полностью соответствуют современным тенденциям моды. В магазине «Style National Club» можно купить пальто оптом от производителя, а также стильную и изысканную одежду из качественных материалов. </p>
		
		{/literal}
		{/if}
	</div>
{elseif isset($cms_category)}
	<div class="block-cms">
		<h1><a href="{if $cms_category->id eq 1}{$base_dir}{else}{$link->getCMSCategoryLink($cms_category->id, $cms_category->link_rewrite)}{/if}">{$cms_category->name|escape:'html':'UTF-8'}</a></h1>
		{if $cms_category->description}
			<p>{$cms_category->description|escape:'html':'UTF-8'}</p>
		{/if}
		{if isset($sub_category) && !empty($sub_category)}	
			<p class="title_block">{l s='List of sub categories in %s:' sprintf=$cms_category->name}</p>
			<ul class="bullet list-group">
				{foreach from=$sub_category item=subcategory}
					<li>
						<a class="list-group-item" href="{$link->getCMSCategoryLink($subcategory.id_cms_category, $subcategory.link_rewrite)|escape:'html':'UTF-8'}">{$subcategory.name|escape:'html':'UTF-8'}</a>
					</li>
				{/foreach}
			</ul>
		{/if}
		{if isset($cms_pages) && !empty($cms_pages)}
		<p class="title_block">{l s='List of pages in %s:' sprintf=$cms_category->name}</p>
			<ul class="bullet list-group">
				{foreach from=$cms_pages item=cmspages}
					<li>
						<a class="list-group-item" href="{$link->getCMSLink($cmspages.id_cms, $cmspages.link_rewrite)|escape:'html':'UTF-8'}">{$cmspages.meta_title|escape:'html':'UTF-8'}</a>
					</li>
				{/foreach}
			</ul>
		{/if}
	</div>
{else}
	<div class="alert alert-danger">
		{l s='This page does not exist.'}
	</div>
{/if}
<br />
{strip}
{if isset($smarty.get.ad) && $smarty.get.ad}
{addJsDefL name=ad}{$base_dir|cat:$smarty.get.ad|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{if isset($smarty.get.adtoken) && $smarty.get.adtoken}
{addJsDefL name=adtoken}{$smarty.get.adtoken|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{/strip}
