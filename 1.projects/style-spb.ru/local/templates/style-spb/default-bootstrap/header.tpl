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
<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9"{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}><![endif]-->
<html{if isset($language_code) && $language_code} lang="{$language_code|escape:'html':'UTF-8'}"{/if}>
	<head>
		<meta charset="utf-8" />
		{if isset($product)}
			<meta name="old_data" content="" />
			<title>Купить {$product->name|escape:'html':'UTF-8'|mb_substr:0:1|lower}{$product->name|escape:'html':'UTF-8'|mb_substr:1} ({$product->reference|escape:'html':'UTF-8'}) от производителя классической и деловой одежды с доставкой по России - style-spb.ru</title>
			<meta name="description" content="{$product->name|escape:'html':'UTF-8'} ({$product->reference|escape:'html':'UTF-8'}) оптом и в розницу от ведущего производителя женской классической и деловой одежды - компании Style National" />
		{elseif isset($cms) && $cms->id_cms_category == 2}
			<title>{$meta_title|escape:'html':'UTF-8'}</title>
			{if isset($meta_description) AND $meta_description}
				<meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />
			{else}
				<meta name="description" content="{$meta_title|escape:'html':'UTF-8'}" />
			{/if}
		{else}
			<title>{$meta_title|escape:'html':'UTF-8'|replace:' - STYLE NATIONAL CLUB':''}</title>
			{if isset($meta_description) AND $meta_description}
				<meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />
			{/if}
		{/if}
		{if $page_name == 'product' && isset($product->id)}
			<link rel="canonical" href="{$link->getProductLink($product->id)}" />
		{/if}
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
		<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
		<meta name="yandex-verification" content="071d97fd301498ef" />
		{if isset($js_defer) && !$js_defer && isset($js_files) && isset($js_def)}
			{$js_def}
			{foreach from=$js_files item=js_uri}
			<script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
			{/foreach}
		{/if}
		{$HOOK_HEADER}
		
		{if isset($css_files)}
			{foreach from=$css_files key=css_uri item=media}
				{if $css_uri == 'lteIE9'}
					<!--[if lte IE 9]>
					{foreach from=$css_files[$css_uri] key=css_uriie9 item=mediaie9}
					<link rel="stylesheet" href="{$css_uriie9|escape:'html':'UTF-8'}" type="text/css" media="{$mediaie9|escape:'html':'UTF-8'}" />
					{/foreach}
					<![endif]-->
				{else}
					{if $mobile_device}
						<link rel="preload" as="style" href="{$css_uri|escape:'html':'UTF-8'}" onload="this.rel='stylesheet'">
						<noscript><link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}"/></noscript>
					{else}
						<link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}"/>
					{/if}
				{/if}
			{/foreach}
		{/if}		
		{if $mobile_device}
			<link rel="preload" as="style" href="//fonts.googleapis.com/css?family=Open+Sans:300,600&amp;subset=latin,latin-ext" onload="this.rel='stylesheet'">
			<noscript><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,600&amp;subset=latin,latin-ext" type="text/css" media="all"/></noscript>
		{else}
			<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,600&amp;subset=latin,latin-ext" type="text/css" media="all"/>
		{/if}
		
		<!--[if IE 8]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<!-- rollover script -->
		<!--<script>
		var sourceSwap = function () {
			var $this = $(this).find('img');
			var newSource = $this.data('rollover');
			if(newSource!=0){
			$this.data('rollover', $this.attr('src'));
			$this.attr('src', newSource);
			}
		}

		
		$('.product_list li div').on('mouseenter','div.left-block',function(e){
			sourceSwap()
		}).on("mouseleave", "div.left-block", function(e){
			sourceSwap()
		});
		
		//$(function () {
		//	$('div.left-block').hover(sourceSwap, sourceSwap);
		//});
		</script>-->
	</head>
	<body{if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if} class="{if isset($page_name)}{$page_name|escape:'html':'UTF-8'}{/if}{if isset($body_classes) && $body_classes|@count} {implode value=$body_classes separator=' '}{/if}{if $hide_left_column} hide-left-column{else} show-left-column{/if}{if $hide_right_column} hide-right-column{else} show-right-column{/if}{if isset($content_only) && $content_only} content_only{/if} lang_{$lang_iso}">
	{if !isset($content_only) || !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'}{if isset($geolocation_country) && $geolocation_country} <span class="bold">{$geolocation_country|escape:'html':'UTF-8'}</span>{/if}</p>
			</div>
		{/if}
		<div id="page">
			<div class="header-container">
				<header id="header">
					{capture name='displayBanner'}{hook h='displayBanner'}{/capture}
					{if $smarty.capture.displayBanner}
						<div class="banner">
							<div class="container">
								<div class="row">
									{$smarty.capture.displayBanner}
								</div>
							</div>
						</div>
					{/if}
					{capture name='displayNav'}{hook h='displayNav'}{/capture}
					{if $smarty.capture.displayNav}
						<div class="nav">
							<div class="container hide-mobile">
								<div class="row d1">
									<nav>{$smarty.capture.displayNav}</nav>
								</div>
							</div>
							<div class="mobileMenu">
								<div class="container-fluid">
									<div class="row m1">
                                        <div class="col-xs-6 nopad text-center">
                                            <a href="tel:+7(812)6771386" class="mobile-phone">+7 (812) 677-13-86</a>
                                        </div>
                                        <div class="col-xs-6 nopad text-center">
                                            <a href="tel:8(800)5050517" class="mobile-phone">8 (800) 505-05-17</a>
                                        </div>
										<div class="col-xs-2 nopad">
											<button class="menuBtn menuToggle"></button>
										</div>
										<div class="col-xs-6 nopad">
											<form class="searchMobile" style="display: none;" id="searchbox" method="get" action="//style-spb.ru/search"> <input type="hidden" name="controller" value="search"> <input type="hidden" name="orderby" value="position"> <input type="hidden" name="orderway" value="desc"> <input class="search_query form-control ac_input" type="text" id="search_query_top" name="search_query" placeholder="Поиск" value="" autocomplete="off"></form>
										</div>
										<div class="col-xs-4"style="text-align: right;">
											<button class="menuBtn menuSearch"></button>
											<a href="/order"><button class="menuBtn menuCart"></button></a>
										</div>
										
										<script>
												$(function(){
													$(".menuToggle").click(function(){
														$("ul.sf-menu").fadeToggle(250);
													});
													$(".menuSearch").click(function(){
														if($(".searchMobile .search_query").val()){
															$(".searchMobile").submit();
														}else{
															$(".mobileMenu .searchMobile").fadeToggle(250);
														}
													});
												})
											</script>
									</div>
								</div>
							</div>
						</div>
					{/if}
					<div>
						<div class="container">
							<div class="row">
								<div id="header_logo">
									<a href="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" title="{$shop_name|escape:'html':'UTF-8'}">
										<img class="logo img-responsive" src="/upload/style-logo.png" data-oldsrc="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
									</a>
									<!--<img class="logo img-responsive" src="/upload/topa.png" data-oldsrc="{$logo_url}" alt="{$shop_name|escape:'html':'UTF-8'}"{if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>-->
									<img src="/upload/topa.png" {if isset($logo_image_width) && $logo_image_width} width="{$logo_image_width}"{/if}{if isset($logo_image_height) && $logo_image_height} height="{$logo_image_height}"{/if}/>
								</div>
								{if isset($HOOK_TOP)}{$HOOK_TOP}{/if}
							</div>
						</div>
					</div>
				</header>
			</div>
			<div class="columns-container">
				<div id="columns" class="container">
					{if $page_name !='index' && $page_name !='pagenotfound'}
						{include file="$tpl_dir./breadcrumb.tpl"}
					{/if}
					<div id="slider_row" class="row">
						{capture name='displayTopColumn'}{hook h='displayTopColumn'}{/capture}
						{if $smarty.capture.displayTopColumn}
							<div id="top_column" class="center_column col-xs-12 col-sm-12">{$smarty.capture.displayTopColumn}</div>
						{/if}
					</div>
					<div class="row">
						{if isset($left_column_size) && !empty($left_column_size)}
						<div id="left_column" class="column col-xs-12 col-sm-{$left_column_size|intval}">{$HOOK_LEFT_COLUMN}{hook h='displayCustomSlick'}
                            {*<script type="text/javascript" src="/modules/magicslideshow/views/js/magicslideshow.js"></script>*}
                            {*<link rel="stylesheet" href="/modules/magicslideshow/views/css/magicslideshow.css">*}
                            {hook h='displaymagicslideshow'}
                            <script>
                                $(document).ready(function(){
                                    $('.MagicSlideshow').slick({
                                        infinite: true,
                                        slidesToShow: 1,
                                        slidesToScroll: 1,
                                        autoplay: true,
                                        autoplaySpeed: 5000
                                });
                                });
                            </script>
						</div>
						{/if}
						{if isset($left_column_size) && isset($right_column_size)}{assign var='cols' value=(12 - $left_column_size - $right_column_size)}{else}{assign var='cols' value=12}{/if}
						<div id="center_column" class="qwe11 center_column col-xs-12 col-sm-{$cols|intval}">
	{/if}
