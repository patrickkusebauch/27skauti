<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Hlasinek/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2138532039', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb5770501b0b_content')) { function _lb5770501b0b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$months = array(
	'Září' => '01',
	'Říjen' => '02',
	'Listopad' => '03',
	'Prosinec' => '04',
	'Leden' => '05',
	'Únor' => '06',
	'Březen'=> '07',
	'Duben' => '08',
	'Květen' => '09',
	'Červen' => '10',
	'Tábor' => '11'
) ?>

<h1 class="heading_1">Hlásínek</h1>
<div class="box-nolined">
	<p>I když se hlásínek dá nahrát přímo na FTP server a pokud má správné jméno, tak se zobrazí,
	avšak důrazně od toho odrazuji. Pokud někde vytvoříte složku nebo soubor, co tam nemá co dělat,
	tak můžete celé zobrazování hlásínku kompletně rozhodit. Proto raději použijte pro nahrávání tuto stránku.</p>
	<div m:if="$user->isAllowed('Admin:Default:Hlasinek', 'create')">
<?php $_l->tmp = $_control->getComponent("addFolderForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
	<div m:if="$user->isAllowed('Admin:Default:Hlasinek', 'delete')">
		Smazání složky také smaže všechny hlásínky v ní obsažené.
<?php $_l->tmp = $_control->getComponent("deleteFolderForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
</div>
<?php if ($folders) { ?>
<table class="table">
<?php $iterations = 0; foreach ($folders as $folder) { $year = mb_substr($folder, 0, 4) ?>
	<thead>
		<tr><td colspan=10><?php echo Latte\Runtime\Filters::escapeHtml($year, ENT_NOQUOTES) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml($year + 1, ENT_NOQUOTES) ?></td></tr>
		<tr><td>Měsíc</td>
			<td>GIF 1</td>
			<td>PDF 1</td>
			<td>GIF 2</td>
			<td>PDF 2</td>
		</tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($months as $month_name => $month_number) { $path = '/' . $folder . '/hlas' . $month_number ?>
			
<?php $pages = array(
			$path . '01.gif',
			$path . '01.pdf',
			$path . '02.gif',
			$path . '02.pdf') ?>
		<tr>
			<td class="bold">
<?php if ($user->isAllowed('Admin:Default:Hlasinek', 'addall')) { ?>
					<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("addall", array('folder' => $folder, 'month_number' => $month_number)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($month_name, ENT_NOQUOTES) ?></a>
<?php } else { ?>
					<?php echo Latte\Runtime\Filters::escapeHtml($month_name, ENT_NOQUOTES) ?>

<?php } ?>
			</td>
<?php $iterations = 0; foreach ($pages as $page) { ?>
			<td>
<?php if (file_exists($config['wwwDir'] . $config['hlasinekStorage'] . $page)) { if ($user->isAllowed('Admin:Default:Hlasinek', 'delete')) { ?>
						<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('path' => $page)), ENT_COMPAT) ?>
">Smazat</a><?php } else { ?>Smazat<?php } ?>

<?php } else { if ($user->isAllowed('Admin:Default:Hlasinek', 'addall')) { ?>
						<a class="bold" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("addall", array('folder' => $folder, 'month_number' => $month_number)), ENT_COMPAT) ?>
">Nahrát</a>
					<?php } else { ?>Nahrát<?php } ?>

<?php } ?>
			</td>
<?php $iterations++; } ?>
		</tr>
<?php $iterations++; } ?>
	</tbody>
<?php $iterations++; } ?>
</table>
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

