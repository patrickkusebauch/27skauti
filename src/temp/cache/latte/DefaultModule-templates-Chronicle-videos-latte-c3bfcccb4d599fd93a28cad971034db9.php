<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Chronicle/videos.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2663454392', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe1f187b3d9_content')) { function _lbe1f187b3d9_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kronika - videa</h1>
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
	    <p>Návod na získání potřebného kódu pro kroniku:</p>
    	<ol>
    		<li>Vlezeš na video na youtube</li>
	    	<li>Pod videem klikni na sdílet</li>
		    <li>Následně klikni na vložit</li>
    		<li>Ten kód, co ti to tam dá je to, co zkopíruješ do kroniky</li>
	    </ol>
	    <?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["labelVideosForm"], array()) ?>

    	    <?php echo $_form["id"]->getControl() ?>

    	    <table class="table" style="width:100%">
	    	    <thead>
		    	    <tr>
			    	    <th>Nadpis/Popisek videa</th>
    			    	<th>HTML kód pro zobrazení</th>
	    			    <th>Odebrat video</th>
    		    	<tr>
        		</thead>
	        	<tbody>
<?php $iterations = 0; foreach ($form['chronicle_videos']->containers as $id => $dummy) { ?>
        			<tr>
	        			<td><?php echo $_form["chronicle_videos-$id-id"]->getControl() ;echo $_form["chronicle_videos-$id-note"]->getControl()->addAttributes(array('style' => 'width:275px;')) ?></td>
		        		<td><?php echo $_form["chronicle_videos-$id-input"]->getControl()->addAttributes(array('style' => 'width:300px;')) ?></td>
			        	<td><?php echo $_form["chronicle_videos-$id-remove"]->getControl() ?></td>
        			</tr>
<?php $iterations++; } ?>
		        	<tr>
			        	<td><?php echo $_form["chronicle_videos-add"]->getControl() ?></td>
				        <td><?php if ($_label = $_form["showchronicle"]->getLabelPart("")) echo $_label ; echo $_form["showchronicle"]->getControlPart("") ?></td>
    				    <td><?php echo $_form["send"]->getControl() ?></td>
    	    		</tr>
	    	    </tbody>
    	    </table>
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

