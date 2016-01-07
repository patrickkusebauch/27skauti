<?php
// source: /data/web/virtuals/88857/virtual/app/AdminModule/DefaultModule/templates/Chronicle/photos.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7664230944', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbcd81c8639c_content')) { function _lbcd81c8639c_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Kronika - popisky k fotkám</h1>
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
    <?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["labelPhotosForm"], array()) ?>

        <?php echo $_form["id"]->getControl() ?>

        <table class="table">
	        <thead>
    		    <tr>
        			<th>Foto</th>
	        		<th>Popisek</th>
		        	<th>Úvodní?</th>
    		    </tr>
        	</thead>
	        <tbody>
<?php $iterations = 0; foreach ($form['chronicle_photos']->containers as $id => $dummy) { ?>
	    	    <tr>
		    	    <td class="picture-outer" style="right:auto;"><?php echo $_form["chronicle_photos-$id-id"]->getControl() ?>

<?php $filename = $dirPath . '/' . \Nette\Utils\Strings::padLeft($photos[$id], 4, 0) . '.jpg' ;if (!(file_exists($config['wwwDir'] . $filename) && is_file($config['wwwDir'] . $filename))) { $filename = $config['chroniclePhotosStorage'] . '/default.gif' ;} $picture = Nette\Image::fromFile($config['wwwDir'] . $filename) ;if ($picture->getWidth() > $picture->getHeight()) { ?>
		    	    	<div class="picture-inner-higher"></div>
			    	    <div class="picture-inner-wider">
				    	    <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" class="landscape">
        				</div>
<?php } else { ?>
		        		<div class="picture-inner-wider"></div>
			        	<div class="picture-inner-higher">
				        	<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" class="photo">
    				    </div>
<?php } ?>
	    	    	</td>
		    	    <td><?php echo $_form["chronicle_photos-$id-text"]->getControl() ?></td>
    		    	<td><?php echo $_form["chronicle_photos-$id-intro"]->getControl() ?></td>
    	    	</tr>
<?php $iterations++; } ?>
	        	<tr>
		        	<td><?php if ($_label = $_form["showchronicle"]->getLabelPart("")) echo $_label  ?></td>
			        <td><?php echo $_form["showchronicle"]->getControlPart("") ?></td>
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

