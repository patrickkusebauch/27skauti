<?php
// source: /data/web/virtuals/88857/virtual/app/components/VisualPaginator/template.phtml

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7401521421', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($paginator->pageCount > 1) { ?>
<div class="paginator">
<?php if ($paginator->isFirst()) { ?>
	<span class="paginator-button">«</span>
<?php } else { ?>
	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("this", array('page' => $paginator->page - 1)), ENT_COMPAT) ?>">«</a>
<?php } ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($steps) as $step) { if ($step == $paginator->page) { ?>
		<span class="paginator-current"><?php echo Latte\Runtime\Filters::escapeHtml($step, ENT_NOQUOTES) ?></span>
<?php } else { ?>
		<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("this", array('page' => $step)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($step, ENT_NOQUOTES) ?></a>
<?php } ?>
	<?php if ($iterator->nextValue > $step + 1) { ?><span>…</span><?php } ?>

<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>

<?php if ($paginator->isLast()) { ?>
	<span class="paginator-button">»</span>
<?php } else { ?>
	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("this", array('page' => $paginator->page + 1)), ENT_COMPAT) ?>">»</a>
<?php } ?>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.js"></script>
	<script type="text/javascript">
$().keydown(function (event) {
    if (event.keyCode == 37) {
        // go left
        $('.paginator-current').prev().click();
    } else if (event.keyCode == 39) {
        // go right
        $('.paginator-current').next().click();
    }
});
	</script>
</div>
<?php } 