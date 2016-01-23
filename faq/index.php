<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Вопросы и ответы. FAQ.");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">Вопросы и ответы. FAQ.</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Вопросы и ответы. FAQ.
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-9 left-col left-col--shift160 clearfix news-list">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "faq",
                Array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "IBLOCK_TYPE" => "news",
                    "IBLOCK_ID" => "11",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "",
                    "FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "DETAIL_TEXT"),
                    "PROPERTY_CODE" => array("", ""),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => ""
                )
            );?>
            <div class="col-xs-4 centered-col clearfix content-block">
                <div class="btn btn--full btn--gray modal-open" data-src="question-form" data-load="/ajax/faq_form.php">Задать свой вопрос</div>
            </div>
        </div>
    </div>
<?$APPLICATION->AddHeadScript('/local/js/jquery.form.js');?>
<?include $_SERVER["DOCUMENT_ROOT"]."/local/include/ask_quest.php";?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>