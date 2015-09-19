<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Role cell
 */
class RoleCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->set('user_roles', ['admin' => 'Admin', 'author' => 'Author']);
    }
}
