<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2005703755', 'html')
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
    </head>

    <body>
	<h2>Žádost o propojení účtů na oddílovém webu (27skauti.cz)</h2>

	<ul>
            <li>
                <strong>Uživatelské jméno:</strong> <?php echo Latte\Runtime\Filters::escapeHtml($username, ENT_NOQUOTES) ?>

            </li>
            <li>
                <strong>Jméno:</strong> <?php echo Latte\Runtime\Filters::escapeHtml($name, ENT_NOQUOTES) ?>

            </li>
            <li>
                <strong>Příjmení:</strong> <?php echo Latte\Runtime\Filters::escapeHtml($surname, ENT_NOQUOTES) ?>

            </li>
        </ul>

    </body>
</html>
