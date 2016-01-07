<?php
namespace Models;
/**
 * Member model
 * 
 * Represents the members of Mustang Liberec
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Member extends Repository
{
    /**
     * Gets all members that have an account connected to them
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getAuthenticatedUsers(){
        return $this->findAll()
            ->where('user_id IS NOT NULL')
            ->order('nickname ASC');
    }

    /** @var string */
    protected $table = "member";

    /**
     * Gets the main leader of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\ActiveRow
     */
    public function getLeader() {
    	return $this->findAll()
            ->where('group LIKE', '%Vedoucí oddílu%')
			->limit(1)
			->fetch();
    }

    /**
     * Gets all the leaders of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getLeaders() {
        return $this->findAll()
            ->where('group LIKE', '%Vedoucí%')
    		->order('stripe ASC')
			->order('entered ASC');
    }

    /**
     * All the members that don't have registration
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getMembersWithoutRegistration() {
        $nicknames = $this->database->table('registration')->where([
            'member_nickname NOT' => NULL,
        ])
            ->fetchPairs('member_nickname', 'member_nickname');
        return $this->findBy([
            'NOT (nickname ?)' => array_values($nicknames),
        ])
            ->order('nickname ASC');
    }

    /**
     * Gets all the "Mloky" of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getMloci() {
        return $this->findAll()
            ->where('group LIKE', '%Mlok%')
            ->order('stripe DESC')
            ->order('entered ASC');
    }

    /**
     * Gets all the newbies of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getNewbies(){
        return $this->findAll()
            ->where('group LIKE', '%Nováček%')
            ->order('entered ASC');
    }

    /**
     * Gets all the oldscouts of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getOldscouts() {
        return $this->findAll()
            ->where('group LIKE', '%Oldskaut%')
            ->order('entered ASC');
    }

    /**
     * Returns all the members ordered by their stripes and group
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getOrderedMembers() {
        return $this->findAll()
            ->order('stripe DESC')
            ->order('group DESC');
    }

    /**
     * Gets all the rangers of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getRangers() {
        return $this->findAll()
            ->where('group LIKE', '%Rover%')
			->order('stripe ASC')
			->order('entered ASC');
    }

    /**
     * Gets all the "Tučňáky" of "27. oddíl střediska Mustang Liberec"
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getTucnaci() {
        return $this->findAll()
            ->where('group LIKE', '%Tučňák%')
			->order('stripe DESC')
			->order('entered ASC');
    }
}
