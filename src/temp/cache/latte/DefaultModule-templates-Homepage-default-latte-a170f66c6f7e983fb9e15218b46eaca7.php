<?php
// source: /vagrant/src/app/FrontModule/DefaultModule/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5194030405', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb4484065a64_head')) { function _lb4484065a64_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbc62eee4bff_submenu')) { function _lbc62eee4bff_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd2c27a4edc_content')) { function _lbd2c27a4edc_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Úvod</h1>
<?php if ($chronicle) { ?>
<!-- newest photo -->
<div class="chronicle" id="photogalery" style="float:right;">
	<span class="bold italic" style="float:right;">foto z poslední akce</span>
	<div class="picture-outer">
<?php $_b->templates['5194030405']->renderChildTemplate('../common/chronicle_picture.latte', $template->getParameters()) ?>
	</div>
</div>
<!-- end of newest photo -->
<?php } ?>

<?php if ($news->fetch()) { ?>
<!-- news -->
<div class="box-outer">
	<span class="box-left-small">Aktuálně na 27skauti.cz</span>
	<div class="box-doublelined-inner" style="padding:5px;">
		<table style="float:left;"><thead></thead><tbody style="vertical-align: top;">
			<?php $iterations = 0; foreach ($news as $post) { ?><tr>
			    <td style="color:black;"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($post->posted, 'j. n.'), ENT_NOQUOTES) ?></td>
<?php if ($post->type == "Akce") { ?>
				<td class="bold"><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("News:"), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?> - <?php echo Latte\Runtime\Filters::escapeHtml($post->event->type, ENT_NOQUOTES) ?>

<?php $event = $post->event ;if ($event->datestart == $event->dateend) { ?>
						(<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
						(<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } else { ?>
						(<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
					<?php } ?><br>
			    	    <span style="font-weight:normal;"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->heading, '40'), ENT_NOQUOTES) ?></span></a></td>
<?php } elseif ($post->type == "Kronika") { ?>
			    	<td class="bold"><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:detail", array('id' => $post->event_id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?> - <?php echo Latte\Runtime\Filters::escapeHtml($post->event->type, ENT_NOQUOTES) ?>

<?php $event = $post->event ;if ($event->datestart == $event->dateend) { ?>
						(<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
						(<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } else { ?>
						(<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
					<?php } ?><br>
			    	    <span style="font-weight:normal;"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->heading, '40'), ENT_NOQUOTES) ?></span></a></td>
			    <?php } else { ?> 
			    	<td class="bold"><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("News:news"), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?><br>
			    	    <span style="font-weight:normal;"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($post->heading, '40'), ENT_NOQUOTES) ?></span></a></td>
<?php } ?>
			</tr><?php $iterations++; } ?>

		</tbody></table>
	</div>
</div>
<!-- news -->
<?php } ?>

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
		<p>
		    <span class="bold">Přidej se k nám…</span><br>
		    … přijímame nové členy celoročně<br>
		    … obrať se kdykoliv na vedoucího oddílu - <?php echo Latte\Runtime\Filters::escapeHtml($leader->title, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($leader->name, ENT_NOQUOTES) ?> <?php echo Latte\Runtime\Filters::escapeHtml($leader->surname, ENT_NOQUOTES) ?><br>
<?php $member = $leader->related('registration')->fetch() ?>
		    … kontakt tel: <?php echo Latte\Runtime\Filters::escapeHtml($member->mobile, ENT_NOQUOTES) ?>
, email: <?php echo Latte\Runtime\Filters::escapeHtml($leader->user->mail, ENT_NOQUOTES) ?>

		</p>
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

<?php call_user_func(reset($_b->blocks['submenu']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 