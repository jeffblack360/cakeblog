<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * Hello shell command.
 */
class HelloShell extends Shell
{

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $this->out('Hello world');
        
    }
    
    /**
    * Name of method
    *
    * Purpose of method
    *
    * @return void
    */
    public function heyThere($name = 'Anonymous')
    {
        $this->out('Hey there '. $name);
    }
}
