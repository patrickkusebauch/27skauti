<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5338980007', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbec47610991_content')) { function _lbec47610991_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Zpěvník</h1>
<div class="box-outer">
<span class="box-left">Přehled</span>
<div class="box-nolined">
	<p><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("add"), ENT_COMPAT) ?>
">Přidat novou píseň</a></p>
	<table class="table">
	    <thead>
	        <tr>
	            <th>Zpěvník</th>
	            <th>Název písně</th>
	            <th>Interpret</th>
<?php if ($user->isAllowed("Oddil:Songbook", "edit")) { ?>	            <th>Editace</th>
<?php } if ($user->isAllowed("Oddil:Songbook", "delete")) { ?>	            <th>Smazat</th>
<?php } ?>
	        </tr>
	    </thead>
	    <tbody>
<?php $iterations = 0; foreach ($songbook as $song) { ?>	        <tr>
	            <td><?php echo Latte\Runtime\Filters::escapeHtml($song->group, ENT_NOQUOTES) ?></td>
	            <td><?php echo Latte\Runtime\Filters::escapeHtml($song->name, ENT_NOQUOTES) ?></td>
	            <td><?php echo Latte\Runtime\Filters::escapeHtml($song->artist, ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed("Oddil:Songbook", "edit")) { ?>	            <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array($song->id)), ENT_COMPAT) ?>
">Editovat</a></td>
<?php } if ($user->isAllowed("Oddil:Songbook", "delete")) { ?>	            <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array($song->id)), ENT_COMPAT) ?>
">Smazat</a></td>
<?php } ?>
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 