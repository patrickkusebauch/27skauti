<?php
use Nette\Security\Permission;
/**
 * Access Control List
 *
 * @author Patrick Kusebauch
 * @version 2.00, 10. 11. 2014
 */
class Acl extends Permission
{

    /**
     * Set up privileges
     *
     * Be careful with the ordering as some might require
     * others to be already called.
     */
    public function __construct()
    {
        $this->addBaseConfig();
        $this->addVIPChronicleConfig();
        $this->addOrganizationConfig();
        $this->addGuestbookConfig();
        $this->addPrivilegeConfig();
        $this->addChronicleConfig();
        $this->addEventConfig();
        $this->addHlasinekConfig();
        $this->addNewsConfig();
        \OddilModule\OddilModule::createPrivileges($this);
        //\DefaultModule\DefaultModule::createPrivileges($this);
    }

    private function addBaseConfig() {
        $this->addRole('guest');
        $this->addRole('base - člen', 'guest');

        $this->addResource('Admin:Default:Homepage');
        $this->addResource('Admin:Default:User');
        $this->addResource('Admin:Default:Oddil');

        $this->allow('base - člen', 'Admin:Default:User', 'default');
        $this->allow('base - člen', 'Admin:Default:Homepage', 'default');
        $this->allow('base - člen', 'Admin:Default:Oddil', 'default');
    }

    private function addEventConfig() {
        $this->addRole('event - vstup');
        $this->addRole('event - vytváření/editace', 'event - vstup');
        $this->addRole('event - zobrazování', 'event - vytváření/editace');
        $this->addRole('event - mazání', 'event - zobrazování');

        $this->addResource('Admin:Default:Event');

        $this->allow('event - vstup', 'Admin:Default:Event', 'default');
        $this->allow('event - vytváření/editace', 'Admin:Default:Event', 'create');
        $this->allow('event - vytváření/editace', 'Admin:Default:Event', 'createcalendar');
        $this->allow('event - vytváření/editace', 'Admin:Default:Event', 'edit');
        $this->allow('event - vytváření/editace', 'Admin:Default:Event', 'editcalendar');
        $this->allow('event - zobrazování', 'Admin:Default:Event', 'show');
        $this->allow('event - zobrazování', 'Admin:Default:Event', 'showcalendar');
        $this->allow('event - mazání', 'Admin:Default:Event', 'delete');
    }

    private function addGuestbookConfig() {
        $this->addRole('guestbook - vstup');
        $this->addRole('guestbook - editace', 'guestbook - vstup');
        $this->addRole('guestbook - zobrazování', 'guestbook - editace');
        $this->addRole('guestbook - mazání', 'guestbook - zobrazování');

        $this->addResource('Admin:Default:Guestbook');

        $this->allow('guestbook - vstup', 'Admin:Default:Guestbook', 'default');
        $this->allow('guestbook - editace', 'Admin:Default:Guestbook', 'edit');
        $this->allow('guestbook - editace', 'Admin:Default:Organization', 'default');//user verification
        $this->allow('guestbook - zobrazování', 'Admin:Default:Guestbook', 'show');
        $this->allow('guestbook - mazání', 'Admin:Default:Guestbook', 'delete');
    }

    private function addHlasinekConfig() {
        $this->addRole('hlasinek - vstup');
        $this->addRole('hlasinek - vytváření', 'hlasinek - vstup');
        $this->addRole('hlasinek - mazání', 'hlasinek - vytváření');

        $this->addResource('Admin:Default:Hlasinek');

        $this->allow('hlasinek - vstup', 'Admin:Default:Hlasinek', 'default');
        $this->allow('hlasinek - vytváření', 'Admin:Default:Hlasinek', 'addall');
        $this->allow('hlasinek - mazání', 'Admin:Default:Hlasinek', 'delete');
    }

    private function addChronicleConfig() {
        $this->addRole('chronicle - vstup');
        $this->addRole('chronicle - vytváření/editace', 'chronicle - vstup');
        $this->addRole('chronicle - popisky', 'chronicle - vytváření/editace');
        $this->addRole('chronicle - generování', 'chronicle - popisky');
        $this->addRole('chronicle - zobrazování', 'chronicle - generování');
        $this->addRole('chronicle - mazání', 'chronicle - zobrazování');

        $this->addResource('Admin:Default:Chronicle');
        $this->addResource('Admin:Default:History');

        $this->allow('chronicle - vstup', 'Admin:Default:Chronicle', 'default');
        $this->allow('chronicle - vstup', 'Admin:Default:History', 'default');
        $this->allow('chronicle - vytváření/editace', 'Admin:Default:Chronicle', 'create');
        $this->allow('chronicle - vytváření/editace', 'Admin:Default:Chronicle', 'edit');
        $this->allow('chronicle - popisky', 'Admin:Default:Chronicle', 'photos');
        $this->allow('chronicle - popisky', 'Admin:Default:Chronicle', 'videos');
        $this->allow('chronicle - generování', 'Admin:Default:Chronicle', 'generate');
        $this->allow('chronicle - zobrazování', 'Admin:Default:Chronicle', 'show');
        $this->allow('chronicle - zobrazování', 'Admin:Default:History', 'create');
        $this->allow('chronicle - zobrazování', 'Admin:Default:History', 'edit');
        $this->allow('chronicle - mazání', 'Admin:Default:Chronicle', 'delete');
        $this->allow('chronicle - mazání', 'Admin:Default:History', 'delete');
    }

    private function addNewsConfig() {
        $this->addRole('news - vstup');
        $this->addRole('news - vytváření/editace', 'news - vstup');
        $this->addRole('news - zobrazování', 'news - vytváření/editace');
        $this->addRole('news - mazání', 'news - zobrazování');

        $this->addResource('Admin:Default:News');

        $this->allow('news - vstup', 'Admin:Default:News', 'default');
        $this->allow('news - vytváření/editace', 'Admin:Default:News', 'create');
        $this->allow('news - vytváření/editace', 'Admin:Default:News', 'edit');
        $this->allow('news - zobrazování', 'Admin:Default:News', 'show');
        $this->allow('news - mazání', 'Admin:Default:News', 'delete');
    }

    private function addOrganizationConfig() {
        $this->addRole('registration - vstup');
        $this->addRole('registration - vytváření/editace', 'registration - vstup');
        $this->addRole('registration - mazání', 'registration - vytváření/editace');

        $this->addResource('Admin:Default:Registration');
        $this->addResource('Admin:Default:Organization');

        $this->allow('registration - vstup', 'Admin:Default:Registration', 'default');
        $this->allow('registration - vstup', 'Admin:Default:Organization', 'default');
        $this->allow('registration - vytváření/editace', 'Admin:Default:Registration', 'create');
        $this->allow('registration - vytváření/editace', 'Admin:Default:Registration', 'edit');
        $this->allow('registration - vytváření/editace', 'Admin:Default:Organization', 'create');
        $this->allow('registration - vytváření/editace', 'Admin:Default:Organization', 'edit');
        $this->allow('registration - mazání', 'Admin:Default:Registration', 'delete');
        $this->allow('registration - mazání', 'Admin:Default:Organization', 'delete');
    }

    private function addPrivilegeConfig() {
        $this->addRole('privilege - vstup');
        $this->addRole('privilege - vytváření/editace', 'privilege - vstup');
        $this->addRole('privilege - mazání', 'privilege - vytváření/editace');

        $this->addResource('Admin:Default:Privilege');

        $this->allow('privilege - vstup', 'Admin:Default:Privilege', 'default');
        $this->allow('privilege - vytváření/editace', 'Admin:Default:Privilege', 'create');
        $this->allow('privilege - vytváření/editace', 'Admin:Default:Privilege', 'edit');
        $this->allow('privilege - mazání', 'Admin:Default:Privilege', 'delete');
    }

    private function addVIPChronicleConfig() {
        $this->addRole('vip - vstup');
        $this->addRole('vip - vytváření/editace', 'vip - vstup');
        $this->addRole('vip - popisky', 'vip - vytváření/editace');
        $this->addRole('vip - generování', 'vip - popisky');
        $this->addRole('vip - zobrazování', 'vip - generování');
        $this->addRole('vip - mazání', 'vip - zobrazování');

        $this->addResource('Admin:Default:Vipchronicle');

        $this->allow('vip - vstup', 'Admin:Default:Vipchronicle', 'default');
        $this->allow('vip - vytváření/editace', 'Admin:Default:Vipchronicle', 'create');
        $this->allow('vip - vytváření/editace', 'Admin:Default:Vipchronicle', 'edit');
        $this->allow('vip - popisky', 'Admin:Default:Vipchronicle', 'photos');
        $this->allow('vip - generování', 'Admin:Default:Vipchronicle', 'generate');
        $this->allow('vip - zobrazování', 'Admin:Default:Vipchronicle', 'show');
        $this->allow('vip - mazání', 'Admin:Default:Vipchronicle', 'delete');
    }
}
