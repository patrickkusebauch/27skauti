<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Homepage/contact.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2068742504', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lbeb7cea5433_submenu')) { function _lbeb7cea5433_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb90f3f14425_content')) { function _lb90f3f14425_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<?php $iterations = 0; foreach ($leaders as $leader) { $member = $leader->related('registration')->fetch() ?>
<div class="box-outer">
	<span class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($leader->group, ENT_NOQUOTES) ?>
 - <?php echo Latte\Runtime\Filters::escapeHtml($leader->nickname, ENT_NOQUOTES) ?></span>
	<span class="box-right"><?php echo Latte\Runtime\Filters::escapeHtml($leader->title, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($leader->name, ENT_NOQUOTES) ?> <?php echo Latte\Runtime\Filters::escapeHtml($leader->surname, ENT_NOQUOTES) ?></span>
	<div class="box-doublelined-inner in-box-text-bigger">
		<div class="picture-outer">
<?php $_b->templates['2068742504']->renderChildTemplate('../common/member_picture.latte', array('member' => $leader) + $template->getParameters()) ?>
		</div>
		<table class="in-box-table"><thead></thead><tbody>
<?php if ($member) { ?>			<tr>
			    <td>Věk</td><td>
<?php $age = $member->birth_date->diff(\Nette\DateTime::from(time()))->y ?>
                <?php echo Latte\Runtime\Filters::escapeHtml($age, ENT_NOQUOTES) ?>

                <?php if ($age == 1) { ?> rok
				    <?php } elseif ($age < 5) { ?> roky
				    <?php } else { ?> let
<?php } ?>
				</td>
			</tr>
<?php } if ($member) { ?>			<tr>
			    <td>Mobil:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($member->mobile, ENT_NOQUOTES) ?></td>
			</tr><?php } if ($leader->user) { ?><tr>
			    <td>E-mail:</td><td><?php echo Latte\Runtime\Filters::escapeHtml($leader->user->mail, ENT_NOQUOTES) ?></td>
			</tr><?php } if ($member) { ?><tr>
			    <td>Adresa:</td><td><?php echo $template->nl2br($member->address) ?></td>
			</tr>
<?php } ?>
		</tbody></table>
	</div>
</div>
<?php $iterations++; } ?>

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
call_user_func(reset($_b->blocks['submenu']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 