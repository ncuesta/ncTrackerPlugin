<?php


/**
 * Skeleton subclass for representing a row from the 'nc_tracker_entry' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jun 27 03:16:29 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    plugins.ncTrackerPlugin.lib.model
 */
class ncTrackerEntry extends BasencTrackerEntry
{
  const ANONYMOUS = 'anonymous';

  public function __toString()
  {
    return strval($this->getId());
  }
  
  public function fromAction(sfAction $action)
  {
    $this->fromArray(array(
      'user_id'     => $this->getUserIdFromAction($action),
      'module_name' => $action->getModuleName(),
      'action_name' => $action->getActionName(),
      'referrer'    => $action->getRequest()->getReferer(),
      'ip_address'  => $action->getRequest()->getRemoteAddress()
    ), BasePeer::TYPE_FIELDNAME);
  }

  private function getUserIdFromAction(sfAction $action)
  {
    $user = $action->getContext()->getUser();

    if (null === $user || (method_exists($user, 'isAuthenticated') && !$user->isAuthenticated()))
    {
      $user_id = self::ANONYMOUS;
    }
    else
    {
      $user_id = $user->getUsername();
    }

    return $user_id ? $user_id : self::ANONYMOUS;
  }
} // ncTrackerEntry
