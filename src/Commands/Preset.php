<?php

namespace Orchestra\Canvas\Commands;

use Illuminate\Support\Str;
use Orchestra\Canvas\Processors\GeneratesPresetConfiguration;
use Symfony\Component\Console\Input\InputOption;

class Preset extends Generator
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'preset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create canvas.yaml for the project';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Preset';

    /**
     * Generator processor.
     *
     * @var string
     */
    protected $processor = GeneratesPresetConfiguration::class;

    /**
     * Get the stub file for the generator.
     */
    public function getStubFile(): string
    {
        $name = $this->getNameInput();

        $directory = __DIR__.'/../../storage/preset';

        if (! $this->files->exists("{$directory}/{$name}.stub")) {
            $name = 'laravel';
        }

        return "{$directory}/{$name}.stub";
    }

    /**
     * Generator options.
     */
    public function generatorOptions(): array
    {
        return [
            'namespace' => $this->option('namespace'),
            'preset' => $this->getNameInput(),
        ];
    }

    /**
     * Get the desired class name from the input.
     */
    protected function getNameInput(): string
    {
        return Str::lower(\trim($this->argument('name')));
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['namespace', null, InputOption::VALUE_OPTIONAL, 'Root namespace'],
        ];
    }
}
