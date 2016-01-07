<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1354941795', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb1e0e203c5f_head')) { function _lb1e0e203c5f_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb10ae2515ff_content')) { function _lb10ae2515ff_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Zápisník</h1>
<div class="box-outer" style="clear:both;">
	<span class="box-left-small">Přehled</span>
<div class="box-doublelined-inner">
	<table class="table">
		<thead>
			<tr>
				<th>Nadpis</th>
				<th>Témata</th>
				<th>Text</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($notebook as $entry) { ?>			<tr>
				<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("detail", array('id' => $entry->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($entry->name, ENT_NOQUOTES) ?></a></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($entry->tags, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($entry->content, 50), ENT_NOQUOTES) ?></td>
			</tr>
<?php $iterations++; } ?>
		</tbody>
	</table>
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
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 