<?php
namespace Models;
/**
 * Privilege model
 * 
 * Represents the set of privileges for users.
 * Changing any code in this class can break how access to certain part of the 
 * website is determined. Therefore make sure you absolutely know what you are 
 * doing when altering the code in this class.
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Privilege extends Repository
{
    /** @var string */
    protected $table = "privilege";

    /**
     * Get the row of privileges for a user
     *
     * @param int $id                           User ID
     * @return \Nette\Database\Table\ActiveRow
     */
    public function getPersonalPrivileges($id) {
        return $this->getBy(['user_id' => $id]);
    }
}
