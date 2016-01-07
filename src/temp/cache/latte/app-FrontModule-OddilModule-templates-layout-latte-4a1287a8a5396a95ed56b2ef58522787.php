<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/OddilModule/templates/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3459302914', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lba499eedc03_head')) { function _lba499eedc03_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbe7ecbb7c5c_submenu')) { function _lbe7ecbb7c5c_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbec3e93bd50_scripts')) { function _lbec3e93bd50_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

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
<?php if (isset($robots)) { ?>	<meta name="robots" content="<?php echo Latte\Runtime\Filters::escapeHtml($robots, ENT_COMPAT) ?>">
<?php } ?>

	<title><?php if (isset($title)) { echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?>
 - <?php } ?>27skauti.cz</title>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/screen.css">
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/boxes.css">
	<link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>
<div id="body">
	<div id="header">
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/common/logo.gif" id="logo">
		<span id="heading">Mustang</span>
		<span id="address">www.27skauti.cz</span>
		<hr id="head_line">
		<span id="subheading">27. oddíl Liberec</span>
		<div id="submenu"><?php call_user_func(reset($_b->blocks['submenu']), $_b, get_defined_vars())  ?></div>
	</div>
	<div id="menu">
<?php $_l->tmp = $_control->getComponent("menu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;if ($user->isLoggedIn()) { ?>
		Přihlášen jako:<br><?php echo Latte\Runtime\Filters::escapeHtml($user->getIdentity()->username, ENT_NOQUOTES) ?><br>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Out!"), ENT_COMPAT) ?>
">Odhlásit se</a>		
<?php } else { ?>
			<span style="font-size:16px;" >
<?php $_l->tmp = $_control->getComponent("signInForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
			    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Sign:forgot"), ENT_COMPAT) ?>
">Zapomenuté heslo</a><br>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:Sign:register"), ENT_COMPAT) ?>
">Registrace</a>
            </span>
<?php } ?>
	</div>
	<div id="content-outer">
		<div id="content-inner">
<?php $iterations = 0; foreach ($flashes as $flash) { ?>			<div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>
		</div>
	</div>
</div>

<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>


</body>
</html>
