<?php
namespace Models;
/**
 * Repository template for models
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
abstract class Repository extends \Nette\Object
{
    /** @var \Nette\Database\Context */
    protected $database;

    /** @var string */
    protected $table;

    /**
     * Database connection
     *
     * @param \Nette\Database\Context $database
     */
    public function __construct(\Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    /**
     * Vrátí všechny platné záznamy
     *
     * @return \Nette\Database\Table\Selection
     */
    public function findAll()
    {
        return $this->database->table($this->table);
    }


    /**
     * Vrátí kolekci záznamů podle podmínky
     *
     * @param array
     * @return \Nette\Database\Table\Selection
     */
    public function findBy($where)
    {
        return $this->findAll()->where($where);
    }


    /**
     * Vrátí záznam podle primárního klíče
     *
     * @param int
     * @return \Nette\Database\Table\ActiveRow|FALSE
     */
    public function get($id)
    {
        return $this->findAll()->get($id);
    }


    /**
     * Vrátí jeden záznam podle podmínky
     *
     * @param array
     * @return \Nette\Database\Table\ActiveRow|FALSE
     */
    public function getBy($where)
    {
        return $this->findAll()->where($where)->fetch();
    }



    /**
     * Vloží nový záznam do tabulky
     *
     * @param array
     * @return \Nette\Database\Table\IRow|int
     */
    public function insert($data)
    {
        return $this->database->table($this->table)->insert($data);
    }

}