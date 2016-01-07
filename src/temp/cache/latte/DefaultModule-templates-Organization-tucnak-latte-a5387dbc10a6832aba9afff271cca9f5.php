<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Organization/tucnak.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7834659311', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb1bf275fb5d_submenu')) { function _lb1bf275fb5d_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd8c35b33c0_content')) { function _lbd8c35b33c0_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
	<div class="box-nolined">
		<p>Základní stavební jednotkou každého oddílu je družina. V systému "party" vede skautskou družinu starší a
		zkušenější chlapec tzv. rádce a pomáhá mu jeho zástupce podrádce. Na správný chod každé družiny dohlížejí
		samozřejmě vedoucí a roveři. Každý ze členů má možnost podílet se na tvorbě programu a utvářet život oddílu.
		Družina Tučňáků, kterou si můžete prohlédnout o něco málo níže, funguje již od vzniku našeho oddílu a prošli
		jí již desítky lidí.</p>
	</div>
<?php $_b->templates['7834659311']->renderChildTemplate('member.latte', array('showAge' => FALSE) + $template->getParameters()) ;
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

