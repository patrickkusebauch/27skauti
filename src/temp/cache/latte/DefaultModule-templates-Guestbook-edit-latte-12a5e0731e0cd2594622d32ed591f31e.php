<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Guestbook/edit.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0964957096', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb979fcb936b_content')) { function _lb979fcb936b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Přidat příspěvek</h1>

<div class="box-nolined">
	<p>Pokud vyberete ověřeného uživatele, tak se přezdívka a e-mail neuloží,
	místo toho se použije e-mail a přezdívka ověřeného uživatele.</p>
<?php $_l->tmp = $_control->getComponent("guestbookForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

