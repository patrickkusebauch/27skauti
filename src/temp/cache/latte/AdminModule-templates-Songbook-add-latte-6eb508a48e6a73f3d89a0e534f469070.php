<?php
// source: /data/web/virtuals/88857/virtual/app/OddilModule/AdminModule/templates/Songbook/add.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2412219178', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3b027a595e_content')) { function _lb3b027a595e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Admin</h1>
<div class="box-outer">
<span class="box-left">Oprávnění</span>
<div class="box-nolined">
	<p>Momentálně máte přístup do těchto sekcí s těmito oprávněními:</p>
<?php $_l->tmp = $_control->getComponent("editSongForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
</div>
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbd6180803bf_scripts')) { function _lbd6180803bf_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><script type="text/javascript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/tiny_mce/tiny_mce.js" ></script>
<script type="text/javascript" >
tinyMCE.init({
        language : 'cs',
	mode: "specific_textareas",
	editor_selector: "mceEditor",	
	theme : "advanced",
	plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
	skin : "o2k7",
	skin_variant : "silver",

	// Theme options - button# indicated the row# only
	theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,|,undo,redo",
	theme_advanced_buttons1 : "bullist,numlist,|,outdent,indent,|,link,unlink,anchor|,code,preview,|,forecolor,backcolor,|,insertdate,inserttime,charmap,emotions",
	theme_advanced_buttons3 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,|,advhr,removeformat,image,|,sub,sup",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	//theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; 