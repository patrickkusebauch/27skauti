<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/News/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3806801239', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbb237da0a23_content')) { function _lbb237da0a23_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"> Aktuality </h1>

<div class="box-nolined">
<?php if ($user->isAllowed('Admin:Default:News', 'create')) { ?>	<p><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("News:create"), ENT_COMPAT) ?>
">Vytvořit novou aktualitu</a></p>
<?php } ?>
	Stránkování:
<?php $_l->tmp = $_control->getComponent("vp"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
</div>

<?php if ($news->fetch()) { ?>
<table class="table"><thead><tr>
	<th>Datum</th>
	<th>Sekce</th>
	<th style="width:300px">Nadpis</th>
<?php if ($user->isAllowed('Admin:Default:News', 'edit')) { ?>	<th>Editace</th>
<?php } if ($user->isAllowed('Admin:Default:News', 'show')) { ?>	<th>Zobrazení</th>
<?php } if ($user->isAllowed('Admin:Default:News', 'delete')) { ?>	<th>Mazání</th>
<?php } ?>
</tr></thead><tbody>
<?php $iterations = 0; foreach ($news as $post) { ?>
	<tr>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($post->posted, 'j. n. y'), ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->heading, '30'), ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:News', 'edit')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('id' => $post->id)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:News', 'show')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("show!", array('id' => $post->id)), ENT_COMPAT) ?>
">
			<?php if ($post->show) { ?>Odzobraz<?php } else { ?>Zobraz<?php } ?>

		</a></td>
<?php } if ($user->isAllowed('Admin:Default:News', 'delete')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('id' => $post->id)), ENT_COMPAT) ?>
">Smaž</a></td>
<?php } ?>
		
	</tr>
<?php $iterations++; } ?>
</tbody></table>
<?php } 
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

