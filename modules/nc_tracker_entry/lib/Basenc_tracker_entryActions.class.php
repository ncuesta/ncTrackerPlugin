<?php

/**
 * Basenc_tracker_entryActions
 *
 * @author José Nahuel Cuesta Luengo <ncuesta@cespi.unlp.edu.ar>
 */
class Basenc_tracker_entryActions extends autoNc_tracker_entryActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->getUser()->setFlash('error', 'Hand-creation of tracking entries is forbidden.');
    
    $this->redirect('@nc_tracker_entry');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->executeNew($request);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->getUser()->setFlash('error', 'Hand-edition of tracking entries is forbidden.');

    $this->redirect('@nc_tracker_entry');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->executeEdit($request);
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->getUser()->setFlash('error', 'Deletion of tracking entries is forbidden.');

    $this->redirect('@nc_tracker_entry');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->ncTrackerEntry = $this->getRoute()->getObject();
  }
}
