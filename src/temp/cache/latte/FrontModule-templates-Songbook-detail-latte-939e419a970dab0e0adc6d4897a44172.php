<?php
// source: /data/web/virtuals/88857/virtual/app/modules/OddilModule/FrontModule/templates/Songbook/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0626556168', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbd9c33c86f3_head')) { function _lbd9c33c86f3_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb46fd804a33_content')) { function _lb46fd804a33_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Zpěvník</h1>
<div class="box-outer" style="clear:both;">
	<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($songbook->name, ENT_NOQUOTES) ?></span>
	<span class="box-right"><?php echo Latte\Runtime\Filters::escapeHtml($songbook->artist, ENT_NOQUOTES) ?></span>
    <div class="box-doublelined-inner">
        <?php echo $songbook->lyrics ?>

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