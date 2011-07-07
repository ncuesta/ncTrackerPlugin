<?php

/**
 * ncIncognitoActions
 *
 * Base class for actions that should not be tracked.
 *
 * @author José Nahuel Cuesta Luengo <ncuesta@cespi.unlp.edu.ar>
 */
abstract class ncIncognitoActions extends sfActions
{
  /**
   * This actions should not be tracked.
   *
   * @return bool
   */
  public function isTrackable()
  {
    return false;
  }
}
