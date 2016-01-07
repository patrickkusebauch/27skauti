<?php
// source: /data/web/virtuals/88857/virtual/app/Modules/BaseModule/templates/Error/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6276975608', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="robots" content="noindex">

	<title>27skauti.cz</title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/screen.css">
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/boxes.css">
	<link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
</head>

<body>
<div id="body">
	<div id="header">
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/common/logo.gif" id="logo">
		<span id="heading">Mustang</span>
		<span id="address">www.27skauti.cz</span>
		<hr id="head_line">
		<span id="subheading">27. oddíl Liberec</span>
	</div>
    <div id="menu">
<ul>
	<li>
	        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Homepage:"), ENT_COMPAT) ?>
">Úvod</a>
	</li>
	<li>
	        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:News:"), ENT_COMPAT) ?>
">Aktuality/Akce</a>
	</li>
	<li>
	        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Organization:"), ENT_COMPAT) ?>
">Organizace</a>
	</li>
	<li>
	        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Chronicle:"), ENT_COMPAT) ?>
">Kronika</a>
	</li>
	<li>
	        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Hlasinek:"), ENT_COMPAT) ?>
">Hlásínek</a>
	</li>
	<li>
	        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Guestbook:"), ENT_COMPAT) ?>
">Kniha Návštěv</a>
	</li>
</ul>
	</div>
	<div id="content-outer">
		<div id="content-inner">
<?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>
		</div>
    </div>
</div>

</body>
</html>