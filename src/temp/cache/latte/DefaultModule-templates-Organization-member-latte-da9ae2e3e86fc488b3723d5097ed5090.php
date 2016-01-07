<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Organization/member.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5198682245', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$iterations = 0; foreach ($members as $member) { ?>
<div class="box-outer">
    <span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($member->nickname, ENT_NOQUOTES) ?></span>
	<div class="box-doublelined-inner in-box-text-bigger">
		<div class="picture-outer">
<?php $_b->templates['5198682245']->renderChildTemplate('../common/member_picture.latte', array('member' => $member) + $template->getParameters()) ?>
		</div>
		<table class="in-box-table"><thead></thead><tbody>
		    <tr>
				<td>Jméno:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($member->name, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($member->surname, ENT_NOQUOTES) ?></td>
			</tr>
<?php if ($showAge && $member->ref('registration', 'nickname')) { ?>			<tr><td>Věk:</td><td>
                <?php echo Latte\Runtime\Filters::escapeHtml($age = $member->ref('registration', 'nickname')->birth_date->diff(\Nette\DateTime::from(time()))->y, ENT_NOQUOTES) ?>

		<?php if ($age == 1) { ?>rok<?php } elseif ($age < 5) { ?>roky<?php } else { ?>
let<?php } ?>

            </td></tr>
<?php } ?>
			<tr>
				<td>V oddíle:</td><td>
<?php $age = $member->entered->diff(\Nette\DateTime::from(time()))->y ?>
                <?php if ($age == 0) { ?> 1. rokem
                <?php } elseif ($age == 1) { ?> <?php echo Latte\Runtime\Filters::escapeHtml($age, ENT_NOQUOTES) ?> rok
                <?php } elseif ($age < 5) { ?> <?php echo Latte\Runtime\Filters::escapeHtml($age, ENT_NOQUOTES) ?> roky
                <?php } else { ?> <?php echo Latte\Runtime\Filters::escapeHtml($age, ENT_NOQUOTES) ?> let
<?php } ?>
            </td></tr>
			<tr>
				<td>Pozice:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($template->lower($member->group), ENT_NOQUOTES) ?></td>
			</tr>
		</tbody></table>
	</div>
</div>
<?php $iterations++; } 