<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Кабинет попечителя");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">Авторизация</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Авторизация
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix">
            <?$APPLICATION->IncludeComponent(
                "bitrix:system.auth.form",
                "curator",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "REGISTER_URL" => "/cabinet/auth.php",
                    "FORGOT_PASSWORD_URL" => "/cabinet/auth.php",
                    "PROFILE_URL" => "/cabinet/index.php",
                    "SHOW_ERRORS" => "Y"
                )
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:system.auth.forgotpasswd",
                "curator",
                Array()
            );?>
        </div>
    </div>
<?//$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?//include $_SERVER["DOCUMENT_ROOT"]."/local/include/regist.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>