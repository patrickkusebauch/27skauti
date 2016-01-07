<?php
// source: /data/web/virtuals/88857/virtual/app/modules/OddilModule/FrontModule/templates/Notebook/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3756062881', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbc2bcf0232a_head')) { function _lbc2bcf0232a_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3365d3f500_content')) { function _lb3365d3f500_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Zápisník</h1>
<div class="box-outer" style="clear:both;">
	<span class="box-left-small"><?php echo Latte\Runtime\Filters::escapeHtml($notebook->name, ENT_NOQUOTES) ?></span>
    <div class="box-doublelined-inner">
    <p>
        <span class="bold">Témata: </span><?php echo Latte\Runtime\Filters::escapeHtml($notebook->tags, ENT_NOQUOTES) ?>

    </p>
    <?php echo $notebook->content ?>

    </div>
</div>
<?php
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