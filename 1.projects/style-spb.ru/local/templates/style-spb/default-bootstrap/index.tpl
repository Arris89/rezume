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
<!-- banners mainpage -->
<div class="grid-container">
	<div class="grid-block first">
		<div class="block-title">
			Lookbook
		</div>
		<a href="/productlookbooks" class="block-link"></a>
	</div>
	<div class="grid-block second">
		<div class="block-title">
			Пальто
		</div>
		<a href="/12-coats" class="block-link"></a>
	</div>
	<!--<div class="grid-block third">
		<div class="block-title">
			Распродажа
		</div>
		<a href="/25-sale" class="block-link"></a>
	</div>-->
	<div class="grid-block fourth">
		<div class="block-title">
			Irina Lari Collection
		</div>
		<a href="/13-irina-lari" class="block-link"></a>
	</div>
</div>
<style>
	.grid-container {
		display: grid;
		grid-gap: 30px;
		grid-template-columns: 0.9fr 0.9fr 1.2fr;
		grid-template-rows: 350px 200px 150px;
		grid-template-areas: 
		"a a b"
		"d d b"
		"d d b";
		margin-bottom: 30px;
	}
	
	@media screen and (max-width: 767px){
		.grid-container {
			display: block;
		}

		.grid-block{
			display: block;
			margin-bottom: 30px;
			height: 300px;
		}
	}
	
	.grid-block{
		background-color: #aeaeae;
		background-size: cover;
		background-position: center 0;
		position: relative;
	}

	.block-title{
		width: 100%;
		position: absolute;
		bottom: 0;
		text-align: center;
		background: rgba(0,0,0,.5);
		font-size: 18px;
		color: #fff;
		padding: 10px;
	}

	.block-link{
		display: inline-block;
		position: absolute;
		width: 100%;
		height: 100%;
	}

	.grid-block.first{
		grid-area: a;
		background-image: url('/upload/lookbook_h.jpg');
        background-position: 50% 50%;
	}

	.grid-block.second{
		grid-area: b;
		background-image: url('/upload/sale2020.png');
	}

	.grid-block.third{
		grid-area: c;
		background-image: url('/upload/sale.jpg');
        background-position: 50% 8%;
	}

	.grid-block.fourth{
		grid-area: d;
		background-image: url('/upload/IrinaLari_light.png');
	}

	.grid-block.fifth{
		grid-area: e;
		background-image: url('/upload/h1.jpg');
        background-position: 50% 35%;
	}
</style>
<!-- /banners mainpage -->
{if isset($HOOK_HOME_TAB_CONTENT) && $HOOK_HOME_TAB_CONTENT|trim}
    {if isset($HOOK_HOME_TAB) && $HOOK_HOME_TAB|trim}
        <ul id="home-page-tabs" class="nav nav-tabs clearfix">
			{$HOOK_HOME_TAB}
		</ul>
	{/if}
	<div class="tab-content">{$HOOK_HOME_TAB_CONTENT}</div>
{/if}
{if isset($HOOK_HOME) && $HOOK_HOME|trim}
	<div class="clearfix">{$HOOK_HOME}</div>
{/if}