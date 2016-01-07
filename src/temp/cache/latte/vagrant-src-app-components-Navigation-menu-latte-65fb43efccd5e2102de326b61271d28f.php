<?php
// source: /vagrant/src/app/components/Navigation/menu.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1460868490', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block menu
//
if (!function_exists($_b->blocks['menu'][] = '_lb94e0cb146f_menu')) { function _lb94e0cb146f_menu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><ul>
<?php $iterations = 0; foreach ($children as $item) { ?>	<li>
<?php $url = $item->url . '*' ?>
	        <a<?php try { $_presenter->link($url); } catch (Nette\Application\UI\InvalidLinkException $e) {}; if ($_presenter->getLastCreatedRequestFlag("current")) { ?>
 class="current"<?php } ?> href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link($item->url), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($item->label, ENT_NOQUOTES) ?></a>
	</li>
<?php $iterations++; } ?>
</ul>
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
call_user_func(reset($_b->blocks['menu']), $_b, get_defined_vars()) ; 