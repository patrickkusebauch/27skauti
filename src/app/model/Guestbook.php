<?php
namespace Models;
/**
 * Guestbook model
 * 
 * Represents the guestbook
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
class Guestbook extends Repository
{
    /** @var string */
    protected $table = "guestbook";

    /**
     * Deletes an individual post
     *
     * @param int $id   post ID
     * @return int      number of affected rows (1|0)
     */
    public function deletePost($id) {
        return $this->get($id)->delete();
    }

    /**
     * Return Collection of ALL guestbook post allowed for viewing
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getAllViewable() {
    	return $this->findBy(['show' => 1])
			->order('time DESC');
    }

    /**
     * Return all posts ordered by the time they were posted
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getOrderedPosts() {
        return $this->findAll()->order('time DESC');
    }

    /**
     * Return a subset of guestbook post allowed for viewing
     *
     * @param int $limit                        How many results to return
     * @return \Nette\Database\Table\Selection
     */
    public function getViewableSubset($limit = NULL) {
        return $this->findBy(['show' => 1])
			->order('time DESC')
			->limit($limit);
    }

    /**
     * Do you want to show the post
     *
     * @param int $id                           Guestbook post ID
     * @param bool|NULL $show                   Do you want to show the post (NULL for flip from current state)
     * @return \Nette\Database\Table\ActiveRow  Affected row
     * @throws \Nette\InvalidArgumentException  If $show is not bool|NULL
     */
    public function showPost($id, $show = NULL) {
        $post = $this->get($id);
        if((($post->show == 1) && ($show === NULL)) || $show === FALSE) {
            $post->update(['show' => 0]);
        } elseif((($post->show == 0) && ($show === NULL)) || $show === TRUE) {
            $post->update(['show' => 1]);
        } else {
            throw new \Nette\InvalidArgumentException("Second argument of showPost must be a bool|NULL, '$show' given");
        }
        return $post;
    }
}
