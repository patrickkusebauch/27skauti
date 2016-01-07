<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Event/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3610002315', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbff5cd9bf54_head')) { function _lbff5cd9bf54_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/paginator.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb68276efc13_content')) { function _lb68276efc13_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Akce</h1>


<?php $_l->tmp = $_control->getComponent("vp"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;if ($events->fetch()) { ?>
<table class="table"><thead><tr>
	<th>Datum</th>
	<th>Typ Akce</th>
	<th>Záznam</th>
<?php if ($user->isAllowed('Admin:Default:Event', 'edit')) { ?>	<th>Editace</th>
<?php } if ($user->isAllowed('Admin:Default:Event', 'show')) { ?>	<th>Zobrazení</th>
<?php } if ($user->isAllowed('Admin:Default:Event', 'delete')) { ?>	<th>Mazání</th>
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
	<td><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($event->name, 25), ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:Event', 'edit')) { ?>	<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array('id' => $event->id)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:Event', 'show')) { ?>	<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("show!", array('id' => $event->id)), ENT_COMPAT) ?>
">
		<?php if ($event->showevent) { ?>Odzobraz<?php } else { ?>Zobraz<?php } ?>

	</a></td>
<?php } if ($user->isAllowed('Admin:Default:Event', 'delete')) { ?>	<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete!", array('id' => $event->id)), ENT_COMPAT) ?>
">Smaž</a></td>
<?php } ?>
</tr><?php $iterations++; } ?>

</tbody></table>
<?php } ?>



<div class="box-outer">
    <span class="box-left">Kalendáře</span>
    <div class="box-nolined">
<?php if ($user->isAllowed('Admin:Default:Event', 'edit')) { ?>    	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("createcalendar"), ENT_COMPAT) ?>
">Přidat Kalendář</a>
<?php } if ($calendars->fetch()) { ?>
        <table class="table"><thead><tr>
	        <th>Rok</th>
	        <th>Období</th>
<?php if ($user->isAllowed('Admin:Default:Event', 'edit')) { ?>        	<th>Editace</th>
<?php } if ($user->isAllowed('Admin:Default:Event', 'show')) { ?>    	    <th>Zobrazení</th>
<?php } ?>
        </tr></thead><tbody>
<?php $iterations = 0; foreach ($calendars as $calendar) { ?>
        	<tr>
        		<td><?php echo Latte\Runtime\Filters::escapeHtml($calendar->year, ENT_NOQUOTES) ?></td>
    		    <td><?php echo Latte\Runtime\Filters::escapeHtml($calendar->yearpart, ENT_NOQUOTES) ?></td>
<?php if ($user->isAllowed('Admin:Default:Event', 'edit')) { ?>    		    <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("editcalendar", array('id' => $calendar->id)), ENT_COMPAT) ?>
">Edituj</a></td>
<?php } if ($user->isAllowed('Admin:Default:Event', 'show')) { ?>        		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("showcalendar!", array('id' => $calendar->id)), ENT_COMPAT) ?>
">
        			<?php if ($calendar->show) { ?>Odzobraz<?php } else { ?>Zobraz<?php } ?>

    		    </a></td>
<?php } ?>
        	</tr>
<?php $iterations++; } ?>
        </tbody></table>
<?php } ?>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

