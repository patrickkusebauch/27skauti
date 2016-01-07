<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Guestbook/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1029567811', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba7f948f3a7_content')) { function _lba7f948f3a7_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kniha návštěv</h1>
<div class="box-nolined">
	<p>Červené <span style="color:#9D3621;">®</span>
	  se dá přiradit pouze ke členovi, kterého lze nalést v sekci organizace</p>
</div>

<?php $_l->tmp = $_control->getComponent("vp"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;if ($posts->fetch()) { ?>
<table class="table"><thead><tr>
	<th>Datum</th>
	<th>Sekce</th>
	<th style="width:300px">Nadpis</th>
<?php if ($user->isAllowed('Admin:Default:Guestbook', 'edit')) { ?>	<th>Editace</th>
<?php } if ($user->isAllowed('Admin:Default:Guestbook', 'show')) { ?>	<th>Zobrazení</th>
<?php } if ($user->isAllowed('Admin:Default:Guestbook', 'delete')) { ?>	<th>Mazání</th>
<?php } ?>
</tr></thead><tbody>
<?php $iterations = 0; foreach ($posts as $post) { ?>
	<tr>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($post->time, 'j. n.'), ENT_NOQUOTES) ?></td>
		<td>
<?php if ($post->name) { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->name, '10'), ENT_NOQUOTES) ?>

<?php } elseif ($post->user->related('member')->fetch()) { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->user->related('member')->fetch()->nickname, '10'), ENT_NOQUOTES) ?><span style="color:#9D3621;vertical-align:baseline;position:relative;top:-0.4em;font-size:.83em;">&reg</span>
<?php } else { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->user->username, '10'), ENT_NOQUOTES) ?>

<?php } ?>
		</td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->post, '30'), ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:Guestbook', 'edit')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('id' => $post->id)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:Guestbook', 'show')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("show!", array('id' => $post->id)), ENT_COMPAT) ?>
">
			<?php if ($post->show) { ?>Odzobraz<?php } else { ?>Zobraz<?php } ?>

		</a></td>
<?php } if ($user->isAllowed('Admin:Default:Guestbook', 'delete')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('id' => $post->id)), ENT_COMPAT) ?>
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

