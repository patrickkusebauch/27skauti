<?php
/**
 * @author Patrick Kusebauch
 * @version 1.01, 26. 10. 2014
 */

namespace skauti;

/**
 * Finder class for files
 * 
 * Adds the possibility to order found files by certain conditions
 */
class Finder extends \Nette\Utils\Finder
{
	/** @var callback */
	private $order;

	/**
	 * Sets the order comparison function
	 * @param callback $order
	 * @return \skauti\Finder
	 */
	public function order($order)
	{
		$this->order = $order;
		return $this;
	}

	/**
	 * Orders results by name
	 * @return \skauti\Finder
	 */
	public function orderByName()
	{
		$this->order = function($f1, $f2) {
			return \strcasecmp($f1->getFilename(), $f2->getFilename());
		};
		return $this;
	}

	/**
	 * Orders results by time
	 * @return \skauti\Finder
	 */
	public function orderByMTime()
	{
	    $this->order = function($f1, $f2) {
	        return $f1->getMTime() - $f2->getMTime();
	    };
		return $this;
	}


	/**
	 * Returns iterator.
	 * @return \Iterator
	 */
	 public function getIterator()
	 {
	 	$iterator = parent::getIterator();
		if ($this->order === NULL) {
			return $iterator;
		}

		$iterator = new \ArrayIterator(\iterator_to_array($iterator));
		$iterator->uasort($this->order);
	    return $iterator;
	}

}
?>
