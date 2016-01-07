<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Chronicle/edit.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4202887362', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb1c2c4af4d6_content')) { function _lb1c2c4af4d6_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kronika - Editace akce</h1>
<div class="box-outer">
	<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($event->name, 45), ENT_NOQUOTES) ?>

<?php if ($event->datestart == $event->dateend) { ?>
        (<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
        (<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
<?php } else { ?>
        (<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>)
    <?php } ?></span>
	<div class="box-nolined">
		<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["editChronicleForm"], array()) ?>

<?php if ($form->hasErrors()) { ?>			<ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>			        <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
			</ul>
<?php } ?>
		<?php echo $_form["id"]->getControl() ?>

		<table class="bold" style="width:100%"><tbody>
			<tr><td style="width:175px"><?php if ($_label = $_form["name"]->getLabel()) echo $_label  ?>
</td><td><?php echo $_form["name"]->getControl()->addAttributes(array('style' => 'width:100%')) ?></td></tr>
			<tr><td><?php if ($_label = $_form["rangers"]->getLabel()) echo $_label  ?></td><td><?php echo $_form["rangers"]->getControl()->addAttributes(array('style' => 'width:100%', 'rows' => 3)) ?></td></tr>
			<tr><td><?php if ($_label = $_form["mloci"]->getLabel()) echo $_label  ?></td><td><?php echo $_form["mloci"]->getControl()->addAttributes(array('style' => 'width:100%', 'rows' => 3)) ?></td></tr>
			<tr><td><?php if ($_label = $_form["tucnaci"]->getLabel()) echo $_label  ?></td><td><?php echo $_form["tucnaci"]->getControl()->addAttributes(array('style' => 'width:100%', 'rows' => 3)) ?></td></tr>
			<tr><td><?php if ($_label = $_form["novacci"]->getLabel()) echo $_label  ?></td><td><?php echo $_form["novacci"]->getControl()->addAttributes(array('style' => 'width:100%', 'rows' => 3)) ?></td></tr>
			<tr><td><?php if ($_label = $_form["route"]->getLabel()) echo $_label  ?></td><td><?php echo $_form["route"]->getControl()->addAttributes(array('style' => 'width:100%', 'rows' => 4)) ?></td></tr>
			<tr><td><?php if ($_label = $_form["content"]->getLabel()) echo $_label  ?></td><td><?php echo $_form["content"]->getControl()->addAttributes(array('style' => 'width:100%', 'rows' => 8)) ?></td></tr>
			<tr><td><?php if ($_label = $_form["chroniclewriter"]->getLabel()) echo $_label->addAttributes(array('class' => 'required'))  ?>
</td><td><?php echo $_form["chroniclewriter"]->getControl() ?></td></tr>
<?php if ($form->components['showchronicle']) { ?>			<tr><td><?php if ($_label = $_form["showchronicle"]->getLabelPart("")) echo $_label  ?>
</td><td><?php echo $_form["showchronicle"]->getControlPart("") ?></td></tr>
<?php } ?>
			<tr><td></td><td><?php echo $_form["send"]->getControl() ?></td></tr>
		</tbody></table>
		<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>

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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

