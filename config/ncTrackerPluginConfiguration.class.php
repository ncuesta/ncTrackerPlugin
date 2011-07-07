<?php

class ncTrackerPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    if (sfConfig::get('app_nc_tracker_plugin_register_routes', true) && in_array('nc_tracker_entry', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array($this, 'registerRoutes'));
    }
  }

  /**
   * Register the needed routes for this plugin.
   * This method is intended to be used as a 'routing.load_configuration'
   * event listener.
   * 
   * @param sfEvent $event The dispatched event.
   */
  public function registerRoutes(sfEvent $event)
  {
    $event->getSubject()->prependRoute('nc_tracker_entry', new sfPropelRouteCollection(array(
      'name'                 => 'nc_tracker_entry',
      'model'                => 'ncTrackerEntry',
      'module'               => 'nc_tracker_entry',
      'prefix_path'          => '/nc_tracker_entry',
      'column'               => 'id',
      'with_wildcard_routes' => true
    )));
  }
}