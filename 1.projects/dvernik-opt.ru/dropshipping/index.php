<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Дропшиппинг");
?>

    <section class="dropshipping">
        <div class="dropshipping__wrapper">
            <div class="dropshipping__inner dropshipping__inner_info"><h1 class="dropshipping__title title title_h1">
                    Дропшиппинг</h1>
                <p class="dropshipping__text">Интернет-магазин Dvernik Opt является крупным дистрибьютором белорусских
                    дверей в России. В нашем каталоге представлено несколько сотен наименований товаров, что позволяет
                    оптовым покупателям приобрести у нас дверные полотна различной ценовой категории как крупным, так и
                    мелким оптом.</p>
                <p class="dropshipping__text">Наша компания стремится сделать сотрудничество с каждым клиентом
                    максимально выгодным и удобным. Именно поэтому мы запустили дропшиппинг, позволяющий оптовым
                    покупателям не вкладывать большие суммы в приобретение товаров и их хранение. С нами Вы сможете
                    создать успешный бизнес даже с ограниченным бюджетом!</p></div>
            <div class="dropshipping__inner dropshipping__inner_steps"><h2 class="dropshipping__title title title_h3">
                    Как работает дропшиппинг Dvernik Opt?</h2>
                <p class="dropshipping__text">Пока Вы будете заниматься маркетингом и продажами, мы возьмем на себя
                    логистику и обеспечим перечисление Вам полученных от покупателей денежных средств. Модель
                    сотрудничества с нами достаточно проста.</p>
                <ul class="dropshipping__list dropshipping-steps">
                    <li class="dropshipping-steps__item"><p class="dropshipping-steps__info">
                            <span>1. Покупатель</span><br>оформляет у Вас заказ и оплачивает розничную стоимость</p>
                        <div class="dropshipping-steps__decor">
                            <svg class="dropshipping-steps__icon icon icon_customer icon_theme_red">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-customer"></use>
                            </svg>
                        </div>
                    </li>
                    <li class="dropshipping-steps__item"><p class="dropshipping-steps__info"><span>2. Вы</span><br>оформляете
                            заказ в Dvernik Opt и оплачиваете нам по специальной цене</p>
                        <div class="dropshipping-steps__decor">
                            <svg class="dropshipping-steps__icon icon icon_online-shop icon_theme_red">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-online-shop"></use>
                            </svg>
                        </div>
                    </li>
                    <li class="dropshipping-steps__item"><p class="dropshipping-steps__info">
                            <span>3. Наша компания</span><br>отправляет заказ в конечный пункт назначения либо Вы
                            самостоятельно забираете товар со склада</p>
                        <div class="dropshipping-steps__decor">
                            <svg class="dropshipping-steps__icon icon icon_delivery-truck icon_theme_red">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-delivery-truck"></use>
                            </svg>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="profit-info">
        <div class="profit-info__wrapper"><h2 class="profit-info__title title title_h3">Почему выгодно сотрудничать с
                нами?</h2>
            <ul class="profit-info__list features-list">
                <li class="features-list__item">
                    <div class="features-list__decor">
                        <svg class="features-list__icon icon icon_doors icon_theme_green">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-doors"></use>
                        </svg>
                    </div>
                    <div class="features-list__text-area"><h3 class="features-list__name">Широкий ассортимент</h3>
                        <p class="features-list__text">Предоставляем своим клиентам доступ к широкому ассортименту
                            качественных белорусских дверей на российском рынке</p></div>
                </li>
                <li class="features-list__item">
                    <div class="features-list__decor">
                        <svg class="features-list__icon icon icon_calculator icon_theme_green">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-calculator"></use>
                        </svg>
                    </div>
                    <div class="features-list__text-area"><h3 class="features-list__name">Это экономично</h3>
                        <p class="features-list__text">Помогаем сэкономить Вам деньги за счет выгодных тарифов на услуги
                            транспортных компаний.</p></div>
                </li>
                <li class="features-list__item">
                    <div class="features-list__decor">
                        <svg class="features-list__icon icon icon_delivery-2 icon_theme_green">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-delivery-2"></use>
                        </svg>
                    </div>
                    <div class="features-list__text-area"><h3 class="features-list__name">Доставка</h3>
                        <p class="features-list__text">Предлагаем доставку по всей России заказов любым удобным для Вас
                            способом.</p></div>
                </li>
                <li class="features-list__item">
                    <div class="features-list__decor">
                        <svg class="features-list__icon icon icon_feedback icon_theme_green">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/sprite.svg#icon-feedback"></use>
                        </svg>
                    </div>
                    <div class="features-list__text-area"><h3 class="features-list__name">Помощь</h3>
                        <p class="features-list__text">Оказываем профессиональную помощь по всем интересующим Вас
                            вопросам.</p></div>
                </li>
            </ul>
        </div>
    </section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>