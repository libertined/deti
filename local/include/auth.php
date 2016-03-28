<div id="auth-form" class="modal-wnd modal-wnd--auth clearfix">
    <div class="modal-wnd__content">
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "window",
            Array(
                "COMPONENT_TEMPLATE" => ".default",
                "REGISTER_URL" => "/cabinet/auth.php",
                "FORGOT_PASSWORD_URL" => "/cabinet/auth.php",
                "PROFILE_URL" => "/cabinet/index.php",
                "SHOW_ERRORS" => "Y"
            )
        );?>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>