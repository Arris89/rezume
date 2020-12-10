<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ваша персональная информация");


CModule::IncludeModule('highloadblock');
if ($USER->IsAuthorized()) {
         global $USER;
   		 $USER = new CUser;
    	$us = $USER->GetID();
    	$rsUser = CUser::GetByID($us);
   		 $arUser = $rsUser->Fetch();
                        ?>
    <div class="columns-container">
        <div id="columns" class="container">

            <!-- Breadcrumb -->
            <div class="breadcrumb clearfix">
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","style",Array(
        "START_FROM" => "0", 
        "PATH" => "", 
        "SITE_ID" => "s1" 
    )
);?>
            </div>
            <!-- /Breadcrumb -->

            <div id="slider_row" class="row">
            </div>
            <div class="row">
                <div id="center_column" class="qwe11 center_column col-xs-12 col-sm-12">

                    <div class="box">
                        <h1 class="page-subheading">
                            Ваша персональная информация
                        </h1>
                        <p class="info-title">
                            Пожалуйста, не забывайте обновлять личную информацию в случае любых изменений.
                        </p>
                        <p class="required">
                            <sup>*</sup>Обязательное поле
                        </p>
                        <form action="/local/templates/style-spb/ajax/profile.php" method="post" class="std" id="std">
                        	<input name="us_id" type="hidden" value="<?=$arUser['ID']?>">
                            <fieldset>
     <!--                            <div class="clearfix">
                                    <label>Форма обращения</label>
                                    <br>
                                    <div class="radio-inline">
                                            	<input type="radio" name="id_gender" id="id_gender1" value="1">
                                            Г-н
                                    </div>
                                    <div class="radio-inline">
                                            	<input type="radio" name="id_gender" id="id_gender2" value="2">
                                            Г-жа
                                    </div>
                                </div> -->
                                <div class="required form-group">
                                    <label for="firstname" class="required">
                                        Имя
                                    </label>
                                    <input class="is_required validate form-control" type="text"
                                           id="name" name="user_name" value="">
                                </div>
                                <div class="required form-group">
                                    <label for="lastname" class="required">
                                        Фамилия
                                    </label>
                                    <input class="is_required validate form-control"type="text"
                                           name="user_surname" id="lastname" value="">
                                </div>
                                <div class="required form-group">
                                    <label for="email" class="required">
                                        Адрес электронной почты
                                    </label>
                                    <input class="is_required validate form-control"
                                           type="email" name="user_email" id="email" value="">
                                </div>
                 <!--                <div class="form-group">
                                    <label>
                                        Дата рождения
                                    </label>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="selector" id="uniform-days" style="width: 82px;">
                                            	<span style="width: 72px; user-select: none;">-</span>
                                        <select name="days" id="days" class="form-control">
                                <option value="">-</option>
                                                                    <option value="1">1&nbsp;&nbsp;</option>
                                                                    <option value="2">2&nbsp;&nbsp;</option>
                                                                    <option value="3">3&nbsp;&nbsp;</option>
                                                                    <option value="4">4&nbsp;&nbsp;</option>
                                                                    <option value="5">5&nbsp;&nbsp;</option>
                                                                    <option value="6">6&nbsp;&nbsp;</option>
                                                                    <option value="7">7&nbsp;&nbsp;</option>
                                                                    <option value="8">8&nbsp;&nbsp;</option>
                                                                    <option value="9">9&nbsp;&nbsp;</option>
                                                                    <option value="10">10&nbsp;&nbsp;</option>
                                                                    <option value="11">11&nbsp;&nbsp;</option>
                                                                    <option value="12">12&nbsp;&nbsp;</option>
                                                                    <option value="13">13&nbsp;&nbsp;</option>
                                                                    <option value="14">14&nbsp;&nbsp;</option>
                                                                    <option value="15">15&nbsp;&nbsp;</option>
                                                                    <option value="16">16&nbsp;&nbsp;</option>
                                                                    <option value="17">17&nbsp;&nbsp;</option>
                                                                    <option value="18">18&nbsp;&nbsp;</option>
                                                                    <option value="19">19&nbsp;&nbsp;</option>
                                                                    <option value="20">20&nbsp;&nbsp;</option>
                                                                    <option value="21">21&nbsp;&nbsp;</option>
                                                                    <option value="22">22&nbsp;&nbsp;</option>
                                                                    <option value="23">23&nbsp;&nbsp;</option>
                                                                    <option value="24">24&nbsp;&nbsp;</option>
                                                                    <option value="25">25&nbsp;&nbsp;</option>
                                                                    <option value="26">26&nbsp;&nbsp;</option>
                                                                    <option value="27">27&nbsp;&nbsp;</option>
                                                                    <option value="28">28&nbsp;&nbsp;</option>
                                                                    <option value="29">29&nbsp;&nbsp;</option>
                                                                    <option value="30">30&nbsp;&nbsp;</option>
                                                                    <option value="31">31&nbsp;&nbsp;</option>
                                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">

                                            <div class="selector" id="uniform-months" style="width: 82px;">
                                            	<span style="width: 72px; user-select: none;">-</span>
                                            	<select id="months" name="months" class="form-control">
                                                    <option value="">-</option>
                                                    <option value="1">Январь&nbsp;</option>
                                                    <option value="2">Февраль&nbsp;</option>
                                                    <option value="3">Март&nbsp;</option>
                                                    <option value="4">Апрель&nbsp;</option>
                                                    <option value="5">Май&nbsp;</option>
                                                    <option value="6">Июнь&nbsp;</option>
                                                    <option value="7">Июль&nbsp;</option>
                                                    <option value="8">Август&nbsp;</option>
                                                    <option value="9">Сентябрь&nbsp;</option>
                                                    <option value="10">Октябрь&nbsp;</option>
                                                    <option value="11">Ноябрь&nbsp;</option>
                                                    <option value="12">Декабрь&nbsp;</option>
                                                </select></div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="selector" id="uniform-years" style="width: 82px;">
                                            	<span style="width: 72px; user-select: none;">-</span>
                                        <select id="years" name="years" class="form-control">
                                <option value="">-</option>
                                                                    <option value="2020">2020&nbsp;&nbsp;</option>
                                                                    <option value="2019">2019&nbsp;&nbsp;</option>
                                                                    <option value="2018">2018&nbsp;&nbsp;</option>
                                                                    <option value="2017">2017&nbsp;&nbsp;</option>
                                                                    <option value="2016">2016&nbsp;&nbsp;</option>
                                                                    <option value="2015">2015&nbsp;&nbsp;</option>
                                                                    <option value="2014">2014&nbsp;&nbsp;</option>
                                                                    <option value="2013">2013&nbsp;&nbsp;</option>
                                                                    <option value="2012">2012&nbsp;&nbsp;</option>
                                                                    <option value="2011">2011&nbsp;&nbsp;</option>
                                                                    <option value="2010">2010&nbsp;&nbsp;</option>
                                                                    <option value="2009">2009&nbsp;&nbsp;</option>
                                                                    <option value="2008">2008&nbsp;&nbsp;</option>
                                                                    <option value="2007">2007&nbsp;&nbsp;</option>
                                                                    <option value="2006">2006&nbsp;&nbsp;</option>
                                                                    <option value="2005">2005&nbsp;&nbsp;</option>
                                                                    <option value="2004">2004&nbsp;&nbsp;</option>
                                                                    <option value="2003">2003&nbsp;&nbsp;</option>
                                                                    <option value="2002">2002&nbsp;&nbsp;</option>
                                                                    <option value="2001">2001&nbsp;&nbsp;</option>
                                                                    <option value="2000">2000&nbsp;&nbsp;</option>
                                                                    <option value="1999">1999&nbsp;&nbsp;</option>
                                                                    <option value="1998">1998&nbsp;&nbsp;</option>
                                                                    <option value="1997">1997&nbsp;&nbsp;</option>
                                                                    <option value="1996">1996&nbsp;&nbsp;</option>
                                                                    <option value="1995">1995&nbsp;&nbsp;</option>
                                                                    <option value="1994">1994&nbsp;&nbsp;</option>
                                                                    <option value="1993">1993&nbsp;&nbsp;</option>
                                                                    <option value="1992">1992&nbsp;&nbsp;</option>
                                                                    <option value="1991">1991&nbsp;&nbsp;</option>
                                                                    <option value="1990">1990&nbsp;&nbsp;</option>
                                                                    <option value="1989">1989&nbsp;&nbsp;</option>
                                                                    <option value="1988">1988&nbsp;&nbsp;</option>
                                                                    <option value="1987">1987&nbsp;&nbsp;</option>
                                                                    <option value="1986">1986&nbsp;&nbsp;</option>
                                                                    <option value="1985">1985&nbsp;&nbsp;</option>
                                                                    <option value="1984">1984&nbsp;&nbsp;</option>
                                                                    <option value="1983">1983&nbsp;&nbsp;</option>
                                                                    <option value="1982">1982&nbsp;&nbsp;</option>
                                                                    <option value="1981">1981&nbsp;&nbsp;</option>
                                                                    <option value="1980">1980&nbsp;&nbsp;</option>
                                                                    <option value="1979">1979&nbsp;&nbsp;</option>
                                                                    <option value="1978">1978&nbsp;&nbsp;</option>
                                                                    <option value="1977">1977&nbsp;&nbsp;</option>
                                                                    <option value="1976">1976&nbsp;&nbsp;</option>
                                                                    <option value="1975">1975&nbsp;&nbsp;</option>
                                                                    <option value="1974">1974&nbsp;&nbsp;</option>
                                                                    <option value="1973">1973&nbsp;&nbsp;</option>
                                                                    <option value="1972">1972&nbsp;&nbsp;</option>
                                                                    <option value="1971">1971&nbsp;&nbsp;</option>
                                                                    <option value="1970">1970&nbsp;&nbsp;</option>
                                                                    <option value="1969">1969&nbsp;&nbsp;</option>
                                                                    <option value="1968">1968&nbsp;&nbsp;</option>
                                                                    <option value="1967">1967&nbsp;&nbsp;</option>
                                                                    <option value="1966">1966&nbsp;&nbsp;</option>
                                                                    <option value="1965">1965&nbsp;&nbsp;</option>
                                                                    <option value="1964">1964&nbsp;&nbsp;</option>
                                                                    <option value="1963">1963&nbsp;&nbsp;</option>
                                                                    <option value="1962">1962&nbsp;&nbsp;</option>
                                                                    <option value="1961">1961&nbsp;&nbsp;</option>
                                                                    <option value="1960">1960&nbsp;&nbsp;</option>
                                                                    <option value="1959">1959&nbsp;&nbsp;</option>
                                                                    <option value="1958">1958&nbsp;&nbsp;</option>
                                                                    <option value="1957">1957&nbsp;&nbsp;</option>
                                                                    <option value="1956">1956&nbsp;&nbsp;</option>
                                                                    <option value="1955">1955&nbsp;&nbsp;</option>
                                                                    <option value="1954">1954&nbsp;&nbsp;</option>
                                                                    <option value="1953">1953&nbsp;&nbsp;</option>
                                                                    <option value="1952">1952&nbsp;&nbsp;</option>
                                                                    <option value="1951">1951&nbsp;&nbsp;</option>
                                                                    <option value="1950">1950&nbsp;&nbsp;</option>
                                                                    <option value="1949">1949&nbsp;&nbsp;</option>
                                                                    <option value="1948">1948&nbsp;&nbsp;</option>
                                                                    <option value="1947">1947&nbsp;&nbsp;</option>
                                                                    <option value="1946">1946&nbsp;&nbsp;</option>
                                                                    <option value="1945">1945&nbsp;&nbsp;</option>
                                                                    <option value="1944">1944&nbsp;&nbsp;</option>
                                                                    <option value="1943">1943&nbsp;&nbsp;</option>
                                                                    <option value="1942">1942&nbsp;&nbsp;</option>
                                                                    <option value="1941">1941&nbsp;&nbsp;</option>
                                                                    <option value="1940">1940&nbsp;&nbsp;</option>
                                                                    <option value="1939">1939&nbsp;&nbsp;</option>
                                                                    <option value="1938">1938&nbsp;&nbsp;</option>
                                                                    <option value="1937">1937&nbsp;&nbsp;</option>
                                                                    <option value="1936">1936&nbsp;&nbsp;</option>
                                                                    <option value="1935">1935&nbsp;&nbsp;</option>
                                                                    <option value="1934">1934&nbsp;&nbsp;</option>
                                                                    <option value="1933">1933&nbsp;&nbsp;</option>
                                                                    <option value="1932">1932&nbsp;&nbsp;</option>
                                                                    <option value="1931">1931&nbsp;&nbsp;</option>
                                                                    <option value="1930">1930&nbsp;&nbsp;</option>
                                                                    <option value="1929">1929&nbsp;&nbsp;</option>
                                                                    <option value="1928">1928&nbsp;&nbsp;</option>
                                                                    <option value="1927">1927&nbsp;&nbsp;</option>
                                                                    <option value="1926">1926&nbsp;&nbsp;</option>
                                                                    <option value="1925">1925&nbsp;&nbsp;</option>
                                                                    <option value="1924">1924&nbsp;&nbsp;</option>
                                                                    <option value="1923">1923&nbsp;&nbsp;</option>
                                                                    <option value="1922">1922&nbsp;&nbsp;</option>
                                                                    <option value="1921">1921&nbsp;&nbsp;</option>
                                                                    <option value="1920">1920&nbsp;&nbsp;</option>
                                                                    <option value="1919">1919&nbsp;&nbsp;</option>
                                                                    <option value="1918">1918&nbsp;&nbsp;</option>
                                                                    <option value="1917">1917&nbsp;&nbsp;</option>
                                                                    <option value="1916">1916&nbsp;&nbsp;</option>
                                                                    <option value="1915">1915&nbsp;&nbsp;</option>
                                                                    <option value="1914">1914&nbsp;&nbsp;</option>
                                                                    <option value="1913">1913&nbsp;&nbsp;</option>
                                                                    <option value="1912">1912&nbsp;&nbsp;</option>
                                                                    <option value="1911">1911&nbsp;&nbsp;</option>
                                                                    <option value="1910">1910&nbsp;&nbsp;</option>
                                                                    <option value="1909">1909&nbsp;&nbsp;</option>
                                                                    <option value="1908">1908&nbsp;&nbsp;</option>
                                                                    <option value="1907">1907&nbsp;&nbsp;</option>
                                                                    <option value="1906">1906&nbsp;&nbsp;</option>
                                                                    <option value="1905">1905&nbsp;&nbsp;</option>
                                                                    <option value="1904">1904&nbsp;&nbsp;</option>
                                                                    <option value="1903">1903&nbsp;&nbsp;</option>
                                                                    <option value="1902">1902&nbsp;&nbsp;</option>
                                                                    <option value="1901">1901&nbsp;&nbsp;</option>
                                                                    <option value="1900">1900&nbsp;&nbsp;</option>
                                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
<!--                                 <div class="required form-group form-ok">
                                    <label for="old_passwd" class="required">
                                        Текущий пароль
                                    </label>
                                    <input class="is_required validate form-control" type="password"
                                           data-validate="isPasswd" name="old_passwd" id="old_passwd">
                                </div>
                                <div class="password form-group">
                                    <label for="passwd">
                                        Новый пароль
                                    </label>
                                    <input class="is_required validate form-control" type="password"
                                           data-validate="isPasswd" name="passwd" id="passwd">
                                </div>
                                <div class="password form-group">
                                    <label for="confirmation">
                                        Пароль еще раз
                                    </label>
                                    <input class="is_required validate form-control" type="password"
                                           data-validate="isPasswd" name="confirmation" id="confirmation">
                                </div> -->
     <!--                            <div class="checkbox">
                                    <label for="newsletter">
                                        <div class="checker" id="uniform-newsletter">
                                        	<span>
                                        		<input type="checkbox" id="newsletter" name="newsletter" value="1">
                                       		 </span>
                                        </div>
                                        Подписаться на нашу рассылку!
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="optin">
                                        <div class="checker" id="uniform-optin"><span>
                                        	<input type="checkbox" name="optin" id="optin" value="1"></span>
                                        </div>
                                        Получать специальные предложения от наших партнеров
                                    </label>
                                </div> -->

                                <div class="form-group">
                                    <button type="submit" name="submitIdentity"
                                            class="btn btn-default button button-medium">
                                        <span class="save">Сохранить<i class="icon-chevron-right right"></i></span>
                                    </button>
                                </div>
                            </fieldset>
                        </form> <!-- .std -->
                    </div>
                    <ul class="footer_links clearfix">
                        <li>
                            <a class="btn btn-default button button-small" href="/personal/">
            <span>
                <i class="icon-chevron-left"></i>Вернуться к учетной записи
            </span>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-default button button-small" href="/">
            <span>
                <i class="icon-chevron-left"></i>Главная
            </span>
                            </a>
                        </li>
                    </ul>
                </div><!-- #center_column -->
            </div><!-- .row -->
        </div><!-- #columns -->
    </div>
    <?} else {

            header('Location: /authentication/');

        }?>






        				<script>
                            $(document).ready(function () {
                                $('.save').on('click', function (e) {

    e.preventDefault(); // отменит перезагрузку
        var form = $('#std');
    var url = form.attr('action'); //урл указанный в форме
   
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // вся информация с формы
           success: function(data)
           {
                  setTimeout(function(){location.reload();},100);
           }
         });





                                   /* var user_name = $("#name").val();
                                    var user_surname = $("#lastname").val();
                                    var user_email = $("#email").val();*/
                 /*   
                                    $.post('/local/templates/style-spb/ajax/profile.php', {
                                        user_email,
                                        user_name,
                                        user_surname,
                                        us_id
                                    }, 

                                    function (datab) {
                                     
											alert('норм');
                                    })*/
                                });
                            });
                        </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>