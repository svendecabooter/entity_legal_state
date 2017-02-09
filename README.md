# Description

This module stores the entity_legal document "published version" info 
in Drupal state, rather than in the config entity itself.

This is useful when trying to avoid this setting being reverted inadvertently, 
e.g. by an (automated) deployment changing the reference to the 
EntityLegalDocumentVersion content entity.
It is also useful in cases where you have different version entities on 
different environments.

# Usage

Just enable the module, and document's published versions will be stored via
the Drupal State API instead.
