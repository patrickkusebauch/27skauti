<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Guestbook/post.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3845743176', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$iterations = 0; foreach ($posts as $post) { ?>
<div class="box-outer">
	<div class="box-innerlined-inner">
		<div class="box-innerlined-inner-heading">
<?php if ($post->name) { ?>
			<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($post->name, ENT_NOQUOTES) ?></span>
<?php } elseif ($post->user->related('member')->fetch()) { ?>
			<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($post->user->related('member')->fetch()->nickname, ENT_NOQUOTES) ?><span style="color:#9D3621;vertical-align:baseline;position:relative;top:-0.4em;font-size:.83em;">&reg</span></span>
<?php } else { ?>
			<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($post->user->username, ENT_NOQUOTES) ?></span>
<?php } ?>
		<span class="box-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($post->time, 'j. n. Y - G:i'), ENT_NOQUOTES) ?></span>
		</div>
		<div class="box-singlelined-inner">
			<table class="in-box-table" style="width:100%"><thead></thead><tbody>
				<tr><td>Příspěvek</td><td style="text-align:justify;"><?php echo Latte\Runtime\Filters::escapeHtml($post->post, ENT_NOQUOTES) ?></td></tr>
				<?php if ($post->mail) { ?><tr><td>E-mail:</td><td><a href="mailto:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($post->mail), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->mail, ENT_NOQUOTES) ?></a></td></tr>
				<?php } elseif ($post->user_id) { ?>	<tr><td>E-mail:</td><td><a href="mailto:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($post->user->mail), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($post->user->mail, ENT_NOQUOTES) ?></a></td></tr>
<?php } if ($post->web) { ?>				<tr><td>Web:</td><td><a href="//<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($post->web), ENT_COMPAT) ?>
" target="_blank"><?php echo Latte\Runtime\Filters::escapeHtml($post->web, ENT_NOQUOTES) ?></a></td></tr>
<?php } ?>
			</tbody></table>
		</div>
	</div>
</div>
<?php $iterations++; } 