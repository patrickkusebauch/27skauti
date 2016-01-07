<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9072149349', 'html')
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
<html>
    <head>
        <title><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></title>
        <style>
            .bold {
                font-weight: bold;
            }
        </style>
    </head>

    <body>
	<h2>Nezávazná příhlíška z oddílového webu (27sakuti.cz)</h2>

	<ul>
            <li>
                <span class="bold">Jméno:</span> <?php echo Latte\Runtime\Filters::escapeHtml($values['name'], ENT_NOQUOTES) ?>

            </li>
            <li>
                <span class="bold">Email:</span> <?php echo Latte\Runtime\Filters::escapeHtml($values['mail'], ENT_NOQUOTES) ?>

            </li>
            <li>
                <span class="bold">Telefon:</span> <?php echo Latte\Runtime\Filters::escapeHtml($values['phone'], ENT_NOQUOTES) ?>

	        </li>
	        <li>
		        <span class="bold">Škola:</span> <?php echo Latte\Runtime\Filters::escapeHtml($values['school'], ENT_NOQUOTES) ?>

	        </li>
	        <li>
    		    <span class="bold">Třída:</span> <?php echo Latte\Runtime\Filters::escapeHtml($values['class'], ENT_NOQUOTES) ?>

	        </li>
        </ul>
    </body>
</html>
