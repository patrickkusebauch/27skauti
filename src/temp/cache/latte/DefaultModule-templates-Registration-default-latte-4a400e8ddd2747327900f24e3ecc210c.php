<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Registration/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4139692672', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbeb76636861_content')) { function _lbeb76636861_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Registrace</h1>
<div class="box-nolined">
	<p>Registrace jsou rozšířením informací o členech střediska, proto je lze
	vytvořit pouze pro členy, které je možno nalést v sekci organizace. Pokud
	chcete vytvořit kompletně nového člena, nejprve vytvořte osobu v organizaci
	a následně doplnte informace v registraci. Pokud osoba není členem našeho
	oddílu, nevplňujte jí pozici v oddílu. Tak se nezobrazí v sekci "Organizace"
	na stránkách. V budoucnu snad bude možné tyto informace získat rovnou z IS.skaut,
	ale prozatím je nutné je zadávat ručně.</p>
<?php if ($user->isAllowed('Admin:Default:Registration', 'create')) { ?>	<p><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("create"), ENT_COMPAT) ?>
">Registrovat stávajícího člena</a></p>
<?php } ?>
</div>

<?php $iterations = 0; foreach ($groups as $group) { ?>
<table class="table">
	<thead>
		<tr><td colspan=8><?php echo Latte\Runtime\Filters::escapeHtml($group['name'], ENT_NOQUOTES) ?>. oddíl</td></tr>
		<tr>
			<td>Přezdívka</td>
			<td>Datum nar.</td>
			<td>Adresa</td>
			<td>Mobil</td>
<?php if ($user->isAllowed('Admin:Default:Registration', 'edit')) { ?>			<td>Editace</td>
<?php } if ($user->isAllowed('Admin:Default:Registration', 'delete')) { ?>			<td>Mazání</td>
<?php } ?>
		</tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($group['members'] as $member) { ?>
		<tr>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($member->member_nickname, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($member->birth_date, 'j. n. Y'), ENT_NOQUOTES) ?></td>
			<td><?php echo $template->nl2br($member->address) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($member->mobile, ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:Registration', 'edit')) { ?>			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('member_nickname' => $member->member_nickname)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:Registration', 'delete')) { ?>			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('member_nickname' => $member->member_nickname)), ENT_COMPAT) ?>
">Smaž</a></td>
<?php } ?>
		</tr>
<?php $iterations++; } ?>
	</tbody>
</table>
<?php $iterations++; } ?>

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

