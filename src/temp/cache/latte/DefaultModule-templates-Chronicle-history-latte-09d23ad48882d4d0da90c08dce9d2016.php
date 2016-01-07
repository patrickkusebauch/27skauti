<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Chronicle/history.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2352219073', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb3945b43d52_submenu')) { function _lb3945b43d52_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba3b24329df_content')) { function _lba3b24329df_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<div class="box-nolined">
	<p>Náš oddíl byl založen 7. září 1983 jako třetí oddíl střediska Mustang (odtud starý název "Trojka"). Mezi první
	vedoucí našeho oddílu patří Polednice, Meke a Mourek. Prvními nováčky v té době byli například Kiwi, Kondor,
	Plamínek, Šotek a Mravenec. Postupem času se ve vedení oddílu vystřídali také Karla, Špunt, Vítek, Kiwi, Muf a Zip
	(který vede oddíl do dnes).</p>
	<p>Náš oddíl měl skoro vždy dvě družiny a to Tučňáky a Mloky. Avšak několikrát v historii byly chvíle, kdy se náš
	oddíl rozrostl až na družiny tři (s názvem Krtci, nebo Jezevci). Chvíli tu fungovala i roverská družina Vlci.</p>
	<p>O něco málo níže si můžete prohlédnout složení našeho oddílu od jeho založení až dodnes. Jsou tu napsaní opravdu
	všichni, jenž tu vydrželi alespoň jeden tábor. Civilní jméno je vždy uvedeno pouze jednou a to v roce, kdy dotyčný
	člověk vstoupil do oddílu.</p>
</div>

<?php $iterations = 0; foreach ($histories as $history) { ?>
<div class="box-outer">
	<span class="box-left">&nbsp</span><span class="box-right"><?php echo Latte\Runtime\Filters::escapeHtml($history->year, ENT_NOQUOTES) ?></span>
	<div class="box-doublelined-inner in-box-text-bigger">
		<table class="in-box-table" style="width:100%"><thead></thead><tbody>
		<tr>
		    <td style="width:160px;">Táborová hra</td><td style="color:#B0381A"><?php echo Latte\Runtime\Filters::escapeHtml($history->game, ENT_NOQUOTES) ?></td>
<?php $filename = $config['historyPhotosStorage'] . '/' . $history->year . '.jpg' ;if (file_exists($config['wwwDir'] . $filename)) { ?>
		    <td rowspan=4><div class="picture-outer" style="right:0px;">
<?php $picture = Nette\Image::fromFile($config['wwwDir'] . $filename) ;if ($picture->getWidth() > $picture->getHeight()) { ?>
			        <div class="picture-inner-higher"></div>
			            <div class="picture-inner-wider">
       					<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" width="160px" height="110px">
       				</div>
<?php } else { ?>
	        		<div class="picture-inner-wider"></div>
       				<div class="picture-inner-higher">
	        			<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" width="110px" height="160px">
       				</div>
<?php } ?>
	    	</div></td>
<?php } ?>
        </tr>
		<tr><td>Vedoucí:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($history->leaders, ENT_NOQUOTES) ?></td></tr>
		<tr><td>Zástupci:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($history->deputies, ENT_NOQUOTES) ?></td></tr>
		<tr><td>Oldskauti:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($history->oldscouts, ENT_NOQUOTES) ?></td></tr>
		<tr><td>Roveři:</td><td colspan=2><?php echo Latte\Runtime\Filters::escapeHtml($history->rangers, ENT_NOQUOTES) ?></td></tr>
		<tr><td>Klubovna:</td><td colspan=2><?php echo Latte\Runtime\Filters::escapeHtml($history->club, ENT_NOQUOTES) ?></td></tr>
		<tr><td>Tábořiště:</td><td colspan=2><?php echo Latte\Runtime\Filters::escapeHtml($history->camp, ENT_NOQUOTES) ?></td></tr>
		</tbody></table>
		<table class="in-box-table" style="width:100%;">
			<thead><tr><td>MLOCI</td><td>TUČŇÁCI</td><?php if ($history->jezevci) { ?>
<td>JEZEVCI</td><?php } ?></tr></thead>
			<tbody><tr>
			    <td style="width:auto; color:black; font-style:italic;"><?php echo $template->nl2br($history->mloci) ?></td>
				<td><?php echo $template->nl2br($history->tucnaci) ?></td>
				<?php if ($history->jezevci) { ?><td><?php echo $template->nl2br($history->jezevci) ?>
</td><?php } ?>

		    </tr></tbody>
		</table>
	</div>
</div>
<?php $iterations++; } 
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
call_user_func(reset($_b->blocks['submenu']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 