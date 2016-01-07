<?php

namespace OddilModule;

use Nette\Application\Routers\Route;

class OddilModule {

    const MODULE_NAME = 'Oddil';

    public static function createRoutes($router, $prefix)
    {
        $router[] = new Route($prefix . 'admin/<presenter>/<action>[/<id>]', array(
            'module' => self::MODULE_NAME . ':Admin',
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
            'module' => self::MODULE_NAME . ':Front',
            'presenter' => array(
                Route::VALUE => 'Homepage',
                Route::FILTER_TABLE => array(
                    // řetězec v URL => presenter
                    'bodovani' => 'Attendance',
                    'zapisnik' => 'Notebook',
                    'zpevnik' => 'Songbook',
                ),
            ),
            'action' => array(
                Route::VALUE => 'default',
                Route::FILTER_TABLE => array(
                    // řetězec v URL => akce
                    'zapomenuteHeslo' => 'forgot',
                ),
            ),
        ));
    }

    /**
     * Sets up permissions for the module
     *
     * @param \Acl $acl
     */
    public static function createPrivileges($acl)
    {
        $acl->addResource("Oddil:Homepage");
        $acl->allow("base - člen", "Oddil:Homepage", ["display", "default"]);

        $acl->addResource("Oddil:Notebook");
        $acl->allow("base - člen", "Oddil:Notebook", "display");

        $acl->addResource("Oddil:Attendance");
        $acl->allow("base - člen", "Oddil:Attendance", "display");

        $acl->addResource("Oddil:Stezky");
        $acl->allow("base - člen", "Oddil:Stezky", "display");

        self::addSongbookPrivileges($acl);
    }

    /**
     * Sets up permissions for the module
     *
     * @param \Acl $acl
     */
    public static function addSongbookPrivileges($acl)
    {
        $acl->addRole('songbook - vstup');
        $acl->addRole('songbook - vytváření/editace', 'songbook - vstup');
        $acl->addRole('songbook - mazání', 'songbook - vytváření/editace');

        $acl->addResource("Oddil:Songbook");

        $acl->allow("base - člen", "Oddil:Songbook", "display");
        $acl->allow("songbook - vstup", "Oddil:Songbook", "default");
        $acl->allow("songbook - vytváření/editace", "Oddil:Songbook", ["add", "edit"]);
        $acl->allow("songbook - mazání", "Oddil:Songbook", "delete");
    }
} 