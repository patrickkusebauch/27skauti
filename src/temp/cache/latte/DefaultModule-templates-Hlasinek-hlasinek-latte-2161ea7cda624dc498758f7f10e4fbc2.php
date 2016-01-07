<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Hlasinek/hlasinek.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7182471589', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$months = array(
	'Září' => '01',
	'Říjen' => '02',
	'Listopad' => '03',
	'Prosinec' => '04',
	'Leden' => '05',
	'Únor' => '06',
	'Březen'=> '07',
	'Duben' => '08',
	'Květen' => '09',
	'Červen' => '10',
	'Tábor' => '11'

) ;$iterations = 0; foreach ($months as $month_name => $month_number) { $path = $config['hlasinekStorage'] . '/' . $dir . '/hlas' . $month_number ;$first_page_gif = $path . '01.gif' ;$first_page_pdf = $path . '01.pdf' ;$second_page_gif = $path . '02.gif' ;$second_page_pdf = $path . '02.pdf' ;$has_first_page = file_exists($config['wwwDir'] . $first_page_gif) && file_exists($config['wwwDir'] . $first_page_pdf) ;$has_second_page = file_exists($config['wwwDir'] . $second_page_gif) && file_exists($config['wwwDir'] . $second_page_pdf) ;if ($has_first_page) { ?>
	<div class="hlasinek-outer-box">
		<div class="box-left"><?php echo Latte\Runtime\Filters::escapeHtml($month_name, ENT_NOQUOTES) ?></div>
<?php if ($has_first_page) { ?>
		<div class="hlasinek-inner-box"<?php if (!$has_second_page) { ?> style="float:none; margin-left:auto; margin-right:auto;"<?php } ?>>
			<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ;echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($first_page_pdf), ENT_COMPAT) ?>" target="_blank">
				<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($first_page_gif), ENT_COMPAT) ?>" alt="¨První strana Hlásínku" width="90px" height="130px"><span class="bold">PDF</span>
			</a>
		</div>
<?php } if ($has_second_page) { ?>
		<div class="hlasinek-inner-box">
			<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ;echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($second_page_pdf), ENT_COMPAT) ?>" target="_blank">
				<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ;echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($second_page_gif), ENT_COMPAT) ?>" alt="Druhá strana Hlásínku" width="90px" height="130px"><span class="bold">PDF</span>
			</a>
		</div>
<?php } ?>
	</div>
<?php } $iterations++; } 