<?php
// source: /vagrant/src/app/FrontModule/DefaultModule/templates/News/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6251392553', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lba63368f889_head')) { function _lba63368f889_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/news.css">
<?php
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb53c06c41bb_submenu')) { function _lb53c06c41bb_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbfd801ff949_content')) { function _lbfd801ff949_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($events->fetch()) { ?> <h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?>
</h1><?php } ?>

<?php $iterations = 0; foreach ($events as $event) { ?>
	<div class="box-outer">
		<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($event->name, 30), ENT_NOQUOTES) ?></span>
		<span class="box-right">
<?php if ($event->datestart == $event->dateend) { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } else { ?>
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n. Y'), ENT_NOQUOTES) ?>

<?php } ?>
		</span>
		<div class="box-doublelined-inner">
			<p style="text-align:justify;"><?php echo Latte\Runtime\Filters::escapeHtml($event->text, ENT_NOQUOTES) ?></p>
			<table class="in-box-table" style="width:100%;">
				<thead></thead>
				<tbody>
					<tr>
						<td>Sraz:</td><td>
<?php $iterations = 0; foreach ($event->related('event_meeting') as $meeting) { if ($meeting->comment) { ?>
						    <span class="bold"><?php echo Latte\Runtime\Filters::escapeHtml($meeting->comment, ENT_NOQUOTES) ?>: </span>
<?php } ?>
						    <?php echo Latte\Runtime\Filters::escapeHtml($template->date($meeting->starttime, '%A'), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($template->date($meeting->starttime, 'j. n. Y G:i'), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($meeting->startplace, ENT_NOQUOTES) ?><br>
<?php $iterations++; } ?>
						</td>
					</tr>
					<tr>
						<td>Návrat:</td><td>
<?php $iterations = 0; foreach ($event->related('event_meeting') as $meeting) { if ($meeting->comment) { ?>
						    <span class="bold"><?php echo Latte\Runtime\Filters::escapeHtml($meeting->comment, ENT_NOQUOTES) ?>: </span>
<?php } ?>
						    <?php echo Latte\Runtime\Filters::escapeHtml($template->date($meeting->endtime, '%A'), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($template->date($meeting->endtime, 'j. n. Y G:i'), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($meeting->endplace, ENT_NOQUOTES) ?><br>
<?php $iterations++; } ?>
						</td>
					</tr>
					<tr>
						<td>S sebou:</td><td><?php echo $template->nl2br($event->equipment) ?></td>
					</tr>
<?php if ($event->morse) { ?>					<tr><td>Morseovka:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($template->morse($event->morse), ENT_NOQUOTES) ?></td></tr>
<?php } ?>
					<?php if ($event->ref('member', 'contactperson')
					&& $event->ref('member', 'contactperson')->ref('registration', 'nickname')
					&& $event->ref('member', 'contactperson')->user) { ?>					<tr>
						<td>Kontakt:</td>
<?php $contactperson = $event->ref('member', 'contactperson') ?>
						<td><?php echo Latte\Runtime\Filters::escapeHtml($contactperson->nickname, ENT_NOQUOTES) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($contactperson->name, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($contactperson->surname, ENT_NOQUOTES) ?>) -
						<?php echo Latte\Runtime\Filters::escapeHtml($event->ref('member', 'contactperson')->ref('registration', 'nickname')->mobile, ENT_NOQUOTES) ?>,
						<?php echo Latte\Runtime\Filters::escapeHtml($event->ref('member', 'contactperson')->user->mail, ENT_NOQUOTES) ?></td>
					</tr>
<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php $iterations++; } ?>
<!-- end of Akce -->

<!-- Kalendář akcí -->
<?php if ($calendars->fetch()) { ?> <h1 class="heading_1">Kalendář akcí </h1><?php } ?>

<?php $highlighted = FALSE ;$iterations = 0; foreach ($calendars as $calendar) { ?>
<div class="box-outer">
	<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($template->capitalize($calendar->yearpart), ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($calendar->year, ENT_NOQUOTES) ?></span>
	<div class="box-doublelined-inner">
		<table class="table" style="width:100%"><thead>
			<tr>
				<td style="width:140px;">Datum</td>
				<td style="widht:120px;">Akce</td>
				<td style="width:200px;">Poznámky</td>
				<td style="width:230px;">Vede</td>
			</tr>
		</thead><tbody>
<?php $events = $calendar->related('event', 'calendar_id')->order('dateend') ;$iterations = 0; foreach ($events as $event) { ?>
		    			<tr <?php if (($highlighted == FALSE)&&($event->dateend >= new Datetime("today"))) { $highlighted = TRUE ?>
 id="calendar-highlighted" <?php } ?> >
				<td><?php if ($event->datestart == $event->dateend) { ?>

					<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>

<?php } elseif ($event->datestart->format('n') == $event->dateend->format('n')) { ?>
					<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n.'), ENT_NOQUOTES) ?>

<?php } else { ?>
					<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datestart, 'j. n.'), ENT_NOQUOTES) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->dateend, 'j. n.'), ENT_NOQUOTES) ?>

				<?php } ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($event->type, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($event->calendarnote, ENT_NOQUOTES) ?></td>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($event->leaders, ENT_NOQUOTES) ?></td>
			</tr>
<?php $iterations++; } ?>
		</tbody></table>
	</div>
</div>
<?php $iterations++; } ?>
<!-- end of Kalendář akcí -->

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
<!-- Akce -->
<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

