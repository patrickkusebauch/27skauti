<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/OddilModule/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7361117275', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb4d75bb32de_head')) { function _lb4d75bb32de_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc20b96c01f_content')) { function _lbc20b96c01f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Úvod</h1>
<!-- about -->
<div class="box-outer" style="clear:both;">
	<span class="box-left-small">O oddílu</span>	
	<div class="box-doublelined-inner"> 
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/nabor.gif" style="width: 255px; height: 361px; float:right; padding: 0px 0px 10px 10px;">
		<span class="bold"> Co znamená 27.oddíl skautů?</span>
		<p>
		    <span class="bold">Prima parta</span> správných kluků od osmi let.<br>
		    <span class="bold">Společné akce</span> - scházíme se každou středu od&nbsp17h v klubovně v Hanychově. Jednou za&nbspčtrnáct dní v sobotu jezdíme na&nbspvýpravy do okolí Liberce. V létě pořádáme tábor nedaleko Českého Dubu.<br>
		    <span class="bold">Dobrodružství</span> - turistika, zálesáctví, horolezectví, lyžování, …
		</p>
		<p>
		    <span class="bold">Přidej se i ty do našeho oddílu!</span><br>
		    Hledáme chlapce ze 3.-5. tříd, kteří se nebojí…<br>
		    <span class="bold">…nových zkušeností</span>, s nimiž je jednoduché připravit se do života.<br>
		    <span class="bold">…nových kamarádů</span>, kteří vědí, co je to přátelství.<br>
		    <span class="bold">…nových zážitků</span> ve městě, v horách, na laně na skále, u&nbsppočítače, v přírodě, s mapou nebo i GPSkou v ruce…<br>
		</p>
		<p>
		    <span class="bold">Náš oddíl…</span><br>
		    … vedou dospělí a zkušení vedoucí<br>
		    … funguje již od roku 1983<br>
		    … je způsob, jak poznáš, co v tobě doopravdy je<br>
		    … příležitost ukázat, co skutečně dokážeš<br>
		    … je přátelství, zábava, sport, odpočinek, poznání, ale i dřina a překonání sebe sama<br>
		    … se zúčastnil letu Měsíc, natáčel film v Hollywoodu, spolupracoval s tajnými službami, …, a kam se vydáme tentokrát? 
		</p>
		<div class="bold" style="text-align:center">Záleží jen na Vás jestli to&nbspchcete vědět …</div>
	</div>
</div>
<!-- end of about -->

<div style="clear:both; float:right;">
	Počet návštěv: 
	<a href="http://counter.cnw.cz" target="_blank">
		<img src="http://counter.cnw.cz/cooper.cgi?27skauticz&5&C2C3C5&F7F7F7&on">
	</a>
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