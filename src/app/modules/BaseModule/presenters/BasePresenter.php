<?php
use \Nette\Security\IUserStorage;

/**
 * Base application presenter
 *
 * Add common functionality to all presenters in frontend & backend
 *
 * @author Patrick Kusebauch
 * @version 3.00, 09. 11. 2014
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter
{

    /**
	 * Check permissions by annotations
	 * {@inheritdoc}
	 */
	public function checkRequirements($element)
	{
		parent::checkRequirements($element);
		if ($element instanceof \Nette\Reflection\ClassType) {return;}; //not checking class access, only method access
        $user = $this->user;
        // Allowing for both method level and class level annotations
		$class = ($element instanceof \Nette\Reflection\Method) ? $element->getDeclaringClass() : $element;
        $secured = $element->getAnnotation('Secured') || $class->getAnnotation('Secured');

		if ($secured) {
			if (!$user->isLoggedIn()) {
				if ($user->getLogoutReason() === IUserStorage::INACTIVITY) {
					$this->flashMessage("Byl jsi odhlášen, protože jsi nebyl po dlouhou dobu aktivní.");
				} else {
                    $this->flashMessage("Pro vstup do této části webu se musíš přihlásit.");
                }
				$this->redirect(":Front:Default:Sign:in", array("backlink" => $this->storeRequest()));
			} else {
                //check existence of resource
                if (!($element->hasAnnotation('Resource') || $class->hasAnnotation('Resource'))) {
                    throw new \Nette\InvalidStateException('Secured method is missing a resource.');
                }
                $resource = $element->hasAnnotation('Resource') ? $element->getAnnotation('Resource') : $class->getAnnotation('Resource');
                $privileges = array_merge((array) $class->getAnnotation('Privilege'), (array) $element->getAnnotation('Privilege'));
                $allowed = FALSE;
                foreach ($privileges as $privilege) {
                    if ($user->isAllowed($resource, $privilege)) $allowed = TRUE;
                }
                if (!$allowed) {
                    throw new \Nette\Application\ForbiddenRequestException("Pro vstup do této části webu nemáte dostatečná oprávnění", 403);
                }
            }

		}
	}

    /**
     * Adds new helpers into the templates
     * {@inheritdoc}
     */
    protected function createTemplate($class = NULL)
    {
        $template = parent::createTemplate($class);
        $template->registerHelperLoader('Helpers::loader');
        return $template;
    }

    /**
     * Handles logging out the user on all/any pages
     */
    public function handleOut()
	{
		$this->getUser()->logout(TRUE);
		$this->flashMessage('Odhlášení proběhlo úspěšně.');
		$this->redirect('this');
	}

    /**
     * Adding useful variables for use in view.
     */
    protected function beforeRender()
	{
        $this->template->config = $this->context->parameters;
	}

    /**
     * Sign-in form factory.
     *
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignInForm()
    {
        $form = new \Nette\Application\UI\Form;
        $form->addText('username', 'Jméno:')
            ->setRequired('Vložte přihlašovací jméno.');

        $form->addPassword('password', 'Heslo:')
            ->setRequired('Vložte své heslo.');

        $form->addCheckbox('remember', 'Zůstat přihlášen');
        $form->addSubmit('send', 'Přihlásit');

        // form presentation
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['pair']['container'] = NULL;
        $renderer->wrappers['label']['container'] = NULL;
        $renderer->wrappers['control']['container'] = 'div';

        $form->onSuccess[] = $this->signInFormSucceeded;
        return $form;
    }

    /**
     * Processing of Sign In Form
     *
     * @param \Nette\Application\UI\Form $form
     */
    public function signInFormSucceeded(\Nette\Application\UI\Form $form)
    {
        $values = $form->getValues();

        if ($values->remember) {
            $this->getUser()->setExpiration('14 days', FALSE);
        } else {
            $this->getUser()->setExpiration('40 minutes', TRUE);
        }

        try {
            $this->getUser()->login($values->username, $values->password);
            $this->redirect('this');

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }
}
