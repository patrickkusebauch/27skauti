<?php
namespace Models;
/**
 * News model
 * 
 * Represents the news published on the website
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class News extends Repository
{
    /** @var string */
    protected $table = "news";

    /**
     * Return all News allowed for viewing
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getAll() {
        return $this->findBy(['show' => 1])
            ->order('posted DESC');
    }

    /**
     * Return X newest News on the website as a Collection
     *
     * @param int $limit                        How many news to return
     * @return \Nette\Database\Table\Selection
     */
    public function getNewest($limit)
    {
    	return $this->findBy(['show' => 1])
			->order('posted DESC')
			->limit($limit);
    }

    /**
     * Get all news ordered by the time they were posted
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getOrderedNews() {
        return $this->findAll()->order('posted DESC');
    }

    /**
     * Do you want to show the news post
     *
     * @param int $id                           News ID
     * @param bool|NULL $show                   Do you want to show the news post (NULL for flip from current state)
     * @return \Nette\Database\Table\ActiveRow  Affected row
     * @throws \Nette\InvalidArgumentException  If $show is not bool/NULL
     */
    public function showNews($id, $show = NULL) {
        $post = $this->get($id);
        if((($post->show == 1) && ($show === NULL)) || $show === FALSE) {
            $post->update(['show' => 0]);
        } elseif((($post->show == 0) && ($show === NULL)) || $show === TRUE) {
            $post->update(['show' => 1]);
        } else {
            throw new \Nette\InvalidArgumentException("Second argument of showNews must be a bool|NULL, '$show' given");
        }
        return $post;
    }

}
