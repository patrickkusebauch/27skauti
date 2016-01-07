<?php
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0599740508', 'html')
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
	<h2>Obnovení hesla na webu 27skauti.cz</h2>
	
	<p>Děkujeme za registraci na našem webu <a href="http://www.27skauti.cz">27skauti.cz</a>.</p>

	<ul>
		<li><strong>Uživatelské jméno:</strong> <?php echo Latte\Runtime\Filters::escapeHtml($username, ENT_NOQUOTES) ?></li>
	</ul>

	<p>Pro obnovení vašeho hesla prosím klikněte na tento <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("//:Front:Default:Sign:recover", array('username' => $username, 'token' => $token)), ENT_COMPAT) ?>
">odkaz</a>.</p>

    </body>
</html>
