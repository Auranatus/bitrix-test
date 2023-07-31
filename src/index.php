<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Список постов");

$APPLICATION->IncludeComponent(
    'custom:post.list',
    '.default',
    [
        'ELEMENTS_COUNT' => 3
    ]
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");