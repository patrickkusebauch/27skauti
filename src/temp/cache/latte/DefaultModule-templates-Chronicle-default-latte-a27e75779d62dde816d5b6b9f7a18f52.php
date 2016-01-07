<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Chronicle/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0384198651', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb2103ae1fef_head')) { function _lb2103ae1fef_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/paginator.css">
<?php
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb70c3248866_submenu')) { function _lb70c3248866_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf5d9184a1e_content')) { function _lbf5d9184a1e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kronika</h1>
<?php $_l->tmp = $_control->getComponent("vp"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;$iterations = 0; foreach ($chronicles as $chronicle) { ?>
<div class="box-outer">
	<div class="box-innerlined-inner">
		<div class="box-innerlined-inner-heading">
			<span class="box-left"><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:detail", array('id'=>$chronicle->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($chronicle->name, 30), ENT_NOQUOTES) ?></a></span>
			<span class="box-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->dateend, '%B %Y'), ENT_NOQUOTES) ?></span>
		</div>
<?php if ($chronicle->related('chronicle_photos')->where('intro', 1)->fetch()) { ?>
		<div class="picture-outer" style="margin-top:10px;">
<?php $_b->templates['0384198651']->renderChildTemplate('../common/chronicle_picture.latte', array('chronicle' => $chronicle) + $template->getParameters()) ?>
		</div>
<?php } ?>
		<table class="in-box-table" style="width:450px; margin-top:30px;">
			<thead></thead><tbody style="vertical-align: top;">
				<tr>
					<td class="italic">Datum:</td><td class="bold">
<?php if ($chronicle->datestart == $chronicle->dateend) { ?>
						<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } elseif ($chronicle->datestart->format('n') == $chronicle->dateend->format('n')) { ?>
						<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } else { ?>
						<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } ?>
					</td>
				</tr><?php if ($chronicle->route) { ?><tr>
					<td class="italic">Trasa:</td><td class="bold"><?php echo Latte\Runtime\Filters::escapeHtml($chronicle->route, ENT_NOQUOTES) ?></td>
				</tr>
<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php $iterations++; } ?>

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

<?php call_user_func(reset($_b->blocks['submenu']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 