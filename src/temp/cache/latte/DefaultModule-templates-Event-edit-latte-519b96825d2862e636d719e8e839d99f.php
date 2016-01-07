<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Event/edit.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2507784565', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbdb87d07fd2_content')) { function _lbdb87d07fd2_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Editace akce</h1>
<div class="box-nolined">

<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["editEventForm"], array()) ?>

<?php if ($form->hasErrors()) { ?><ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>        <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
</ul>
<?php } ?>

<?php echo $_form["id"]->getControl() ?>

<table>
<tbody>
	<tr><td><?php if ($_label = $_form["name"]->getLabel()) echo $_label->addAttributes(array('class'=>"required bold"))  ?>
</td><td><?php echo $_form["name"]->getControl()->addAttributes(array('size'=>50)) ?></td></tr>
	<tr><td><?php if ($_label = $_form["text"]->getLabel()) echo $_label->addAttributes(array('class'=>"required bold"))  ?>
</td><td><?php echo $_form["text"]->getControl()->addAttributes(array('rows'=>7, 'cols'=>60)) ?></td></tr>
	<tr><td colspan=2><span class="required bold">Srazy:</span> (v případě pouze jednoho srazu nevyplňujte typ)
	<table class="table" style="width:100%">
		<thead>
			<tr>
				<td>Typ</td>
				<td>Datum a čas srazu</td>
				<td>Místo srazu</td>
				<td>Datum a čas návratu</td>
				<td>Místo návratu</td>
				<td>X</td>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($form['event_meeting']->containers as $id => $meeting) { ?>
			<tr>
				<td><?php echo $_form["event_meeting-$id-comment"]->getControl()->addAttributes(array('style' => "width:80px")) ?></td>
				<td><?php echo $_form["event_meeting-$id-starttime"]->getControl()->addAttributes(array('style' => "width:170px")) ?></td>
				<td><?php echo $_form["event_meeting-$id-startplace"]->getControl()->addAttributes(array('style' => "width:110px")) ?></td>
				<td><?php echo $_form["event_meeting-$id-endtime"]->getControl()->addAttributes(array('style' => "width:170px")) ?></td>
				<td><?php echo $_form["event_meeting-$id-endplace"]->getControl()->addAttributes(array('style' => "width:110px")) ?></td>
				<td><?php echo $_form["event_meeting-$id-remove"]->getControl() ?></td>
			</tr>
<?php $iterations++; } ?>
		</tbody>
	</table>
	</td></tr>
	<tr><td colspan=2 style="text-align:center"><?php echo $_form["event_meeting-add"]->getControl() ?></td></tr>
	<tr><td><?php if ($_label = $_form["equipment"]->getLabel()) echo $_label->addAttributes(array('class'=>"required bold"))  ?>
</td><td><?php echo $_form["equipment"]->getControl()->addAttributes(array('rows'=>6, 'cols'=>60)) ?></td></tr>
	<tr><td><?php if ($_label = $_form["morse"]->getLabel()) echo $_label->addAttributes(array('class'=>"required bold"))  ?><br>
			Normální text,<br>sama se převede
		</td>
		<td><?php echo $_form["morse"]->getControl()->addAttributes(array('cols'=>60)) ?></td></tr>
	<tr><td><?php if ($_label = $_form["contactperson"]->getLabel()) echo $_label->addAttributes(array('class'=>"required bold"))  ?>
</td><td><?php echo $_form["contactperson"]->getControl() ?></td></tr>
	<tr><td></td><td style="float:right;"><?php echo $_form["send"]->getControl() ?></td></tr>
</tbody>
</table>

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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

