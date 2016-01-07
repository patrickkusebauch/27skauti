<?php
// source: /data/web/virtuals/88857/virtual/app/modules/BaseModule/templates/Error/500.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6478922823', 'html')
;
// prolog Latte\Macros\BlockMacros
// template extending

$_l->extends = FALSE; $_g->extended = TRUE;

if ($_l->extends) { return $template->renderChildTemplate($_l->extends, get_defined_vars());}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
// ?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="robots" content="noindex">
<style>
	body { color: #333; background: white; width: 500px; margin: 100px auto }
	h1 { font: bold 47px/1.5 sans-serif; margin: .6em 0 }
	p { font: 21px/1.5 Georgia,serif; margin: 1.5em 0 }
	small { font-size: 70%; color: gray }
</style>

<h1>Chyba</h1>

<p>Omlouváme se, ale na stránkách došlo k neočekávané chybě.
Můžeme vás ujistit, že tým cvičených opic usilovně pracuje na
vyřešení tohoto probému. Zkuste se tu znovu zastavit později.</p>

<p><small>error 500</small></p>
