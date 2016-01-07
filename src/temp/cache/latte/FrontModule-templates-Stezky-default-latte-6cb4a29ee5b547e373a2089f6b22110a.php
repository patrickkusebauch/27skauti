<?php
// source: /data/web/virtuals/88857/virtual/app/modules/OddilModule/FrontModule/templates/Stezky/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9194509106', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbf557e0b105_head')) { function _lbf557e0b105_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb2e31a89fe5_content')) { function _lb2e31a89fe5_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1">Stezky</h1>
<div class="box-outer" style="clear:both;">
	<span class="box-left-small">Přehledy</span>
	<div class="box-doublelined-inner">
	<table class="table" style="width:35%; float:left;">
		<thead>
			<tr>
				<th>Přezdívka</th>
				<th>Spl. úkolů</th>
				<th>Spl. odborností</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($overview as $member) { ?>			<tr>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($member->nickname, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($member->count, ENT_NOQUOTES) ?></td>
				<td></td>
			</tr>
<?php $iterations++; } ?>
		</tbody>
	</table>
	<table class="table" style="width:60%; float:right;">
		<thead>
			<tr>
				<th>Odbornost</th>
				<th>Stupeň</th>
				<th>Spl. úkolů</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($myOverview->fetchAll() as $member) { ?>			<tr>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($member->name, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($member->level, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($member->count, ENT_NOQUOTES) ?></td>
			</tr>
<?php $iterations++; } ?>
		</tbody>
	</table>
	</div>
</div>
<div class="box-outer" style="clear:both;">
	<span class="box-left-small">Já vs. ostatní</span>
	<div class="box-doublelined-inner">
	<table class="table">
		<thead>
			<tr>
				<th>Prezdívka</th>
<?php $iterations = 0; foreach ($myOverview->fetchAll() as $member) { ?>				<th><span title="<?php echo Latte\Runtime\Filters::escapeHtml($member->name, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($member->name, 1, ''), ENT_NOQUOTES) ?><span></th>
<?php $iterations++; } ?>
				<th>Celkem</th>
			</tr>
		</thead>
		<tbody>
<?php $iterations = 0; foreach ($allOverviews as $nickname => $oneOverview) { ?>			<tr>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($nickname, ENT_NOQUOTES) ?></td>
<?php $iterations = 0; foreach ($oneOverview as $member) { ?>				<td><?php echo Latte\Runtime\Filters::escapeHtml($member->count, ENT_NOQUOTES) ?></td>
<?php $iterations++; } ?>
				<td></td>
			</tr>
<?php $iterations++; } ?>
		</tbody>
	</table>
	</div>
</div>
<div class="box-outer" style="clear:both;">
	<span class="box-left-small">Moje stezky</span>
	<div class="box-doublelined-inner">
	<ol style="list-style-type: none;">
<?php $iterations = 0; foreach ($detail as $levelName => $level) { ?>		<li class="toggle"><?php echo Latte\Runtime\Filters::escapeHtml($levelName, ENT_NOQUOTES) ?>

		<ol style="list-style-type: none;">
<?php $iterations = 0; foreach ($level as $groupName => $group) { ?>			<li class="toggle"><?php echo Latte\Runtime\Filters::escapeHtml($groupName, ENT_NOQUOTES) ?>

			<ol style="list-style-type: none; display:none;"><li>
				<table class="table">
					<thead>
						<tr>
							<th>Znění úkolu</th>
							<th>Status</th>
							<th>Datum</th>
							<th>Podepsal</th>
						</tr>
					</thead>
					<tbody>
<?php $iterations = 0; foreach ($group as $taskName => $task) { ?>						<tr>
							<td><?php echo Latte\Runtime\Filters::escapeHtml($taskName, ENT_NOQUOTES) ?></td>
							<td><?php echo Latte\Runtime\Filters::escapeHtml($task->status, ENT_NOQUOTES) ?></td>
							<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($task->signed, 'j.n.Y'), ENT_NOQUOTES) ?></td>
							<td><?php echo Latte\Runtime\Filters::escapeHtml($task->signature, ENT_NOQUOTES) ?></td>
						</tr>
<?php $iterations++; } ?>
					</tbody>
				</table>
			</li></ol>
			</li>
<?php $iterations++; } ?>
		</ol>
		</li>
<?php $iterations++; } ?>
	</ol>
	</div>
</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb0d2ebfbe54_scripts')) { function _lb0d2ebfbe54_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><script type="text/javascript">
$("li.toggle").click(function() {
	$(this).children().toggle("slow");
	return false;
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

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; 