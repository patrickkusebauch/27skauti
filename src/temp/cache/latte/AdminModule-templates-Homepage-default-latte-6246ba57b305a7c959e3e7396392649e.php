<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0868885973', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbeb5ca2ae46_content')) { function _lbeb5ca2ae46_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Admin</h1>
<div class="box-outer">
<span class="box-left">Oprávnění</span>
<div class="box-nolined">
	<p>Momentálně máte přístup do těchto sekcí s těmito oprávněními:</p>
	<table class="table"><thead><tr><th>Sekce</th><th>Oprávnění</th></tr></thead><tbody>
		<tr><td>Obecně</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->base, ENT_NOQUOTES) ?></td></tr>
<?php if ($privilege->news) { ?>		<tr><td>Aktuality</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->news, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->event) { ?>		<tr><td>Akce/Kalendář</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->event, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->chronicle) { ?>		<tr><td>Kronika/Historie oddílu</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->chronicle, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->vip) { ?>		<tr><td>VIP Kronika</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->vip, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->hlasinek) { ?>		<tr><td>Hlásínek</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->hlasinek, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->registration) { ?>		<tr><td>Registrace/Organizace</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->registration, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->guestbook) { ?>		<tr><td>Kniha návštěv</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->guestbook, ENT_NOQUOTES) ?></td></tr>
<?php } if ($privilege->privilege) { ?>		<tr><td>Práva</td><td><?php echo Latte\Runtime\Filters::escapeHtml($privilege->privilege, ENT_NOQUOTES) ?></td></tr>
<?php } ?>
	</tbody></table>
</div>
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 