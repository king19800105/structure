<?php

namespace Anthony\Structure\Generator\Commands;

use Illuminate\Console\Command;
use Anthony\Structure\Generator\GeneratorHelp;

class CreateResponse extends Command
{
    use GeneratorHelp;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phpno1:response {name} {--dir=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Create Response';

    protected $name;

    protected $option;

    protected $namespace;

    protected const COMMAND_KEY = 'response';

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
        $this->option = $this->option('dir') ?? '';
        $this->namespace = !empty($this->option)?'\\'.ucfirst($this->option):'';
        $tplContent = $this->getFullTplContent(static::COMMAND_KEY, $this->name, null);
        $this->writeFileByType(static::COMMAND_KEY, $this->name, $tplContent, $this->option);
    }

    protected function getTplVars()
    {
        return [
            'class_name'           => $this->name,
            'namespace'            => $this->getFullNamespaceByType(static::COMMAND_KEY).$this->namespace ,
        ];
    }
}
