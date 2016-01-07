<?php
// source: /vagrant/src/app/FrontModule/DefaultModule/templates/Hlasinek/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7402333930', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbc87721ba9c_head')) { function _lbc87721ba9c_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/hlasinek.css">
	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/paginator.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd73c05223c_content')) { function _lbd73c05223c_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<?php $_l->tmp = $_control->getComponent("vp"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
<div class="box-nolined">
	<p>Hlásínek je náš oddílový časopis s dlouholetou tradicí, který vychází pravidelně každý měsíc.</p>
	<p>Hlásínek začal vycházet již v roce 1983, kdy byl založen náš oddíl. V roce 1994 byl Hlásínek nahrazen
	vícestránkovým časopisem Guláš. Guláš přestal vycházet v roce 1997, kdy byl opět nahrazen klasickým Hlásínkem.</p>
	<p>Úkolem Hlásínku je informovat všechny členy oddílu o bodování, připravovaných akcích a zajímavých událostech,
	které se v daném měsíci udály. V současné době je hlavním redaktorem Klíšťák.</p>
</div>
<?php $_b->templates['7402333930']->renderChildTemplate('hlasinek.latte', array('dir' => $dir) + $template->getParameters()) ;
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 