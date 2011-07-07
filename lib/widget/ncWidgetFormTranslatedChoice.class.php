<?php

/**
 * ncWidgetFormTranslatedChoice
 *
 * @author José Nahuel Cuesta Luengo <ncuesta@cespi.unlp.edu.ar>
 */
class ncWidgetFormTranslatedChoice extends sfWidgetFormChoice
{
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addRequiredOption('catalogue');
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $current_catalogue = strval($this->parent->getFormFormatter()->getTranslationCatalogue());

    $this->parent->getFormFormatter()->setTranslationCatalogue($this->getOption('catalogue'));

    $response = parent::render($name, $value, $attributes, $errors);

    $this->parent->getFormFormatter()->setTranslationCatalogue($current_catalogue);

    return $response;
  }
}
