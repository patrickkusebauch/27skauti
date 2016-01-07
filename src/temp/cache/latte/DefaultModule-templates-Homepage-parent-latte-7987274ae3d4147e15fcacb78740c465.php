<?php
// source: /data/web/virtuals/88857/virtual/app/FrontModule/DefaultModule/templates/Homepage/parent.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1372809992', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb0481b363e0_head')) { function _lb0481b363e0_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/homepage.css">
<?php
}}

//
// block submenu
//
if (!function_exists($_b->blocks['submenu'][] = '_lb8c36eed065_submenu')) { function _lb8c36eed065_submenu($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("submenu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb619309d45c_content')) { function _lb619309d45c_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 class="heading_1"><?php echo Latte\Runtime\Filters::escapeHtml($title, ENT_NOQUOTES) ?></h1>
<div class="box-outer">
	<div class="box-doublelined-inner">
		<p>Dobrý den,<br>
        jsme liberecký chlapecký skautský oddíl ze střediska Mustang. Na našich internetových stránkách se můžete
        dozvědět veškeré informace o nás. V sekci <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Chronicle:default"), ENT_COMPAT) ?>
">kronika</a> si můžete například prohlédnout fotky z akcí, které pořádáme.</p>
		<p class="bold">V současné době nabíráme do našeho oddílu chlapce ze 3. - 5. tříd.</p>
		<p>Každý týden pořádáme ve středu od 17:00 do 18:30 schůzky v naší klubovně, která se nalézá v Liberci v Hanychově na adrese:
		Zemědělská 18a/302, 460 08 Liberec 8 (<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:lounge"), ENT_COMPAT) ?>
">mapa klubovny</a>). 
		Jednou za čtrnáct dní (v sobotu) organizujeme výpravy, na které jezdíme do bližšího i vzdálenějšího 
		okolí Liberce. Přibližně šestkrát do roka pořádáme výpravu vícedenní a o jarních prázdninách 
		dokonce týdenní výpravu. Naše celoroční činnost je završena táborem, který trvá tři týdny. Tábor se 
		koná na začátku letních prázdnin a již řadu let jezdíme na louku nedaleko vesnice Vápno za Českým 
		Dubem. Stanujeme tu v malebném údolí řeky Zábrdky v indiánských tee-pee.</p>
		<p>Naše činnost a program akcí jsou zaměřeny nejen na výlety do přírody a její poznávání, ale
		též na rozvíjení osobnostních stránek dětí. Učíme je různým dovednostem pomocí her a soutěží. 
		Námi pořádané klasické výpravy do přírody jsou zpestřené například výlety do bazénu, na lyže 
		(běžky, sjezdovky i snowboard), na horolezeckou stěnu či na vodu.</p>
		<p>Náš oddíl funguje již od roku 1983 a vedou ho dospělí a zkušení vedoucí, kteří mají splněny 
		vůdcovské zkoušky. Během těchto zkoušek museli prokázat znalosti z oborů pedagogiky, 
		psychologie, zdravovědy, práva, práce s mládeží, principů skautingu, hospodaření a dalších. 
		Zároveň museli absolvovat zdravotní kurz pořádaný Českým Červeným křížem. Těmto vedoucím při 
		vedení pomáhají ještě tzv. roveři, což jsou středoškoláci, kteří prošli oddílem a nyní se podílí na 
		přípravě programu.</p>
		<p>Častý dotaz je, kolik peněz členství v našem oddíle stojí. Jednou ročně se platí členské 
		příspěvky ve výši 550 Kč, na jednodenní výpravu vybíráme kolem 70,- Kč a na vícedenní kolem 400 
		Kč (dle její délky). Tábor, který trvá tři týdny, stojí přibližně 3600 Kč. Nezaručujeme, že se ceny 
		vůbec nezmění, ale určitě ne o mnoho. V rámci těchto poplatků je Váš syn zároveň pojištěn proti 
		úrazu a vedoucí jsou navíc pojištěni i na škodu, kterou by děti případně způsobily.</p>
		<p>Na schůzky i výpravy bude Váš syn potřebovat několik základních věcí. Jednou z nich je 
		uzlák, což je 1,5 - 2 metry dlouhý silnější provaz, dále KPZ (viz úkol z Nováčkovské zkoušky), papír, 
		tužka, Mustangy (oddílová platidla), Přijímací a Nováčkovská zkouška a průvodce k ní. Na výpravy 
		bude ještě kromě těchto věcí potřebovat pláštěnku, dobré boty, vhodné oblečení, šátek, nůž, jídlo a 
		pití. Na vícedenní výpravy bude dále potřebovat velký batoh, spacák, karimatku, ešus (ne vždy), 
		lžíci a rébl (pevnější igelit 2x4 metry, který mu po splnění nováčkovské dáme). Některé z těchto 
		věcí můžeme na začátek zapůjčit, ale je lepší si co nejdříve obstarat vlastní vybavení. Když si při 
		nákupu těchto věcí nebudete vědět rady, nebojte se obrátit na někoho ze zkušených vedoucích, 
		kteří Vám rádi poradí s jejich výběrem. V zimě jezdíme na běžky nebo sjezdovky a byla by škoda, 
		kdyby s námi Váš syn nemohl jezdit jen proto, že by je neměl. V naší klubovně máme na výběr 
		starší, ale stále dobré sjezdovky i běžky. Není tudíž nutné utrácet zbytečně peníze za jejich nákup, 
		když z nich brzy chlapec vyroste, ale tyto lyže mu můžeme na zimu půjčit.</p>
		<p>Na naše akce naopak nepatří elektronika a hlavně zapnuté mobilní telefony. Na výpravách i
		schůzkách to narušuje program a děti se nenaučí takové samostatnosti. Telefon, na který můžete 
		vždy zavolat, má vedoucí oddílu a případně "kontaktní osoba", která je uvedená na lístečku k 
		výpravě. U tohoto člověka si můžete ověřit, zda je vše v pořádku a případně si můžete i s Vaším 
		synem popovídat.</p>
		<p>Informovat se o připravovaných akcích i dění v oddíle můžete kdykoliv telefonicky i emailem 
		u vedoucího oddílu. Dále pak na našich internetových stránkách. Před každou výpravou však děti 
		dostávají lísteček s informacemi o dané akci a vždy na první schůzce v měsíci dostávají <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Hlasinek:default"), ENT_COMPAT) ?>
">Hlásínek 
		(náš oddílový časopis)</a>, kde se dozvíte vše podstatné a aktuální. V případě zájmu Vám budeme 
		veškeré materiály zasílat i emailem. Vše je samozřejmě k dispozici i na našem webu. Dvakrát do 
		roka pro Vás připravuje i společné setkání - na začátku školního roku a pak před táborem. Rádi se 
		zde s Vámi uvidíme a uvítáme Vaše podněty k činnosti oddílu.</p>
		<p>Pokud budete mít jakékoliv další dotazy, můžete se obrátit na vedoucího oddílu.</p>

<?php if ($mainLeader) { ?>		<div style="float: right; text-align: right;">
		    <span class="bold"><?php echo Latte\Runtime\Filters::escapeHtml($mainLeader->title, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($mainLeader->name, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($mainLeader->surname, ENT_NOQUOTES) ?></span><br>vedoucí oddílu
		</div>
<?php } ?>

	</div>
</div>

<?php if ($leaders->fetch()) { ?><div class="box-outer">
	<span class="box-left-small">Vedení oddílu</span>
	<div class="box-doublelined-inner">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($leaders) as $leader) { $member = $leader->related('registration')->fetch() ?>
	    <?php if ($iterator->isFirst(2)) { ?><div style="overflow:hidden;"><?php } ?>

    	<div style="float:left; margin-bottom:10px; width:50%;">
		    <span class="bold"><?php echo Latte\Runtime\Filters::escapeHtml($leader->nickname, ENT_NOQUOTES) ?>
</span> - <?php echo Latte\Runtime\Filters::escapeHtml($leader->title, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($leader->name, ENT_NOQUOTES) ?> <?php echo Latte\Runtime\Filters::escapeHtml($leader->surname, ENT_NOQUOTES) ?><br>
	    	<?php if ($leader->user && $leader->user->mail) { ?><span class="bold" style="padding-left:10px;">
    		    E-mail:</span> <?php echo Latte\Runtime\Filters::escapeHtml($leader->user->mail, ENT_NOQUOTES) ?>
<br><?php } ?>

<?php if ($member && $member->mobile) { ?>
		    	<span class="bold" style="padding-left:10px;">
		    	Mobil:</span> <?php echo Latte\Runtime\Filters::escapeHtml($member->mobile, ENT_NOQUOTES) ?>
<br><?php } ?>

	    	<?php if ($member && $member->address) { ?><span class="bold" style="padding-left:10px;">
	    	    Adresa: </span><span style="display:inline-block; vertical-align:top;">
	    	    <?php echo $template->nl2br($member->address) ?></span><?php } ?>

	    </div>
	    <?php if ($iterator->isLast(2)) { ?></div><?php } ?>

<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
	</div>
</div>
<?php } 
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

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 