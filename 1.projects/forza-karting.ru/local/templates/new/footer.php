<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$footpage = $APPLICATION->GetCurPage(false);

if (($footpage !== '/children/') && ($footpage !== '/kartingschool/')) {
    ?>

    <section class="opening-contacts" id="contacts">
        <div class="container">
            <div class="opening-contacts__text">
                <h2 class="opening-contacts__title">Контакты</h2>
                <div class="opening-contacts__contacts">
                    <div class="opening-contact opening-contact_phone"><span class="opening-contact__icon">
												<svg>
													<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#phone"></use>
												</svg></span><span class="opening-contact__text"><a
                                    href="tel:+74956403302">+7 (495) 640 33 02</a></span></div>
                    <div class="opening-contact opening-contact_phone"><span class="opening-contact__icon">
												<svg>
													<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#phone"></use>
												</svg></span><span class="opening-contact__text"><a
                                    href="tel:+79690771112">+7 (969) 077 11 12</a></span></div>
                    <div class="opening-contact opening-contact_address"><span class="opening-contact__icon">
												<svg>
													<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#address"></use>
												</svg></span><span class="opening-contact__text">Москва, Шарикоподшипниковская, улица&nbsp;13,&nbsp;ст.&nbsp;41 (мы в здании напротив)</span>
                    </div>
                    <div class="opening-contact opening-contact_email"><span class="opening-contact__icon">
												<svg>
													<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#time"></use>
												</svg></span><span class="opening-contact__text"><a
                                    href="mailto:info@forza-karting.ru">info@forza-karting.ru</a></span></div>
                    <div class="opening-contact opening-contact_email"><span class="opening-contact__icon">
												<svg>
													<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#time"></use>
												</svg></span><span class="opening-contact__text"><a
                                    href="mailto:alex@forza-karting.ru">
                            alex@forza-karting.ru (по вопросам сотрудничества)
                        </a></span></div>
                </div>
                <div class="opening-contacts__routes">
                    <ul class="opening-contacts-routes">
                        <li class="js-route is-active">
                            <button class="opening-contacts-routes__title js-route-title" type="button"
                                    data-travel-mode="WALKING" data-start="55.717734, 37.677035"
                                    data-waypoints="55.714838, 37.679166; 55.716891, 37.686521">Как добраться до нас
                                от м. «Дубровка»
                            </button>
                            <div class="opening-contacts-routes__descr js-route-descr">
                                <?php $APPLICATION->IncludeComponent(
                                    'bitrix:main.include',
                                    '',
                                    [
                                        'AREA_FILE_SHOW' => 'file',
                                        'PATH' => '/include_content/footer_from_dubrovka.php',
                                        'AREA_FILE_RECURSIVE' => 'N',
                                        'EDIT_MODE' => 'php',
                                    ]
                                ); ?>
                            </div>
                        </li>
                        <li class="js-route">
                            <button class="opening-contacts-routes__title js-route-title" type="button"
                                    data-travel-mode="WALKING" data-start="55.724689, 37.687659"
                                    data-waypoints="55.722919, 37.681845">Как добраться от м. Волгоградский проспект
                            </button>
                            <div class="opening-contacts-routes__descr js-route-descr">
                                <?php $APPLICATION->IncludeComponent(
                                    'bitrix:main.include',
                                    '',
                                    [
                                        'AREA_FILE_SHOW' => 'file',
                                        'PATH' => '/include_content/footer_from_volgograd_prospect.php',
                                        'AREA_FILE_RECURSIVE' => 'N',
                                        'EDIT_MODE' => 'php',
                                    ]
                                ); ?>
                            </div>
                        </li>
                        <li class="js-route">
                            <button class="opening-contacts-routes__title js-route-title" type="button"
                                    data-travel-mode="DRIVING" data-start="55.718252, 37.693946">На машине
                            </button>
                            <div class="opening-contacts-routes__descr js-route-descr">
                                <?php $APPLICATION->IncludeComponent(
                                    'bitrix:main.include',
                                    '',
                                    [
                                        'AREA_FILE_SHOW' => 'file',
                                        'PATH' => '/include_content/footer_by_car.php',
                                        'AREA_FILE_RECURSIVE' => 'N',
                                        'EDIT_MODE' => 'php',
                                    ]
                                ); ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="opening-contacts__map">
            <div class="opening-contacts__map-inner js-opening-contacts-map"></div>
        </div>
    </section>
    <div class="fixed-contacts" data-aos="fade-left" data-aos-anchor-placement="center-bottom">
        <div class="fixed-contacts__close"></div>
        <div class="fixed-contacts__item">
            <a class="fixed-contacts__phone" href="tel:+74956403302">
									<span class="is-mobile">
										<svg><use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#fixed-phone"></use></svg>
									</span>
                <span class="is-desktop">+7 (495) 640 33 02</span>
            </a>
        </div>
        <div class="fixed-contacts__item"><a class="fixed-contacts__address is-desktop js-anchor" href="#contacts">
                <span>г. Москва, Шарикоподшипниковская,&nbsp;13&nbsp;ст.&nbsp;41 (мы в здании напротив)</span></a>
            <span class="fixed-contacts__address is-mobile">
            <svg><use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#fixed-address"></use></svg>
        </span>
        </div>
    </div>
    </main>
    <div class="popup__hidden">
        <div id="popup-registration">
            <div class="popup__title">Регистрация</div>
            <div class="popup__descr">
                <p>Просто заполните данные формы и приходите к нам, как только мы откроемся. <br> Мы сообщим Вам об этом
                    по
                    телефону!</p>
            </div>
            <form class="popup-form js-form-ajax" action="/registration/" method="post">
                <div class="popup-form__input">
                    <input class="input-text" type="text" name="name" required placeholder="Ваше имя*">
                </div>
                <div class="popup-form__input">
                    <input class="input-text" type="text" name="lastName" required placeholder="Ваша фамилия*">
                </div>
                <div class="popup-form__input">
                    <input class="input-text" type="text" name="phone" required placeholder="Телефон*">
                </div>
                <div class="popup-form__input">
                    <input class="input-text" type="email" name="email" placeholder="E-mail">
                </div>
                <div class="popup-form__input popup-form__input_submit">
                    <button class="btn btn_small" type="submit" name="sendRegistration" value="send">Зарегистрироваться
                    </button>
                </div>
            </form>
            <div class="popup__descr-bottom">
                <p>Скидка предоставляется на&nbsp;заезды на&nbsp;прокатном или детском карте и&nbsp;не&nbsp;суммируется
                    с&nbsp;другими
                    скидками и&nbsp;специальными предложениями. Скидка действует на&nbsp;один заезд на&nbsp;одного
                    гостя.</p>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="footer-wrap">
        <footer class="footer">
            <div class="container">
                <div class="footer__soc-links">
                    <ul class="soc-links">
                        <li><a href="https://vk.com/forzakarting" target="_blank" title="Наша страница ВКонтакте">
                                <svg>
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#vk"></use>
                                </svg>
                            </a></li>
                        <li><a href="https://www.instagram.com/forzakarting/" target="_blank"
                               title="Наша страница в Instagram">
                                <svg>
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#instagram"></use>
                                </svg>
                            </a></li>
                        <li><a href="https://www.facebook.com/ForzaKarting/" target="_blank"
                               title="Наша страница в Facebook">
                                <svg>
                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/images/sprites.svg#facebook"></use>
                                </svg>
                            </a></li>
                    </ul>
                </div>
                <div class="footer__copyright">Copyright &copy;&nbsp;ООО &laquo;Forza&raquo; <?= date('Y') ?>г. Не&nbsp;является
                    публичной офертой
                </div>
            </div>
        </footer>
    </div>
    </div>

<?
} else {
    ?>
    </div>
    </div>
    <div class="footer-wrap is-footer-bottom">
        <div class="container">
            <footer class="footer"><span>© 2000 - 2019 Forza Miks</span><a href="#">Все права защищены</a></footer>
        </div>
    </div>
<? } ?>

<script src="<?= SITE_TEMPLATE_PATH ?>/js/vendor.js?v=1563198286643"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/main.js?v=1563198286643"></script>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/fix.js?v=1563198286649"></script>
</body>
</html>