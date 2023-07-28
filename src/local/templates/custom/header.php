<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?$APPLICATION->ShowHead()?>
    <title><?$APPLICATION->ShowTitle()?></title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>


<?$APPLICATION->ShowPanel();?>

<div id="container">

<div id="header">
	<div id="header_text">
        <div class="bx-main-title">Bitrix-test</div>
	</div>
	<div id="menu">
	<?$APPLICATION->IncludeComponent(
		"bitrix:menu", 
		"tabs", 
		Array(
			"ROOT_MENU_TYPE"	=>	"top",
			"MAX_LEVEL"	=>	"1",
			"USE_EXT"	=>	"N",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "N",
			"MENU_CACHE_GET_VARS" => Array()
		)
	);?>
	</div>
</div>

<table id="content" cellpadding="0" cellspacing="0">
	<tr>
		<td rowspan="4" width="9" class="table-border-color"><div style="width:9px"></div></td>
		<td width="4"><img src="<?=SITE_TEMPLATE_PATH?>/images/left_top_corner.gif" width="4" height="4" border="0" alt="" /></td>
		<td align="right"><img src="<?=SITE_TEMPLATE_PATH?>/images/right_top_corner.gif" width="7" height="5" border="0" alt="" /></td>
		<td rowspan="4" width="7" class="table-border-color"><div style="width:7px"></div></td>
	</tr>
	<tr>
		<td class="left-column"></td>
		<td class="main-column">
			<div id="navigation"><?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				".default",
				Array(
					"START_FROM" => "0", 
					"PATH" => "", 
					"SITE_ID" => "" 
				)
			);?></div>
			<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>