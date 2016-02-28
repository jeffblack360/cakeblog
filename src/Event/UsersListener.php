<?php
namespace App\Event;

use Cake\Log\Log;
use Cake\Event\EventListenerInterface;

/**
 * Implement UsersListener
 *
 * @author jb
 */
class UsersListener implements EventListenerInterface
{
    public function implementedEvents() {
        return array(
            'Model.Users.afterAdd' => 'addUserJobFunc',
        );
    }

    public function addUserJobFunc($event) {
        Log::write(
                'info', 'A new user was added with id: ' . $event->data['user']['id']);
    }

}
