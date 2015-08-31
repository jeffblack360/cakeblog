<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

    /**
    * Hash the User password
    *
    * @var string
    */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
    
    /**
    * Hash the User password on display
    *
    * @var string
    */
    protected function _getHashedUsername()
    {
        $username = $this->_properties['username'];
        return (new DefaultPasswordHasher)->hash($username);
    }    
}
