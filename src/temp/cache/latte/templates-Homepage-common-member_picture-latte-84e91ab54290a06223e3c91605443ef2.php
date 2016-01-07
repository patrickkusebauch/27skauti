<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6473233275', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$filename = $config['memberPhotosStorage'] . "/" . \Nette\Utils\Strings::lower(\Nette\Utils\Strings::toAscii($member->nickname)) . ".jpg" ;if (file_exists($config['wwwDir'] . $filename) === FALSE) { $filename = $config['memberPhotosStorage'] . '/default.gif' ;} ?>

<?php $picture = Nette\Image::fromFile($config['wwwDir'] . $filename) ;if ($picture->getWidth() > $picture->getHeight()) { ?>
	<div class="picture-inner-higher"></div>
	<div class="picture-inner-wider">
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto člena" class="landscape">
	</div>
<?php } else { ?>
	<div class="picture-inner-wider"></div>
	<div class="picture-inner-higher">
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" alt="Foto člena" class="photo">
	</div>
<?php } 