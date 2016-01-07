<?php
namespace Models;

/**
 * Registration model
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Registration extends Repository {

    /** @var string */
    protected $table = "registration";

    /**
     * Returns registration by pseudo-primary key
     *
     * @param mixed $key
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    public function get($key) {
        return $this->getBy(['member_nickname' => $key]);
    }

    /**
     * All the groups available in registration
     *
     * @return array
     */
    public function getAllGroups() {
        return $this->findAll()
            ->select('DISTINCT oddil')
            ->fetchPairs('oddil', 'oddil');
    }

    /**
     * All the members of particular group
     *
     * @param $group string                     Name of the group
     * @return \Nette\Database\Table\Selection
     */
    public function getMembersOfGroup($group) {
        return $this->findBy([
                'oddil' => $group
            ])
            ->order('member_nickname ASC');
    }
} 