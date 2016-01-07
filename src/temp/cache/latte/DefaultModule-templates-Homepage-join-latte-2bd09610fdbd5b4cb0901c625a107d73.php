<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Homepage/join.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9608762977', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbe218a4e7d6_submenu')) { function _lbe218a4e7d6_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb16da9b2176_content')) { function _lb16da9b2176_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<div class="box-outer">
	<div class="box-doublelined-inner">
		<p>Pokud Vás činnost našeho oddílu zaujala, můžete nám poslat nezávaznou přihlášku. My se Vám ozveme a domluvíme  další podrobnosti, které by Vás mohly zajímat. Pro lepší přehled vyplňte i školu a třídu, do které Váš syn chodí – preferujeme kluky za 3. – 5. tříd, ale příp. se můžeme dohodnout i na vstupu syna staršího věku. Pokud byste měli zájem přihlásit syna mladšího nebo Vaši dceru, rádi předáme kontakt na další skautské oddíly v našem středisku.</p>
		<p>A pokud ještě chodíš na základní školu a máš o náš oddíl zájem, nezapomeň o své zaslané nezávazné přihlášce říci rodičům nebo ještě lépe, pošli nám kontakty přímo na ně.</p>
	</div>
</div>
<?php $_l->tmp = $_control->getComponent("optInForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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

