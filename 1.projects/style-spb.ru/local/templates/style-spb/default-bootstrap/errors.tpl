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
{assign var=foo value='0'}
{if isset($errors) && $errors}
	<div class="alert alert-danger">
		<p>{if $errors|@count > 1}{l s='There are %d errors' sprintf=$errors|@count}{else}{l s='There is %d error' sprintf=$errors|@count}{/if}</p>
		<ol>
		{foreach from=$errors key=k item=error}
			<li>{$error}</li>
			{if $error == 'Товар не найден' || $error == 'Page not found' }
				{assign var=foo value='1'}
			{/if}
		{/foreach}
		</ol>
		{if isset($smarty.server.HTTP_REFERER) && !strstr($request_uri, 'authentication') && preg_replace('#^https?://[^/]+/#', '/', $smarty.server.HTTP_REFERER) != $request_uri}
			<p class="lnk"><a class="alert-link" href="{$smarty.server.HTTP_REFERER|escape:'html':'UTF-8'|secureReferrer}" title="{l s='Back'}">&laquo; {l s='Back'}</a></p>
		{/if}
	</div>
{/if}
{if $foo == 1 }
	<div id="pagenotfound">
	<div id="center_column" class="center_column col-xs-12 col-sm-12"><div class="pagenotfound"><h1>Страница недоступна</h1><p> Извините, запрошеной вами страницы не существует</p><div class="h3">Для поиска товара введите его наименование в следующее поле</div><form action="https://style-spb.ru/search" method="post" class="std"><fieldset><div> <label for="search_query">Поиск в каталоге:</label> <input id="search_query" name="search_query" type="text" class="form-control grey"> <button type="submit" name="Submit" value="OK" class="btn btn-default button button-small"><span>OK</span></button></div></fieldset></form><div class="buttons"><a class="btn btn-default button button-medium" href="https://style-spb.ru/" title="Главная"><span><i class="icon-chevron-left left"></i>Главная</span></a></div></div></div>
	</div>
{/if}