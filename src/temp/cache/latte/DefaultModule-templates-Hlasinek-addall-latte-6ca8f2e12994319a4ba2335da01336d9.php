<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Hlasinek/addall.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9775555009', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb151d7a9bb2_content')) { function _lb151d7a9bb2_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$months = array(
	'01' => 'září',
	'02' => 'říjen',
	'03' => 'listopad',
	'04' => 'prosinec',
	'05' => 'leden',
	'06' => 'únor',
	'07' => 'březen',
	'08' => 'duben',
	'09' => 'květen',
	'10' => 'červen',
	'11' => 'tábor'
) ?>

<h1 class="heading_1">Hlásínek pro <?php echo Latte\Runtime\Filters::escapeHtml($months[$month_number], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($year, ENT_NOQUOTES) ?>/<?php echo Latte\Runtime\Filters::escapeHtml($year+1, ENT_NOQUOTES) ?></h1>


<div class="box-outer">
	<span class="box-left">Přidání souborů</span>
	<div class="box-nolined">
		<p>Přidání jakýchkoliv souborů automaticky přepíše soubory, které jsou pro daný Hlásínek už nahrané.</p>
<?php $_l->tmp = $_control->getComponent("addHlasinekForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
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

