<?php

/**
 * ncWidgetFormActionsChoices
 *
 * @author José Nahuel Cuesta Luengo <ncuesta@cespi.unlp.edu.ar>
 */
class ncWidgetFormActionsChoices extends ncWidgetFormTranslatedChoice
{
  public function __construct($options = array(), $attributes = array())
  {
    $options['catalogue'] = 'actions';

    parent::__construct($options, $attributes);
  }
}
