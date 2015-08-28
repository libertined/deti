<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Кабинет администратора");
?>
    <div class="wrapper wrapper--fill clearfix">
        <div class="breadcrumbs col-xs-7"><a href="/" class="breadcrumbs__item">главная</a> <span class="breadcrumbs__separator">&frasl;</span> <span class="breadcrumbs__current">Кабинет администратора</span></div>
        <h1 class="page-title page-title--h1 col-xs-9">
            Кабинет администратора
        </h1>
    </div>
    <div class="wrapper wrapper--fill content-block clearfix">
        <div class="col-xs-10 centered-col clearfix">
        <?if(cabinetAdminAccess()):?>
            <p><a href="/admin/projects.php">Заканчивающиеся проекты</a></p>
            <p><a href="/admin/children.php">Дети без попечителя</a></p>
            <p><a href="/admin/curators.php">Попечители у которых подходит срок попечительства</a></p>
        <?else:?>

            <p class="error">У вас недостаточно прав для доступа к данной странице.</p>
        <?endif;?>
        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>