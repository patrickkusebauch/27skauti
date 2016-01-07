<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8308298590', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$filename = NULL ;if ($chronicle) { $picture = $chronicle->related('chronicle_photos')->where('intro', 1)->order('RAND()')->limit(1)->fetch() ;if ($picture) { $filename = \Nette\Utils\Strings::padLeft($picture->order, 4 ,'0') ;$year = $chronicle->calendar->yearpart == "jaro" ? ($chronicle->calendar->year -1) : $chronicle->calendar->year ;$filename = $config['chroniclePhotosStorage'] . '/' . $year . ($year + 1) . '/' . Nette\Templating\Helpers::date($chronicle->datestart, 'Ymd') . '/' . $filename . '.jpg' ;} } if (!(file_exists($config['wwwDir'] . $filename) && is_file($config['wwwDir'] . $filename))) { $filename = $config['chroniclePhotosStorage'] . '/default.gif' ;} ?>
		
<?php $picture = Nette\Image::fromFile($config['wwwDir'] . $filename) ;if ($picture->getWidth() > $picture->getHeight()) { ?>
	<div class="picture-inner-higher"></div>
	<div class="picture-inner-wider">
<?php if ($chronicle) { ?>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:detail", array('id'=>$chronicle->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" class="landscape"></a>
<?php } else { ?>
		    <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" class="landscape">
<?php } ?>
	</div>
<?php } else { ?>
	<div class="picture-inner-wider"></div>
	<div class="picture-inner-higher">
<?php if ($chronicle) { ?>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:detail", array('id'=>$chronicle->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" class="photo"></a>
<?php } else { ?>
		    <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto z akce" class="photo">
<?php } ?>
	</div>
<?php } 