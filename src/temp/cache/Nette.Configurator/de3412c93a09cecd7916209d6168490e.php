<?php
// source: /vagrant/src/app/config/config.neon 

/**
 * @property Nette\Application\Application $application
 * @property Authenticator $authenticator
 * @property Acl $authorizator
 * @property Nette\Caching\Storages\FileStorage $cacheStorage
 * @property Models\Calendar $calendar
 * @property Nette\DI\Container $container
 * @property Models\Event $event
 * @property Models\Guestbook $guestbook
 * @property Models\History $history
 * @property Nette\Http\Request $httpRequest
 * @property Nette\Http\Response $httpResponse
 * @property Models\Member $member
 * @property Nette\Bridges\Framework\NetteAccessor $nette
 * @property Models\News $news
 * @property Models\Notebook $notebook
 * @property Models\Privilege $privilege
 * @property Models\Registration $registration
 * @property Nette\Application\IRouter $router
 * @property RouterFactory $routerFactory
 * @property Nette\Http\Session $session
 * @property SkautIS\SkautIS $skautis
 * @property Models\Songbook $songbook
 * @property Models\Stezky $stezky
 * @property Nette\Security\User $user
 * @property Models\User $users
 */
class SystemContainer extends Nette\DI\Container
{

	protected $meta = array(
		'types' => array(
			'nette\\object' => array(
				'nette',
				'nette.cacheJournal',
				'cacheStorage',
				'nette.httpRequestFactory',
				'httpRequest',
				'httpResponse',
				'nette.httpContext',
				'session',
				'nette.userStorage',
				'user',
				'application',
				'nette.presenterFactory',
				'nette.mailer',
				'nette.templateFactory',
				'nette.database.default',
				'nette.database.default.context',
				'thumbnail.thumbnail',
				'authorizator',
				'authenticator',
				'calendar',
				'event',
				'guestbook',
				'history',
				'member',
				'news',
				'notebook',
				'privilege',
				'registration',
				'songbook',
				'stezky',
				'users',
				'container',
			),
			'nette\\bridges\\framework\\netteaccessor' => array('nette'),
			'nette\\caching\\storages\\ijournal' => array('nette.cacheJournal'),
			'nette\\caching\\storages\\filejournal' => array('nette.cacheJournal'),
			'nette\\caching\\istorage' => array('cacheStorage'),
			'nette\\caching\\storages\\filestorage' => array('cacheStorage'),
			'nette\\http\\requestfactory' => array('nette.httpRequestFactory'),
			'nette\\http\\irequest' => array('httpRequest'),
			'nette\\http\\request' => array('httpRequest'),
			'nette\\http\\iresponse' => array('httpResponse'),
			'nette\\http\\response' => array('httpResponse'),
			'nette\\http\\context' => array('nette.httpContext'),
			'nette\\http\\session' => array('session'),
			'nette\\security\\iuserstorage' => array('nette.userStorage'),
			'nette\\http\\userstorage' => array('nette.userStorage'),
			'nette\\security\\user' => array('user'),
			'nette\\application\\application' => array('application'),
			'nette\\application\\ipresenterfactory' => array('nette.presenterFactory'),
			'nette\\application\\presenterfactory' => array('nette.presenterFactory'),
			'nette\\application\\irouter' => array('router'),
			'nette\\mail\\imailer' => array('nette.mailer'),
			'nette\\mail\\sendmailmailer' => array('nette.mailer'),
			'nette\\bridges\\applicationlatte\\ilattefactory' => array('nette.latteFactory'),
			'nette\\application\\ui\\itemplatefactory' => array('nette.templateFactory'),
			'nette\\bridges\\applicationlatte\\templatefactory' => array('nette.templateFactory'),
			'nette\\database\\connection' => array('nette.database.default'),
			'nette\\database\\context' => array('nette.database.default.context'),
			'skautis\\skautis' => array('skautis'),
			'kollarovic\\thumbnail\\abstractgenerator' => array('thumbnail.thumbnail'),
			'kollarovic\\thumbnail\\generator' => array('thumbnail.thumbnail'),
			'nette\\security\\permission' => array('authorizator'),
			'nette\\security\\iauthorizator' => array('authorizator'),
			'acl' => array('authorizator'),
			'nette\\security\\iauthenticator' => array('authenticator'),
			'authenticator' => array('authenticator'),
			'models\\repository' => array(
				'calendar',
				'event',
				'guestbook',
				'history',
				'member',
				'news',
				'notebook',
				'privilege',
				'registration',
				'songbook',
				'stezky',
				'users',
			),
			'models\\calendar' => array('calendar'),
			'models\\event' => array('event'),
			'models\\guestbook' => array('guestbook'),
			'models\\history' => array('history'),
			'models\\member' => array('member'),
			'models\\news' => array('news'),
			'models\\notebook' => array('notebook'),
			'models\\privilege' => array('privilege'),
			'models\\registration' => array('registration'),
			'models\\songbook' => array('songbook'),
			'models\\stezky' => array('stezky'),
			'models\\user' => array('users'),
			'routerfactory' => array('routerFactory'),
			'nette\\di\\container' => array('container'),
		),
	);


	public function __construct()
	{
		parent::__construct(array(
			'appDir' => '/vagrant/src/app',
			'wwwDir' => '/vagrant/src/www',
			'debugMode' => FALSE,
			'productionMode' => TRUE,
			'environment' => 'production',
			'consoleMode' => FALSE,
			'container' => array(
				'class' => 'SystemContainer',
				'parent' => 'Nette\\DI\\Container',
				'accessors' => TRUE,
			),
			'tempDir' => '/vagrant/src/app/../temp',
			'chroniclePhotosStorage' => '/images/chronicle',
			'historyPhotosStorage' => '/images/history',
			'loungePhotosStorage' => '/images/lounge',
			'memberPhotosStorage' => '/images/organization/profile',
			'stripePhotosStorage' => '/images/organization/stripes',
			'hlasinekStorage' => '/files/hlasinek',
			'baseChronicleYear' => '1983',
			'baseEventYear' => '2005',
			'contactMail' => 'ondrej.petrovsky@email.cz',
			'supportMail' => 'lukasssss@centrum.cz',
		));
	}


	/**
	 * @return Nette\Application\Application
	 */
	public function createServiceApplication()
	{
		$service = new Nette\Application\Application($this->getService('nette.presenterFactory'), $this->getService('router'), $this->getService('httpRequest'), $this->getService('httpResponse'));
		$service->catchExceptions = TRUE;
		$service->errorPresenter = 'Error';
		Nette\Bridges\ApplicationTracy\RoutingPanel::initializePanel($service);
		return $service;
	}


	/**
	 * @return Authenticator
	 */
	public function createServiceAuthenticator()
	{
		$service = new Authenticator($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Acl
	 */
	public function createServiceAuthorizator()
	{
		$service = new Acl;
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\FileStorage
	 */
	public function createServiceCacheStorage()
	{
		$service = new Nette\Caching\Storages\FileStorage('/vagrant/src/app/../temp/cache', $this->getService('nette.cacheJournal'));
		return $service;
	}


	/**
	 * @return Models\Calendar
	 */
	public function createServiceCalendar()
	{
		$service = new Models\Calendar($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Nette\DI\Container
	 */
	public function createServiceContainer()
	{
		return $this;
	}


	/**
	 * @return Models\Event
	 */
	public function createServiceEvent()
	{
		$service = new Models\Event($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Models\Guestbook
	 */
	public function createServiceGuestbook()
	{
		$service = new Models\Guestbook($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Models\History
	 */
	public function createServiceHistory()
	{
		$service = new Models\History($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Nette\Http\Request
	 */
	public function createServiceHttpRequest()
	{
		$service = $this->getService('nette.httpRequestFactory')->createHttpRequest();
		if (!$service instanceof Nette\Http\Request) {
			throw new Nette\UnexpectedValueException('Unable to create service \'httpRequest\', value returned by factory is not Nette\\Http\\Request type.');
		}
		return $service;
	}


	/**
	 * @return Nette\Http\Response
	 */
	public function createServiceHttpResponse()
	{
		$service = new Nette\Http\Response;
		return $service;
	}


	/**
	 * @return Models\Member
	 */
	public function createServiceMember()
	{
		$service = new Models\Member($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Nette\Bridges\Framework\NetteAccessor
	 */
	public function createServiceNette()
	{
		$service = new Nette\Bridges\Framework\NetteAccessor($this);
		return $service;
	}


	/**
	 * @return Nette\Caching\Cache
	 */
	public function createServiceNette__cache($namespace = NULL)
	{
		$service = new Nette\Caching\Cache($this->getService('cacheStorage'), $namespace);
		trigger_error('Service cache is deprecated.', 16384);
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\FileJournal
	 */
	public function createServiceNette__cacheJournal()
	{
		$service = new Nette\Caching\Storages\FileJournal('/vagrant/src/app/../temp');
		return $service;
	}


	/**
	 * @return Nette\Database\Connection
	 */
	public function createServiceNette__database__default()
	{
		$service = new Nette\Database\Connection('mysql:host=wm79.wedos.net;dbname=d88857_27skaut', 'w88857_27skaut', 'mpH3FhAP', NULL);
		Tracy\Debugger::getBlueScreen()->addPanel('Nette\\Bridges\\DatabaseTracy\\ConnectionPanel::renderException');
		return $service;
	}


	/**
	 * @return Nette\Database\Context
	 */
	public function createServiceNette__database__default__context()
	{
		$service = new Nette\Database\Context($this->getService('nette.database.default'), new Nette\Database\Reflection\DiscoveredReflection($this->getService('nette.database.default'), $this->getService('cacheStorage')), $this->getService('cacheStorage'));
		return $service;
	}


	/**
	 * @return Nette\Http\Context
	 */
	public function createServiceNette__httpContext()
	{
		$service = new Nette\Http\Context($this->getService('httpRequest'), $this->getService('httpResponse'));
		return $service;
	}


	/**
	 * @return Nette\Http\RequestFactory
	 */
	public function createServiceNette__httpRequestFactory()
	{
		$service = new Nette\Http\RequestFactory;
		$service->setProxy(array());
		return $service;
	}


	/**
	 * @return Latte\Engine
	 */
	public function createServiceNette__latte()
	{
		$service = new Latte\Engine;
		$service->setTempDirectory('/vagrant/src/app/../temp/cache/latte');
		$service->setAutoRefresh(FALSE);
		$service->setContentType('html');
		return $service;
	}


	/**
	 * @return Nette\Bridges\ApplicationLatte\ILatteFactory
	 */
	public function createServiceNette__latteFactory()
	{
		return new SystemContainer_Nette_Bridges_ApplicationLatte_ILatteFactoryImpl_nette_latteFactory($this);
	}


	/**
	 * @return Nette\Mail\SendmailMailer
	 */
	public function createServiceNette__mailer()
	{
		$service = new Nette\Mail\SendmailMailer;
		return $service;
	}


	/**
	 * @return Nette\Application\PresenterFactory
	 */
	public function createServiceNette__presenterFactory()
	{
		$service = new Nette\Application\PresenterFactory('/vagrant/src/app', $this);
		$service->setMapping(array(
			'module' => 'Module\\*s',
			'presenter' => 'Presenters\\*Presenter',
		));
		return $service;
	}


	/**
	 * @return Nette\Templating\FileTemplate
	 */
	public function createServiceNette__template()
	{
		$service = new Nette\Templating\FileTemplate;
		$service->registerFilter($this->getService('nette.latteFactory')->create());
		$service->registerHelperLoader('Nette\\Templating\\Helpers::loader');
		return $service;
	}


	/**
	 * @return Nette\Caching\Storages\PhpFileStorage
	 */
	public function createServiceNette__templateCacheStorage()
	{
		$service = new Nette\Caching\Storages\PhpFileStorage('/vagrant/src/app/../temp/cache', $this->getService('nette.cacheJournal'));
		trigger_error('Service templateCacheStorage is deprecated.', 16384);
		return $service;
	}


	/**
	 * @return Nette\Bridges\ApplicationLatte\TemplateFactory
	 */
	public function createServiceNette__templateFactory()
	{
		$service = new Nette\Bridges\ApplicationLatte\TemplateFactory($this->getService('nette.latteFactory'), $this->getService('httpRequest'), $this->getService('httpResponse'), $this->getService('user'), $this->getService('cacheStorage'));
		return $service;
	}


	/**
	 * @return Nette\Http\UserStorage
	 */
	public function createServiceNette__userStorage()
	{
		$service = new Nette\Http\UserStorage($this->getService('session'));
		return $service;
	}


	/**
	 * @return Models\News
	 */
	public function createServiceNews()
	{
		$service = new Models\News($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Models\Notebook
	 */
	public function createServiceNotebook()
	{
		$service = new Models\Notebook($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Models\Privilege
	 */
	public function createServicePrivilege()
	{
		$service = new Models\Privilege($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Models\Registration
	 */
	public function createServiceRegistration()
	{
		$service = new Models\Registration($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Nette\Application\IRouter
	 */
	public function createServiceRouter()
	{
		$service = $this->getService('routerFactory')->createRouter();
		if (!$service instanceof Nette\Application\IRouter) {
			throw new Nette\UnexpectedValueException('Unable to create service \'router\', value returned by factory is not Nette\\Application\\IRouter type.');
		}
		return $service;
	}


	/**
	 * @return RouterFactory
	 */
	public function createServiceRouterFactory()
	{
		$service = new RouterFactory;
		return $service;
	}


	/**
	 * @return Nette\Http\Session
	 */
	public function createServiceSession()
	{
		$service = new Nette\Http\Session($this->getService('httpRequest'), $this->getService('httpResponse'));
		$service->setExpiration('14 days');
		$service->setOptions(array(
			'cookiePath' => '/',
			'cookieDomain' => '.27skauti.cz',
		));
		return $service;
	}


	/**
	 * @return SkautIS\SkautIS
	 */
	public function createServiceSkautis()
	{
		$service = SkautIS\SkautIS::getInstance('cb32ee0e-543d-4998-8723-0dda08da4920', FALSE, TRUE);
		if (!$service instanceof SkautIS\SkautIS) {
			throw new Nette\UnexpectedValueException('Unable to create service \'skautis\', value returned by factory is not SkautIS\\SkautIS type.');
		}
		return $service;
	}


	/**
	 * @return Models\Songbook
	 */
	public function createServiceSongbook()
	{
		$service = new Models\Songbook($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Models\Stezky
	 */
	public function createServiceStezky()
	{
		$service = new Models\Stezky($this->getService('nette.database.default.context'));
		return $service;
	}


	/**
	 * @return Kollarovic\Thumbnail\Generator
	 */
	public function createServiceThumbnail__thumbnail()
	{
		$service = new Kollarovic\Thumbnail\Generator('/vagrant/src/www', $this->getService('httpRequest'), '{dir}/thumbs/{filename}-{width}x{height}.{extension}', 'http://dummyimage.com/{width}x{height}/efefef/f00&text=Image+not+found');
		return $service;
	}


	/**
	 * @return Nette\Security\User
	 */
	public function createServiceUser()
	{
		$service = new Nette\Security\User($this->getService('nette.userStorage'), $this->getService('authenticator'), $this->getService('authorizator'));
		return $service;
	}


	/**
	 * @return Models\User
	 */
	public function createServiceUsers()
	{
		$service = new Models\User($this->getService('nette.database.default.context'));
		return $service;
	}


	public function initialize()
	{
		date_default_timezone_set('Europe/Prague');
		ini_set('zlib.output_compression', TRUE);
		Nette\Bridges\Framework\TracyBridge::initialize();
		Nette\Caching\Storages\FileStorage::$useDirectories = TRUE;
		$this->getByType("Nette\Http\Session")->exists() && $this->getByType("Nette\Http\Session")->start();
		header('X-Frame-Options: SAMEORIGIN');
		header('X-Powered-By: Nette Framework');
		header('Content-Type: text/html; charset=utf-8');
		Nette\Utils\SafeStream::register();
		Nette\Reflection\AnnotationsParser::setCacheStorage($this->getByType("Nette\Caching\IStorage"));
		Nette\Reflection\AnnotationsParser::$autoRefresh = FALSE;
		$storage = $this->session->getSection("__SkautisExtension__");$this->skautis->setStorage($storage, TRUE);
	}

}



final class SystemContainer_Nette_Bridges_ApplicationLatte_ILatteFactoryImpl_nette_latteFactory implements Nette\Bridges\ApplicationLatte\ILatteFactory
{

	private $container;


	public function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new Latte\Engine;
		$service->setTempDirectory('/vagrant/src/app/../temp/cache/latte');
		$service->setAutoRefresh(FALSE);
		$service->setContentType('html');
		return $service;
	}

}
