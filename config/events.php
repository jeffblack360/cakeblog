<?php

use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Log\Log;
use App\Model\Entity\User;

/**
 * Attach custom events
 *
 */

EventManager::instance()->attach(function (Event $event, User $entity, ArrayObject $options) {
    Log::write('info', 'UsersTable.afterSave fired! '. $entity->username);
}, 'UsersTable.afterSave');