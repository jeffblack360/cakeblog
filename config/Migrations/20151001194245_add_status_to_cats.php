<?php
use Migrations\AbstractMigration;

class AddStatusToCats extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('cats');
        $table->addColumn('status', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->update();
    }
}
