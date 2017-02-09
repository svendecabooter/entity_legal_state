<?php

namespace Drupal\entity_legal_state;

use Drupal\entity_legal\EntityLegalDocumentInterface;

interface EntityLegalStateInterface {

  /**
   * Get the published version for a document from state.
   *
   * @param \Drupal\entity_legal\EntityLegalDocumentInterface $legal_document
   *   The legal document config entity.
   * @param string $version_value
   *   The EntityLegalDocumentVersion ID to alter.
   *
   * @return string
   *   The ID of the published EntityLegalDocumentVersion entity.
   */
  public function getPublishedVersion(EntityLegalDocumentInterface $legal_document, $version_value);

  /**
   * Update the published version in state.
   *
   * @param \Drupal\entity_legal\EntityLegalDocumentInterface $legal_document
   *   The legal document config entity.
   * @param string $version_value
   *   The EntityLegalDocumentVersion ID to save.
   */
  public function updateStateVersion(EntityLegalDocumentInterface $legal_document, $version_value);

}
