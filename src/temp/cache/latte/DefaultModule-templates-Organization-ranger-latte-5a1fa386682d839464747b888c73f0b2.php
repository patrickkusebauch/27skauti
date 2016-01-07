<?php
// source: /vagrant/src/app/FrontModule/DefaultModule/templates/Organization/ranger.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0339782349', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb18a17db7e1_submenu')) { function _lb18a17db7e1_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6b223403ed_content')) { function _lb6b223403ed_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
	<div class="box-nolined">
		<p>Roveři jsou aktivní členové oddílu ve věku od 15 do cca 18 let. Pomáhají vedoucím s přípravou programu,
		zajišťují nezbytné technické i programové zázemí většiny akcí. Díky roverům se daří realizovat program, na který
		by vedoucí již neměli kapacitu. Roveři skládají tzv. čekatelské zkoušky, kde musí prokázat základní znalosti
		nejen klasických skautských disciplín, ale i zdravovědy, pedagogiky či psychologie. O něco málo níže se můžete
		podívat jaké máme v současné době aktivní rovery.</p>
	</div>
<?php $_b->templates['0339782349']->renderChildTemplate('member.latte', array('showAge' => TRUE) + $template->getParameters()) ;
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