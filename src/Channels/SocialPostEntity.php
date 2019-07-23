<?php
namespace OffbeatWP\SocialImporter\Channels;

abstract class SocialPostEntity {
    abstract public function getEntityType();

    public function getInternalId() {
        return $this->getEntityType() . '_' . $this->getId();
    }
}