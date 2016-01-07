<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Organization/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1345554654', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb9e57392d25_content')) { function _lb9e57392d25_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Organizace</h1>
<div class="box-nolined">
	<p>Pokud pouze nechcete, aby se osoba zobrazovala v organizaci na stránkách, tak jí pouze vymažte Pozici.</p>
	<p>Pokud smažete osobu v organizaci, tak jí také vymažete registraci a v neposlední řadě jí nebudete moci přidat
	jako kontakt v lístečku na výpravu nebo ověřit ji v knize návštěv. Každá osoba v organizaci by měla být členem našeho
	středika nebo jinak významně zasahovat do fungování webu.</p>
<?php if ($user->isAllowed('Admin:Default:Organization', 'create')) { ?>	<p><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("create"), ENT_COMPAT) ?>
">Přidat nového člena</a></p>
<?php } ?>
</div>

<?php if ($members->fetch()) { ?>
<table class="table"><thead><tr>
	<th>Jméno</th>
	<th>Foto</th>
	<th>Vstup do oddílu</th>
	<th style="width:200px">Pozice</th>
	<th>Frčky</th>
<?php if ($user->isAllowed('Admin:Default:Organization', 'edit')) { ?>	<th>Editace</th>
<?php } if ($user->isAllowed('Admin:Default:Organization', 'delete')) { ?>	<th>Mazání</th>
<?php } ?>
</tr></thead><tbody>
<?php $iterations = 0; foreach ($members as $member) { ?>
	<tr>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($member->title, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($member->name, ENT_NOQUOTES) ?> <?php echo Latte\Runtime\Filters::escapeHtml($member->surname, ENT_NOQUOTES) ?></td>
		<td>
<?php $filename = $config['memberPhotosStorage'] . "/" . \Nette\Utils\Strings::lower(\Nette\Utils\Strings::toAscii($member->nickname)) . ".jpg" ?>
			<?php if (file_exists($config['wwwDir'] . $filename)) { ?><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>
" style="height:40px; vertical-align:middle;"> <?php } ?>

		</td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($member->entered, 'j. n. Y'), ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($member->group, ENT_NOQUOTES) ?></td>
		<td><?php if ($member->stripe) { ?><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ;echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($config['stripePhotosStorage']), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($member->stripe), ENT_COMPAT) ?>
"><?php } ?></td>
<?php if ($user->isAllowed('Admin:Default:Organization', 'edit')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('nickname' => $member->nickname)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:Organization', 'delete')) { ?>		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('nickname' => $member->nickname)), ENT_COMPAT) ?>
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

