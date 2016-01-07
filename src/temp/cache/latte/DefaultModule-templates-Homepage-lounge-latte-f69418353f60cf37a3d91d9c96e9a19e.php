<?php
// source: /vagrant/src/app/FrontModule/DefaultModule/templates/Homepage/lounge.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8158676809', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb26c2d3a365_head')) { function _lb26c2d3a365_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/photobox.css">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtmlComment($basePath) ?>/css/photobox.ie.css"><![endif]-->
<?php
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb59dc340a15_submenu')) { function _lb59dc340a15_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb1d6a40382f_content')) { function _lb1d6a40382f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<div class="box-outer">
	<span class="box-left-small">Kde nás najdete?</span>
	<div class="box-doublelined-inner">
		<p>Každý týden pořádáme ve středu od 17:00 do 18:30 schůzky v naší klubovně, která se nalézá v Liberci v Hanychově na adrese:</p>
		<p class="bold">Zemědělská 18a/302<br>
				Liberec 8<br>
				460 08</p>
		<p style="text-align:center;"><a href="http://www.mapy.cz/#st=s@sss=1@ssq=id%3Apremise%201913838@@" target="_blank"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/klubovna.gif" width="483" height="284"></a></p>
	</div>
</div>

<div class="box-outer" id="photogalery">
	<span class="box-left-small">Fotografie naší klubovny</span>
	<div class="box-doublelined-inner" id="gallery">
<?php $iterations = 0; foreach ($images as $image) { ?>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $config['loungePhotosStorage'] . '/' . $image->getFilename()), ENT_COMPAT) ?>">
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath . $config['loungePhotosStorage'] . '/' . $image->getFilename()), ENT_COMPAT) ?>" alt="Foto klubovny" width="166px"></a>
<?php $iterations++; } ?>
	</div>
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb3f6f6a6b01_scripts')) { function _lb3f6f6a6b01_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
<script src='<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_QUOTES) ?>/js/jquery.photobox.js'></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/masonry.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/imagesloaded.js"></script>
<script type="text/javascript">	
	$('#gallery').photobox('a');
	$('#gallery').imagesLoaded(function() {
		$('#gallery').masonry({
		columnWidth: 166,
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