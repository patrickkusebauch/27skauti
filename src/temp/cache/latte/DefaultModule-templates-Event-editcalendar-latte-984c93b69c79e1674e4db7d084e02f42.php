<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Event/editcalendar.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6929700265', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb270ad247b0_content')) { function _lb270ad247b0_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Editace kalendáře - <?php echo Latte\Runtime\Filters::escapeHtml($calendar->yearpart, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($calendar->year, ENT_NOQUOTES) ?></h1>

<div class="box-nolined">

<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["editCalendarForm"], array()) ?>

<?php if ($form->hasErrors()) { ?><ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>        <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
</ul>
<?php } echo $_form["calendar_id"]->getControl() ?>


<table class="table">
	<thead>
		<tr>
			<th>Začátek</th>
			<th>Konec</th>
			<th>Typ</th>
			<th>Poznámka</th>
			<th>Vedoucí</th>
			<th>X</th>
		</tr>
	</thead>
	<tbody>
<?php $iterations = 0; foreach ($form['events']->containers as $id => $event) { ?>
		<tr>
			<?php echo $_form["events-$id-id"]->getControl() ?>

			<td><?php echo $_form["events-$id-datestart"]->getControl()->addAttributes(array('style' => 'width:90px')) ?></td>
			<td><?php echo $_form["events-$id-dateend"]->getControl()->addAttributes(array('style' => 'width:90px')) ?></td>
			<td><?php echo $_form["events-$id-type"]->getControl() ?></td>
			<td><?php echo $_form["events-$id-calendarnote"]->getControl() ?></td>
			<td><?php echo $_form["events-$id-leaders"]->getControl() ?></td>
			<td><?php echo $_form["events-$id-remove"]->getControl() ?></td>
		</tr>
<?php $iterations++; } ?>
	</tbody>
</table>
<div style="float:left;"><?php echo $_form["events-add"]->getControl() ?></div>
<div style="float:right;"><?php echo $_form["send"]->getControl() ?></div>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>


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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 