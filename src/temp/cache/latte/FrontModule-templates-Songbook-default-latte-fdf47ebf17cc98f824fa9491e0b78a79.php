<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6643681059', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb749f7d5e3e_head')) { function _lb749f7d5e3e_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3c4afad35e_content')) { function _lb3c4afad35e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Zpěvník</h1>
<div class="box-outer" style="clear:both;">
	<span class="box-left-small">Přehled</span>
<div class="box-doublelined-inner">
	<table class="table" style="width:100%;">
		<thead>
			<tr>
				<th>Zpěvník</th>
				<th>Název</th>
				<th>Interpret</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($songbook as $song) { ?>			<tr>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($song->group, ENT_NOQUOTES) ?></td>
				<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("detail", array('id' => $song->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($song->name, ENT_NOQUOTES) ?></a></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($song->artist, ENT_NOQUOTES) ?></td>
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