<?php
// source: /data/web/virtuals/88857/virtual/app/components/VisualPaginator/template-schoolyear.phtml

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4181959659', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$dummy = rsort($steps) ;if ($paginator->pageCount > 1) { ?>
<ul class="drop-paginator">
	<li><?php echo Latte\Runtime\Filters::escapeHtml($paginator->page, ENT_NOQUOTES) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml($paginator->page + 1, ENT_NOQUOTES) ?>

		<ul><?php $iterations = 0; foreach ($steps as $step) { ?>

<?php if ($step == $paginator->page) { ?>
				<li class="paginator-current"><?php echo Latte\Runtime\Filters::escapeHtml($step, ENT_NOQUOTES) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml($step + 1, ENT_NOQUOTES) ?></li>
<?php } else { ?>
				<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("this", array('page' => $step)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($step, ENT_NOQUOTES) ?>/<?php echo Latte\Runtime\Filters::escapeHtml($step + 1, ENT_NOQUOTES) ?></a></li>
<?php } ?>
		<?php $iterations++; } ?></ul>
	</li>
</ul>
<?php } 