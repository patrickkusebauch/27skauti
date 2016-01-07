<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/News/post.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7533460809', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<div class="box-outer">
	<span class="box-left">
	<?php if ($post->type == "Akce") { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("News:"), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?></a>
	<?php } elseif ($post->type == "Kronika") { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:detail", array('id' => $post->event_id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?></a>
	<?php } else { echo Latte\Runtime\Filters::escapeHtml($post->type, ENT_NOQUOTES) ?>

<?php } ?>
	</span>
	<span class="box-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($post->posted, 'j. n. Y'), ENT_NOQUOTES) ?></span>
	<div class="box-singlelined-inner">
		<p style="text-align:justify;"><span class="bold">
		    <?php if ($post->type == 'Akce') { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("News:"), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->heading, ENT_NOQUOTES) ?></a>
		    <?php } elseif ($post->type == "Kronika") { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:detail", array('id' => $post->event_id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->heading, ENT_NOQUOTES) ?></a>
		    <?php } else { ?><span style="color:black;"><?php echo Latte\Runtime\Filters::escapeHtml($post->heading, ENT_NOQUOTES) ?></span>
<?php } ?>
		     - </span><?php echo $post->content ?>

        </p>
    </div>
</div>
