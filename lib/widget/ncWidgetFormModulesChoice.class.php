<?php

/**
 * ncWidgetFormModulesChoice
 *
 * @author José Nahuel Cuesta Luengo <ncuesta@cespi.unlp.edu.ar>
 */
class ncWidgetFormModulesChoice extends ncWidgetFormTranslatedChoice
{
  public function __construct($options = array(), $attributes = array())
  {
    $options['catalogue'] = 'modules';

    parent::__construct($options, $attributes);
  }
}
