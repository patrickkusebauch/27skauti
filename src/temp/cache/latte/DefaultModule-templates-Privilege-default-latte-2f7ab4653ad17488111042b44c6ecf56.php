<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Privilege/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0490035730', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb14c2a5be1e_content')) { function _lb14c2a5be1e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="box-outer">
	<span class="box-left">Oprávnění uživatelů</span>
	<div class="box-nolined">
<?php if ($user->isAllowed('Admin:Default:Privilege', 'edit')) { $_l->tmp = $_control->getComponent("pickUserForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;if ($privilege) { $_l->tmp = $_control->getComponent("changePrivilegeForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} } else { ?>
			<p>Pro úpravu práv nemáte dostatečná oprávnění.</p>
<?php } ?>
	</div>
</div>

<div class="box-outer">
	<span class="box-left">Tabulka práv</span>
	<div class="box-nolined">
		<p>Pokud není výslovně stanoveno jinak, tak jakékoliv pozdější právo v sekci může dělat vše, co všechna předchozí práva dohromady.</p>
		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Aktuality</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může pouze vstoupit do sekce a prohlížet záznamy.<br>
							Nemůže je však žádným způsobem upravovat.</td></tr>
				<tr><td>Vytváření/Editace</td><td>Může vytvářet a editovat aktuality.<br>
							Nemůže však zobrazit aktuality na webu.</td></tr>
				<tr><td>Zobrazování</td><td>Může rozhodovat o tom, jestli se aktualita<br>
							zobrazí na webu nebo ne.</td></tr>
				<tr><td>Mazání</td><td>Může smazat aktuality z webu.</td></tr>
			</tbody>
	    </table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Akce</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může pouze vstoupit do sekce a prohlížet záznamy.<br>
							Nemůže je však žádným způsobem upravovat.</td></tr>
				<tr><td>Vytváření/Editace</td><td>Může vytvářet a editovat akce anebo kalendář.<br>
							Nemůže je však zobrazit na webu</td></tr>
				<tr><td>Zobrazování</td><td>Může rozhodovat o tom, jestli se lísteček na akci<br>
							anebo kalendář zobrazí na webu nebo ne.</td></tr>
				<tr><td>Mazání</td><td>Může smazat akce. Ne však kalendář</td></tr>
			</tbody>
	    </table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Kronika/Historie oddílu</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může nahlédnout do sekcí.<br>
				            Nemůže však nic upravovat ani nahrávat</td></tr>
				<tr><td>Vytváření/Editace</td><td>Může vytvářet a editovat kroniky</td></tr>
				<tr><td>Popisky</td><td>Může přidávat popisky k fotkám a videa</td></tr>
				<tr><td>Generování</td><td>Může nahrávat fotky ke kronikám.</td></tr>
				<tr><td>Zobrazování</td><td>Může zobrazovat kroniky.<br>
				            Může vytvářet a upravovat historie oddílu.</td></tr>
				<tr><td>Mazání</td><td>Může mazat korniky a historie.</td></tr>
			</tbody>
	    </table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce VIP Kronika</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td colspan=2>Momentálně nedělá vůbec nic</td></tr>
			</tbody>
	    </table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Hlásínek</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může nahlédnout do sekce.<br>
				            Nemůže však nic upravovat ani nahrávat</td></tr>
				<tr><td>Vytváření</td><td>Může nahrávat hlásínky na server</td></tr>
				<tr><td>Mazání</td><td>Může mazat hlásínky ze serveru</td></tr>
			</tbody>
	    </table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Organizace/Registrace</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může pouze vstoupit do sekcí a prohlížet záznamy.<br>
							Nemůže je však žádným způsobem upravovat.</td></tr>
				<tr><td>Vytváření/Editace</td><td>Může vytvářet a editovat členy a jejich registrace.<br>
				            Automaticky je také může zobrazovat, pokud správně vyplní pole</td></tr>
				<tr><td>Mazání</td><td>Může mazat členy a jejich registrace.</td></tr>
			</tbody>
		</table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Historie oddílu</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může pouze vstoupit do sekcí a prohlížet záznamy.<br>
							Nemůže je však žádným způsobem upravovat.</td></tr>
			</tbody>
		</table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Kniha návštěv</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může pouze vstoupit do sekce a prohlížet záznamy.<br>
							Nemůže je však žádným způsobem upravovat.</td></tr>
				<tr><td>Editace</td><td>Může upravovat záznamy.<br>
							Může nahlížet do organizace aby věděl, kdo je ověřený uživatel.</td></tr>
				<tr><td>Zobrazování</td><td>Může zobrazovat a odzobrazovat záznamy.</td></tr>
				<tr><td>Mazání</td><td>Může mazat záznamy.</td></tr>
			</tbody>
		</table>

		<table class="table">
			<thead>
				<tr><th colspan=2>Sekce Práva</th></tr>
				<tr><th>Oprávnění</th><th>Co může dělat</th></tr>
			</thead>
			<tbody>
				<tr><td>Vstup</td><td>Může pouze vstoupit do sekcí a prohlížet záznamy.<br>
							Nemůže je však žádným způsobem upravovat.</td></tr>
				<tr><td>Vytváření/Editace</td><td>Může sobě a ostatním měnit přístupová práva.<br>
				            Přidělit toto právo je jako přidělit "mazání" ke všem právům.</td></tr>
				<tr><td>Mazání</td><td>Momentálně nědělá nic extra.</td></tr>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

