<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/History/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6304001551', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbeadb3f3a5a_content')) { function _lbeadb3f3a5a_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Historie oddílu</h1>

<div class="box-nolined">
<?php if ($user->isAllowed('Admin:Default:History', 'create')) { ?>	<p><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("create"), ENT_COMPAT) ?>
">Přidat historii oddílu</a></p>
<?php } if ($histories->fetch()) { ?>
	<table class="table">
		<thead>
			<tr>
				<td>Rok</td>
				<td>Táborová hra</td>
<?php if ($user->isAllowed('Admin:Default:History', 'edit')) { ?>				<td>Editace</td>
<?php } if ($user->isAllowed('Admin:Default:History', 'delete')) { ?>				<td>Mazání</td>
<?php } ?>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($histories as $history) { ?>
			<tr>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($history->year, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($history->game, ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:History', 'edit')) { ?>				<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('year' => $history->year)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:History', 'delete')) { ?>				<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('year' => $history->year)), ENT_COMPAT) ?>
">Smaž</a></td>
<?php } ?>
			</tr>
<?php $iterations++; } ?>
		</tbody>
	</table>
<?php } ?>
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

