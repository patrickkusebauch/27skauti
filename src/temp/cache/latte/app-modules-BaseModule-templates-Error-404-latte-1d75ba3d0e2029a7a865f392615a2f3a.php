<?php
// source: /vagrant/src/app/modules/BaseModule/templates/Error/404.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8764752039', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6e070a5214_content')) { function _lb6e070a5214_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <h1 class="heading_1">Stránka nenalezena</h1>
    <p>Stránka, kterou jste se pokusily zobrazit, nebyla nalezena. Je možná, že máte špatný
    odkaz nebo stránka byla smazána.</p>
    <p><small>error 404</small></p>
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 