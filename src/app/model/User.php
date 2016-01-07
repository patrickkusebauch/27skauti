<?php
namespace Models;
/**
 * User model
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 */
class User extends Repository{

    /**
     * Activates a user based in its ID
     *
     * @param int $id               User's ID
     */
    public function activate($id){
        $user = $this->get($id);
        $user->update([
            'active' => 1,
            'token' => NULL,
            'issuedate' => NULL,
        ]);
        $this->database->table('privilege')
            ->insert([
                'user_id' => $user->id,
                'base' => 'člen'
            ]);
    }

    protected $table = 'user';

    /**
     * Return a user by its username
     *
     * @param string $username                          User's username
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    public function getByUsername($username) {
        return $this->getBy(['username' => $username]);
    }

    /**
     * @param string $username                          User's username
     * @param string $token                             Activation token
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    public function getByUsernameAndToken($username, $token) {
        return $this->getBy([
                'username' => $username,
                'token' => $token,
            ]);
    }

    /**
     * Return a user by its username
     *
     * @param string $mail                              User's mail
     * @return FALSE|\Nette\Database\Table\ActiveRow
     */
    public function getByMail($mail) {
        return $this->getBy(['mail' => $mail]);
    }

    /**
     * All the users ordered by their username
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getOrderedUsers() {
        return $this->findAll()
            ->order('username ASC');
    }

    /**
     * Users that are not connected to any member
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getUnconnectedUsers(){
        $ids = $this->database->table('member')->where([
                'user_id NOT' => NULL,
            ])
            ->fetchPairs('nickname', 'user_id');
        return $this->findBy([
                'NOT (id ?)' => array_values($ids),
            ])
            ->order('username ASC');
    }

    /**
     * Is there a need to create new token?
     *
     * @param int $id                               User's id
     * @return bool                                 Is the token expired
     */
    public function needsRetoken($id) {
        $row = $this->get($id);
        $now = \Nette\Utils\DateTime::from('NOW');
        $issuedate = $row->issuedate;
        if (is_null($issuedate)) return TRUE;
        $passed = $issuedate->diff($now);
        if($passed->days > 7 && ($passed->invert === 0)) { //token is too old
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Registers a user
     *
     * @param string $username              User's username
     * @param string $password              User's password
     * @param string $mail                  Activation mail
     * @return string                       Registration token
     */
    public function register($username, $password, $mail){
        $hashedPassword = \Nette\Security\Passwords::hash($password);
        $this->insert([
            'username' => $username,
            'password' => $hashedPassword,
            'mail' => $mail,
        ]);
        $user = $this->getByUsername($username);
        return $this->updateToken($user->id);
    }

    /**
     * Updates password is a user forgot it
     *
     * @param int $id
     * @param string $password
     */
    public function updatePassword($id, $password) {
        $hashedPassword = \Nette\Security\Passwords::hash($password);
        $this->get($id)->update([
            'password' => $hashedPassword,
            'token' => NULL,
            'issuedate' => NULL,
        ]);
    }

    /**
     * Updates the token
     *
     * @param int $id               User's ID
     * @return string               New token
     */
    public function updateToken($id) {
        $now = \Nette\Utils\DateTime::from('NOW');
        $token = \Nette\Utils\Random::generate(60);
        $user = $this->get($id);
        $user->update([
            'token' => $token,
            'issuedate' => $now,
        ]);
        return $token;
    }
}