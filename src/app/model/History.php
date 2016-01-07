<?php
namespace Models;
/**
 * History model
 * 
 * Represents the history of "27. oddíl Mustang Liberec"
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class History extends Repository
{
    /** @var string */
    protected $table = "history";

    /**
     * Ordered histories of the group
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getOrderedHistories() {
        return $this->findAll()->order('year DESC');
    }

}
