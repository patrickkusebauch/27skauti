<?php
use Nette\Security;

/**
 * Users authenticator
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Authenticator extends Nette\Object implements Security\IAuthenticator
{
	/** @var Nette\Database\Context */
	private $database;

	/**
	 * Connects to the database by DI
	 * @param Nette\Database\Context $database
	 */
	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	/**
	 * Performs an authentication.
	 * @param array $credentials (string $username, string $password)
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->database->table('user')
			->where('username', $username)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('Uživatel s tímto jménem neexistuje.', self::IDENTITY_NOT_FOUND);
		}
        elseif (!Security\Passwords::verify($password, $row->password)) {
			throw new Security\AuthenticationException('Nesprávné heslo.', self::INVALID_CREDENTIAL);
		}
        elseif (!$row->active) {
			throw new Security\AuthenticationException('Účet není aktivovaný.', self::NOT_APPROVED);
		}
        elseif (Security\Passwords::needsRehash($row->password)) {
            $row->update(array(
                'password' => Security\Passwords::hash($password),
            ));
        }

		$arr = $row->toArray();
		unset($arr['password']);
		$roles = $row->related('privilege')->fetch()->toArray();
		unset($roles['user_id']);
		//adds privileges
		array_walk($roles, function(&$value, $key) use (&$roles){
			if($value != NULL) $value = $key . ' - ' . $value;
		});
		return new Security\Identity($row->id, $roles, $arr);
	}

}
