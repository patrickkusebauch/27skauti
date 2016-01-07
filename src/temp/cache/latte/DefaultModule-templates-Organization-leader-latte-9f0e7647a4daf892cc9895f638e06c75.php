<?php
// source: /vagrant/src/app/FrontModule/DefaultModule/templates/Organization/leader.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7536264155', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbf5c1db95a7_submenu')) { function _lbf5c1db95a7_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3513e7d9f6_content')) { function _lb3513e7d9f6_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
	<div class="box-nolined">
		<p>Vedení oddílu je svěřeno do rukou dospělým vůdcům. Aby mohli děti vést, musí postupně složit dvě zkoušky -
		čekatelskou a vůdcovskou, zaměřenou nejen na klasické skautské disciplíny, ale především na pedagogiku,
		psychologii, schopnost organizace a týmové práce, znalost právních předpisů, zdravovědy a zásad bezpečnosti.
		Nutné je též lékařské doporučení a absolvování zdravotnického kurzu. O něco málo níže se můžete podívat,
		kdo náš oddíle vede. V případě jakýchkoliv datazů ohledně našeho oddílu je můžete s důverou kontaktovat.</p>
	</div>
<?php $_b->templates['7536264155']->renderChildTemplate('member.latte', array('showAge' => TRUE) + $template->getParameters()) ;
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