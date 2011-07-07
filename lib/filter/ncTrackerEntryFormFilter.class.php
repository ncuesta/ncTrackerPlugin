<?php

/**
 * ncTrackerEntry filter form.
 *
 * @package    plugins
 * @subpackage filter
 * @author     José Nahuel Cuesta Luengo <nahuelcuestaluengo@gmail.com>
 */
class ncTrackerEntryFormFilter extends BasencTrackerEntryFormFilter
{
  private
    $user_ids     = null,
    $module_names = null,
    $action_names = null;

  public function configure()
  {
    $this->getWidget('ip_address')->setOption('with_empty', false);
    $this->getWidget('created_at')
      ->setOption('with_empty', false)
      ->setOption('template', 'From %from_date%<br />to %to_date%');

    $this->setWidget('user_id', new sfWidgetFormChoice(array(
      'choices' => $this->getUserChoices()
    )));
    $this->setValidator('user_id', new sfValidatorChoice(array(
      'choices'  => array_keys($this->getUserChoices()),
      'required' => false
    )));

    $this->setWidget('module_name', new ncWidgetFormModulesChoice(array(
      'choices' => $this->getModuleChoices()
    )));
    $this->setValidator('module_name', new sfValidatorChoice(array(
      'choices'  => array_keys($this->getModuleChoices()),
      'required' => false
    )));

    $this->setWidget('action_name', new ncWidgetFormActionsChoices(array(
      'choices' => $this->getActionChoices()
    )));
    $this->setValidator('action_name', new sfValidatorChoice(array(
      'choices'  => array_keys($this->getActionChoices()),
      'required' => false
    )));

    $this->useFields(array(
      'user_id',
      'module_name',
      'action_name',
      'ip_address',
      'created_at'
    ));
  }

  protected function getUserChoices()
  {
    if (null === $this->user_ids)
    {
      $user_ids = ncTrackerEntryPeer::retrieveAllValuesForColumn(ncTrackerEntryPeer::USER_ID);
      
      $this->user_ids = array('' => '');
      
      if (count($user_ids) > 0)
      {
        $this->user_ids = $this->user_ids + array_combine($user_ids, $user_ids);
      }
    }

    return $this->user_ids;
  }

  protected function getModuleChoices()
  {
    if (null === $this->module_names)
    {
      $module_names = ncTrackerEntryPeer::retrieveAllValuesForColumn(ncTrackerEntryPeer::MODULE_NAME);

      $this->module_names = array('' => '');

      if (count($module_names) > 0)
      {
         $this->module_names = $this->module_names + array_combine($module_names, $module_names);
      }
    }

    return $this->module_names;
  }

  protected function getActionChoices()
  {
    if (null === $this->action_names)
    {
      $action_names = ncTrackerEntryPeer::retrieveAllValuesForColumn(ncTrackerEntryPeer::ACTION_NAME);

      $this->action_names = array('' => '');

      if (count($action_names) > 0)
      {
        $this->action_names = $this->action_names + array_combine($action_names, $action_names);
      }
    }

    return $this->action_names;
  }

}
