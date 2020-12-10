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
{if !isset($content_only) || !$content_only}
					</div><!-- #center_column -->
					{if isset($right_column_size) && !empty($right_column_size)}
						<div id="right_column" class="col-xs-12 col-sm-{$right_column_size|intval} column">{$HOOK_RIGHT_COLUMN}</div>
					{/if}
					</div><!-- .row -->
				</div><!-- #columns -->
			</div><!-- .columns-container -->
			{if isset($HOOK_FOOTER)}
				<!-- Footer -->
				<div class="footer-container">
					<footer id="footer"  class="container">
						<div class="row">{$HOOK_FOOTER}</div>
						<img src="//style-spb.ru/themes/default-bootstrap/img/pay_logo.png">
						<p><iframe src="https://yandex.ru/sprav/widget/rating-badge/1001270388" width="150" height="50" frameborder="0"></iframe></p>
					</footer>
				</div><!-- #footer -->
			{/if}
		</div><!-- #page -->
{/if}
{include file="$tpl_dir./global.tpl"}
<noindex>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter51396214 = new Ya.Metrika2({
                    id:51396214,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
    jQuery(document).ready(function($){
      $(document).on('click touch','#add_to_cart button',function(){
        yaCounter51396214.reachGoal('vkorzinu');
      });
      $(document).on('click touch','.ajax_add_to_cart_button',function(){
        yaCounter51396214.reachGoal('vkorzinu');
      });
      $(document).on('click touch','.cart_navigation button[name="submitGuestAccount"]',function(){
        yaCounter51396214.reachGoal('zakaz2');
      });
      $(document).on('click touch','.cart_navigation button[name="processAddress"]',function(){
        yaCounter51396214.reachGoal('zakaz3');
      });
      $(document).on('click touch','.cart_navigation button[name="processCarrier"]',function(){
        yaCounter51396214.reachGoal('zakaz4');
      });
      $(document).on('click touch','#HOOK_PAYMENT .cash',function(){
        yaCounter51396214.reachGoal('oplatanal');
      });
      $(document).on('click touch','#paykeeper_payment_module .paykeeper',function(){
        yaCounter51396214.reachGoal('oplatakarta');
      });
      $(document).on('click touch','#module-cashondelivery-validation .cart_navigation button',function(){
        yaCounter51396214.reachGoal('zakazok');
      });
      $(document).on('click touch','#header #contact-link',function(){
        yaCounter51396214.reachGoal('napisatnam');
      });
      $('.contact-form-box').submit(function(){
        yaCounter51396214.reachGoal('napisatnamok');
      });
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51396214" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</noindex>

<!-- Facebook Pixel Code -->
{literal}
<script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','2110088645756102');fbq('track','PageView')
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2110088645756102&ev=PageView&noscript=1"/></noscript>
{/literal}
<!-- End Facebook Pixel Code -->

<div itemscope itemtype="http://schema.org/Organization" style="display:none;">
  <meta itemprop="name" content="Style National Club"/>
  <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <span itemprop="streetAddress">Левашовский пр., д. 13 лит. А офис 131</span>
    <span itemprop="postalCode">197110</span>
    <span itemprop="addressLocality">г. Санкт-Петербург</span>
  </div>
  <span itemprop="telephone">8 800 505 05 17</span>
  <span itemprop="telephone">8 (812) 677-13-86</span>
  <span itemprop="telephone">8 (812) 677-07-30</span>
  <span itemprop="email">info@style-spb.ru</span>
</div>
<script type="text/javascript" src="https://cloudparser.ru/widget/script?hash=48c62b04251c71cd6ee5ad8ab13348ffda678018" async></script>
{if !$cookie->isLogged()} {literal}    <script>  jQuery(document).ready(function() {  $.fancybox('  {/literal}  <div style="width:400px">	 <form action="{$link->getPageLink('authentication.php', true)}" method="post" id="create-account_form" class="std">		 <fieldset>			 <h3>{l s='Для просмотра цен на сайте необходимо зарегистрироваться'}</h3>			 <h4>{l s='Введите адрес электронной почты для создания учетной записи'}.</h4>			 <p class="text">				 <label for="email_create">{l s='Адрес E-mail'}</label>				 <span><input type="text" id="email_create" name="email_create" value="{if isset($smarty.post.email_create)}{$smarty.post.email_create|escape:'htmlall':'UTF-8'|stripslashes}{/if}" class="account_input" /></span>			 </p>			 <p class="submit">			 {if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'htmlall':'UTF-8'}" />{/if}				 <input type="submit" id="SubmitCreate" name="SubmitCreate" class="button_large" value="{l s='Создать учетную запись'}" />				 <input type="hidden" class="hidden" name="SubmitCreate" value="{l s='Создать учетную запись'}" />			 </p>		 </fieldset>	 </form>	 <form action="{$link->getPageLink('authentication.php', true)}" method="post" id="login_form" class="std">		 <fieldset>			 <h3>{l s='Уже зарегистрированы?'}</h3>			 <p class="text">				 <label for="email">{l s='Адрес E-mail'}</label>				 <span><input type="text" id="email" name="email" value="{if isset($smarty.post.email)}{$smarty.post.email|escape:'htmlall':'UTF-8'|stripslashes}{/if}" class="account_input" /></span>			 </p>			 <p class="text">				 <label for="passwd">{l s='Пароль'}</label>				 <span><input type="password" id="passwd" name="passwd" value="{if isset($smarty.post.passwd)}{$smarty.post.passwd|escape:'htmlall':'UTF-8'|stripslashes}{/if}" class="account_input" /></span>			 </p>			 <p class="submit">				 {if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'htmlall':'UTF-8'}" />{/if}				 <input type="submit" id="SubmitLogin" name="SubmitLogin" class="button" value="{l s='Войти'}" />			 </p>			 <p class="lost_password"><a href="{$link->getPageLink('password.php')}">{l s='Забыли пароль?'}</a></p>		 </fieldset>	 </form> </a>  </div> {literal}	', {padding: 20});  });  </script>{/literal}  {/if}
	</body>
</html>