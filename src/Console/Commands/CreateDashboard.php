<?php

namespace AlexBowers\MultipleDashboard\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateDashboard extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:dashboard {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a dashboard for Nova.';

    protected $type = 'Dashboard';
    
    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);
    
        $stub = str_replace('uri-key', Str::snake($this->argument('name'), '-'), $stub);
    
        return str_replace('dashboard-name', ucwords(Str::snake($this->argument('name'), ' ')), $stub);
    }
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return realpath(__DIR__ . '/../stubs/dashboard.stub');
    }
    
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Nova\Dashboards';
    }
}
