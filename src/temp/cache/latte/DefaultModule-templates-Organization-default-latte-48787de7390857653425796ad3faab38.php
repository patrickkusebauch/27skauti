<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Organization/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4372377687', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb70cbe714c9_submenu')) { function _lb70cbe714c9_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbda388e019f_content')) { function _lbda388e019f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<?php $iterations = 0; foreach ($members as $type => $people) { ?>
<div class="box-outer" id="<?php echo Latte\Runtime\Filters::escapeHtml($type, ENT_COMPAT) ?>">
    	<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($type, ENT_NOQUOTES) ?></span>
    	<div class="box-doublelined-inner in-box-text-bigger">
<?php $iterations = 0; foreach ($people as $person) { ?>
		<div style="float:left; margin-right:10px;">
<?php $file = $basePath . $config['stripePhotosStorage'] . '/' . $person->stripe ;if ($person->stripe) { ?>
		    <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file), ENT_COMPAT) ?>" alt="Frčka" style="vertical-align:middle;">
<?php } ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($person->nickname, ENT_NOQUOTES) ?>

		</div>
<?php $iterations++; } ?>
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
call_user_func(reset($_b->blocks['submenu']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

