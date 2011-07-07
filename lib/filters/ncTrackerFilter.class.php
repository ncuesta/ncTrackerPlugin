<?php

/**
 * ncTrackerFilter
 *
 * @author José Nahuel Cuesta Luengo <nahuelcuestaluengo@gmail.com>
 */
class ncTrackerFilter extends sfFilter
{
  /**
   * Executes this filter.
   *
   * @param sfFilterChain $filter_chain The filter chain
   */
  public function execute(sfFilterChain $filter_chain)
  {
    $action_instance = $this->context->getController()->getActionStack()->getLastEntry()->getActionInstance();

    // Keep track only of trackable actions
    if ($this->isTrackable($action_instance))
    {
      try
      {
        $entry = ncTrackerEntryPeer::createFromAction($action_instance);

        $this->log('Created a new ncTrackerEntry.');
      }
      catch (PropelException $exception)
      {
        $this->log(
          sprintf('Unable to create a new ncTrackerEntry. Error message: %s.', $exception->getMessage())
        );
      }
    }
    else
    {
      $this->log(
        sprintf('Ignored non-trackable action: %s/%s.', $action_instance->getModuleName(), $action_instance->getActionName())
      );
    }

    $filter_chain->execute($filter_chain);
  }

  /**
   * Answer whether $action should be tracked.
   *
   * @param  sfAction $action The action to test.
   *
   * @return bool Whether the action should be tracked or not.
   */
  protected function isTrackable(sfAction $action)
  {
    if (method_exists($action, 'isTrackable') && !$action->isTrackable())
    {
      return false;
    }

    if (!$this->getOption('track_ajax', true) && $this->isAjax($action))
    {
      return false;
    }

    if (!$this->getOption('track_errors', true) && $this->isError($action))
    {
      return false;
    }
    else if ($this->isError($action))
    {
      return true;
    }

    if (!$this->getOption('track_non_secure', true) && !$action->isSecure())
    {
      return false;
    }

    return true;
  }

  /**
   * Answer whether $action has an error response.
   *
   * @param  sfAction $action The action to test.
   *
   * @return bool Whether the response is an error.
   */
  private function isError(sfAction $action)
  {
    return $action->getResponse()->getStatusCode() != '200';
  }

  /**
   * Answer whether $action is an ajax request (XMLHttpRequest).
   *
   * @param sfAction $action The action to test.
   *
   * @return bool Whether the request is ajax.
   */
  private function isAjax(sfAction $action)
  {
    return $action->getRequest()->isXmlHttpRequest();
  }

  /**
   * Get the value of an option set for this filter via app.yml.
   * 
   * @param string $option  The option key.
   * @param mixed  $default The default value for the option.
   *
   * @return mixed The user-set value or $default.
   */
  private function getOption($option, $default = null)
  {
    return sfConfig::get('app_nc_tracker_plugin_'.$option, $default);
  }

  /**
   * Log a message using the event dispatcher. This method will only log messages
   * if logging is enabled.
   * 
   * @param  string $message The message to log.
   *
   * @return void
   */
  protected function log($message)
  {
    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->context->getEventDispatcher()->notify(new sfEvent(
        $this, 'application.log', array($message)
      ));
    }

  }
}
