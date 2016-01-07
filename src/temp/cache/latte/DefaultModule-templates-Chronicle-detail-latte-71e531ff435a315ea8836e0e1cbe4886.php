<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Chronicle/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2428205773', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbf35601ec16_head')) { function _lbf35601ec16_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/chronicle.css">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/photobox.css">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtmlComment($basePath) ?>/css/photobox.ie.css"><![endif]-->
<?php
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbab9232d30d_submenu')) { function _lbab9232d30d_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb0b07f74bdd_content')) { function _lb0b07f74bdd_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><!-- Overview -->
<div class="box-outer">
	<span class="box-left" title="<?php echo Latte\Runtime\Filters::escapeHtml($chronicle->name, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($chronicle->name, 30), ENT_NOQUOTES) ?></span>
	<span class="box-right">
<?php if ($chronicle->datestart == $chronicle->dateend) { ?>
		<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } elseif ($chronicle->datestart->format('n') == $chronicle->dateend->format('n')) { ?>
		<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } else { ?>
		<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($chronicle->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } ?>
	</span>
	<div class="box-singlelined-inner">
		<table class="in-box-table" style="width:100%;">
			<thead></thead><tbody>
				<tr><td>Trasa:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($chronicle->route, ENT_NOQUOTES) ?></td></tr>
				<tr><td>Vedení:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($chronicle->rangers, ENT_NOQUOTES) ?></td></tr>
				<tr><td>Členové:</td><td>
					<span class="bold">Mloci: </span><?php echo Latte\Runtime\Filters::escapeHtml($chronicle->mloci, ENT_NOQUOTES) ?><br>
					<span class="bold">Tučňáci: </span><?php echo Latte\Runtime\Filters::escapeHtml($chronicle->tucnaci, ENT_NOQUOTES) ?>

					<?php if ($chronicle->novacci) { ?><br><span class="bold">Nováčci: </span><?php echo Latte\Runtime\Filters::escapeHtml($chronicle->novacci, ENT_NOQUOTES) ;} ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- end of Overview -->

<!-- Record -->
<?php if (($chronicle->content && $chronicle->chroniclewriter)) { ?>
<div class="box-outer">
	<span class="box-left-small">Zápis do kroniky</span>
	<span class="box-right" style="top:4px;">Zapsal: <?php echo Latte\Runtime\Filters::escapeHtml($chronicle->chroniclewriter, ENT_NOQUOTES) ?></span>
	<div class="box-doublelined-inner" style="text-align:justify;">
		<?php echo $chronicle->content ?>

	</div>
</div>
<?php } ?>
<!-- end of Record -->

<!-- Videos -->
<?php if ($chronicle->related('chronicle_videos')->fetch()) { ?>
<div class="box-outer">
	<span class="box-left-small">Videa</span>
	<div class="box-doublelined-inner">
<?php $iterations = 0; foreach ($chronicle->related('chronicle_videos') as $video) { ?>
		<span class="bold"><?php echo Latte\Runtime\Filters::escapeHtml($video->note, ENT_NOQUOTES) ?></span><br>
		<?php echo $video->input ?><br><br>
<?php $iterations++; } ?>
	</div>
</div>
<?php } ?>
<!-- end of Videos -->

<!-- Photos -->
<?php if ($chronicle->related('chronicle_photos')->fetch()) { ?>
<div class="box-outer" id="photogalery">
	<span class="box-left-small">Fotky</span>
	<div class="box-doublelined-inner" id="gallery">
<?php $iterations = 0; foreach ($chronicle->related('chronicle_photos') as $photo) { ?>

<?php $filename = \Nette\Utils\Strings::padLeft($photo->order, 4, '0') ;$year = $chronicle->calendar->yearpart == "jaro" ? ($chronicle->calendar->year -1) : $chronicle->calendar->year ;$filename = $config['chroniclePhotosStorage'] . '/' . $year . ($year + 1) . '/' . Nette\Templating\Helpers::date($chronicle->datestart, 'Ymd') . '/' . $filename . '.jpg' ?>
                <?php if (file_exists($config['wwwDir'] . $filename) === FALSE) { $filename = $config['chroniclePhotosStorage']. '/default.gif' ;} ?>

		
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>" style="display:inline;">
        	<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $filename), ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($photo->text, ENT_COMPAT) ?>" width="166px"></a>
<?php $iterations++; } ?>
	</div>
</div>
<?php } ?>
<!-- end of Photos -->
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbb2d62189af_scripts')) { function _lbb2d62189af_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
<script src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>/js/jquery.photobox.js'></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/masonry.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/imagesloaded.js"></script>
<script type="text/javascript">	
	$('#gallery').photobox('a');
	$('#gallery').imagesLoaded(function() {
		$('#gallery').masonry({
		columnWidth: 168,
		itemSelector: 'a'
		});
	});
</script>
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

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; 