<?php

/**
 * @file
 * Adds extra functionality to the entity_legal module.
 *
 * Stores entity_legal published version config in state rather than config
 * entities.
 */

namespace Drupal\entity_legal_state;

use Drupal\Core\State\StateInterface;
use Drupal\entity_legal\EntityLegalDocumentInterface;

/**
 * EntityLegalState service.
 *
 * @package Drupal\entity_legal_state
 */
class EntityLegalState implements EntityLegalStateInterface {

  /**
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * EntityLegalState constructor.
   *
   * @param \Drupal\Core\State\StateInterface $state
   *  The state service.
   */
  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public function getPublishedVersion(EntityLegalDocumentInterface $legal_document, $version_value) {
    if ($version_value == NULL || $version_value == 'retrieve_from_state') {
      // Retrieve the current version of the document.
      return $this->getStateVersion($legal_document);
    }
    else {
      // Check whether to change published version or not.
      if ($version_value != $this->getStateVersion($legal_document)) {
        // New published version is set in the entity. We need to update state.
        $this->updateStateVersion($legal_document, $version_value);
      }
      return $version_value;
    }
  }

  /**
   * Get the published version from state.
   * @TODO: add to interface
   *
   * @param \Drupal\entity_legal\EntityLegalDocumentInterface $legal_document
   *   The legal document config entity.
   *
   * @return string
   *   The ID of the published EntityLegalDocumentVersion entity.
   */
  public function getStateVersion(EntityLegalDocumentInterface $legal_document) {
    $version_from_state = $this->state->get('entity_legal_state.' . $legal_document->id());
    // If empty, retrieve a fake placeholder, to avoid changes to config entity.
    if (!$version_from_state) {
      $version_from_state = 'retrieve_from_state';
    }
    return $version_from_state;
  }

  /**
   * {@inheritdoc}
   */
  public function updateStateVersion(EntityLegalDocumentInterface $legal_document, $version_value) {
    $this->state->set('entity_legal_state.' . $legal_document->id(), $version_value);
  }

}
