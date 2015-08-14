<div id="question-form" class="modal-wnd modal-wnd--wide clearfix">
    <div class="modal-wnd__content modal-wnd__content--padd15">
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "ask",
            Array(
                "COMPONENT_TEMPLATE" => ".default",
                "WEB_FORM_ID" => "3",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "N",
                "SEF_MODE" => "N",
                "VARIABLE_ALIASES" => Array(
                    "WEB_FORM_ID" => "WEB_FORM_ID",
                    "RESULT_ID" => "RESULT_ID"
                ),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "LIST_URL" => "result_list.php",
                "EDIT_URL" => "result_edit.php",
                "SUCCESS_URL" => "",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => ""
            )
        );?>
    </div>
    <span class="modal-wnd__close" href="/"></span>
</div>