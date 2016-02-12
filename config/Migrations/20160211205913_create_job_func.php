<?php
use Migrations\AbstractMigration;

class CreateJobFunc extends AbstractMigration
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
        $table = $this->table('job_funcs');
        $table->addColumn('process_name', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => false,
        ]);
        $table->addColumn('process_status', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);
        $table->addColumn('process_opt', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ]);
        $table->addColumn('func_name', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => false,
        ]);
        $table->addColumn('func_status', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('func_opt', 'string', [
            'default' => null,
            'limit' => 15,
            'null' => true,
        ]);
        $table->addColumn('func_data', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
