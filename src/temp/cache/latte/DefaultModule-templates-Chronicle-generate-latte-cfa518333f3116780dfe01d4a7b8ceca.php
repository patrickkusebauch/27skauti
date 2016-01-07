<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Chronicle/generate.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6166434656', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbec1fa87850_scripts')) { function _lbec1fa87850_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbf18ebf5c4c_head')) { function _lbf18ebf5c4c_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <script type="text/JavaScript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/jquery.js"></script>
        <script type="text/JavaScript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/jquery.livequery.js"></script>
        <script type="text/JavaScript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/jquery.nette.js"></script>
        <script type="text/JavaScript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/js/netteForms.js"></script>
	    <script type="text/JavaScript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($baseUri), ENT_COMPAT) ?>/modules/multipleFileUpload/js/MFUFallbackController.js"></script>
	    <?php echo MultipleFileUpload::getHead() ?>

<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb7a674fde15_content')) { function _lb7a674fde15_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kronika - Nahrávání fotek</h1>
<div class="box-outer">
	<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($event->name, 45), ENT_NOQUOTES) ?>

<?php if ($event->datestart == $event->dateend) { ?>
        (<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
        (<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } else { ?>
        (<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
    <?php } ?></span>
	<div class="box-nolined">
<div id="<?php echo $_control->getSnippetId('form') ?>"><?php call_user_func(reset($_b->blocks['_form']), $_b, $template->getParameters()) ?>
</div>    </div>
</div>
<?php
}}

//
// block _form
//
if (!function_exists($_b->blocks['_form'][] = '_lb1b16cd7257__form')) { function _lb1b16cd7257__form($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('form', FALSE)
;$_l->tmp = $_control->getComponent("uploadPhotosForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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
call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

