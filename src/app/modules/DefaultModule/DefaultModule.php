<?php

namespace DefaultModule;

use \Nette\Application\Routers\Route;

class DefaultModule {

    const MODULE_NAME = 'Default';

    public static function createRoutes($router, $prefix)
    {
        $router[] = new Route('index.php', 'Front:Default:Homepage:default', Route::ONE_WAY);

        $router[] = new Route($prefix . 'admin/<presenter>/<action>[/<id>]', array(
            //'module' => self::MODULE_NAME . ':Admin',
            'module' => 'Admin:Default',
            'presenter' => array(
                Route::VALUE => 'Homepage',
                Route::FILTER_TABLE => array(
                    // řetězec v URL => presenter
                    'isskaut' => 'Skautis',
                ),
            ),
            'action' => 'default',
        ));

        $router[] = new Route($prefix . '<presenter>/<action>[/<id>]', array(
            //'module' => self::MODULE_NAME . ':Front',
            'module' => 'Front:Default',
            'presenter' => array(
                Route::VALUE => 'Homepage',
                Route::FILTER_TABLE => array(
                    // řetězec v URL => presenter
                    'aktuality' => 'News',
                    'akce' => 'Event',
                    'kronika' => 'Chronicle',
                    'organizace' => 'Organization',
                    'knihanavstev' => 'Guestbook',
                    'prihlaseni' => 'Sign',
                ),
            ),
            'action' => array(
                Route::VALUE => 'default',
                Route::FILTER_TABLE => array(
                    // řetězec v URL => akce
                    'zapomenuteHeslo' => 'forgot',
                    'registrace' => 'register',
                    'aktivace' => 'activate',
                    'nabor' => 'recruit',
                    'prorodice' => 'parent',
                    'klubovna' => 'lounge',
                    'detailKlubovny' => 'loungeDetail',
                    'detailFotky' => 'detailPicture',
                    'kontakty' => 'contact',
                    'pridejse' => 'join',
                    'akce' => 'event',
                    'aktuality' => 'news',
                    'archiv' => 'archive',
                    'vedeni' => 'leader',
                    'roveri' => 'ranger',
                    'novacci' => 'newbie',
                    'oldskauti' => 'oldscout',
                    'historieOddilu' => 'history',
                ),
            ),
        ));
    }

    /**
     * Sets up permissions for the module
     * @param \Acl $acl
     */
    public static function createPrivileges($acl)
    {
        self::addBasePermissions($acl);
        self::addVIPChroniclePermissions($acl);
        self::addOrganizationPermissions($acl);
        self::addGuestbookPermissions($acl);
        self::addPrivilegePermissions($acl);
        self::addChroniclePermissions($acl);
        self::addEventPermissions($acl);
        self::addHlasinekPermissions($acl);
        self::addNewsPermissions($acl);
    }

    /**
     * @param \Acl $acl
     */
    private function addBasePermissions($acl) {
        $acl->addRole('guest');
        $acl->addRole('base - člen', 'guest');

        $acl->addResource(self::MODULE_NAME . ':Admin:Homepage');
        $acl->addResource(self::MODULE_NAME . ':Admin:User');
        $acl->addResource(self::MODULE_NAME . ':Admin:Oddil');

        $acl->allow('base - člen', self::MODULE_NAME . ':Admin:User', 'default');
        $acl->allow('base - člen', self::MODULE_NAME . ':Admin:Homepage', 'default');
        $acl->allow('base - člen', self::MODULE_NAME . ':Admin:Oddil', 'default');
    }

    /**
     * @param \Acl $acl
     */
    private function addEventPermissions($acl) {
        $acl->addRole('event - vstup');
        $acl->addRole('event - vytváření/editace', 'event - vstup');
        $acl->addRole('event - zobrazování', 'event - vytváření/editace');
        $acl->addRole('event - mazání', 'event - zobrazování');

        $acl->addResource(self::MODULE_NAME . ':Admin:Event');

        $acl->allow('event - vstup', self::MODULE_NAME . ':Admin:Event', 'default');
        $acl->allow('event - vytváření/editace', self::MODULE_NAME . ':Admin:Event', 'create');
        $acl->allow('event - vytváření/editace', self::MODULE_NAME . ':Admin:Event', 'createcalendar');
        $acl->allow('event - vytváření/editace', self::MODULE_NAME . ':Admin:Event', 'edit');
        $acl->allow('event - vytváření/editace', self::MODULE_NAME . ':Admin:Event', 'editcalendar');
        $acl->allow('event - zobrazování', self::MODULE_NAME . ':Admin:Event', 'show');
        $acl->allow('event - zobrazování', self::MODULE_NAME . ':Admin:Event', 'showcalendar');
        $acl->allow('event - mazání', self::MODULE_NAME . ':Admin:Event', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addGuestbookPermissions($acl) {
        $acl->addRole('guestbook - vstup');
        $acl->addRole('guestbook - editace', 'guestbook - vstup');
        $acl->addRole('guestbook - zobrazování', 'guestbook - editace');
        $acl->addRole('guestbook - mazání', 'guestbook - zobrazování');

        $acl->addResource(self::MODULE_NAME . ':Admin:Guestbook');

        $acl->allow('guestbook - vstup', self::MODULE_NAME . ':Admin:Guestbook', 'default');
        $acl->allow('guestbook - editace', self::MODULE_NAME . ':Admin:Guestbook', 'edit');
        $acl->allow('guestbook - editace', self::MODULE_NAME . ':Admin:Organization', 'default');//user verification
        $acl->allow('guestbook - zobrazování', self::MODULE_NAME . ':Admin:Guestbook', 'show');
        $acl->allow('guestbook - mazání', self::MODULE_NAME . ':Admin:Guestbook', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addHlasinekPermissions($acl) {
        $acl->addRole('hlasinek - vstup');
        $acl->addRole('hlasinek - vytváření', 'hlasinek - vstup');
        $acl->addRole('hlasinek - mazání', 'hlasinek - vytváření');

        $acl->addResource(self::MODULE_NAME . ':Admin:Hlasinek');

        $acl->allow('hlasinek - vstup', self::MODULE_NAME . ':Admin:Hlasinek', 'default');
        $acl->allow('hlasinek - vytváření', self::MODULE_NAME . ':Admin:Hlasinek', 'addall');
        $acl->allow('hlasinek - mazání', self::MODULE_NAME . ':Admin:Hlasinek', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addChroniclePermissions($acl) {
        $acl->addRole('chronicle - vstup');
        $acl->addRole('chronicle - vytváření/editace', 'chronicle - vstup');
        $acl->addRole('chronicle - popisky', 'chronicle - vytváření/editace');
        $acl->addRole('chronicle - generování', 'chronicle - popisky');
        $acl->addRole('chronicle - zobrazování', 'chronicle - generování');
        $acl->addRole('chronicle - mazání', 'chronicle - zobrazování');

        $acl->addResource(self::MODULE_NAME . ':Admin:Chronicle');
        $acl->addResource(self::MODULE_NAME . ':Admin:History');

        $acl->allow('chronicle - vstup', self::MODULE_NAME . ':Admin:Chronicle', 'default');
        $acl->allow('chronicle - vstup', self::MODULE_NAME . ':Admin:History', 'default');
        $acl->allow('chronicle - vytváření/editace', self::MODULE_NAME . ':Admin:Chronicle', 'create');
        $acl->allow('chronicle - vytváření/editace', self::MODULE_NAME . ':Admin:Chronicle', 'edit');
        $acl->allow('chronicle - popisky', self::MODULE_NAME . ':Admin:Chronicle', 'photos');
        $acl->allow('chronicle - popisky', self::MODULE_NAME . ':Admin:Chronicle', 'videos');
        $acl->allow('chronicle - generování', self::MODULE_NAME . ':Admin:Chronicle', 'generate');
        $acl->allow('chronicle - zobrazování', self::MODULE_NAME . ':Admin:Chronicle', 'show');
        $acl->allow('chronicle - zobrazování', self::MODULE_NAME . ':Admin:History', 'create');
        $acl->allow('chronicle - zobrazování', self::MODULE_NAME . ':Admin:History', 'edit');
        $acl->allow('chronicle - mazání', self::MODULE_NAME . ':Admin:Chronicle', 'delete');
        $acl->allow('chronicle - mazání', self::MODULE_NAME . ':Admin:History', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addNewsPermissions($acl) {
        $acl->addRole('news - vstup');
        $acl->addRole('news - vytváření/editace', 'news - vstup');
        $acl->addRole('news - zobrazování', 'news - vytváření/editace');
        $acl->addRole('news - mazání', 'news - zobrazování');

        $acl->addResource(self::MODULE_NAME . ':Admin:News');

        $acl->allow('news - vstup', self::MODULE_NAME . ':Admin:News', 'default');
        $acl->allow('news - vytváření/editace', self::MODULE_NAME . ':Admin:News', 'create');
        $acl->allow('news - vytváření/editace', self::MODULE_NAME . ':Admin:News', 'edit');
        $acl->allow('news - zobrazování', self::MODULE_NAME . ':Admin:News', 'show');
        $acl->allow('news - mazání', self::MODULE_NAME . ':Admin:News', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addOrganizationPermissions($acl) {
        $acl->addRole('registration - vstup');
        $acl->addRole('registration - vytváření/editace', 'registration - vstup');
        $acl->addRole('registration - mazání', 'registration - vytváření/editace');

        $acl->addResource(self::MODULE_NAME . ':Admin:Registration');
        $acl->addResource(self::MODULE_NAME . ':Admin:Organization');

        $acl->allow('registration - vstup', self::MODULE_NAME . ':Admin:Registration', 'default');
        $acl->allow('registration - vstup', self::MODULE_NAME . ':Admin:Organization', 'default');
        $acl->allow('registration - vytváření/editace', self::MODULE_NAME . ':Admin:Registration', 'create');
        $acl->allow('registration - vytváření/editace', self::MODULE_NAME . ':Admin:Registration', 'edit');
        $acl->allow('registration - vytváření/editace', self::MODULE_NAME . ':Admin:Organization', 'create');
        $acl->allow('registration - vytváření/editace', self::MODULE_NAME . ':Admin:Organization', 'edit');
        $acl->allow('registration - mazání', self::MODULE_NAME . ':Admin:Registration', 'delete');
        $acl->allow('registration - mazání', self::MODULE_NAME . ':Admin:Organization', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addPrivilegePermissions($acl) {
        $acl->addRole('privilege - vstup');
        $acl->addRole('privilege - vytváření/editace', 'privilege - vstup');
        $acl->addRole('privilege - mazání', 'privilege - vytváření/editace');

        $acl->addResource(self::MODULE_NAME . ':Admin:Privilege');

        $acl->allow('privilege - vstup', self::MODULE_NAME . ':Admin:Privilege', 'default');
        $acl->allow('privilege - vytváření/editace', self::MODULE_NAME . ':Admin:Privilege', 'create');
        $acl->allow('privilege - vytváření/editace', self::MODULE_NAME . ':Admin:Privilege', 'edit');
        $acl->allow('privilege - mazání', self::MODULE_NAME . ':Admin:Privilege', 'delete');
    }

    /**
     * @param \Acl $acl
     */
    private function addVIPChroniclePermissions($acl) {
        $acl->addRole('vip - vstup');
        $acl->addRole('vip - vytváření/editace', 'vip - vstup');
        $acl->addRole('vip - popisky', 'vip - vytváření/editace');
        $acl->addRole('vip - generování', 'vip - popisky');
        $acl->addRole('vip - zobrazování', 'vip - generování');
        $acl->addRole('vip - mazání', 'vip - zobrazování');

        $acl->addResource(self::MODULE_NAME . ':Admin:Vipchronicle');

        $acl->allow('vip - vstup', self::MODULE_NAME . ':Admin:Vipchronicle', 'default');
        $acl->allow('vip - vytváření/editace', self::MODULE_NAME . ':Admin:Vipchronicle', 'create');
        $acl->allow('vip - vytváření/editace', self::MODULE_NAME . ':Admin:Vipchronicle', 'edit');
        $acl->allow('vip - popisky', self::MODULE_NAME . ':Admin:Vipchronicle', 'photos');
        $acl->allow('vip - generování', self::MODULE_NAME . ':Admin:Vipchronicle', 'generate');
        $acl->allow('vip - zobrazování', self::MODULE_NAME . ':Admin:Vipchronicle', 'show');
        $acl->allow('vip - mazání', self::MODULE_NAME . ':Admin:Vipchronicle', 'delete');
    }
} 