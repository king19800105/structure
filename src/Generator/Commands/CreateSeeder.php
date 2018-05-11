<?php

namespace Anthony\Structure\Generator\Commands;

use Illuminate\Console\Command;
use Anthony\Structure\Generator\GeneratorHelp;

class CreateSeeder extends Command
{
    use GeneratorHelp;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anthony:seeder {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Create Seeder';

    protected $name;

    protected const COMMAND_KEY = 'seeder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->generatorInit();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->name = ucfirst($this->argument('name'));
        $this->callCommand(static::COMMAND_KEY, $this->name, 'make:seeder');
        $this->callCommand('factory', $this->name, 'make:factory');
    }
}
