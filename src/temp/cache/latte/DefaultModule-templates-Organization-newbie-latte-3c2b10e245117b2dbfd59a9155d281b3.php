<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Organization/newbie.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3480523430', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb8bca63562f_submenu')) { function _lb8bca63562f_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc24373a4dd_content')) { function _lbc24373a4dd_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
	<div class="box-nolined">
		<p>Každý oddíl potřebuje pravidelně doplňovat nové členy. Postupně se tak obnovuje členská základna. Rádci a
		podrádci odcházejí do roverů a na jejich místo postupně dorůstají mladší členi. Když k nám přijde nový kluk,
		má nějaký čas, aby se v oddíle rozkoukal. Po nějaké době je již přiřazen do jedné z družin a po splnění
		přijímací zkoušky se stává právoplatným členem našeho oddílu.</p>
	</div>
<?php $_b->templates['3480523430']->renderChildTemplate('member.latte', array('showAge' => FALSE) + $template->getParameters()) ;
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