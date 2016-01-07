<?php
namespace AdminModule;

/**
 * Admin side specific common extensions
 *
 * @author Patrick Kusebauch
 * @version 2.00, 09. 11. 2014
 */
abstract class BasePresenter extends \BasePresenter
{
	/**
     * Component can be tied to specific presenter-action by annotation
     * {@inheritdoc}
	 */
	protected function createComponent($name)
	{
		$ucname = ucfirst($name);
		$method = 'createComponent' . $ucname;

		$presenterReflection = $this->getReflection();
		if ($presenterReflection->hasMethod($method)) {
			$reflection = $presenterReflection->getMethod($method);
			$this->checkRequirements($reflection);

			$annotations = (array) $reflection->getAnnotation('Action');
			if (!empty($annotations) && !in_array($this->getAction(), $annotations)) {
				throw new \Nette\Application\ForbiddenRequestException("Creation of component '$name' is forbidden for action '$this->action'.");
			}

			return parent::createComponent($name);
		}
	}
}
