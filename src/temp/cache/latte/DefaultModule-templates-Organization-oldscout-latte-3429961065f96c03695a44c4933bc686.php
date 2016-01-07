<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Organization/oldscout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8230499621', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbad7c85e590_submenu')) { function _lbad7c85e590_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb287542ee3c_content')) { function _lb287542ee3c_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
	<div class="box-nolined">
		<p>Oldskauti jsou lidé, kteří prošli naším oddílem, někteří z nich ho nějaký čas i aktivně vedli, či alespoň s
		vedením pomáhali. V současné době se vzhledem k nejrůznějším okolnostem již nemohou aktivně podílet na přípravě
		programu pro oddíl. Pomáhají nám však svými nápady, či materiálním zázemím, které jsou ochotni oddílu
		poskytnout. O něco málo níže se můžete podívat na naše současné oldskauty.</p>
	</div>
<?php $_b->templates['8230499621']->renderChildTemplate('member.latte', array('showAge' => TRUE) + $template->getParameters()) ;
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

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 