<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Chronicle/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4346268314', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb6050085958_head')) { function _lb6050085958_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/paginator.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe509517842_content')) { function _lbe509517842_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kronika</h1>
<div class="box-nolined">
<?php if ($user->isAllowed('Admin:Default:Chronicle', 'generate')) { ?>	 <p>Pokud chcete přidat fotky nebo videa, použijde Editace "G". "F" a "V" slouží pro přidání popisků k fotkám a videím.</p>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'delete')) { ?>	 <p>Vymazání kroniky vymaže pouze text, všechny fotky a videa. Samotná akce se dá kompletně vymazat (včetně lístečku a zobrazení v kalendáři) v sekci Akce.</p>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'delete')) { ?>	 <p>Pokud jsou fotky nahrané na serveru, avšak se vám nezobrazují u akce, využijte sekce <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("fixPhotos"), ENT_COMPAT) ?>
">oprava fotek</a></p>
<?php } ?>
</div>
	Stránkování:
<?php $_l->tmp = $_control->getComponent("vp"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

<?php if ($events->fetch()) { ?>
<table class="table"><thead><tr>
	<th>Datum</th>
	<th>Typ Akce</th>
	<th>Záznam</th>
<?php if ($user->isAllowed('Admin:Default:Chronicle', 'edit')) { ?>	<th style="min-width:110px;">Editace</th>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'show')) { ?>	<th>Zobrazení</th>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'delete')) { ?>	<th>Mazání</th>
<?php } ?>
</tr></thead><tbody>
<?php $iterations = 0; foreach ($events as $event) { ?><tr>
	<td>
<?php if ($event->datestart == $event->dateend) { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>

<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n.'), ENT_NOQUOTES) ?>

<?php } else { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n.'), ENT_NOQUOTES) ?>

<?php } ?>
	</td>
	<td><?php echo Latte\Runtime\Filters::escapeHtml($event->type, ENT_NOQUOTES) ?></td>
	<td><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($event->name, 24), ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:Chronicle', 'edit')) { ?>	<td>
		<span><a title="Text" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('id' => $event->id)), ENT_COMPAT) ?>
">T</a></span>
<?php if ($user->isAllowed('Admin:Default:Chronicle', 'photos')) { ?>		<span>
			 | <a title="Popisky fotek" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("photos", array('id' => $event->id)), ENT_COMPAT) ?>
">F</a></span>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'videos')) { ?>		<span>
			 | <a title="Nadpisy videí" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("videos", array('id' => $event->id)), ENT_COMPAT) ?>
">V</a></span>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'generate')) { ?>		<span>
			 | <a title="Generovat fotky nebo videa" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("generate", array('id' => $event->id)), ENT_COMPAT) ?>
">G</a></span>
<?php } ?>
	</td>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'show')) { ?>	<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("show!", array('id' => $event->id)), ENT_COMPAT) ?>
">
		<?php if ($event->showchronicle) { ?>Odzobraz<?php } else { ?>Zobraz<?php } ?>

	</a></td>
<?php } if ($user->isAllowed('Admin:Default:Chronicle', 'delete')) { ?>	<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('id' => $event->id)), ENT_COMPAT) ?>
">Smaž</a></td>
<?php } ?>
</tr><?php $iterations++; } ?>

</tbody></table>
<?php } ?>

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

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

